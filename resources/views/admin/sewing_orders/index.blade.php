@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Sewing Orders</h4>
            </div>
            <a href="{{ route('sewing-orders.create') }}" class="btn btn-primary btn-sm">Add Sewing Order</a>
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
                                <div class="row g-2  align-items-end">
                                    <div class="col-sm-3 col-lg-2">
                                        <label for="search_type" class="form-label">Search By</label>
                                        <select name="type" id="search_type" class="form-select" required>
                                            <option value="">-- Select Type --</option>
                                            <option value="id" {{ request('type') == 'id' ? 'selected' : '' }}>ID
                                            </option>
                                            <option value="customer_id"
                                                {{ request('type') == 'customer_id' ? 'selected' : '' }}>Customer ID
                                            </option>
                                            <option value="customer_name"
                                                {{ request('type') == 'customer_name' ? 'selected' : '' }}>Customer Name
                                            </option>
                                            <option value="customer_phone"
                                                {{ request('type') == 'customer_phone' ? 'selected' : '' }}>Customer Phone
                                            </option>
                                            <option value="sewing_order_number"
                                                {{ request('type') == 'sewing_order_number' ? 'selected' : '' }}>Order
                                                Number</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-3 col-lg-2">
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
                        <table id="datatable-buttons"
                            class="table table-striped table-hover table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Sewing Order Number</th>
                                    <th>Customer</th>

                                    <th>Date</th>
                                    <th>Delivery Date</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($orders->isNotEmpty())
                                    @foreach ($orders as $order)
                                        @php
                                            $totalPaid = $order->payments->sum('amount');
                                            $remaining = $order->total_amount - $totalPaid;
                                        @endphp
                                        @php
                                            // Calculate if delivery date is today or tomorrow
                                            $deliveryDate = $order->delivery_date;
                                            $now = \Carbon\Carbon::now();
                                            $isDeliveryClose = false;
                                            if ($deliveryDate) {
                                                // Check if delivery date is today or tomorrow
                                                $daysDiff = $now->diffInDays($deliveryDate, false);
                                                $isDeliveryClose = $daysDiff >= 0 && $daysDiff <= 1;
                                            }
                                        @endphp
                                        <tr
                                            @if ($isDeliveryClose && $order->order_status != 'delivered') style="background-color:rgba(255,87,34,0.1);" @endif>
                                            <td>{{ $order->id }}</td>
                                            <td><a
                                                    href="{{ route('sewing-orders.show', $order->id) }}">{{ $order->sewing_order_number ?? 'N/A' }}</a>
                                            </td>
                                            <td>{{ $order->customer->name ?? 'N/A' }}</td>

                                            <td>{{ $order->order_date ? $order->order_date->format('Y-m-d') : 'N/A' }}</td>
                                            <td>
                                                {{ $order?->delivery_date?->format('Y-m-d') }}
                                            </td>
                                            <td>Rs {{ number_format($order->total_amount, 2) }}</td>
                                            <td>
                                                @php
                                                    $totalPaid = $order->payments->sum('amount');
                                                    $remaining = $order->total_amount - $totalPaid;
                                                @endphp
                                                {{-- <span class="badge bg-{{ $remaining <= 0 ? 'success' : 'warning' }}">
                                                    {{ $remaining <= 0 ? 'Paid' : 'Pending' }}
                                                </span> --}}

                                                <span
                                                    class="badge bg-{{ ($order->order_status == 'completed' || $order->order_status == 'delivered') ? 'success' : ($order->order_status == 'cancelled' ? 'danger' : 'warning') }}">
                                                    {{ ucfirst(str_replace('_', ' ', $order->order_status)) }}
                                                </span>
                                                @if ($remaining > 0)
                                                    <br><small class="text-muted">Remaining: Rs
                                                        {{ number_format($remaining, 2) }}</small>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('sewing-orders.show', $order) }}"
                                                    class="btn btn-sm bg-info-subtle">
                                                    <i class="mdi mdi-eye fs-14 text-info"></i>
                                                </a>
                                                <a href="{{ route('sewing-orders.edit', $order->id) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="mdi mdi-pencil"></i> Edit
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
                    <div class="px-3">
                        {{ $orders->links('pagination::bootstrap-5') }}
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
