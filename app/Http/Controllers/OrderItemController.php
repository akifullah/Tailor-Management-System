<?php

namespace App\Http\Controllers;

use App\Models\InventoryTracking;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    public function updateStatus(Request $request, OrderItem $item)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,progress,completed',
        ]);

        $item->update(['status' => $validated['status']]);

        return response()->json(['success' => true, 'message' => 'Item status updated successfully']);
    }

    public function returnItem(Request $request, OrderItem $item)
    {
        $validated = $request->validate([
            'return_date' => 'required|date',
            'return_reason' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Get order before updating
            $order = $item->order;
            $originalOrderTotal = $order->total_amount;

            // Restore inventory if from inventory
            if ($item->is_from_inventory && $item->product_id) {
                $product = Product::find($item->product_id);
                if ($product) {
                    $product->update([
                        'available_meters' => $product->available_meters + $item->quantity_meters,
                    ]);

                    InventoryTracking::create([
                        'product_id' => $product->id,
                        'order_id' => $item->order_id,
                        'quantity_meters' => $item->quantity_meters,
                        'balance_meters' => $product->available_meters,
                        'type' => 'return',
                        'order_id' => $item->order_id,
                        'notes' => "Item Returned - Order #{$order->order_number}",
                        'reference_number' => $order->order_number,
                    ]);
                }
            }

            // Mark item as returned
            $item->update([
                'is_return' => true,
                'return_date' => $validated['return_date'],
                'return_reason' => $validated['return_reason'] ?? null,
            ]);

            // Process refund if payment was made (before reducing order total)
            $this->processItemRefund($order, $item, $originalOrderTotal);

            // Reduce order total amount
            $order->total_amount -= $item->total_price;
            $order->save();

            // Update payment status
            $this->updateOrderPaymentStatus($order);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Item returned successfully. Refund processed if payment was made.']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to return item: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Process refund for a returned item (same logic as cancelled item)
     */
    private function processItemRefund(Order $order, OrderItem $item, $originalOrderTotal = null)
    {
        // Use original order total if provided, otherwise use current
        $orderTotal = $originalOrderTotal ?? $order->total_amount;
        
        // Calculate proportional refund amount
        if ($orderTotal > 0) {
            $itemProportion = $item->total_price / $orderTotal;
        } else {
            $itemProportion = 0;
        }
        
        // Get all payments for this order
        $payments = $order->payments()->where('type', 'payment')->orderBy('payment_date', 'asc')->get();
        
        foreach ($payments as $payment) {
            $proportionalAmount = $payment->amount * $itemProportion;
            
            // Only create refund if amount > 0
            if ($proportionalAmount > 0) {
                // Check if already refunded for this item
                $existingRefund = Payment::where('refund_for_payment_id', $payment->id)
                    ->where('type', 'refund')
                    ->where('refund_reason', 'like', '%Item returned: ' . $item->product_name . '%')
                    ->first();
                
                if (!$existingRefund) {
                    // Create refund record
                    Payment::create([
                        'payable_type' => Order::class,
                        'payable_id' => $order->id,
                        'type' => 'refund',
                        'refund_for_payment_id' => $payment->id,
                        'amount' => $proportionalAmount,
                        'payment_method' => $payment->payment_method,
                        'payment_date' => now(),
                        'refund_reason' => "Item returned: {$item->product_name}",
                        'notes' => "Refund for returned item - Order #{$order->order_number}",
                        'created_by' => Auth::id(),
                    ]);
                }
            }
        }
    }

    /**
     * Update order payment status based on total payments (accounting for refunds)
     */
    private function updateOrderPaymentStatus(Order $order)
    {
        $totalPaid = $order->payments()->where('type', 'payment')->sum('amount');
        $totalRefunded = $order->payments()->where('type', 'refund')->sum('amount');
        $netPaid = $totalPaid - $totalRefunded;
        $remaining = $order->total_amount - $netPaid;

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
}
