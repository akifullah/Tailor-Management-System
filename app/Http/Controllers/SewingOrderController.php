<?php

namespace App\Http\Controllers;

use App\Models\SewingOrder;
use App\Models\SewingOrderItem;
use App\Models\Customer;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SewingOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SewingOrder::with(['customer', 'items', 'payments']);

        $type = $request->input('type');
        $value = $request->input('value');

        if ($type && $value !== null && $value !== '') {
            if ($type === 'id') {
                $query->where('id', $value);
            } elseif ($type === 'customer_id') {
                $query->where('customer_id', $value);
            } elseif ($type === 'sewing_order_number') {
                $query->where('sewing_order_number', 'like', '%' . $value . '%');
            }
        }

        $orders = $query->latest()->get();

        return view('admin.sewing_orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($customer = null)
    {
        $selectedCustomer = $customer ? Customer::find($customer) : null;
        $customers = Customer::with('measurements')->get();
        $workers = User::all();

        return view('admin.sewing_orders.create', compact('customers', 'selectedCustomer', 'workers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'delivery_date' => 'nullable|date',
            'payment_method' => 'required|in:cash,online,bank_transfer,cheque',
            'payment_status' => 'required|in:partial,full,no_payment',
            'partial_amount' => 'nullable|numeric|min:0',
            'payment_date' => 'nullable|date',
            'person_reference' => 'nullable|string|max:255',
            'payment_notes' => 'nullable|string',
            'notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_name' => 'required|string',
            'items.*.sewing_price' => 'required|numeric|min:0',
            'items.*.qty' => 'required|integer|min:1',
            'items.*.customer_measurement' => 'nullable',
            'items.*.assign_to' => 'nullable|exists:users,id',
            'items.*.assign_note' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $totalAmount = 0;
            foreach ($validated['items'] as $item) {
                $totalAmount += $item['sewing_price'] * $item['qty'];
            }

            // Determine payment amount and treat all status types
            $paymentAmount = 0;
            if ($validated['payment_status'] === 'full') {
                $paymentAmount = $totalAmount;
            } elseif ($validated['payment_status'] === 'partial' && isset($validated['partial_amount']) && $validated['partial_amount'] > 0) {
                $paymentAmount = min($validated['partial_amount'], $totalAmount);
            } elseif ($validated['payment_status'] === 'no_payment') {
                $paymentAmount = 0;
            }

            // Generate unique order number
            $orderNumber = null;
            do {
                $lastOrder = SewingOrder::withTrashed()->orderBy('id', 'desc')->first();
                $nextNumber = $lastOrder ? ((int) str_replace('SEW-', '', $lastOrder->sewing_order_number ?? '0')) + 1 : 1;
                $orderNumber = 'SEW-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
            } while (SewingOrder::where('sewing_order_number', $orderNumber)->exists());

            $sewingOrder = SewingOrder::create([
                'sewing_order_number' => $orderNumber,
                'customer_id' => $validated['customer_id'],
                'order_date' => $validated['order_date'],
                'delivery_date' => $validated['delivery_date'] ?? null,
                'total_amount' => $totalAmount,
                'paid_amount' => $paymentAmount,
                'remaining_amount' => max(0, $totalAmount - $paymentAmount),
                'payment_method' => $validated['payment_method'],
                'payment_status' => $validated['payment_status'],
                'partial_amount' => $paymentAmount > 0 ? $paymentAmount : null,
                'order_status' => 'pending',
                'notes' => $validated['notes'] ?? null,
            ]);

            // Only create payment record if paymentAmount > 0 (i.e., not for no_payment)
            if ($paymentAmount > 0) {
                $paymentDate = $validated['payment_date'] ?? $validated['order_date'];
                if (is_string($paymentDate) && str_contains($paymentDate, 'T')) {
                    $paymentDate = str_replace('T', ' ', $paymentDate);
                    if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}$/', $paymentDate)) {
                        $paymentDate .= ':00';
                    }
                } elseif (is_string($paymentDate) && !str_contains($paymentDate, ' ')) {
                    $paymentDate = $paymentDate . ' ' . now()->format('H:i:s');
                }

                Payment::create([
                    'payable_type' => SewingOrder::class,
                    'payable_id' => $sewingOrder->id,
                    'type' => 'payment',
                    'amount' => $paymentAmount,
                    'payment_method' => $validated['payment_method'],
                    'person_reference' => $validated['person_reference'] ?? null,
                    'payment_date' => $paymentDate,
                    'notes' => $validated['payment_notes'] ?? null,
                    'created_by' => Auth::id(),
                ]);
            }

            // Always update sewing order payment status (even for no_payment)
            $this->updateSewingOrderPaymentStatus($sewingOrder);

            // Create order items
            foreach ($validated['items'] as $itemData) {
                $measurement = $itemData['customer_measurement'] ?? null;
                if (is_string($measurement)) {
                    $measurement = json_decode($measurement, true);
                }

                SewingOrderItem::create([
                    'sewing_order_id' => $sewingOrder->id,
                    'product_name' => $itemData['product_name'],
                    'sewing_price' => $itemData['sewing_price'],
                    'qty' => $itemData['qty'],
                    'customer_measurement' => $measurement,
                    'assign_to' => $itemData['assign_to'] ?? null,
                    'assign_note' => $itemData['assign_note'] ?? null,
                    'status' => 'pending',
                    'total_price' => $itemData['sewing_price'] * $itemData['qty'],
                ]);
            }

            DB::commit();

            session()->flash('success', 'Sewing order created successfully.');
            return redirect()->route('sewing-orders.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to create sewing order: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SewingOrder $sewingOrder)
    {
        $sewingOrder->load(['customer.measurements', 'items.worker', 'payments']);


        return view('admin.sewing_orders.show', compact('sewingOrder'));
    }

    public function print(SewingOrder $sewingOrder)
    {
        $sewingOrder->load(['customer', 'items.worker', 'payments']);

        return view('admin.sewing_orders.receipt', compact('sewingOrder'));
    }

    public function printMeasurement(SewingOrderItem $item)
    {
        $item->load(['sewingOrder.customer']);

        // Decode measurement data if string
        $measurement = $item->customer_measurement;
        if (is_string($measurement)) {
            $measurement = json_decode($measurement, true);
        }

        // Ensure data and style are arrays
        if (isset($measurement['data']) && is_string($measurement['data'])) {
            $measurement['data'] = json_decode($measurement['data'], true);
        }
        if (isset($measurement['style']) && is_string($measurement['style'])) {
            $measurement['style'] = json_decode($measurement['style'], true);
        }

        return view('admin.sewing_orders.print_measurement', compact('item', 'measurement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SewingOrder $sewingOrder)
    {
        $sewingOrder->load(['customer', 'items']);
        $customers = Customer::with('measurements')->get();
        $workers = User::all();

        return view('admin.sewing_orders.edit', compact('sewingOrder', 'customers', 'workers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SewingOrder $sewingOrder)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'delivery_date' => 'nullable|date',
            'order_status' => 'required|in:pending,in_progress,completed,on_hold,cancelled,delivered',
            'notes' => 'nullable|string',
            'cancellation_reason' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // If order is being cancelled, handle refunds
            if ($validated['order_status'] === 'cancelled' && $sewingOrder->order_status !== 'cancelled') {
                $this->cancelSewingOrder($sewingOrder, $validated['cancellation_reason'] ?? null);
            }

            $sewingOrder->update($validated);
            $this->updateSewingOrderPaymentStatus($sewingOrder);

            DB::commit();
            session()->flash('success', 'Sewing order updated successfully.');
            return redirect()->route('sewing-orders.show', $sewingOrder);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to update sewing order: ' . $e->getMessage());
        }
    }

    /**
     * Cancel entire sewing order and process refunds
     */
    private function cancelSewingOrder(SewingOrder $sewingOrder, $reason = null)
    {
        // Cancel all items
        foreach ($sewingOrder->items as $item) {
            if ($item->status !== 'cancelled') {
                $this->cancelSewingOrderItem($item, $reason ?? 'Order cancelled');
            }
        }

        // Update order status
        $sewingOrder->update([
            'order_status' => 'cancelled',
            'cancelled_at' => now(),
            'cancelled_by' => Auth::id(),
            'cancellation_reason' => $reason ?? 'Order cancelled',
        ]);

        // Process refunds for all payments
        $this->processSewingOrderRefund($sewingOrder, $reason);
    }

    /**
     * Process refund for entire cancelled sewing order
     */
    private function processSewingOrderRefund(SewingOrder $sewingOrder, $reason = null)
    {
        // Get all payments for this order
        $payments = $sewingOrder->payments()->where('type', 'payment')->get();

        foreach ($payments as $payment) {
            // Check if already refunded
            $existingRefund = Payment::where('refund_for_payment_id', $payment->id)
                ->where('type', 'refund')
                ->first();

            if (!$existingRefund) {
                // Create full refund
                Payment::create([
                    'payable_type' => SewingOrder::class,
                    'payable_id' => $sewingOrder->id,
                    'type' => 'refund',
                    'refund_for_payment_id' => $payment->id,
                    'amount' => $payment->amount,
                    'payment_method' => $payment->payment_method,
                    'payment_date' => now(),
                    'refund_reason' => $reason ?? 'Order cancelled',
                    'notes' => "Refund for cancelled order - Sewing Order #{$sewingOrder->sewing_order_number}",
                    'created_by' => Auth::id(),
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SewingOrder $sewingOrder)
    {
        DB::beginTransaction();
        try {
            $sewingOrder->items()->delete();
            $sewingOrder->delete();

            DB::commit();
            session()->flash('success', 'Sewing order deleted successfully.');
            return redirect()->route('sewing-orders.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete sewing order: ' . $e->getMessage());
        }
    }

    /**
     * Update sewing order item status
     */
    public function updateItemStatus(Request $request, SewingOrderItem $item)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,in_progress,completed,on_hold,cancelled,delivered',
            'cancellation_reason' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $sewingOrder = $item->sewingOrder;
            if ($validated['status'] === 'cancelled' && $item->status !== 'cancelled') {
                // If cancelling, decrease item total_price from SewingOrder's total_amount
                $sewingOrder->total_amount -= $item->total_price;
                if ($sewingOrder->total_amount < 0) {
                    $sewingOrder->total_amount = 0;
                }
                $sewingOrder->save();
            }

            // if ($validated['status'] === 'cancelled' && $item->status !== 'cancelled') {
            //     // Cancel item with refund processing
            //     $this->cancelSewingOrderItem($item, $validated['cancellation_reason'] ?? null);
            // } else {
            //     // Just update status
            // }
            $item->update($validated);

            // Check if all items are cancelled
            if ($sewingOrder->allItemsCancelled()) {
                $sewingOrder->update([
                    'order_status' => 'cancelled',
                    'cancelled_at' => now(),
                    'cancelled_by' => Auth::id(),
                    'cancellation_reason' => 'All items cancelled',
                ]);
            }

            // Update payment status
            $this->updateSewingOrderPaymentStatus($sewingOrder);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Item status updated successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to update item status: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Cancel a sewing order item and process refund
     */
    private function cancelSewingOrderItem(SewingOrderItem $item, $reason = null)
    {
        $sewingOrder = $item->sewingOrder;
        $originalOrderTotal = $sewingOrder->total_amount;

        // Update item status
        $item->update([
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'cancelled_by' => Auth::id(),
            'cancellation_reason' => $reason ?? 'Item cancelled',
        ]);

        // Process refund if payment was made
        $this->processSewingItemRefund($sewingOrder, $item, $originalOrderTotal);

        // Reduce order total amount
        $sewingOrder->total_amount -= $item->total_price;
        $sewingOrder->save();
    }

    /**
     * Process refund for a cancelled sewing order item
     */
    private function processSewingItemRefund(SewingOrder $sewingOrder, SewingOrderItem $item, $originalOrderTotal = null)
    {
        // Use original order total if provided, otherwise use current
        $orderTotal = $originalOrderTotal ?? $sewingOrder->total_amount;

        // Calculate proportional refund amount
        if ($orderTotal > 0) {
            $itemProportion = $item->total_price / $orderTotal;
        } else {
            $itemProportion = 0;
        }

        // Get all payments for this order
        $payments = $sewingOrder->payments()->where('type', 'payment')->orderBy('payment_date', 'asc')->get();

        foreach ($payments as $payment) {
            $proportionalAmount = $payment->amount * $itemProportion;

            // Only create refund if amount > 0
            if ($proportionalAmount > 0) {
                // Create refund record
                Payment::create([
                    'payable_type' => SewingOrder::class,
                    'payable_id' => $sewingOrder->id,
                    'type' => 'refund',
                    'refund_for_payment_id' => $payment->id,
                    'amount' => $proportionalAmount,
                    'payment_method' => $payment->payment_method,
                    'payment_date' => now(),
                    'refund_reason' => "Item cancelled: {$item->product_name}",
                    'notes' => "Refund for cancelled item - Sewing Order #{$sewingOrder->sewing_order_number}",
                    'created_by' => Auth::id(),
                ]);
            }
        }
    }

    /**
     * Update sewing order payment status based on total payments (accounting for refunds)
     */
    private function updateSewingOrderPaymentStatus(SewingOrder $sewingOrder)
    {
        $totalPaid = $sewingOrder->payments()->where('type', 'payment')->sum('amount');
        $totalRefunded = $sewingOrder->payments()->where('type', 'refund')->sum('amount');
        $netPaid = $totalPaid - $totalRefunded;
        $remaining = $sewingOrder->total_amount - $netPaid;

        if ($remaining <= 0) {
            $sewingOrder->payment_status = 'full';
            $sewingOrder->remaining_amount = 0;
        } else {
            $sewingOrder->payment_status = 'partial';
            $sewingOrder->remaining_amount = $remaining;
        }

        $sewingOrder->paid_amount = $netPaid;
        $sewingOrder->partial_amount = $netPaid;
        $sewingOrder->save();
    }

    /**
     * Worker dashboard - show assigned items
     */
    public function workerDashboard(Request $request)
    {
        $userId = Auth::id();

        // Base query builder for all assigned items
        $baseQuery = function () use ($userId) {
            return SewingOrderItem::where('assign_to', $userId);
        };

        // Calculate statistics
        $stats = [
            'total_assigned' => $baseQuery()->count(),
            'pending' => $baseQuery()->where('status', 'pending')->count(),
            'on_hold' => $baseQuery()->where('status', 'on_hold')->count(),
            'in_progress' => $baseQuery()->where('status', 'in_progress')->count(),
            'completed' => $baseQuery()->whereIn('status', ['completed', "delivered"])->count(),
            'cancelled' => $baseQuery()->where('status', 'cancelled')->count(),
            'delivered' => $baseQuery()->where('status', 'delivered')->count(),
            'total_value' => $baseQuery()->sum('total_price'),
            'completed_value' => $baseQuery()->where('status', 'completed')->sum('total_price'),
            'in_progress_value' => $baseQuery()->where('status', 'in_progress')->sum('total_price'),
        ];

        // Filtered query for table display
        $query = SewingOrderItem::with(['sewingOrder.customer', 'worker'])
            ->where('assign_to', $userId);

        // Filter by status if provided
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $items = $query->latest()->get();

        return view('admin.sewing_orders.worker_dashboard', compact('items', 'stats'));
    }


    /**
     * Update the status of a sewing order (used by PATCH: sewing-orders/{sewing_order}/update-status)
     */
    public function updateStatus(Request $request, SewingOrder $sewing_order)
    {
        $validated = $request->validate([
            'order_status' => 'required|in:pending,completed,delivered,cancelled',
        ]);

        $sewing_order->order_status = $validated['order_status'];
        $sewing_order->save();

        // If the order is delivered OR cancelled, update all items
        if (in_array($sewing_order->order_status, ['delivered', 'cancelled'])) {
            \App\Models\SewingOrderItem::where('sewing_order_id', $sewing_order->id)
                ->update(['status' => $sewing_order->order_status]);
        }

        return redirect()->route('sewing-orders.show', $sewing_order->id)
            ->with('success', 'Order status updated successfully.');
    }

    /**
     * Assign a measurement to a sewing order item
     */
    public function assignMeasurement(Request $request, SewingOrderItem $item)
    {
        $validated = $request->validate([
            'measurement_id' => 'required|exists:measurements,id',
        ]);

        $measurement = \App\Models\Measurement::find($validated['measurement_id']);

        // Decode data if it's a string (though cast should handle it, good to be safe given previous code)
        $measurementData = $measurement->data;
        if (is_string($measurementData)) {
            $measurementData = json_decode($measurementData, true);
        }

        $measurementStyle = $measurement->style;
        if (is_string($measurementStyle)) {
            $measurementStyle = json_decode($measurementStyle, true);
        }

        // Construct the measurement array structure expected by SewingOrderItem
        $newMeasurement = [
            'id' => $measurement->id,
            'type' => $measurement->type,
            'name' => $measurement->name,
            'data' => $measurementData,
            'style' => $measurementStyle,
            'notes' => $measurement->notes,
        ];

        $item->customer_measurement = $newMeasurement;
        $item->save();

        return back()->with('success', 'Measurement assigned successfully.');
    }
}
