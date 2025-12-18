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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['customer', 'items.product', 'items', 'payments']);

        $type = $request->input('type');
        $value = $request->input('value');
        $orderStatus = $request->input('order_status');
        $paymentStatus = $request->input('payment_status');
        $itemStatus = $request->input('item_status');

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

        // New filter: order status
        if ($orderStatus !== null && $orderStatus !== '') {
            if ($orderStatus === 'returned') {
                $query->where(function($q) {
                    $q->where('is_return', true);
                });
            } else {
                $query->where('order_status', $orderStatus);
            }
        }

        // New filter: payment status
        if ($paymentStatus !== null && $paymentStatus !== '') {
            if ($paymentStatus === 'paid') {
                $query->where(function($q) {
                    $q->where('payment_status', 'full');
                });
            }
            if ($paymentStatus === 'pending') {
                $query->where(function($q) {
                    $q->where('payment_status', '!=', 'full');
                });
            }
        }

        $orders = $query->latest()->get();

        // New filter: item status (filter in PHP since it depends on loaded relations)
        if ($itemStatus !== null && $itemStatus !== '') {
            $orders = $orders->filter(function($order) use ($itemStatus) {
                $items = $order->items;
                $count = $items->count();
                $countReturned = $items->where('is_return', true)->count();
                $countCompleted = $items->where('status', 'completed')->count();
                $countPending = $items->where('status', 'pending')->count();
                if ($itemStatus == 'all_done') {
                    return $count > 0 && $countCompleted === $count;
                }
                if ($itemStatus == 'partial') {
                    return $count > 0 && $countCompleted > 0 && $countCompleted < $count;
                }
                if ($itemStatus == 'returned') {
                    return $count > 0 && $countReturned === $count;
                }
                if ($itemStatus == 'not_returned') {
                    return $count > 0 && $countReturned < $count;
                }
                return true;
            });
        }

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
            // 'delivery_date' => 'nullable|date',
            // 'delivery_status' => 'nullable|in:pending,delivered',
            'payment_method' => 'nullable|in:online,cash,bank_transfer,cheque',
            'payment_status' => 'required|in:no_payment,partial,full',
            'partial_amount' => 'nullable|numeric|min:0',
            'payment_date' => 'nullable|date',
            'person_reference' => 'nullable|string|max:255',
            'payment_notes' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            // Always use inventory, don't allow bypass
            // 'items.*.is_from_inventory' => 'nullable|boolean',
            'items.*.sell_price' => 'required|numeric',
            'items.*.quantity_meters' => 'required|numeric',
            // 'items.*.measurement' => 'required',
            'items.*.product_name' => 'nullable',
            // 'items.*.status' => 'nullable|in:pending,progress,completed',
            // 'items.*.assign_to' => 'nullable',
        ]);

        // Make sure each item is from inventory, so we do not need conditional stock checks
        $totals = [];
        foreach ($validated['items'] as $item) {
            $pid = $item['product_id'];
            $totals[$pid] = ($totals[$pid] ?? 0) + $item['quantity_meters'];
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
            // If payment_status is 'no_payment', paymentAmount remains 0 and no payment record is created

            // Generate unique order number
            $orderNumber = null;
            do {
                $lastOrder = Order::withTrashed()->orderBy('id', 'desc')->first();
                $nextNumber = $lastOrder ? ((int) str_replace('ORD-', '', $lastOrder->order_number)) + 1 : 1;
                $orderNumber = 'ORD-' . str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
            } while (Order::where('order_number', $orderNumber)->exists());

            // Determine order discount (from request) and ensure it's non-negative
            $orderDiscount = floatval($request->input('discount_amount', 0));
            if ($orderDiscount < 0) $orderDiscount = 0;

            // Ensure payment + discount does not exceed total amount
            if (($paymentAmount + $orderDiscount) > $totalAmount) {
                DB::rollBack();
                return back()->withInput()->with('error', 'Payment amount plus discount cannot exceed order total.');
            }

            $orderData = [
                'order_number' => $orderNumber,
                'customer_id' => $validated['customer_id'],
                'order_date' => $validated['order_date'],
                // 'delivery_date' => $validated['delivery_date'] ?? null,
                // 'delivery_status' => $validated['delivery_status'] ?? 'pending',
                'total_amount' => $totalAmount,
                'discount_amount' => $orderDiscount,
                'payment_method' => $validated['payment_status'] !== 'no_payment' ? ($validated['payment_method'] ?? null) : null,
                'payment_status' => $validated['payment_status'],
                'partial_amount' => $paymentAmount > 0 ? $paymentAmount : null,
                'remaining_amount' => max(0, $totalAmount - $paymentAmount),
            ];
            
            // Only set order_status if the column exists
            if (Schema::hasColumn('orders', 'order_status')) {
                $orderData['order_status'] = 'pending';
            }
            
            $order = Order::create($orderData);

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
                    'type' => 'payment',
                    'amount' => $paymentAmount,
                    'payment_method' => $validated['payment_method'],
                    'person_reference' => $validated['person_reference'] ?? null,
                    'payment_date' => $paymentDate,
                    'notes' => $validated['payment_notes'] ?? null,
                    'created_by' => Auth::id(),
                ]);

                // Update order payment status based on payments (this ensures consistency)
                $this->updateOrderPaymentStatus($order);
            }

            foreach ($validated['items'] as $itemData) {
                // Force all items as inventory items now
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $itemData['product_id'], // Always required above
                    // 'assign_to' =>   $assignTo,
                    'product_name' => $itemData['product_name'] ?? null,
                    // 'measurement' => $itemData['measurement'] ?? null,
                    'is_from_inventory' => true, // Always using inventory
                    'sell_price' => $itemData['sell_price'],
                    'quantity_meters' => $itemData['quantity_meters'],
                    'status' => 'pending',
                    'total_price' => $itemData['sell_price'] * $itemData['quantity_meters'],
                ]);

                // Always update inventory for each item
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
        $order->load([
            'customer', 
            'items.product', 
            'payments' => function ($query) {
                $query->orderBy('created_at');
            }
        ]);
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

    /**
     * Show the form for editing the specified order.
     */
    public function edit(Order $order)
    {
        $order->load(['customer', 'items.product', 'payments']);
        $products = Product::all();
        return view('admin.orders.edit', compact('order', 'products'));
    }

    public function print(Order $order)
    {
        $order->load([
            'customer',
            'items.product',
            'payments' => function ($query) {
                $query->orderBy('created_at');
            },
        ]);

        return view('admin.orders.receipt', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        // Basic validation for top-level fields
        $validated = $request->validate([
            'order_date' => 'nullable|date',
            'delivery_date' => 'nullable|date',
            'delivery_status' => 'nullable|string|max:50',
            // items is optional - we handle structural validation below
        ]);

        $itemsPayload = $request->input('items', []); // associative array keyed by item id
        $newItems = $request->input('new_items', []); // array of new items
        $removeItems = $request->input('remove_items', []); // array of item ids to remove

        DB::beginTransaction();
        try {
            // Step 1: compute product inventory changes (change > 0 means consume more stock)
            $productChanges = []; // product_id => change (positive means decrease available)

            // Existing items updates
            foreach ($itemsPayload as $itemId => $data) {
                $item = OrderItem::find($itemId);
                if (!$item || $item->order_id !== $order->id) {
                    continue; // ignore invalid
                }

                $oldQty = (float) $item->quantity_meters;
                $oldFromInventory = (bool) $item->is_from_inventory;

                $newQty = isset($data['quantity_meters']) ? (float) $data['quantity_meters'] : $oldQty;
                $newFromInventory = isset($data['is_from_inventory']) ? (bool) $data['is_from_inventory'] : $oldFromInventory;
                $productId = $item->product_id;

                $oldReserved = $oldFromInventory ? $oldQty : 0;
                $newReserved = $newFromInventory ? $newQty : 0;
                $change = $newReserved - $oldReserved;
                if ($change != 0 && $productId) {
                    $productChanges[$productId] = ($productChanges[$productId] ?? 0) + $change;
                }
            }

            // Removals: restore stock for items removed
            foreach ($removeItems as $rid) {
                $item = OrderItem::find($rid);
                if (!$item || $item->order_id !== $order->id) continue;
                if ($item->is_from_inventory && $item->product_id) {
                    $productChanges[$item->product_id] = ($productChanges[$item->product_id] ?? 0) - $item->quantity_meters;
                }
            }

            // New items: consume stock if marked from inventory
            foreach ($newItems as $nitem) {
                if (empty($nitem['product_id'])) continue;
                $pid = $nitem['product_id'];
                $qty = isset($nitem['quantity_meters']) ? (float) $nitem['quantity_meters'] : 0;
                $fromInv = isset($nitem['is_from_inventory']) ? (bool) $nitem['is_from_inventory'] : false;
                if ($fromInv && $pid) {
                    $productChanges[$pid] = ($productChanges[$pid] ?? 0) + $qty;
                }
            }

            // Validate inventory availability
            foreach ($productChanges as $pid => $change) {
                if ($change > 0) {
                    $product = Product::find($pid);
                    if (!$product) throw new \Exception("Product not found: {$pid}");
                    if ($product->available_meters < $change) {
                        throw new \Exception("Insufficient stock for '{$product->title}'. Available: {$product->available_meters}, required: {$change}");
                    }
                }
            }

            // Apply item removals
            foreach ($removeItems as $rid) {
                $item = OrderItem::find($rid);
                if (!$item || $item->order_id !== $order->id) continue;
                // restore stock if needed (we will also perform aggregated product changes below, but do explicit tracking now for clarity)
                if ($item->is_from_inventory && $item->product_id) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->available_meters += $item->quantity_meters;
                        $product->save();
                        InventoryTracking::create([
                            'product_id' => $product->id,
                            'order_id' => $order->id,
                            'type' => 'return',
                            'quantity_meters' => $item->quantity_meters,
                            'balance_meters' => $product->available_meters,
                            'notes' => "Item removed in order edit - Order #{$order->order_number}",
                            'reference_number' => $order->order_number,
                        ]);
                    }
                }
                $item->delete();
            }

            // Apply updates to existing items
            foreach ($itemsPayload as $itemId => $data) {
                $item = OrderItem::find($itemId);
                if (!$item || $item->order_id !== $order->id) continue;

                $oldQty = (float) $item->quantity_meters;
                $oldFromInventory = (bool) $item->is_from_inventory;

                $newQty = isset($data['quantity_meters']) ? (float) $data['quantity_meters'] : $oldQty;
                $newPrice = isset($data['sell_price']) ? (float) $data['sell_price'] : $item->sell_price;
                $newFromInventory = isset($data['is_from_inventory']) ? (bool) $data['is_from_inventory'] : $oldFromInventory;

                $item->quantity_meters = $newQty;
                $item->sell_price = $newPrice;
                $item->is_from_inventory = $newFromInventory ? 1 : 0;
                $item->total_price = $newPrice * $newQty;
                $item->save();
            }

            // Create new items
            foreach ($newItems as $nitem) {
                if (empty($nitem['product_id'])) continue;
                $productId = $nitem['product_id'];
                $qty = isset($nitem['quantity_meters']) ? (float) $nitem['quantity_meters'] : 0;
                $price = isset($nitem['sell_price']) ? (float) $nitem['sell_price'] : 0;
                $fromInv = isset($nitem['is_from_inventory']) ? (bool) $nitem['is_from_inventory'] : false;

                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'product_name' => $nitem['product_name'] ?? null,
                    'is_from_inventory' => $fromInv ? 1 : 0,
                    'sell_price' => $price,
                    'quantity_meters' => $qty,
                    'status' => $nitem['status'] ?? 'pending',
                    'total_price' => $price * $qty,
                ]);
            }

            // Apply aggregated productChanges to inventory and create InventoryTracking records
            foreach ($productChanges as $pid => $change) {
                if ($change == 0) continue;
                $product = Product::find($pid);
                if (!$product) continue;
                // Positive change => consume more stock (decrease available_meters)
                if ($change > 0) {
                    $product->available_meters = max(0, $product->available_meters - $change);
                    $product->save();
                    InventoryTracking::create([
                        'product_id' => $product->id,
                        'order_id' => $order->id,
                        'type' => 'sale',
                        'quantity_meters' => -abs($change),
                        'balance_meters' => $product->available_meters,
                        'notes' => "Order edit - consumed stock - Order #{$order->order_number}",
                        'reference_number' => $order->order_number,
                    ]);
                } else {
                    // Negative change => stock restored
                    $restored = abs($change);
                    $product->available_meters += $restored;
                    $product->save();
                    InventoryTracking::create([
                        'product_id' => $product->id,
                        'order_id' => $order->id,
                        'type' => 'return',
                        'quantity_meters' => $restored,
                        'balance_meters' => $product->available_meters,
                        'notes' => "Order edit - restored stock - Order #{$order->order_number}",
                        'reference_number' => $order->order_number,
                    ]);
                }
            }

            // Recalculate order totals
            $orderItems = $order->items()->get();
            $total = $orderItems->sum(function ($it) { return $it->total_price; });
            $order->total_amount = $total;
            if ($request->filled('order_date')) $order->order_date = $request->input('order_date');
            // if ($request->filled('delivery_status')) $order->delivery_status = $request->input('delivery_status');
            $order->save();
            return $order;
            
            // Update payment status based on payments/refunds
            $this->updateOrderPaymentStatus($order);

            DB::commit();

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => true, 'message' => 'Order updated successfully.']);
            }

            session()->flash('success', 'Order updated successfully.');
            return redirect()->route('orders.show', $order->id);

        } catch (\Exception $e) {
            DB::rollBack();
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json(['success' => false, 'message' => 'Failed to update order: ' . $e->getMessage()], 500);
            }
            return back()->with('error', 'Failed to update order: ' . $e->getMessage());
        }
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
     * Update order payment status based on total payments (accounting for refunds)
     */
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

    /**
     * Cancel an order item and process refund if payment was made
     */
    public function cancelItem(Request $request, OrderItem $item)
    {
        $validated = $request->validate([
            'cancellation_reason' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Update item status
            $item->update([
                'status' => 'cancelled',
                'cancelled_at' => now(),
                'cancelled_by' => Auth::id(),
                'cancellation_reason' => $validated['cancellation_reason'] ?? null,
            ]);

            // Restore inventory if from inventory
            if ($item->is_from_inventory && $item->product_id) {
                $product = $item->product;
                if ($product) {
                    $product->available_meters += $item->quantity_meters;
                    $product->save();

                    InventoryTracking::create([
                        'product_id' => $product->id,
                        'order_id' => $item->order_id,
                        'type' => 'return',
                        'quantity_meters' => $item->quantity_meters,
                        'balance_meters' => $product->available_meters,
                        'notes' => "Item Cancelled - Order #{$item->order->order_number}",
                        'reference_number' => $item->order->order_number,
                    ]);
                }
            }

            // Get order before updating
            $order = $item->order;
            $originalOrderTotal = $order->total_amount;

            // Process refund if payment was made (before reducing order total)
            $this->processItemRefund($order, $item, $originalOrderTotal);

            // Reduce order total amount
            $order->total_amount -= $item->total_price;
            $order->save();

            // Check if all items are cancelled
            if ($order->allItemsCancelled()) {
                $order->update([
                    'order_status' => 'cancelled',
                    'cancelled_at' => now(),
                    'cancelled_by' => Auth::id(),
                    'cancellation_reason' => 'All items cancelled',
                ]);
            }

            // Update payment status
            $this->updateOrderPaymentStatus($order);

            DB::commit();
            return response()->json(['success' => true, 'message' => 'Item cancelled successfully']);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => 'Failed to cancel item: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Cancel entire order and process refunds
     */
    public function cancelOrder(Order $order, $reason = null)
    {
        DB::beginTransaction();
        try {
            // Cancel all items
            foreach ($order->items as $item) {
                if ($item->status !== 'cancelled') {
                    $item->update([
                        'status' => 'cancelled',
                        'cancelled_at' => now(),
                        'cancelled_by' => Auth::id(),
                        'cancellation_reason' => $reason ?? 'Order cancelled',
                    ]);

                    // Restore inventory
                    if ($item->is_from_inventory && $item->product_id) {
                        $product = $item->product;
                        if ($product) {
                            $product->available_meters += $item->quantity_meters;
                            $product->save();

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
            }

            // Update order status
            $order->update([
                'order_status' => 'cancelled',
                'cancelled_at' => now(),
                'cancelled_by' => Auth::id(),
                'cancellation_reason' => $reason ?? 'Order cancelled',
            ]);

            // Process refunds for all payments
            $this->processOrderRefund($order, $reason);

            // Update payment status
            $this->updateOrderPaymentStatus($order);

            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    /**
     * Process refund for a cancelled item
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
                // Create refund record
                Payment::create([
                    'payable_type' => Order::class,
                    'payable_id' => $order->id,
                    'type' => 'refund',
                    'refund_for_payment_id' => $payment->id,
                    'amount' => $proportionalAmount,
                    'payment_method' => $payment->payment_method,
                    'payment_date' => now(),
                    'refund_reason' => "Item cancelled: {$item->product_name}",
                    'notes' => "Refund for cancelled item - Order #{$order->order_number}",
                    'created_by' => Auth::id(),
                ]);
            }
        }
    }

    /**
     * Process refund for entire cancelled order
     */
    private function processOrderRefund(Order $order, $reason = null)
    {
        // Get all payments for this order
        $payments = $order->payments()->where('type', 'payment')->get();
        
        foreach ($payments as $payment) {
            // Check if already refunded
            $existingRefund = Payment::where('refund_for_payment_id', $payment->id)
                ->where('type', 'refund')
                ->first();
            
            if (!$existingRefund) {
                // Create full refund
                Payment::create([
                    'payable_type' => Order::class,
                    'payable_id' => $order->id,
                    'type' => 'refund',
                    'refund_for_payment_id' => $payment->id,
                    'amount' => $payment->amount,
                    'payment_method' => $payment->payment_method,
                    'payment_date' => now(),
                    'refund_reason' => $reason ?? 'Order cancelled',
                    'notes' => "Refund for cancelled order - Order #{$order->order_number}",
                    'created_by' => Auth::id(),
                ]);
            }
        }
    }



    // RETURN ORDER
    public function returnOrder(Order $order, Request $request)
    {
        $validated = $request->validate([
            'return_date' => 'required|date',
            'reason' => 'nullable|string', // Form uses 'reason' field name
            'refund' => 'nullable|boolean', // Add refund option
        ]);

        try {
            DB::beginTransaction();
            
            // Update order return status
            $returnReason = $validated['reason'] ?? null;
            $order->update([
                'is_return' => true,
                'return_date' => $validated['return_date'],
                'return_reason' => $returnReason,
            ]);
            
            // Return all items and restore inventory
            $orderItems = OrderItem::where('order_id', $order->id)->get();
            foreach ($orderItems as $item) {
                // Restore inventory if from inventory
                if ($item->is_from_inventory && $item->product_id) {
                    $product = Product::find($item->product_id);
                    if ($product) {
                        $product->update([
                            'available_meters' => $product->available_meters + $item->quantity_meters,
                        ]);
                        
                        InventoryTracking::create([
                            'product_id' => $product->id,
                            'order_id' => $order->id,
                            'type' => 'return',
                            'quantity_meters' => $item->quantity_meters,
                            'balance_meters' => $product->available_meters,
                            'notes' => "Order Return - Order #{$order->order_number}",
                            'reference_number' => $order->order_number,
                        ]);
                    }
                }
                
                // Mark item as returned
                $item->update([
                    'is_return' => true,
                    'return_date' => $validated['return_date'],
                    'return_reason' => $returnReason,
                ]);
            }
            
            // Check for refund option
            if (array_key_exists('refund', $validated) ? $validated['refund'] : true) {
                // Process refunds for all payments if any payments were made
                $this->processOrderRefund($order, $returnReason ?? 'Order returned');
            }
            
            // Update payment status after refunds
            $this->updateOrderPaymentStatus($order);
            
            DB::commit();
            
            // Return JSON response for AJAX requests
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Order returned successfully.' . ((array_key_exists('refund', $validated) ? $validated['refund'] : true) ? ' Refunds processed if payments were made.' : ' No refund processed.')
                ]);
            }
            
            session()->flash('success', 'Order returned successfully.' . ((array_key_exists('refund', $validated) ? $validated['refund'] : true) ? ' Refunds processed if payments were made.' : ' No refund processed.'));
            return redirect()->route('orders.index');
        } catch (\Exception $e) {
            DB::rollBack();
            
            // Return JSON response for AJAX requests
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Failed to return order: ' . $e->getMessage()
                ], 500);
            }
            
            return back()->with('error', 'Failed to return order: ' . $e->getMessage());
        }
    }
}
