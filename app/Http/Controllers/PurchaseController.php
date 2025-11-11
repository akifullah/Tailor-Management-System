<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\InventoryTracking;
use App\Models\Payment;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    public function index(Request $request)
    {
        $query = InventoryTracking::with(['product', 'product.supplier', 'supplier', 'payments'])
            ->where('type', 'purchase');

        // Filter by search type and value (product, supplier, reference_number)
        $type = $request->input('type');
        $value = $request->input('value');

        if ($type && $value !== null && $value !== '') {
            if ($type === 'product') {
                // Allow searching by product title or ID
                $query->whereHas('product', function($q) use ($value) {
                    $q->where('title', 'like', "%{$value}%")
                      ->orWhere('id', $value);
                });
            } elseif ($type === 'supplier') {
                // By supplier name or ID
                $query->whereHas('supplier', function($q) use ($value) {
                    $q->where('name', 'like', "%{$value}%")
                      ->orWhere('id', $value);
                });
            } elseif ($type === 'reference_number') {
                // By reference number
                $query->where('reference_number', 'like', "%{$value}%");
            }
            // Add more search types if needed
        }

        $purchases = $query->latest()->get();

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
            'payment_status' => 'nullable|in:full,partial',
            'paid_amount' => 'nullable|numeric|min:0.01',
            'payment_method' => 'nullable|in:cash,online,bank_transfer,cheque',
            'payment_date' => 'nullable|date',
            'person_reference' => 'nullable|string|max:255',
            'payment_notes' => 'nullable|string',
        ]);

        // Additional validation: If payment_status is set, payment_method is required
        if (isset($validated['payment_status']) && $validated['payment_status'] !== '') {
            if (empty($validated['payment_method'])) {
                return back()->withInput()->with('error', 'Payment method is required when payment status is selected.');
            }
        }

        // Additional validation: If payment_status is partial, paid_amount is required
        if (isset($validated['payment_status']) && $validated['payment_status'] === 'partial') {
            if (empty($validated['paid_amount']) || $validated['paid_amount'] <= 0) {
                return back()->withInput()->with('error', 'Paid amount is required for partial payment.');
            }
        }
        
        DB::beginTransaction();
        try {
            $product = Product::findOrFail($validated['product_id']);
            
            // Calculate total amount
            $totalAmount = $validated['quantity_meters'] * $validated['price_per_meter'];
            
            // Validate paid amount doesn't exceed total
            if (isset($validated['paid_amount']) && $validated['paid_amount'] > $totalAmount) {
                DB::rollBack();
                return back()->withInput()->with('error', 'Paid amount cannot exceed total amount.');
            }
            
            // Determine payment amount
            $paymentAmount = 0;
            if (isset($validated['payment_status'])) {
                if ($validated['payment_status'] === 'full') {
                    $paymentAmount = $totalAmount;
                } elseif ($validated['payment_status'] === 'partial' && isset($validated['paid_amount']) && $validated['paid_amount'] > 0) {
                    $paymentAmount = min($validated['paid_amount'], $totalAmount); // Ensure payment doesn't exceed total
                }
            }
            
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
            
            // Create payment record if payment amount > 0
            if ($paymentAmount > 0 && isset($validated['payment_method'])) {
                // Format payment_date properly - handle datetime-local format (YYYY-MM-DDTHH:mm)
                $paymentDate = $validated['payment_date'] ?? now();
                
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
                    'payable_type' => InventoryTracking::class,
                    'payable_id' => $purchase->id,
                    'amount' => $paymentAmount,
                    'payment_method' => $validated['payment_method'],
                    'person_reference' => $validated['person_reference'] ?? null,
                    'payment_date' => $paymentDate,
                    'notes' => $validated['payment_notes'] ?? null,
                ]);
            }
            
            DB::commit();
            return redirect()->route('purchases.index')->with('success', 'Stock/Purchase recorded and inventory updated.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Failed to record purchase: ' . $e->getMessage());
        }
    }
}
