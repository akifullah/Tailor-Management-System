@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Worker Ledger - {{ $worker->name }}</h4>
            </div>
            <div>
                <a href="{{ route('admin.workers.ledger.index') }}" class="btn btn-secondary btn-sm">Back to Workers</a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row mb-3">
            <div class="col-md-3 mb-3">
                <div class="card border-primary h-100">
                    <div class="card-body">
                        <h6 class="mb-1">Total Assigned Items</h6>
                        <h3 class="mb-0">{{ $workStats['total'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-secondary h-100">
                    <div class="card-body">
                        <h6 class="mb-1">Pending</h6>
                        <h3 class="mb-0">{{ $workStats['pending'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-warning h-100">
                    <div class="card-body">
                        <h6 class="mb-1">In Progress</h6>
                        <h3 class="mb-0">{{ $workStats['in_progress'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-3 mb-3">
                <div class="card border-info h-100">
                    <div class="card-body">
                        <h6 class="mb-1">On Hold</h6>
                        <h3 class="mb-0">{{ $workStats['on_hold'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3"> --}}
            <div class="col-md-3 mb-3">
                <div class="card border-success h-100">
                    <div class="card-body">
                        <h6 class="mb-1">Completed / Delivered</h6>
                        <h3 class="mb-0">{{ $workStats['completed'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-3 mb-3">
                <div class="card border-success h-100">
                    <div class="card-body">
                        <h6 class="mb-1">Delivered</h6>
                        <h3 class="mb-0">{{ $workStats['delivered'] ?? 0 }}</h3>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-3 mb-3">
                <div class="card border-danger h-100">
                    <div class="card-body">
                        <h6 class="mb-1">Cancelled</h6>
                        <h3 class="mb-0">{{ $workStats['cancelled'] ?? 0 }}</h3>
                    </div>
                </div>
            </div>
        {{-- </div>

        <div class="row mb-3"> --}}
            <div class="col-md-3 mb-3">
                <div class="card border-success h-100">
                    <div class="card-body">
                        <h6 class="mb-1">Amount For Completed Items</h6>
                        <h3 class="mb-0 text-success">Rs {{ number_format($summary['completed_amount'] ?? 0, 2) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-success h-100">
                    <div class="card-body">
                        <h6 class="mb-1">Total Paid To Worker</h6>
                        <h3 class="mb-0 text-success">Rs {{ number_format($summary['paid'] ?? 0, 2) }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <div class="card border-warning h-100">
                    <div class="card-body">
                        <h6 class="mb-1">Remaining (Completed - Paid)</h6>
                        <h3 class="mb-0 text-warning">Rs {{ number_format(($summary['remaining'] ?? 0), 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-7">
                <div class="card mb-3">
                    <div class="card-body">
                        <!-- Bootstrap 5 Tabs -->
                        <ul class="nav nav-tabs mb-3" id="workItemsTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pending-tab" data-bs-toggle="tab" data-bs-target="#pending" type="button" role="tab" aria-controls="pending" aria-selected="true">
                                    Pending <span class="badge bg-secondary">{{ $workStats['pending'] ?? 0 }}</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="in-progress-tab" data-bs-toggle="tab" data-bs-target="#in-progress" type="button" role="tab" aria-controls="in-progress" aria-selected="false">
                                    In Progress <span class="badge bg-warning">{{ $workStats['in_progress'] ?? 0 }}</span>
                                </button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="completed-tab" data-bs-toggle="tab" data-bs-target="#completed" type="button" role="tab" aria-controls="completed" aria-selected="false">
                                    Completed <span class="badge bg-success">{{ $workStats['completed'] ?? 0 }}</span>
                                </button>
                            </li>
                        </ul>

                        <!-- Tab Content -->
                        <div class="tab-content" id="workItemsTabContent">
                            <!-- Pending Items Tab -->
                            <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                                <div class="table-responsive">
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
                                            @forelse ($pendingItems as $index => $item)
                                                <tr>
                                                    <td>{{ $pendingItems->firstItem() + $index }}</td>
                                                    <td>{{ $item->sewingOrder->sewing_order_number ?? '-' }}</td>
                                                    <td>{{ $item->sewingOrder->customer->name ?? '-' }}</td>
                                                    <td class="text-capitalize">{{ $item->product_name }}</td>
                                                    <td>{{ ucfirst(str_replace('_', ' ', $item->pivot->status ?? 'pending')) }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>Rs {{ number_format(($item->pivot->worker_cost ?? 0) * $item->qty, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted">No pending items found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if($pendingItems->hasPages())
                                    <div class="mt-3">
                                        {{ $pendingItems->links('pagination::bootstrap-5') }}
                                    </div>
                                @endif
                            </div>

                            <!-- In Progress Items Tab -->
                            <div class="tab-pane fade" id="in-progress" role="tabpanel" aria-labelledby="in-progress-tab">
                                <div class="table-responsive">
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
                                            @forelse ($inProgressItems as $index => $item)
                                                <tr>
                                                    <td>{{ $inProgressItems->firstItem() + $index }}</td>
                                                    <td>{{ $item->sewingOrder->sewing_order_number ?? '-' }}</td>
                                                    <td>{{ $item->sewingOrder->customer->name ?? '-' }}</td>
                                                    <td class="text-capitalize">{{ $item->product_name }}</td>
                                                    <td>{{ ucfirst(str_replace('_', ' ', $item->pivot->status ?? 'in_progress')) }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>Rs {{ number_format(($item->pivot->worker_cost ?? 0) * $item->qty, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted">No in progress items found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if($inProgressItems->hasPages())
                                    <div class="mt-3">
                                        {{ $inProgressItems->links('pagination::bootstrap-5') }}
                                    </div>
                                @endif
                            </div>

                            <!-- Completed Items Tab -->
                            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Order #</th>
                                                <th>Customer</th>
                                                <th class="text-capitalize">Product</th>
                                                <th>Status</th>
                                                <th>Qty</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($completedItems as $index => $item)
                                                <tr>
                                                    <td>{{ $completedItems->firstItem() + $index }}</td>
                                                    <td>{{ $item->sewingOrder->sewing_order_number ?? '-' }}</td>
                                                    <td>{{ $item->sewingOrder->customer->name ?? '-' }}</td>
                                                    <td>{{ $item->product_name }}</td>
                                                    <td>{{ ucfirst(str_replace('_', ' ', $item->pivot->status ?? 'completed')) }}</td>
                                                    <td>{{ $item->qty }}</td>
                                                    <td>Rs {{ number_format(($item->pivot->worker_cost ?? 0) * $item->qty, 2) }}</td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7" class="text-center text-muted">No completed items found.</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @if($completedItems->hasPages())
                                    <div class="mt-3">
                                        {{ $completedItems->links('pagination::bootstrap-5') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="mb-3">Add Payment</h5>
                        <form method="POST" action="{{ route('admin.workers.ledger.payments.store', $worker->id) }}">
                            @csrf
                            <div class="row">

                                <div class="mb-2 col-md-6">
                                    <label class="form-label">Amount</label>
                                    <input type="number" step="0.01" name="amount" class="form-control" required>
                                </div>
                                <div class="mb-2 col-md-6">
                                    <label class="form-label">Payment Method</label>
                                    <select name="payment_method" class="form-select" required>
                                        <option value="cash">Cash</option>
                                        <option value="online">Online</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                        <option value="cheque">Cheque</option>
                                    </select>
                                </div>
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Payment Date</label>
                                <input type="datetime-local" name="payment_date" class="form-control"
                                    value="{{ date('Y-m-d\TH:i') }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Notes</label>
                                <textarea name="notes" class="form-control" rows="2"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Save Payment</button>
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body table-responsive">
                        <h5 class="mb-3">Payment History</h5>
                        <table class="table table-sm table-bordered align-middle">
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
                                        <td>{{ optional($payment->payment_date)->format('Y-m-d h:i A') }}</td>
                                        <td>Rs {{ number_format($payment->amount, 2) }}</td>
                                        <td>{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</td>
                                        <td style="max-width: 130px">{{ $payment->notes ?? '-' }}</td>
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
