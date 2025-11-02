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
                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Order #</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th>Payment Method</th>
                                <th>Payment Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ number_format($order->total_amount, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->payment_method == 'online' ? 'info' : 'success' }}">
                                            {{ ucfirst($order->payment_method) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $order->payment_status == 'full' ? 'success' : 'warning' }}">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm bg-info-subtle">
                                            <i class="mdi mdi-eye fs-14 text-info"></i>
                                        </a>
                                        @if($order->payment_status == 'partial')
                                        <span class="text-muted small d-block">Remaining: {{ number_format($order->remaining_amount, 2) }}</span>
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
@endsection

@section('js')
<script>
    // DataTable initialization if needed
</script>
@endsection

