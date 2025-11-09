<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Order;
use App\Models\InventoryTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'payable_type' => 'required|in:order,purchase',
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

    public function getPayments(Request $request)
    {
        $validated = $request->validate([
            'payable_type' => 'required|in:order,purchase',
            'payable_id' => 'required|integer',
        ]);

        if ($validated['payable_type'] === 'order') {
            $payable = Order::with('payments')->findOrFail($validated['payable_id']);
        } else {
            $payable = InventoryTracking::with('payments')->findOrFail($validated['payable_id']);
        }

        return response()->json([
            'success' => true,
            'payments' => $payable->payments,
            'total_paid' => $payable->payments->sum('amount'),
            'total_amount' => $payable instanceof Order ? $payable->total_amount : ($payable->price_per_meter * $payable->quantity_meters),
            'remaining' => $payable instanceof Order 
                ? ($payable->total_amount - $payable->payments->sum('amount'))
                : (($payable->price_per_meter * $payable->quantity_meters) - $payable->payments->sum('amount')),
        ]);
    }
}
