@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="py-3 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold mb-0">User Transactions Report</h4>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" action="{{ route('reports.user-transactions') }}">
                <div class="row">
                    <div class="col-md-5">
                        <label>Customer</label>
                        <select name="customer_id" class="form-control">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-5">
                        <label>Supplier</label>
                        <select name="supplier_id" class="form-control">
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">Filter</button>
                        <a href="{{ route('reports.user-transactions') }}" class="btn btn-secondary">Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Customer Summary -->
    @if($customerId && $customerSummary)
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body">
                    <h6>Total Orders</h6>
                    <h4 class="text-primary">{{ $customerSummary['total_orders'] ?? 0 }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info">
                <div class="card-body">
                    <h6>Total Order Amount</h6>
                    <h4 class="text-info">Rs {{ number_format($customerSummary['total_order_amount'] ?? 0, 2) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-success">
                <div class="card-body">
                    <h6>Total Paid</h6>
                    <h4 class="text-success">Rs {{ number_format($customerSummary['total_paid'] ?? 0, 2) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning">
                <div class="card-body">
                    <h6>Remaining Amount</h6>
                    <h4 class="text-warning">Rs {{ number_format($customerSummary['total_remaining'] ?? 0, 2) }}</h4>
                    <small class="text-muted">{{ $customerSummary['pending_orders'] ?? 0 }} pending orders</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Orders Overview -->
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">Customer Orders Overview</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Order Date</th>
                            <th>Total Amount</th>
                            <th>Paid</th>
                            <th>Remaining</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customerOrders as $order)
                        @php
                            $totalPaid = $order->payments->sum('amount');
                            $remaining = $order->total_amount - $totalPaid;
                            $itemsPending = $order->items->where('status', 'pending')->count();
                            $itemsProgress = $order->items->where('status', 'progress')->count();
                            $itemsCompleted = $order->items->where('status', 'completed')->count();
                            $totalItems = $order->items->count();
                        @endphp
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td><strong>Rs {{ number_format($order->total_amount, 2) }}</strong></td>
                            <td class="text-success">Rs {{ number_format($totalPaid, 2) }}</td>
                            <td class="text-{{ $remaining > 0 ? 'warning' : 'success' }}">
                                <strong>Rs {{ number_format($remaining, 2) }}</strong>
                            </td>
                            <td>
                                @if($remaining <= 0)
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                                @if($totalItems > 0)
                                    <br>
                                    <small class="text-muted">
                                        @if($itemsCompleted == $totalItems)
                                            <span class="badge bg-success">All Items Done</span>
                                        @else
                                            <span class="badge bg-info">{{ $itemsCompleted }}/{{ $totalItems }} Done</span>
                                        @endif
                                    </small>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Customer Payment Transactions -->
    @if($customerPayments->count() > 0)
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">Customer Payment History</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Order #</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Person/Reference</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customerPayments as $payment)
                        <tr>
                            <td>{{ $payment->payment_date->format('Y-m-d H:i A') }}</td>
                            <td>
                                @if($payment->payable)
                                    <a href="{{ route('orders.show', $payment->payable->id) }}">{{ $payment->payable->order_number }}</a>
                                @else
                                    N/A
                                @endif
                            </td>
                            <td><strong>Rs {{ number_format($payment->amount, 2) }}</strong></td>
                            <td>
                                <span class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</span>
                            </td>
                            <td>{{ $payment->person_reference ?? 'N/A' }}</td>
                            <td>{{ $payment->notes ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" class="text-end">Total Payments:</th>
                            <th>Rs {{ number_format($customerPayments->sum('amount'), 2) }}</th>
                            <th colspan="3"></th>
                        </tr>
                        @if($customerSummary)
                        <tr>
                            <th colspan="2" class="text-end">Remaining Amount:</th>
                            <th class="text-{{ ($customerSummary['total_remaining'] ?? 0) > 0 ? 'warning' : 'success' }}">
                                Rs {{ number_format($customerSummary['total_remaining'] ?? 0, 2) }}
                            </th>
                            <th colspan="3"></th>
                        </tr>
                        @endif
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @endif
    @endif

    <!-- Supplier Summary -->
    @if($supplierId && $supplierSummary)
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card border-primary">
                <div class="card-body">
                    <h6>Total Purchases</h6>
                    <h4 class="text-primary">{{ $supplierSummary['total_purchases'] ?? 0 }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info">
                <div class="card-body">
                    <h6>Total Purchase Amount</h6>
                    <h4 class="text-info">Rs {{ number_format($supplierSummary['total_purchase_amount'] ?? 0, 2) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-success">
                <div class="card-body">
                    <h6>Total Paid</h6>
                    <h4 class="text-success">Rs {{ number_format($supplierSummary['total_paid'] ?? 0, 2) }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning">
                <div class="card-body">
                    <h6>Remaining Amount</h6>
                    <h4 class="text-warning">Rs {{ number_format($supplierSummary['total_remaining'] ?? 0, 2) }}</h4>
                    <small class="text-muted">{{ $supplierSummary['pending_purchases'] ?? 0 }} pending purchases</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Supplier Purchases Overview -->
    <div class="card mb-3">
        <div class="card-header">
            <h5 class="mb-0">Supplier Purchases Overview</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price/Meter</th>
                            <th>Total Amount</th>
                            <th>Paid</th>
                            <th>Remaining</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($supplierPurchases as $purchase)
                        @php
                            $totalAmount = $purchase->quantity_meters * $purchase->price_per_meter;
                            $totalPaid = $purchase->payments->sum('amount');
                            $remaining = $totalAmount - $totalPaid;
                        @endphp
                        <tr>
                            <td>{{ $purchase->created_at->format('Y-m-d') }}</td>
                            <td>{{ $purchase->product->title ?? 'N/A' }}</td>
                            <td>{{ number_format($purchase->quantity_meters, 2) }}m</td>
                            <td>Rs {{ number_format($purchase->price_per_meter, 2) }}</td>
                            <td><strong>Rs {{ number_format($totalAmount, 2) }}</strong></td>
                            <td class="text-success">Rs {{ number_format($totalPaid, 2) }}</td>
                            <td class="text-{{ $remaining > 0 ? 'warning' : 'success' }}">
                                <strong>Rs {{ number_format($remaining, 2) }}</strong>
                            </td>
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

    <!-- Supplier Payment Transactions -->
    @if($supplierPayments->count() > 0)
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Supplier Payment History</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Date & Time</th>
                            <th>Purchase ID</th>
                            <th>Product</th>
                            <th>Amount</th>
                            <th>Payment Method</th>
                            <th>Person/Reference</th>
                            <th>Notes</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($supplierPayments as $payment)
                        <tr>
                            <td>{{ $payment->payment_date->format('Y-m-d H:i A') }}</td>
                            <td>#{{ $payment->payable_id }}</td>
                            <td>
                                @if($payment->payable && $payment->payable->product)
                                    {{ $payment->payable->product->title }}
                                @else
                                    N/A
                                @endif
                            </td>
                            <td><strong>Rs {{ number_format($payment->amount, 2) }}</strong></td>
                            <td>
                                <span class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</span>
                            </td>
                            <td>{{ $payment->person_reference ?? 'N/A' }}</td>
                            <td>{{ $payment->notes ?? 'N/A' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Total Payments:</th>
                            <th>Rs {{ number_format($supplierPayments->sum('amount'), 2) }}</th>
                            <th colspan="3"></th>
                        </tr>
                        @if($supplierSummary)
                        <tr>
                            <th colspan="3" class="text-end">Remaining Amount:</th>
                            <th class="text-{{ ($supplierSummary['total_remaining'] ?? 0) > 0 ? 'warning' : 'success' }}">
                                Rs {{ number_format($supplierSummary['total_remaining'] ?? 0, 2) }}
                            </th>
                            <th colspan="3"></th>
                        </tr>
                        @endif
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @endif
    @endif

    @if(!$customerId && !$supplierId)
    <div class="card">
        <div class="card-body text-center text-muted">
            <p>Please select a customer or supplier to view their transactions.</p>
        </div>
    </div>
    @endif
</div>
@endsection

