<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\InventoryTracking;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_customers' => Customer::count(),
            'total_orders' => Order::count(),
            'total_revenue' => Order::sum('total_amount'),
            'today_orders' => Order::whereDate('order_date', today())->count(),
            'today_revenue' => Order::whereDate('order_date', today())->sum('total_amount'),
        ];

        $lowStockProducts = Product::where('available_meters', '<', 10)->with(['brand', 'category'])->get();
        $recentOrders = Order::with('customer')->latest()->take(10)->get();

        return view('admin.reports.dashboard', compact('stats', 'lowStockProducts', 'recentOrders'));
    }

    public function salesReport(Request $request)
    {
        $query = Order::with('customer');

        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('order_date', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('order_date', '<=', $request->date_to);
        }

        $orders = $query->get();
        
        $summary = [
            'total_sales' => $orders->count(),
            'total_revenue' => $orders->sum('total_amount'),
            'cash_payments' => $orders->where('payment_method', 'cash')->sum('total_amount'),
            'online_payments' => $orders->where('payment_method', 'online')->sum('total_amount'),
            'full_payments' => $orders->where('payment_status', 'full')->sum('total_amount'),
            'partial_payments' => $orders->where('payment_status', 'partial')->sum('partial_amount'),
            'pending_amount' => $orders->where('payment_status', 'partial')->sum('remaining_amount'),
        ];

        return view('admin.reports.sales', compact('orders', 'summary'));
    }

    public function customerReport(Request $request)
    {
        $query = Customer::with('orders');

        if ($request->has('customer_id') && $request->customer_id) {
            $query->where('id', $request->customer_id);
        }

        $customers = $query->get()->map(function($customer) {
            return [
                'id' => $customer->id,
                'name' => $customer->name,
                'phone' => $customer->phone,
                'total_orders' => $customer->orders->count(),
                'total_spent' => $customer->orders->sum('total_amount'),
                'last_order_date' => $customer->orders->max('order_date'),
            ];
        });

        $allCustomers = Customer::all();

        return view('admin.reports.customers', compact('customers', 'allCustomers'));
    }

    public function supplierReport(Request $request)
    {
        $query = Supplier::with('products');

        if ($request->has('supplier_id') && $request->supplier_id) {
            $query->where('id', $request->supplier_id);
        }

        $suppliers = $query->get()->map(function($supplier) {
            // Calculate totals from actual purchase records (inventory_tracking)
            $totalStock = \App\Models\InventoryTracking::where('type', 'purchase')
                ->where('supplier_id', $supplier->id)
                ->sum('quantity_meters');
            
            $purchases = \App\Models\InventoryTracking::where('type', 'purchase')
                ->where('supplier_id', $supplier->id)
                ->get();
            
            $totalValue = $purchases->sum(function($purchase) {
                return $purchase->quantity_meters * $purchase->price_per_meter;
            });

            return [
                'id' => $supplier->id,
                'name' => $supplier->name,
                'phone' => $supplier->phone,
                'total_products' => $supplier->products->count(),
                'total_stock_meters' => $totalStock,
                'total_stock_value' => $totalValue,
            ];
        });

        $allSuppliers = Supplier::all();

        return view('admin.reports.suppliers', compact('suppliers', 'allSuppliers'));
    }

    public function inventoryHistory(Request $request)
    {
        $query = InventoryTracking::with(['product.brand', 'product.category', 'order']);

        if ($request->has('product_id') && $request->product_id) {
            $query->where('product_id', $request->product_id);
        }

        if ($request->has('type') && $request->type) {
            $query->where('type', $request->type);
        }

        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        $transactions = $query->latest()->get();
        $products = Product::all();

        return view('admin.reports.inventory-history', compact('transactions', 'products'));
    }

    public function customerLedgerDetail($customerId)
    {
        $customer = Customer::with(['orders.items.product'])->findOrFail($customerId);
        $orders = $customer->orders()->with('items.product')->orderByDesc('order_date')->get();
        return view('admin.reports.customer-ledger-detail', compact('customer', 'orders'));
    }

    public function supplierLedgerDetail($supplierId)
    {
        $supplier = \App\Models\Supplier::findOrFail($supplierId);
        $purchases = \App\Models\InventoryTracking::with('product')
            ->where('type','purchase')
            ->where('supplier_id', $supplierId)
            ->orderByDesc('created_at')
            ->get();
        return view('admin.reports.supplier-ledger-detail', compact('supplier','purchases'));
    }
}

