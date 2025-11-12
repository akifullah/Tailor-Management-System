<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Customer;
use App\Models\InventoryTracking;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['customer', 'items.product', 'items', 'payments']);

        $type = $request->input('type');
        $value = $request->input('value');

        // Search by order_number or customer (name or id)
        if ($type && $value !== null && $value !== '') {
            if ($type === 'order_number') {
                $query->where('order_number', 'like', '%' . $value . '%');
            } elseif ($type === 'customer') {
                $query->whereHas('customer', function ($q) use ($value) {
                    $q->where('name', 'like', '%' . $value . '%')
                        ->orWhere('id', $value);
                });
            }
        }

        $orders = $query->latest()->get();

        return view('admin.orders.index', compact('orders'));
    }

    public function create($customer = null)
    {
        $selectedCustomer = $customer ? Customer::find($customer) : null;

        $customers = Customer::with("measurements")->get();
        $products = Product::all();

        $workers = User::get();

        return view('admin.orders.create', compact('customers', 'products', "selectedCustomer", "workers"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'delivery_date' => 'nullable|date',
            'delivery_status' => 'nullable|in:pending,delivered',
            'payment_method' => 'required|in:online,cash,bank_transfer,cheque',
            'payment_status' => 'required|in:partial,full',
            'partial_amount' => 'nullable|numeric|min:0',
            'payment_date' => 'nullable|date',
            'person_reference' => 'nullable|string|max:255',
            'payment_notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.is_from_inventory' => 'nullable|boolean',
            'items.*.sell_price' => 'required|numeric',
            'items.*.quantity_meters' => 'required|numeric',
            'items.*.measurement' => 'required',
            'items.*.product_name' => 'nullable',
            // 'items.*.status' => 'nullable|in:pending,progress,completed',
            'items.*.assign_to' => 'nullable',
        ]);
        // Validate: product_id is required only if is_from_inventory is true
        foreach ($validated['items'] as $idx => $item) {
            $isFromInventory = isset($item['is_from_inventory']) && ($item['is_from_inventory'] == '1' || $item['is_from_inventory'] === true || $item['is_from_inventory'] === 1 || $item['is_from_inventory'] == 'on');
            if ($isFromInventory && empty($item['product_id'])) {
                return back()->withInput()->with('error', "Product is required when using inventory stock (Item " . ($idx + 1) . ")");
            }
        }

        // Gather total quantity requested per product (only for items from inventory)
        $totals = [];
        foreach ($validated['items'] as $item) {
            if (empty($item['product_id'])) continue; // Skip if no product
            $pid = $item['product_id'];
            $isFromInventory = isset($item['is_from_inventory']) && ($item['is_from_inventory'] == '1' || $item['is_from_inventory'] === true || $item['is_from_inventory'] === 1 || $item['is_from_inventory'] == 'on');
            if ($isFromInventory) {
                $totals[$pid] = ($totals[$pid] ?? 0) + $item['quantity_meters'];
            }
        }
        $errors = [];
        foreach ($totals as $pid => $totalQty) {
            $product = Product::find($pid);
            if ($product && $totalQty > $product->available_meters) {
                $errors[] = "Product '{$product->title}' only has {$product->available_meters} meters available, but you requested {$totalQty}.";
            }
        }
        if ($errors) {
            return back()->withInput()->with('error', implode(' ', $errors));
        }

        DB::beginTransaction();
        try {
            $totalAmount = 0;
            foreach ($validated['items'] as $item) {
                $totalAmount += $item['sell_price'] * $item['quantity_meters'];
            }

            // Determine payment amount
            $paymentAmount = 0;
            if ($validated['payment_status'] === 'full') {
                $paymentAmount = $totalAmount;
            } elseif ($validated['payment_status'] === 'partial' && isset($validated['partial_amount']) && $validated['partial_amount'] > 0) {
                $paymentAmount = min($validated['partial_amount'], $totalAmount); // Ensure payment doesn't exceed total
            }

            // Generate unique order number
            $orderNumber = null;
            do {
                $lastOrder = Order::withTrashed()->orderBy('id', 'desc')->first();
                $nextNumber = $lastOrder ? ((int) str_replace('ORD-', '', $lastOrder->order_number)) + 1 : 1;
                $orderNumber = 'ORD-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
            } while (Order::where('order_number', $orderNumber)->exists());

            $order = Order::create([
                'order_number' => $orderNumber,
                'customer_id' => $validated['customer_id'],
                'order_date' => $validated['order_date'],
                'delivery_date' => $validated['delivery_date'] ?? null,
                'delivery_status' => $validated['delivery_status'] ?? 'pending',
                'total_amount' => $totalAmount,
                'payment_method' => $validated['payment_method'],
                'payment_status' => $validated['payment_status'],
                'partial_amount' => $paymentAmount > 0 ? $paymentAmount : null,
                'remaining_amount' => max(0, $totalAmount - $paymentAmount),
            ]);

            // Create payment record if payment amount > 0
            if ($paymentAmount > 0) {
                // Format payment_date properly - handle datetime-local format (YYYY-MM-DDTHH:mm)
                $paymentDate = $validated['payment_date'] ?? $validated['order_date'];

                // Convert datetime-local format (2025-11-09T19:42) to proper datetime format
                if (is_string($paymentDate) && str_contains($paymentDate, 'T')) {
                    // Replace T with space and ensure seconds are included
                    $paymentDate = str_replace('T', ' ', $paymentDate);
                    // If only hours:minutes, add seconds
                    if (preg_match('/^\d{4}-\d{2}-\d{2} \d{2}:\d{2}$/', $paymentDate)) {
                        $paymentDate .= ':00';
                    }
                } elseif (is_string($paymentDate) && !str_contains($paymentDate, ' ')) {
                    // Just a date, add current time
                    $paymentDate = $paymentDate . ' ' . now()->format('H:i:s');
                }

                Payment::create([
                    'payable_type' => Order::class,
                    'payable_id' => $order->id,
                    'amount' => $paymentAmount,
                    'payment_method' => $validated['payment_method'],
                    'person_reference' => $validated['person_reference'] ?? null,
                    'payment_date' => $paymentDate,
                    'notes' => $validated['payment_notes'] ?? null,
                ]);

                // Update order payment status based on payments (this ensures consistency)
                $this->updateOrderPaymentStatus($order);
            }
            foreach ($validated['items'] as $itemData) {
                $isFromInventory = isset($itemData['is_from_inventory']) && ($itemData['is_from_inventory'] == '1' || $itemData['is_from_inventory'] === true || $itemData['is_from_inventory'] === 1 || $itemData['is_from_inventory'] == 'on');
                $assignTo = isset($itemData['assign_to']) && $itemData['assign_to'] !== '' ? $itemData['assign_to'] : null;
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $itemData['product_id'] ?? null, // Can be null if customer brings own fabric
                    'assign_to' =>   $assignTo,
                    'product_name' => $itemData['product_name'] ?? "lkdsajflkdsj", // Can be null if customer brings own fabric
                    'measurement' => $itemData['measurement'] ?? null, // Can be null if customer brings own fabric
                    'is_from_inventory' => $isFromInventory,
                    'sell_price' => $itemData['sell_price'],
                    'quantity_meters' => $itemData['quantity_meters'],
                    'status' => $itemData['status'] ?? 'pending',
                    'total_price' => $itemData['sell_price'] * $itemData['quantity_meters'],
                ]);

                // Only update inventory if item is from inventory and has product_id
                if ($isFromInventory && !empty($itemData['product_id'])) {
                    // Update product stock
                    $product = Product::findOrFail($itemData['product_id']);
                    $product->available_meters = max(0, $product->available_meters - $itemData['quantity_meters']);
                    $product->save();

                    // Track inventory movement
                    InventoryTracking::create([
                        'product_id' => $product->id,
                        'order_id' => $order->id,
                        'type' => 'sale',
                        'quantity_meters' => -abs($itemData['quantity_meters']), // negative for sale
                        'balance_meters' => $product->available_meters,
                        'notes' => "Sale - Order #{$order->order_number}",
                        'reference_number' => $order->order_number,
                    ]);
                }
            }

            DB::commit();

            session()->flash('success', 'Order created successfully.');
            return redirect()->route('orders.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to create order: ' . $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'items.product', 'payments']);
        // Convert the measurement field in each item to parsed JSON
        $orderArray = $order->toArray();
        if (!empty($orderArray['items'])) {
            foreach ($orderArray['items'] as &$item) {
                if (isset($item['measurement']) && is_string($item['measurement'])) {
                    $decodedMeasurement = json_decode($item['measurement'], true);
                    // if the measurement itself has a JSON "data" field, also parse it
                    if (is_array($decodedMeasurement) && isset($decodedMeasurement['data']) && is_string($decodedMeasurement['data'])) {
                        $dataDecoded = json_decode($decodedMeasurement['data'], true);
                        $decodedMeasurement['data'] = $dataDecoded ?: $decodedMeasurement['data'];
                    }
                    $item['measurement'] = $decodedMeasurement ?: $item['measurement'];
                }
            }
        }
        $orderArray['items'] = $orderArray['items'] ?? [];
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'delivery_date' => 'nullable|date',
            'delivery_status' => 'nullable|in:pending,delivered',
        ]);

        $order->update($validated);

        return response()->json(['success' => true, 'message' => 'Order updated successfully']);
    }

    public function destroy(Order $order)
    {
        DB::beginTransaction();
        try {
            foreach ($order->items as $item) {
                // Only restore stock if item was from inventory and has a product
                if ($item->is_from_inventory && $item->product_id) {
                    // Restore stock
                    $product = $item->product;
                    if ($product) {
                        $product->available_meters += $item->quantity_meters;
                        $product->save();

                        // Track reversal
                        InventoryTracking::create([
                            'product_id' => $product->id,
                            'order_id' => $order->id,
                            'type' => 'return',
                            'quantity_meters' => $item->quantity_meters,
                            'balance_meters' => $product->available_meters,
                            'notes' => "Order Cancelled - Order #{$order->order_number}",
                            'reference_number' => $order->order_number,
                        ]);
                    }
                }
            }

            $order->delete();
            DB::commit();
            session()->flash('success', 'Order deleted successfully.');
            return redirect()->route('orders.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to delete order: ' . $e->getMessage());
        }
    }

    /**
     * Update order payment status based on total payments
     */
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
}
