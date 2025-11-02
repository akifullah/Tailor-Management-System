<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\InventoryTracking;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index()
    {
        // List of all purchases (inventory tracking of type 'purchase')
        $purchases = InventoryTracking::with(['product', 'product.supplier'])
            ->where('type', 'purchase')->latest()->get();
            // return $purchases;
        return view('admin.purchases.index', compact('purchases'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $products = Product::all();
        return view('admin.purchases.create', compact('suppliers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'product_id' => 'required|exists:products,id',
            'quantity_meters' => 'required|numeric|min:0.01',
            'price_per_meter' => 'required|numeric|min:0',
            'reference_number' => 'nullable|string|max:191',
            'notes' => 'nullable|string|max:500',
        ]);
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($validated['product_id']);
            // increment stock
            $product->available_meters += $validated['quantity_meters'];
            $product->save();

            $purchase = InventoryTracking::create([
                'product_id' => $product->id,
                'supplier_id' => $validated['supplier_id'],
                'order_id' => null,
                'type' => 'purchase',
                'quantity_meters' => $validated['quantity_meters'],
                'price_per_meter' => $validated['price_per_meter'],
                'balance_meters' => $product->available_meters,
                'reference_number' => $validated['reference_number'],
                'notes' => $validated['notes'],
            ]);
            DB::commit();
            return redirect()->route('purchases.index')->with('success', 'Stock/Purchase recorded and inventory updated.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to record purchase: ' . $e->getMessage());
        }
    }
}
