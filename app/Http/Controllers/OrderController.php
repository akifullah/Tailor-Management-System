<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Customer;
use App\Models\InventoryTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'items.product'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::all();
        return view('admin.orders.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'order_date' => 'required|date',
            'payment_method' => 'required|in:online,cash',
            'payment_status' => 'required|in:partial,full',
            'partial_amount' => 'nullable|numeric',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.is_from_inventory' => 'nullable|boolean',
            'items.*.sell_price' => 'required|numeric',
            'items.*.quantity_meters' => 'required|numeric',
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

            $order = Order::create([
                'order_number' => 'ORD-' . str_pad(Order::count() + 1, 6, '0', STR_PAD_LEFT),
                'customer_id' => $validated['customer_id'],
                'order_date' => $validated['order_date'],
                'total_amount' => $totalAmount,
                'payment_method' => $validated['payment_method'],
                'payment_status' => $validated['payment_status'],
                'partial_amount' => $validated['partial_amount'] ?? null,
                'remaining_amount' => ($validated['payment_status'] === 'partial') ? ($totalAmount - ($validated['partial_amount'] ?? 0)) : 0,
            ]);

            foreach ($validated['items'] as $itemData) {
                $isFromInventory = isset($itemData['is_from_inventory']) && ($itemData['is_from_inventory'] == '1' || $itemData['is_from_inventory'] === true || $itemData['is_from_inventory'] === 1 || $itemData['is_from_inventory'] == 'on');
                
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $itemData['product_id'] ?? null, // Can be null if customer brings own fabric
                    'is_from_inventory' => $isFromInventory,
                    'sell_price' => $itemData['sell_price'],
                    'quantity_meters' => $itemData['quantity_meters'],
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
        $order->load(['customer', 'items.product']);
        // return $order;
        return view('admin.orders.show', compact('order'));
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
}

