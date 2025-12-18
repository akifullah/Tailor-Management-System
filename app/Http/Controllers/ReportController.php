<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\InventoryTracking;
use App\Models\OrderItem;
use App\Models\Supplier;
use App\Models\Payment;
use App\Models\SewingOrder;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function dashboard()
    {
        // Order Statistics
        $totalOrders = Order::count();
        $totalOrderAmount = Order::sum('total_amount');
        $todayOrders = Order::whereDate('order_date', today())->count();
        $todayOrderRevenue = Order::whereDate('order_date', today())->sum('total_amount');



        // Payment Statistics
        $allPayments = Payment::all();
        $totalPaymentsReceived = Payment::where('payable_type', Order::class)->sum('amount');
        $totalPaymentsMade = Payment::where('payable_type', InventoryTracking::class)->sum('amount');
        $todayPaymentsReceived = Payment::where('payable_type', Order::class)
            ->whereDate('payment_date', today())->sum('amount');
        $todayPaymentsMade = Payment::where('payable_type', InventoryTracking::class)
            ->whereDate('payment_date', today())->sum('amount');

        // Order Payment Status
        $orders = Order::with('payments')->get();
        $totalPaid = $orders->sum(function ($order) {
            return $order->payments->sum('amount');
        });
        $totalPending = $totalOrderAmount - $totalPaid;
        $completedOrders = $orders->filter(function ($order) {
            return $order->payments->sum('amount') >= $order->total_amount;
        })->count();
        $pendingOrders = $totalOrders - $completedOrders;

        // Purchase Statistics
        $purchases = InventoryTracking::where('type', 'purchase')->with('payments')->get();
        $totalPurchaseAmount = $purchases->sum(function ($purchase) {
            return $purchase->quantity_meters * $purchase->price_per_meter;
        });
        $totalPurchasePaid = $purchases->sum(function ($purchase) {
            return $purchase->payments->sum('amount');
        });
        $totalPurchasePending = $totalPurchaseAmount - $totalPurchasePaid;

        // Payment Method Breakdown
        $paymentMethods = Payment::select('payment_method', DB::raw('SUM(amount) as total'))
            ->groupBy('payment_method')
            ->get();

        // Expense Statistics
        $totalExpenses = Expense::sum('amount');
        $todayExpenses = Expense::whereDate('date', today())->sum('amount');
        $recentExpenses = Expense::with('user')->latest('date')->take(10)->get();

        // Recent Transactions
        $recentPayments = Payment::with(['payable'])->latest()->take(10)->get();

        // Sewing Order Statistics
        $totalSewingOrders = SewingOrder::count();
        $todaySewingOrders = SewingOrder::whereDate('order_date', today())->count();

        $stats = [
            'total_products' => Product::count(),
            'total_customers' => Customer::count(),
            'total_orders' => $totalOrders,
            'total_sewing_orders' => $totalSewingOrders,
            'total_revenue' => $totalOrderAmount,
            'today_orders' => $todayOrders,
            'today_sewing_orders' => $todaySewingOrders,
            'today_revenue' => $todayOrderRevenue,
            'total_paid' => $totalPaid,
            'total_pending' => $totalPending,
            'completed_orders' => $completedOrders,
            'pending_orders' => $pendingOrders,
            'total_payments_received' => $totalPaymentsReceived,
            'total_payments_made' => $totalPaymentsMade,
            'today_payments_received' => $todayPaymentsReceived,
            'today_payments_made' => $todayPaymentsMade,
            'total_purchase_amount' => $totalPurchaseAmount,
            'total_purchase_paid' => $totalPurchasePaid,
            'total_purchase_pending' => $totalPurchasePending,
            'total_expenses' => $totalExpenses,
            'today_expenses' => $todayExpenses,
        ];

        $lowStockProducts = Product::where('available_meters', '<', 10)->with(['brand', 'category'])->get();
        $recentOrders = Order::with(['customer', 'items', 'payments'])->latest()->take(10)->get();
        $nearestSewingOrders = SewingOrder::with(['customer'])->whereDate('delivery_date', '>=', today())->orderBy('delivery_date', 'asc')->take(10)->get();

        // Daily orders and sewing orders
        $todayOrdersList = Order::with(['customer', 'payments'])->whereDate('order_date', today())->latest()->get();
        $todaySewingOrdersList = SewingOrder::with(['customer'])->whereDate('order_date', today())->latest()->get();
        
        // Delivered orders with pending payments
        $deliveredPendingOrders = SewingOrder::with(['customer', 'payments' => function ($q) {
            $q->where('type', 'payment');
        }])
            ->where('order_status', 'delivered')
            ->paginate(10)
            ->filter(function ($order) {
                $paid = $order->payments->where('type', 'payment')->sum('amount');
                return $paid < ($order->total_amount - ($order->discount_amount ?? 0));
            });
            // return $deliveredPendingOrders;
        return view('admin.reports.dashboard', compact(
            'stats',
            'lowStockProducts',
            'recentOrders',
            'paymentMethods',
            'recentPayments',
            'recentExpenses',
            'nearestSewingOrders',
            'todayOrdersList',
            'todaySewingOrdersList',
            'deliveredPendingOrders'
        ));
    }

    public function salesReport(Request $request)
    {
        $query = Order::with(['customer', 'payments']);

        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('order_date', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('order_date', '<=', $request->date_to);
        }

        $orders = $query->get();

        // Calculate payment statistics from actual payments
        $allPayments = Payment::where('payable_type', Order::class)
            ->whereIn('payable_id', $orders->pluck('id'))
            ->get();

        // Calculate full and partial payments
        $fullPayments = $orders->filter(function ($order) {
            return $order->payments->sum('amount') >= $order->total_amount;
        })->sum('total_amount');

        $partialPayments = $orders->filter(function ($order) {
            $totalPaid = $order->payments->sum('amount');
            return $totalPaid > 0 && $totalPaid < $order->total_amount;
        })->sum(function ($order) {
            return $order->payments->sum('amount');
        });

        $summary = [
            'total_sales' => $orders->count(),
            'total_revenue' => $orders->sum('total_amount'),
            'cash_payments' => $allPayments->where('payment_method', 'cash')->sum('amount'),
            'online_payments' => $allPayments->where('payment_method', 'online')->sum('amount'),
            'bank_transfer_payments' => $allPayments->where('payment_method', 'bank_transfer')->sum('amount'),
            'cheque_payments' => $allPayments->where('payment_method', 'cheque')->sum('amount'),
            'full_payments' => $fullPayments,
            'partial_payments' => $partialPayments,
            'total_paid' => $orders->sum(function ($order) {
                return $order->payments->sum('amount');
            }),
            'pending_amount' => $orders->sum(function ($order) {
                return max(0, $order->total_amount - $order->payments->sum('amount'));
            }),
            'completed_orders' => $orders->filter(function ($order) {
                return $order->payments->sum('amount') >= $order->total_amount;
            })->count(),
            'pending_orders' => $orders->filter(function ($order) {
                return $order->payments->sum('amount') < $order->total_amount;
            })->count(),
        ];

        return view('admin.reports.sales', compact('orders', 'summary'));
    }

    public function customerReport(Request $request)
    {
        $query = Customer::with('orders');

        if ($request->has('customer_id') && $request->customer_id) {
            $query->where('id', $request->customer_id);
        }

        $customers = $query->get()->map(function ($customer) {
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

        $suppliers = $query->get()->map(function ($supplier) {
            // Calculate totals from actual purchase records (inventory_tracking)
            $totalStock = \App\Models\InventoryTracking::where('type', 'purchase')
                ->where('supplier_id', $supplier->id)
                ->sum('quantity_meters');

            $purchases = \App\Models\InventoryTracking::where('type', 'purchase')
                ->where('supplier_id', $supplier->id)
                ->get();

            $totalValue = $purchases->sum(function ($purchase) {
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
        $query = InventoryTracking::with(['product.brand', 'product.category', 'order'])->orderByDesc('id');

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
            ->where('type', 'purchase')
            ->where('supplier_id', $supplierId)
            ->orderByDesc('created_at')
            ->get();
        return view('admin.reports.supplier-ledger-detail', compact('supplier', 'purchases'));
    }

    public function transactionsReport(Request $request)
    {


        // Also include expense payments in the query
        $expenseQuery = Expense::query();

        // Filter expense by category (such as "Worker Payment"), if given
        if ($request->has('category') && $request->category) {
            $expenseQuery->where('category', $request->category);
        }

        // Filter expense by user_id, if given
        if ($request->has('user_id') && $request->user_id) {
            $expenseQuery->where('user_id', $request->user_id);
        }

        // Filter expense by date range (using the `date` field from the table)
        if ($request->has('date_from') && $request->date_from) {
            $expenseQuery->whereDate('date', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $expenseQuery->whereDate('date', '<=', $request->date_to);
        }

        // Get the latest by `date` (since there is no payment_date in this table)
        $expenses = $expenseQuery->latest('date')->get();
        
        $query = Payment::with(['payable']);

        // Filter by transaction type
        if ($request->has('type') && $request->type) {
            if ($request->type === 'orders') {
                $query->where('payable_type', Order::class);
            } elseif ($request->type === 'purchases') {
                $query->where('payable_type', InventoryTracking::class);
            } elseif ($request->type === 'sewing_order') {
                $query->where('payable_type', SewingOrder::class);
            }
        }

        // Filter by payment method
        if ($request->has('payment_method') && $request->payment_method) {
            $query->where('payment_method', $request->payment_method);
        }

        // Filter by date range
        if ($request->has('date_from') && $request->date_from) {
            $query->whereDate('payment_date', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $query->whereDate('payment_date', '<=', $request->date_to);
        }

        $transactions = $query->latest('payment_date')->get();

        // Eager load payments for orders and purchases to calculate remaining amounts
        $orderIds = $transactions->where('payable_type', Order::class)->pluck('payable_id')->unique();
        $sewingOrderIds = $transactions->where('payable_type', SewingOrder::class)->pluck('payable_id')->unique();
        $purchaseIds = $transactions->where('payable_type', InventoryTracking::class)->pluck('payable_id')->unique();
        $workerIds = $transactions->where('payable_type', "App\Models\User")->pluck('payable_id')->unique();

        if ($orderIds->count() > 0) {
            $orders = Order::whereIn('id', $orderIds)->with('payments')->get()->keyBy('id');
            // Attach loaded orders to transactions
            foreach ($transactions as $transaction) {
                if ($transaction->payable_type === Order::class && isset($orders[$transaction->payable_id])) {
                    $transaction->payable = $orders[$transaction->payable_id];
                }
            }
        }
        if ($sewingOrderIds->count() > 0) {
            $sewingOrders = SewingOrder::whereIn('id', $sewingOrderIds)->with('payments')->get()->keyBy('id');
            // Attach loaded orders to transactions
            foreach ($transactions as $transaction) {
                if ($transaction->payable_type === Order::class && isset($orders[$transaction->payable_id])) {
                    $transaction->payable = $sewingOrders[$transaction->payable_id];
                }
            }
        }

        if ($purchaseIds->count() > 0) {
            $purchases = InventoryTracking::whereIn('id', $purchaseIds)->with('payments')->get()->keyBy('id');
            // Attach loaded purchases to transactions
            foreach ($transactions as $transaction) {
                if ($transaction->payable_type === InventoryTracking::class && isset($purchases[$transaction->payable_id])) {
                    $transaction->payable = $purchases[$transaction->payable_id];
                }
            }
        }
        // return $workerIds;

        if ($workerIds->count() > 0) {
            $workerPayments = User::whereIn('id', $workerIds)->with('workerPayments')->get()->keyBy('id');
            
            foreach ($transactions as $transaction) {
                if ($transaction->payable_type === User::class && isset($workerPayments[$transaction->payable_id])) {
                    $transaction->payable = $workerPayments[$transaction->payable_id];
                }
            }
        }

        
        // Calculate summary
        $summary = [
            'total_transactions' => $transactions->count(),
            'total_amount' => $transactions->sum('amount'),
            'orders_payments' => $transactions->where('payable_type', Order::class)->sum('amount'),
            'sewing_orders_payments' => $transactions->where('payable_type', SewingOrder::class)->sum('amount'),
            'purchases_payments' => $transactions->where('payable_type', InventoryTracking::class)->sum('amount'),
            'worker_payments' => $transactions->where('payable_type', User::class)->sum('amount'),
            'expenses' => $expenses->sum('amount'),
            'by_method' => $transactions->groupBy('payment_method')->map->sum('amount'),
        ];
        // return $summary;
        return view('admin.reports.transactions', compact('transactions', "expenses", 'summary'));
    }

    public function pendingTransactionsReport(Request $request)
    {
        // Pending Order Payments
        $orderQuery = Order::with(['payments', 'items']);

        if ($request->has('date_from') && $request->date_from) {
            $orderQuery->whereDate('order_date', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $orderQuery->whereDate('order_date', '<=', $request->date_to);
        }

        $orders = $orderQuery->get()->filter(function ($order) {
            return $order->payments->sum('amount') < $order->total_amount;
        });

        // Pending Purchase Payments
        $purchaseQuery = InventoryTracking::where('type', 'purchase')->with('payments');

        if ($request->has('date_from') && $request->date_from) {
            $purchaseQuery->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $purchaseQuery->whereDate('created_at', '<=', $request->date_to);
        }

        $purchases = $purchaseQuery->get()->filter(function ($purchase) {
            $total = $purchase->quantity_meters * $purchase->price_per_meter;
            return $purchase->payments->sum('amount') < $total;
        });


        // Pending SewingOrder Payments
        $sewingOrderQuery = SewingOrder::with(['payments']);

        if ($request->has('date_from') && $request->date_from) {
            $sewingOrderQuery->whereDate('order_date', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $sewingOrderQuery->whereDate('order_date', '<=', $request->date_to);
        }

        $sewingOrders = $sewingOrderQuery->get()->filter(function ($order) {
            return $order->remaining_amount > 0;
        });

        $summary = [
            'pending_orders_count' => $orders->count(),
            'pending_orders_amount' => $orders->sum(function ($order) {
                return $order->total_amount - $order->payments->sum('amount');
            }),
            'pending_sewing_orders_count'=> $sewingOrders->count(),
            'pending_sewing_orders_amount' => $sewingOrders->sum(function ($sewingOrder) {
                return $sewingOrder->total_amount - $sewingOrder->payments->sum('amount');
            }),
            'pending_purchases_count' => $purchases->count(),
            'pending_purchases_amount' => $purchases->sum(function ($purchase) {
                $total = $purchase->quantity_meters * $purchase->price_per_meter;
                return $total - $purchase->payments->sum('amount');
            }),
        ];

        return view('admin.reports.pending-transactions', compact('orders', 'sewingOrders', 'purchases', 'summary'));
    }

    public function completedTransactionsReport(Request $request)
    {
        // Completed Orders (fully paid)
        $orderQuery = Order::with(['payments', 'items']);

        if ($request->has('date_from') && $request->date_from) {
            $orderQuery->whereDate('order_date', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $orderQuery->whereDate('order_date', '<=', $request->date_to);
        }

        $orders = $orderQuery->get()->filter(function ($order) {
            $totalPaid = $order->payments->where('type', 'payment')->sum('amount');
            $totalRefunded = $order->payments->where('type', 'refund')->sum('amount');
            $netPaid = $totalPaid - $totalRefunded;
            $effectiveTotal = $order->total_amount - ($order->discount_amount ?? 0);
            return $netPaid >= $effectiveTotal;
        });

        // Completed Purchases (fully paid)
        $purchaseQuery = InventoryTracking::where('type', 'purchase')->with('payments');

        if ($request->has('date_from') && $request->date_from) {
            $purchaseQuery->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->has('date_to') && $request->date_to) {
            $purchaseQuery->whereDate('created_at', '<=', $request->date_to);
        }

        $purchases = $purchaseQuery->get()->filter(function ($purchase) {
            $total = $purchase->quantity_meters * $purchase->price_per_meter;
            return $purchase->payments->sum('amount') >= $total;
        });

        $summary = [
            'completed_orders_count' => $orders->count(),
            // Sum effective totals (total - discount) so summaries reflect discounts
            'completed_orders_amount' => $orders->sum(function ($order) {
                return $order->total_amount - ($order->discount_amount ?? 0);
            }),
            'completed_purchases_count' => $purchases->count(),
            'completed_purchases_amount' => $purchases->sum(function ($purchase) {
                return $purchase->quantity_meters * $purchase->price_per_meter;
            }),
        ];

        return view('admin.reports.completed-transactions', compact('orders', 'purchases', 'summary'));
    }

    public function userTransactionsReport(Request $request)
    {
        $customerId = $request->get('customer_id');
        $supplierId = $request->get('supplier_id');

        $customerPayments = collect();
        $supplierPayments = collect();
        $customerOrders = collect();
        $supplierPurchases = collect();
        $customerSummary = null;
        $supplierSummary = null;

        if ($customerId) {
            $customer = Customer::with(['orders.payments'])->findOrFail($customerId);
            $customerOrders = $customer->orders()->with(['payments', 'items'])->get();

            $customerPayments = Payment::where('payable_type', Order::class)
                ->whereIn('payable_id', $customerOrders->pluck('id'))
                ->with('payable')
                ->latest('payment_date')
                ->get();

            // Calculate customer summary
            $totalOrderAmount = $customerOrders->sum('total_amount');
            $totalPaid = $customerOrders->sum(function ($order) {
                return $order->payments->sum('amount');
            });
            $totalRemaining = $totalOrderAmount - $totalPaid;

            $customerSummary = [
                'total_orders' => $customerOrders->count(),
                'total_order_amount' => $totalOrderAmount,
                'total_paid' => $totalPaid,
                'total_remaining' => $totalRemaining,
                'completed_orders' => $customerOrders->filter(function ($order) {
                    return $order->payments->sum('amount') >= $order->total_amount;
                })->count(),
                'pending_orders' => $customerOrders->filter(function ($order) {
                    return $order->payments->sum('amount') < $order->total_amount;
                })->count(),
            ];
        }

        if ($supplierId) {
            $supplier = Supplier::findOrFail($supplierId);
            $supplierPurchases = InventoryTracking::where('type', 'purchase')
                ->where('supplier_id', $supplierId)
                ->with(['payments', 'product'])
                ->get();

            $supplierPayments = Payment::where('payable_type', InventoryTracking::class)
                ->whereIn('payable_id', $supplierPurchases->pluck('id'))
                ->with('payable')
                ->latest('payment_date')
                ->get();

            // Calculate supplier summary
            $totalPurchaseAmount = $supplierPurchases->sum(function ($purchase) {
                return $purchase->quantity_meters * $purchase->price_per_meter;
            });
            $totalPaid = $supplierPurchases->sum(function ($purchase) {
                return $purchase->payments->sum('amount');
            });
            $totalRemaining = $totalPurchaseAmount - $totalPaid;

            $supplierSummary = [
                'total_purchases' => $supplierPurchases->count(),
                'total_purchase_amount' => $totalPurchaseAmount,
                'total_paid' => $totalPaid,
                'total_remaining' => $totalRemaining,
                'completed_purchases' => $supplierPurchases->filter(function ($purchase) {
                    $total = $purchase->quantity_meters * $purchase->price_per_meter;
                    return $purchase->payments->sum('amount') >= $total;
                })->count(),
                'pending_purchases' => $supplierPurchases->filter(function ($purchase) {
                    $total = $purchase->quantity_meters * $purchase->price_per_meter;
                    return $purchase->payments->sum('amount') < $total;
                })->count(),
            ];
        }

        $customers = Customer::all();
        $suppliers = Supplier::all();

        return view('admin.reports.user-transactions', compact(
            'customerPayments',
            'supplierPayments',
            'customerOrders',
            'supplierPurchases',
            'customerSummary',
            'supplierSummary',
            'customers',
            'suppliers',
            'customerId',
            'supplierId'
        ));
    }

    public function customerTransactionsReport(Request $request)
    {
        $customerId = $request->get('customer_id');
        $orderStatus = $request->get('order_status');
        $refundFilter = $request->get('refund_filter');
        $customerPayments = collect();
        $customerOrders = collect();
        $customerSewingOrders = collect();
        $customerSewingPayments = collect();
        $customerSummary = null;

        if ($customerId) {
            $customer = Customer::with(['orders.payments', 'sewingOrders.payments'])->findOrFail($customerId);
            $customerOrders = $customer->orders()->with(['payments', 'items'])->get();
            $customerSewingOrders = $customer->sewingOrders()->with(['payments', 'items'])->get();

            // Filter by order_status (pending, completed, returned, cancelled, or blank)
            if ($orderStatus) {
                $customerOrders = $customerOrders->filter(function ($order) use ($orderStatus) {
                    if ($orderStatus == 'returned') return $order->is_return;
                    return $order->order_status == $orderStatus;
                });
                $customerSewingOrders = $customerSewingOrders->filter(function ($order) use ($orderStatus) {
                    if ($orderStatus == 'returned') return $order->is_return;
                    return $order->order_status == $orderStatus;
                });
            }

            $orderPayments = Payment::where('payable_type', Order::class)
                ->whereIn('payable_id', $customerOrders->pluck('id'))
                ->with('payable')
                ->latest('payment_date')
                ->get();
            $sewingOrderPayments = Payment::where('payable_type', SewingOrder::class)
                ->whereIn('payable_id', $customerSewingOrders->pluck('id'))
                ->with('payable')
                ->latest('payment_date')
                ->get();

            // Combine all payments
            $customerPayments = $orderPayments->concat($sewingOrderPayments)->sortBy('payment_date');
            if ($refundFilter === 'refund' || $refundFilter === 'payment') {
                $customerPayments = $customerPayments->filter(fn($p) => $p->type === $refundFilter);
            }

            // Calculate customer summary including both order types (EXCLUDE cancelled/returned for remaining)
            $totalOrderAmount = $customerOrders->sum('total_amount');
            $totalOrderDiscount = $customerOrders->sum(fn($o) => $o->discount_amount ?? 0);
            $totalSewingOrderAmount = $customerSewingOrders->sum('total_amount');
            $totalSewingDiscount = $customerSewingOrders->sum(fn($o) => $o->discount_amount ?? 0);
            $totalAmount = $totalOrderAmount + $totalSewingOrderAmount;

            $totalPaid = $customerOrders->sum(function ($order) {
                return $order->payments()->where('type', 'payment')->sum('amount');
            }) + $customerSewingOrders->sum(function ($sewingOrder) {
                return $sewingOrder->payments()->where('type', 'payment')->sum('amount');
            });
            $totalRefunded = $customerOrders->sum(function ($order) {
                return $order->payments()->where('type', 'refund')->sum('amount');
            }) + $customerSewingOrders->sum(function ($sewingOrder) {
                return $sewingOrder->payments()->where('type', 'refund')->sum('amount');
            });
            $netPaid = $totalPaid - $totalRefunded;
            // Compute remaining ONLY for non-cancelled/non-returned orders
            $totalRemaining = $customerOrders->filter(function ($o) {
                return $o->order_status !== 'cancelled' && !$o->is_return;
            })->sum(function ($order) {
                $totalPaid = $order->payments()->where('type', 'payment')->sum('amount');
                $totalRefunded = $order->payments()->where('type', 'refund')->sum('amount');
                $netPaid = $totalPaid - $totalRefunded;
                $discount = $order->discount_amount ?? 0;
                return ($order->total_amount - $discount) - $netPaid;
            }) + $customerSewingOrders->filter(function ($o) {
                return $o->order_status !== 'cancelled' && !$o->is_return;
            })->sum(function ($order) {
                $totalPaid = $order->payments()->where('type', 'payment')->sum('amount');
                $totalRefunded = $order->payments()->where('type', 'refund')->sum('amount');
                $netPaid = $totalPaid - $totalRefunded;
                $discount = $order->discount_amount ?? 0;
                return ($order->total_amount - $discount) - $netPaid;
            });

            $customerSummary = [
                'total_orders' => $customerOrders->count() + $customerSewingOrders->count(),
                'total_order_amount' => $totalAmount,
                'total_order_discount' => $totalOrderDiscount,
                'total_sewing_discount' => $totalSewingDiscount,
                'total_paid' => $totalPaid,
                'total_refunded' => $totalRefunded,
                'net_paid' => $netPaid,
                'total_remaining' => $totalRemaining,
                'completed_orders' => $customerOrders->filter(function ($order) {
                    $totalPaid = $order->payments()->where('type', 'payment')->sum('amount');
                    $totalRefunded = $order->payments()->where('type', 'refund')->sum('amount');
                    return ($totalPaid - $totalRefunded) >= $order->total_amount;
                })->count() + $customerSewingOrders->filter(function ($sewingOrder) {
                    $totalPaid = $sewingOrder->payments()->where('type', 'payment')->sum('amount');
                    $totalRefunded = $sewingOrder->payments()->where('type', 'refund')->sum('amount');
                    $discount = $sewingOrder->discount_amount ?? 0;
                    return ($totalPaid - $totalRefunded) >= ($sewingOrder->total_amount - $discount);
                })->count(),
                'pending_orders' => $customerOrders->filter(function ($order) {
                    $totalPaid = $order->payments()->where('type', 'payment')->sum('amount');
                    $totalRefunded = $order->payments()->where('type', 'refund')->sum('amount');
                    return ($totalPaid - $totalRefunded) < $order->total_amount && $order->order_status !== 'cancelled' && !$order->is_return;
                })->count() + $customerSewingOrders->filter(function ($sewingOrder) {
                    $totalPaid = $sewingOrder->payments()->where('type', 'payment')->sum('amount');
                    $totalRefunded = $sewingOrder->payments()->where('type', 'refund')->sum('amount');
                    $discount = $sewingOrder->discount_amount ?? 0;
                    return ($totalPaid - $totalRefunded) < ($sewingOrder->total_amount - $discount) && $sewingOrder->order_status !== 'cancelled' && !$sewingOrder->is_return;
                })->count(),
            ];
        }

        $dateFrom = $request->get('date_from');
        $dateTo = $request->get('date_to');
        $orderType = $request->get('order_type');

        // Filter by dates if provided
        if (!empty($dateFrom)) {
            $customerOrders = $customerOrders->filter(fn($order) => $order->order_date && $order->order_date >= $dateFrom);
            $customerSewingOrders = $customerSewingOrders->filter(fn($order) => $order->order_date && $order->order_date >= $dateFrom);
        }
        if (!empty($dateTo)) {
            $customerOrders = $customerOrders->filter(fn($order) => $order->order_date && $order->order_date <= $dateTo);
            $customerSewingOrders = $customerSewingOrders->filter(fn($order) => $order->order_date && $order->order_date <= $dateTo);
        }

        // Filter by order type if provided
        $showOrders = $showSewingOrders = true;
        if ($orderType == 'order') {
            $customerSewingOrders = collect(); // Hide sewing orders by clearing the collection
            $showSewingOrders = false;
        }
        if ($orderType == 'sewing_order') {
            $customerOrders = collect(); // Hide regular orders by clearing the collection
            $showOrders = false;
        }

        $customers = Customer::all();

        return view('admin.reports.customer-transactions', compact(
            'customerPayments',
            'customerOrders',
            'customerSewingOrders',
            'customerSewingPayments',
            'customerSummary',
            'customers',
            'customerId',
            'orderStatus',
            'refundFilter'
        ));
    }

    public function supplierTransactionsReport(Request $request)
    {
        $supplierId = $request->get('supplier_id');
        $supplierPayments = collect();
        $supplierPurchases = collect();
        $supplierSummary = null;

        if ($supplierId) {
            $supplier = Supplier::findOrFail($supplierId);
            $supplierPurchases = InventoryTracking::where('type', 'purchase')
                ->where('supplier_id', $supplierId)
                ->with(['payments', 'product'])
                ->get();

            $supplierPayments = Payment::where('payable_type', InventoryTracking::class)
                ->whereIn('payable_id', $supplierPurchases->pluck('id'))
                ->with('payable')
                ->latest('payment_date')
                ->get();

            // Calculate supplier summary
            $totalPurchaseAmount = $supplierPurchases->sum(function ($purchase) {
                return $purchase->quantity_meters * $purchase->price_per_meter;
            });
            $totalPaid = $supplierPurchases->sum(function ($purchase) {
                return $purchase->payments->sum('amount');
            });
            $totalRemaining = $totalPurchaseAmount - $totalPaid;

            $supplierSummary = [
                'total_purchases' => $supplierPurchases->count(),
                'total_purchase_amount' => $totalPurchaseAmount,
                'total_paid' => $totalPaid,
                'total_remaining' => $totalRemaining,
                'completed_purchases' => $supplierPurchases->filter(function ($purchase) {
                    $total = $purchase->quantity_meters * $purchase->price_per_meter;
                    return $purchase->payments->sum('amount') >= $total;
                })->count(),
                'pending_purchases' => $supplierPurchases->filter(function ($purchase) {
                    $total = $purchase->quantity_meters * $purchase->price_per_meter;
                    return $purchase->payments->sum('amount') < $total;
                })->count(),
            ];
        }

        $suppliers = Supplier::all();

        return view('admin.reports.supplier-transactions', compact(
            'supplierPayments',
            'supplierPurchases',
            'supplierSummary',
            'suppliers',
            'supplierId'
        ));
    }
}
