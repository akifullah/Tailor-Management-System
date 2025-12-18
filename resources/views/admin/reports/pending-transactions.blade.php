@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold mb-0">Pending Transactions Report</h4>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('reports.pending-transactions') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Date From</label>
                            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                        </div>
                        <div class="col-md-3">
                            <label>Date To</label>
                            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('reports.pending-transactions') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Summary -->
        <div class="row align-items-stretch mb-3">

            <div class="col-md-3 mb-2">
                <div class="card border-danger h-100">
                    <div class="card-body">
                        <h6>Total Pending</h6>
                        <h4 class="text-danger">Rs
                            {{ number_format(($summary['pending_orders_amount'] ?? 0) + ($summary['pending_sewing_orders_amount'] ?? 0) + ($summary['pending_purchases_amount'] ?? 0), 2) }}
                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-2">
                <div class="card border-warning h-100">
                    <div class="card-body">
                        <h6>Pending Orders</h6>
                        <h4 class="text-warning">{{ $summary['pending_orders_count'] ?? 0 }}</h4>
                        <h6>Amount: Rs {{ number_format($summary['pending_orders_amount'] ?? 0, 2) }}</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="card border-warning h-100">
                    <div class="card-body">
                        <h6>Pending Sewing Orders</h6>
                        <h4 class="text-warning">{{ $summary['pending_sewing_orders_count'] ?? 0 }}</h4>
                        <h6>Amount: Rs {{ number_format($summary['pending_sewing_orders_amount'] ?? 0, 2) }}</h6>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-2">
                <div class="card border-warning h-100">
                    <div class="card-body">
                        <h6>Pending Purchases</h6>
                        <h4 class="text-warning">{{ $summary['pending_purchases_count'] ?? 0 }}</h4>
                        <h6>Amount: Rs {{ number_format($summary['pending_purchases_amount'] ?? 0, 2) }}</h6>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-3 mb-2">
                <div class="card border-danger h-100">
                    <div class="card-body">
                        <h6>Total Order Pending</h6>
                        <h4 class="text-danger">Rs
                            {{ number_format($summary['pending_orders_amount'] ?? 0, 2) }}
                        </h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-2">
                <div class="card border-danger h-100">
                    <div class="card-body">
                        <h6>Total Sewing Pending</h6>
                        <h4 class="text-danger">Rs
                            {{ number_format($summary['pending_sewing_orders_amount'] ?? 0, 2) }}
                        </h4>
                    </div>
                </div>
            </div> --}}
        </div>

        <!-- Pending Sewing Orders -->
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="mb-0">Pending Sewing Payments</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sewing Order #</th>
                                <th>Customer</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                                <th>Paid</th>
                                <th>Remaining</th>
                                <!-- <th>Status</th> -->
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sewingOrders as $sewingOrder)
                                @php
                                    $sewingTotalPaid = $sewingOrder->payments->sum('amount');
                                    $sewingRemaining = $sewingOrder->total_amount - $sewingTotalPaid;
                                @endphp
                                <tr>
                                    <td>
                                        <a href="{{ route('sewing-orders.show', $sewingOrder->id) }}">
                                            {{ $sewingOrder->sewing_order_number ?? $sewingOrder->id }}
                                        </a>
                                    </td>
                                    <td>{{ $sewingOrder->customer->name ?? 'N/A' }}</td>
                                    <td>{{ $sewingOrder->order_date->format('d-m-Y') }}
                                    </td>
                                    <td>Rs {{ number_format($sewingOrder->total_amount, 2) }}</td>
                                    <td class="text-success">Rs {{ number_format($sewingTotalPaid, 2) }}</td>
                                    <td class="text-warning"><strong>Rs {{ number_format($sewingRemaining, 2) }}</strong>
                                    </td>
                                    <!-- <td>
                                        @if (isset($sewingOrder->status))
                                            @switch($sewingOrder->status)
                                                @case('pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @break

                                                @case('completed')
                                                    <span class="badge bg-success">Completed</span>
                                                @break

                                                @case('cancelled')
                                                    <span class="badge bg-secondary">Cancelled</span>
                                                @break

                                                @default
                                                    <span
                                                        class="badge bg-light text-dark">{{ ucfirst($sewingOrder->status) }}</span>
                                            @endswitch
                                        @else
                                            <span class="badge bg-light text-dark">N/A</span>
                                        @endif
                                    </td> -->
                                    <td>
                                        <a href="{{ route('sewing-orders.show', $sewingOrder->id) }}"
                                            class="btn btn-sm btn-primary">View</a>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No pending sewing orders</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pending Orders -->
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Pending Order Payments</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Order Date</th>
                                    <th>Total Amount</th>
                                    <th>Paid</th>
                                    <th>Remaining</th>
                                    <!-- <th>Order Status</th> -->
                                    <!-- <th>Items Status</th> -->
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                    @php
                                        $totalPaid = $order->payments->sum('amount');
                                        $remaining = $order->total_amount - $totalPaid;
                                        $itemsPending = $order->items->where('status', 'pending')->count();
                                        $itemsProgress = $order->items->where('status', 'progress')->count();
                                        $itemsCompleted = $order->items->where('status', 'completed')->count();
                                        $totalItems = $order->items->count();
                                    @endphp
                                    <tr>
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}">
                                                {{ $order->order_number }}
                                            </a>
                                        </td>
                                        <td>{{ $order->customer->name ?? 'N/A' }}</td>
                                        <td>{{ $order->order_date->format("d-m-Y") }}</td>
                                        <td>Rs {{ number_format($order->total_amount, 2) }}</td>
                                        <td class="text-success">Rs {{ number_format($totalPaid, 2) }}</td>
                                        <td class="text-warning"><strong>Rs {{ number_format($remaining, 2) }}</strong></td>
                                        <!-- <td>
                                            @if (isset($order->order_status))
                                                @switch($order->order_status)
                                                    @case('pending')
                                                        <span class="badge bg-warning text-dark">Pending</span>
                                                    @break

                                                    @case('completed')
                                                        <span class="badge bg-success">Completed</span>
                                                    @break

                                                    @case('returned')
                                                        <span class="badge bg-danger">Returned</span>
                                                    @break

                                                    @case('cancelled')
                                                        <span class="badge bg-secondary">Cancelled</span>
                                                    @break

                                                    @default
                                                        <span class="badge bg-light text-dark">{{ ucfirst($order->status) }}</span>
                                                @endswitch
                                            @else
                                                <span class="badge bg-light text-dark">N/A</span>
                                            @endif
                                        </td> -->
                                        <!-- <td>
                                            @if ($totalItems > 0)
                                                @if ($itemsCompleted == $totalItems)
                                                    <span class="badge bg-success">All Items Done</span>
                                                @else
                                                    <span class="badge bg-info">{{ $itemsCompleted }}/{{ $totalItems }}
                                                        Done</span>
                                                @endif
                                            @endif
                                        </td> -->
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}"
                                                class="btn btn-sm btn-primary">View</a>
                                        </td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" class="text-center text-muted">No pending orders</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pending Purchases -->
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Pending Purchase Payments</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Product</th>
                                        <th>Supplier</th>
                                        <th>Total Amount</th>
                                        <th>Paid</th>
                                        <th>Remaining</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($purchases as $purchase)
                                        @php
                                            $totalAmount = $purchase->quantity_meters * $purchase->price_per_meter;
                                            $totalPaid = $purchase->payments->sum('amount');
                                            $remaining = $totalAmount - $totalPaid;
                                        @endphp
                                        <tr>
                                            <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                                            <td>{{ $purchase->product->title ?? 'N/A' }}</td>
                                            <td>{{ $purchase->supplier->name ?? 'N/A' }}</td>
                                            <td>Rs {{ number_format($totalAmount, 2) }}</td>
                                            <td class="text-success">Rs {{ number_format($totalPaid, 2) }}</td>
                                            <td class="text-warning"><strong>Rs {{ number_format($remaining, 2) }}</strong></td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No pending purchases</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
