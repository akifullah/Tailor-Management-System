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
            'amount' => 'required|numeric|min:0.01',
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
            $payment = Payment::create([
                'payable_type' => $payableType,
                'payable_id' => $validated['payable_id'],
                'amount' => $validated['amount'],
                'payment_method' => $validated['payment_method'],
                'person_reference' => $validated['person_reference'] ?? null,
                'payment_date' => $paymentDate,
                'notes' => $validated['notes'] ?? null,
            ]);

            // Update order or purchase status
            if ($payable instanceof Order) {
                $this->updateOrderPaymentStatus($payable);
            } elseif ($payable instanceof SewingOrder) {
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
        $totalPaid = $order->payments()->sum('amount');
        $remaining = $order->total_amount - $totalPaid;

        // Update payment status
        if ($remaining <= 0) {
            $order->payment_status = 'full';
            $order->remaining_amount = 0;
        } else {
            $order->payment_status = 'partial';
            $order->remaining_amount = $remaining;
        }

        // Update partial_amount to total paid
        $order->partial_amount = $totalPaid;
        $order->save();
    }

    private function updateSewingOrderPaymentStatus(SewingOrder $sewingOrder)
    {
        $totalPaid = $sewingOrder->payments()->sum('amount');
        $remaining = $sewingOrder->total_amount - $totalPaid;

        if ($remaining <= 0) {
            $sewingOrder->payment_status = 'full';
            $sewingOrder->remaining_amount = 0;
        } else {
            $sewingOrder->payment_status = 'partial';
            $sewingOrder->remaining_amount = $remaining;
        }

        $sewingOrder->paid_amount = $totalPaid;
        $sewingOrder->partial_amount = $totalPaid;
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
        
        $remaining = $totalAmount - $payable->payments->sum('amount');

        return response()->json([
            'success' => true,
            'payments' => $payable->payments,
            'total_paid' => $payable->payments->sum('amount'),
            'total_amount' => $totalAmount,
            'remaining' => $remaining,
        ]);
    }
}
