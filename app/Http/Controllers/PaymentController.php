<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use App\Models\SewingOrder;
use App\Models\InventoryTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'payable_type' => 'required|in:order,purchase,sewing_order',
            'payable_id' => 'required|integer',
            'amount' => 'required|numeric|min:0.00',
            // discount_amount will be stored on sewing_orders.discount_amount, not on payments
            'discount_amount' => 'nullable|numeric|min:0',
            'payment_method' => 'required|in:cash,online,bank_transfer,cheque',
            'person_reference' => 'nullable|string|max:255',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Determine the model based on payable_type
            if ($validated['payable_type'] === 'order') {
                $payable = Order::findOrFail($validated['payable_id']);
                $payableType = Order::class;
            } elseif ($validated['payable_type'] === 'sewing_order') {
                $payable = SewingOrder::findOrFail($validated['payable_id']);
                $payableType = SewingOrder::class;
            } else {
                $payable = InventoryTracking::findOrFail($validated['payable_id']);
                $payableType = InventoryTracking::class;
            }

            // Parse payment_date (handle datetime-local format)
            $paymentDate = $validated['payment_date'];
            if (strpos($paymentDate, 'T') !== false) {
                // datetime-local format: YYYY-MM-DDTHH:mm
                $paymentDate = str_replace('T', ' ', $paymentDate);
                if (strlen($paymentDate) === 16) {
                    // Add seconds if not present
                    $paymentDate .= ':00';
                }
            }

            // Create payment
                // Server-side validation: ensure amount + discount does not exceed remaining for orders and sewing orders
                if ($payable instanceof SewingOrder || $payable instanceof Order) {
                    $paidSoFar = $payable->payments()->where('type', 'payment')->sum('amount');
                    $refundedSoFar = $payable->payments()->where('type', 'refund')->sum('amount');
                    $netPaidSoFar = $paidSoFar - $refundedSoFar;
                    $existingDiscount = $payable->discount_amount ?? 0;
                    $remainingBefore = max(0, $payable->total_amount - $existingDiscount - $netPaidSoFar);
                    $requestedDiscount = floatval($validated['discount_amount'] ?? 0);
                    $requestedAmount = floatval($validated['amount'] ?? 0);
                    if (($requestedAmount + $requestedDiscount) > $remainingBefore) {
                        return response()->json([
                            'success' => false,
                            'message' => 'Amount + discount cannot exceed remaining amount. Remaining: Rs ' . number_format($remainingBefore, 2),
                        ], 400);
                    }
                }

            $payment = Payment::create([
                'payable_type' => $payableType,
                'payable_id' => $validated['payable_id'],
                'type' => 'payment',
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'],
                'person_reference' => $validated['person_reference'] ?? null,
                'payment_date' => $paymentDate,
                'notes' => $validated['notes'] ?? null,
                'created_by' => auth()->id(),
            ]);

            // Update order or purchase status
            if ($payable instanceof Order) {
                // If discount provided, add it to Order.discount_amount (store on order)
                $discount = floatval($validated['discount_amount'] ?? 0);
                if ($discount > 0) {
                    $payable->discount_amount = ($payable->discount_amount ?? 0) + $discount;
                    $payable->save();
                }
                $this->updateOrderPaymentStatus($payable);
            } elseif ($payable instanceof SewingOrder) {
                // If discount provided, add it to SewingOrder.discount_amount (store on order)
                $discount = floatval($validated['discount_amount'] ?? 0);
                if ($discount > 0) {
                    $payable->discount_amount = ($payable->discount_amount ?? 0) + $discount;
                    $payable->save();
                }
                $this->updateSewingOrderPaymentStatus($payable);
            } elseif ($payable instanceof InventoryTracking && $payable->type === 'purchase') {
                // For purchases, we might want to update a status field if we add one
                // For now, we'll just track payments
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Payment added successfully.',
                'payment' => $payment,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to add payment: ' . $e->getMessage(),
            ], 500);
        }
    }

    private function updateOrderPaymentStatus(Order $order)
    {
        $totalPaid = $order->payments()->where('type', 'payment')->sum('amount');
        $totalRefunded = $order->payments()->where('type', 'refund')->sum('amount');
        $netPaid = $totalPaid - $totalRefunded;
        $discount = $order->discount_amount ?? 0;
        $remaining = ($order->total_amount - $discount) - $netPaid;

        // Update payment status
        if ($remaining <= 0) {
            $order->payment_status = 'full';
            $order->remaining_amount = 0;
        } else {
            $order->payment_status = 'partial';
            $order->remaining_amount = $remaining;
        }

        // Update partial_amount to net paid
        $order->partial_amount = $netPaid;
        $order->save();
    }

    private function updateSewingOrderPaymentStatus(SewingOrder $sewingOrder)
    {
        $totalPaid = $sewingOrder->payments()->where('type', 'payment')->sum('amount');
        $totalRefunded = $sewingOrder->payments()->where('type', 'refund')->sum('amount');
            $totalDiscount = $sewingOrder->discount_amount ?? 0;
        $netPaid = $totalPaid - $totalRefunded;
        // Remaining subtracts discounts as well
        $remaining = max(0, $sewingOrder->total_amount - ($totalDiscount ?? 0) - $netPaid);

        if ($remaining <= 0) {
            $sewingOrder->payment_status = 'full';
            $sewingOrder->remaining_amount = 0;
        } else {
            $sewingOrder->payment_status = 'partial';
            $sewingOrder->remaining_amount = $remaining;
        }

        $sewingOrder->paid_amount = $netPaid;
        $sewingOrder->partial_amount = $netPaid;
        $sewingOrder->discount_amount = $totalDiscount;
        $sewingOrder->save();
    }

    public function getPayments(Request $request)
    {
        $validated = $request->validate([
            'payable_type' => 'required|in:order,purchase,sewing_order',
            'payable_id' => 'required|integer',
        ]);

        if ($validated['payable_type'] === 'order') {
            $payable = Order::with('payments')->findOrFail($validated['payable_id']);
        } elseif ($validated['payable_type'] === 'sewing_order') {
            $payable = SewingOrder::with('payments')->findOrFail($validated['payable_id']);
        } else {
            $payable = InventoryTracking::with('payments')->findOrFail($validated['payable_id']);
        }

        $totalAmount = $payable instanceof Order 
            ? $payable->total_amount 
            : ($payable instanceof SewingOrder 
                ? $payable->total_amount 
                : ($payable->price_per_meter * $payable->quantity_meters));

        $totalPaid = $payable->payments()->where('type', 'payment')->sum('amount');
        $totalRefunded = $payable->payments()->where('type', 'refund')->sum('amount');
        $totalDiscount = ($payable->discount_amount ?? 0);
        $netPaid = $totalPaid - $totalRefunded;
        $remaining = max(0, $totalAmount - ($totalDiscount ?? 0) - $netPaid);

        return response()->json([
            'success' => true,
            'payments' => $payable->payments,
            'total_paid' => $totalPaid,
            'total_refunded' => $totalRefunded,
            'net_paid' => $netPaid,
            'total_amount' => $totalAmount,
            'remaining' => $remaining,
        ]);
    }

    /**
     * Create a refund for a payment
     */
    public function createRefund(Request $request, Payment $payment)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'refund_reason' => 'nullable|string|max:255',
            'payment_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Check if payment exists and is a payment (not already a refund)
            if ($payment->type !== 'payment') {
                return response()->json([
                    'success' => false,
                    'message' => 'Can only refund payment records, not refunds.',
                ], 400);
            }

            // Check if refund amount exceeds available amount
            $alreadyRefunded = Payment::where('refund_for_payment_id', $payment->id)
                ->where('type', 'refund')
                ->sum('amount');
            
            $availableToRefund = $payment->amount - $alreadyRefunded;
            
            if ($validated['amount'] > $availableToRefund) {
                return response()->json([
                    'success' => false,
                    'message' => "Refund amount cannot exceed available amount. Available: Rs " . number_format($availableToRefund, 2),
                ], 400);
            }

            // Parse payment_date
            $refundDate = $validated['payment_date'];
            if (strpos($refundDate, 'T') !== false) {
                $refundDate = str_replace('T', ' ', $refundDate);
                if (strlen($refundDate) === 16) {
                    $refundDate .= ':00';
                }
            }

            // Create refund record
            $refund = Payment::create([
                'payable_type' => $payment->payable_type,
                'payable_id' => $payment->payable_id,
                'type' => 'refund',
                'refund_for_payment_id' => $payment->id,
                'amount' => $validated['amount'],
                'payment_method' => $payment->payment_method,
                'payment_date' => $refundDate,
                'refund_reason' => $validated['refund_reason'] ?? null,
                'notes' => $validated['notes'] ?? null,
                'created_by' => auth()->id(),
            ]);

            // Update order or sewing order payment status
            $payable = $payment->payable;
            if ($payable instanceof Order) {
                $this->updateOrderPaymentStatus($payable);
            } elseif ($payable instanceof SewingOrder) {
                $this->updateSewingOrderPaymentStatus($payable);
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Refund created successfully.',
                'refund' => $refund,
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Failed to create refund: ' . $e->getMessage(),
            ], 500);
        }
    }
}
