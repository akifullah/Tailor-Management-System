@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Orders</h4>
            </div>
            <a href="{{ route('orders.create') }}" class="btn btn-primary btn-sm">Add Order</a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <form id="orderSearchForm" method="GET" action="">
                                <div class="row g-2 justify-content-end align-items-end">
                                    <div class="col-md-2">
                                        <label for="search_type" class="form-label">Search By</label>
                                        <select name="type" id="search_type" class="form-select" required>
                                            <option value="">-- Select Type --</option>
                                            <option value="order_number"
                                                {{ request('type') == 'order_number' ? 'selected' : '' }}>Order Number
                                            </option>
                                            <option value="customer" {{ request('type') == 'customer' ? 'selected' : '' }}>
                                                Customer</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="search_value" class="form-label">Input Value</label>
                                        <input type="text" required name="value" id="search_value" class="form-control"
                                            value="{{ request('value') }}" placeholder="Enter value">
                                    </div>
                                    <div class="col-md-1 align-self-end">
                                        <div class="d-flex gap-1">
                                            <button type="submit" class="btn px-2 btn-primary">Search</button>
                                            <a href="{{ route(Route::currentRouteName()) }}"
                                                class="btn px-2 btn-secondary">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Order Number</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Total Amount</th>
                                    <th>Payment Status</th>
                                    <th>Delivery Status</th>
                                    <th>Items Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($orders->isNotEmpty())
                                    @foreach ($orders as $order)
                                        @php
                                            $totalPaid = $order->payments->sum('amount');
                                            $remaining = $order->total_amount - $totalPaid;
                                            $itemsPending = $order->items->where('status', 'pending')->count();
                                            $itemsProgress = $order->items->where('status', 'progress')->count();
                                            $itemsCompleted = $order->items->where('status', 'completed')->count();
                                            $totalItems = $order->items->count();
                                        @endphp
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->order_number }}</td>
                                            <td>{{ $order->order_date }}</td>
                                            <td>{{ $order->customer->name ?? 'N/A' }}</td>
                                            <td>{{ number_format($order->total_amount, 2) }}</td>
                                            <td>
                                                <span class="badge bg-{{ $remaining <= 0 ? 'success' : 'warning' }}">
                                                    {{ $remaining <= 0 ? 'Paid' : 'Pending' }}
                                                </span>
                                                @if ($remaining > 0)
                                                    <br><small class="text-muted">Remaining: Rs
                                                        {{ number_format($remaining, 2) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <span
                                                    class="badge bg-{{ $order->delivery_status == 'delivered' ? 'success' : 'secondary' }}">
                                                    {{ ucfirst($order->delivery_status ?? 'pending') }}
                                                </span>
                                                @if ($order->delivery_date)
                                                    <br><small
                                                        class="text-muted">{{ $order->delivery_date->format('Y-m-d') }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($totalItems > 0)
                                                    @if ($itemsCompleted == $totalItems)
                                                        <span class="badge bg-success">All Completed</span>
                                                    @elseif($itemsProgress > 0 || $itemsPending > 0)
                                                        <span class="badge bg-info">
                                                            {{ $itemsCompleted }}/{{ $totalItems }} Done
                                                        </span>
                                                        <br>
                                                        <small class="text-muted">
                                                            @if ($itemsProgress > 0)
                                                                <span class="badge bg-warning">{{ $itemsProgress }} In
                                                                    Progress</span>
                                                            @endif
                                                            @if ($itemsPending > 0)
                                                                <span class="badge bg-secondary">{{ $itemsPending }}
                                                                    Pending</span>
                                                            @endif
                                                        </small>
                                                    @endif
                                                @else
                                                    <span class="text-muted">No items</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('orders.show', $order) }}"
                                                    class="btn btn-sm bg-info-subtle">
                                                    <i class="mdi mdi-eye fs-14 text-info"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="11" class="text-center text-muted">
                                        No orders found.
                                    </td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        // DataTable initialization if needed
    </script>
@endsection
