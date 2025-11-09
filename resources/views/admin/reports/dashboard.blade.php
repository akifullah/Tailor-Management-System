@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="py-3">
        <h4 class="fs-18 fw-semibold mb-0">Inventory Dashboard</h4>
    </div>

    <!-- Stats Cards -->
    <div class="row align-items-stretch mb-3">
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5>Total Products</h5>
                    <h2 class="text-primary">{{ $stats['total_products'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5>Total Customers</h5>
                    <h2 class="text-info">{{ $stats['total_customers'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5>Today's Orders</h5>
                    <h2 class="text-success">{{ $stats['today_orders'] }}</h2>
                    <small class="text-muted">Revenue: Rs {{ number_format($stats['today_revenue'], 2) }}</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card h-100">
                <div class="card-body">
                    <h5>Total Revenue</h5>
                    <h2 class="text-warning">Rs {{ number_format($stats['total_revenue'], 2) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Transaction Statistics -->
    <div class="row align-items-stretch mb-3">
        <div class="col-md-12">
            <h5 class="mb-3">Transaction Overview</h5>
        </div>
        <div class="col-md-3">
            <div class="card border-success h-100">
                <div class="card-body">
                    <h6>Total Paid (Orders)</h6>
                    <h4 class="text-success">Rs {{ number_format($stats['total_paid'], 2) }}</h4>
                    <small class="text-muted">Today: Rs {{ number_format($stats['today_payments_received'], 2) }}</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning h-100">
                <div class="card-body">
                    <h6>Pending Amount</h6>
                    <h4 class="text-warning">Rs {{ number_format($stats['total_pending'], 2) }}</h4>
                    <small class="text-muted">{{ $stats['pending_orders'] }} pending orders</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info h-100">
                <div class="card-body">
                    <h6>Completed Orders</h6>
                    <h4 class="text-info">{{ $stats['completed_orders'] }}</h4>
                    <small class="text-muted">Out of {{ $stats['total_orders'] }} total</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-primary h-100">
                <div class="card-body">
                    <h6>Purchase Payments</h6>
                    <h4 class="text-primary">Rs {{ number_format($stats['total_purchase_paid'], 2) }}</h4>
                    <small class="text-muted">Pending: Rs {{ number_format($stats['total_purchase_pending'], 2) }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Method Breakdown -->
    @if($paymentMethods->count() > 0)
    <div class="row align-items-stretch mb-3">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Payment Methods Breakdown</h5>
                </div>
                <div class="card-body">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Payment Method</th>
                                <th class="text-end">Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($paymentMethods as $method)
                            <tr>
                                <td>{{ ucfirst(str_replace('_', ' ', $method->payment_method)) }}</td>
                                <td class="text-end"><strong>Rs {{ number_format($method->total, 2) }}</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Quick Links</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('reports.transactions') }}" class="btn btn-outline-primary">All Transactions</a>
                        <a href="{{ route('reports.pending-transactions') }}" class="btn btn-outline-warning">Pending Transactions</a>
                        <a href="{{ route('reports.completed-transactions') }}" class="btn btn-outline-success">Completed Transactions</a>
                        <a href="{{ route('reports.customer-transactions') }}" class="btn btn-outline-info">Customer Transactions</a>
                        <a href="{{ route('reports.supplier-transactions') }}" class="btn btn-outline-secondary">Supplier Transactions</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Low Stock Alert -->
    @if($lowStockProducts->count() > 0)
    <div class="row align-items-stretch mb-3">
        <div class="col-12">
            <div class="card border-warning h-100">
                <div class="card-header bg-warning-subtle">
                    <h5 class="mb-0">⚠️ Low Stock Products</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Available Meters</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($lowStockProducts as $product)
                                <tr>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->brand->name ?? 'N/A' }}</td>
                                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                                    <td>{{ $product->available_meters }}</td>
                                    <td><span class="badge bg-danger">Low Stock</span></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Recent Transactions -->
    <div class="row align-items-stretch mb-3">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Recent Transactions</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentPayments as $payment)
                                <tr>
                                    <td>{{ $payment->payment_date->format('Y-m-d H:i') }}</td>
                                    <td>
                                        @if($payment->payable_type === 'App\Models\Order')
                                            <span class="badge bg-success">Order</span>
                                        @else
                                            <span class="badge bg-info">Purchase</span>
                                        @endif
                                    </td>
                                    <td><strong>Rs {{ number_format($payment->amount, 2) }}</strong></td>
                                    <td><span class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</span></td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No recent transactions</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header">
                    <h5 class="mb-0">Recent Orders</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                @php
                                    $totalPaid = $order->payments->sum('amount');
                                    $remaining = $order->total_amount - $totalPaid;
                                @endphp
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>Rs {{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        @if($remaining <= 0)
                                            <span class="badge bg-success">Paid</span>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

