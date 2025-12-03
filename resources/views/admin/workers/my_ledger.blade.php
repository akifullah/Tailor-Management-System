@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">My Ledger</h4>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <div class="card border-primary h-100">
                    <div class="card-body">
                        <h6 class="mb-1">Total Assigned Items</h6>
                        <h3 class="mb-0">{{ $workStats['total'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-secondary h-100">
                    <div class="card-body">
                        <h6 class="mb-1">Pending</h6>
                        <h3 class="mb-0">{{ $workStats['pending'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-warning h-100">
                    <div class="card-body">
                        <h6 class="mb-1">In Progress</h6>
                        <h3 class="mb-0">{{ $workStats['in_progress'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-info h-100">
                    <div class="card-body">
                        <h6 class="mb-1">On Hold</h6>
                        <h3 class="mb-0">{{ $workStats['on_hold'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-3">
                <div class="card border-success h-100">
                    <div class="card-body">
                        <h6 class="mb-1">Completed / Delivered</h6>
                        <h3 class="mb-0">{{ $workStats['completed'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-danger h-100">
                    <div class="card-body">
                        <h6 class="mb-1">Cancelled</h6>
                        <h3 class="mb-0">{{ $workStats['cancelled'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-success h-100">
                    <div class="card-body">
                        <h5>Total Paid To Me</h5>
                        <h2 class="text-success">Rs {{ number_format($summary['paid'] ?? 0, 2) }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card mb-3">
                    <div class="card-body table-responsive">
                        <h5 class="mb-3">My Work Items</h5>
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order #</th>
                                    <th>Customer</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($workItems as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->sewingOrder->sewing_order_number ?? '-' }}</td>
                                        <td>{{ $item->sewingOrder->customer->name ?? '-' }}</td>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $item->pivot->status ?? 'pending')) }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>Rs {{ number_format($item->total_price, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No work items found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="mb-3">Payment History</h5>
                        <table class="table table-sm table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payments as $payment)
                                    <tr>
                                        <td>{{ optional($payment->payment_date)->format('Y-m-d H:i') }}</td>
                                        <td>Rs {{ number_format($payment->amount, 2) }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                                        <td>{{ $payment->notes ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center text-muted">No payments recorded.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
