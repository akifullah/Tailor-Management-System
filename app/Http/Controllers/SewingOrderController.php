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
            'payment_status' => 'required|in:partial,full',
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

            // Determine payment amount
            $paymentAmount = 0;
            if ($validated['payment_status'] === 'full') {
                $paymentAmount = $totalAmount;
            } elseif ($validated['payment_status'] === 'partial' && isset($validated['partial_amount']) && $validated['partial_amount'] > 0) {
                $paymentAmount = min($validated['partial_amount'], $totalAmount);
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

            // Create payment record if payment amount > 0
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
                    'amount' => $paymentAmount,
                    'payment_method' => $validated['payment_method'],
                    'person_reference' => $validated['person_reference'] ?? null,
                    'payment_date' => $paymentDate,
                    'notes' => $validated['payment_notes'] ?? null,
                ]);

                $this->updateSewingOrderPaymentStatus($sewingOrder);
            }

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
        $sewingOrder->load(['customer', 'items.worker', 'payments']);
        return view('admin.sewing_orders.show', compact('sewingOrder'));
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
            'order_status' => 'required|in:pending,in_progress,completed',
            'notes' => 'nullable|string',
        ]);

        $sewingOrder->update($validated);

        session()->flash('success', 'Sewing order updated successfully.');
        return redirect()->route('sewing-orders.show', $sewingOrder);
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
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $item->update($validated);

        return response()->json(['success' => true, 'message' => 'Item status updated successfully']);
    }

    /**
     * Update sewing order payment status based on total payments
     */
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

    /**
     * Worker dashboard - show assigned items
     */
    public function workerDashboard(Request $request)
    {
        $userId = Auth::id();
        $query = SewingOrderItem::with(['sewingOrder.customer', 'worker'])
            ->where('assign_to', $userId);

        // Filter by status if provided
        if ($request->has('status') && $request->status !== '') {
            $query->where('status', $request->status);
        }

        $items = $query->latest()->get();

        return view('admin.sewing_orders.worker_dashboard', compact('items'));
    }
}
