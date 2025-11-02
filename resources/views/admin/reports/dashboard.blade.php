@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="py-3">
        <h4 class="fs-18 fw-semibold mb-0">Inventory Dashboard</h4>
    </div>

    <!-- Stats Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Total Products</h5>
                    <h2 class="text-primary">{{ $stats['total_products'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Total Customers</h5>
                    <h2 class="text-info">{{ $stats['total_customers'] }}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Today's Orders</h5>
                    <h2 class="text-success">{{ $stats['today_orders'] }}</h2>
                    <small class="text-muted">Revenue: {{ number_format($stats['today_revenue'], 2) }}</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5>Total Revenue</h5>
                    <h2 class="text-warning">{{ number_format($stats['total_revenue'], 2) }}</h2>
                </div>
            </div>
        </div>
    </div>

    <!-- Low Stock Alert -->
    @if($lowStockProducts->count() > 0)
    <div class="row mt-3">
        <div class="col-12">
            <div class="card border-warning">
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

    <!-- Recent Orders -->
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Recent Orders</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Payment</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ number_format($order->total_amount, 2) }}</td>
                                    <td><span class="badge bg-{{ $order->payment_method == 'online' ? 'info' : 'success' }}">{{ ucfirst($order->payment_method) }}</span></td>
                                    <td><span class="badge bg-{{ $order->payment_status == 'full' ? 'success' : 'warning' }}">{{ ucfirst($order->payment_status) }}</span></td>
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

