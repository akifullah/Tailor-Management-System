@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold mb-0">All Transactions Report</h4>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('reports.transactions') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <label>Transaction Type</label>
                            <select name="type" class="form-control">
                                <option value="">All</option>
                                <option value="orders" {{ request('type') == 'orders' ? 'selected' : '' }}>Orders</option>
                                <option value="sewing_order" {{ request('type') == 'sewing_order' ? 'selected' : '' }}>
                                    Sewing Orders</option>
                                <option value="purchases" {{ request('type') == 'purchases' ? 'selected' : '' }}>Purchases
                                </option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Payment Method</label>
                            <select name="payment_method" class="form-control">
                                <option value="">All Methods</option>
                                <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>Cash
                                </option>
                                <option value="online" {{ request('payment_method') == 'online' ? 'selected' : '' }}>Online
                                </option>
                                <option value="bank_transfer"
                                    {{ request('payment_method') == 'bank_transfer' ? 'selected' : '' }}>Bank Transfer
                                </option>
                                <option value="cheque" {{ request('payment_method') == 'cheque' ? 'selected' : '' }}>Cheque
                                </option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label>Date From</label>
                            <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                        </div>
                        <div class="col-md-2">
                            <label>Date To</label>
                            <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('reports.transactions') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Summary -->
        <div class="row align-items-stretch mb-3">
            <div class="col-md-3 col-lg-2 mb-2">
                <div class="card h-100">
                    <div class="card-body">
                        <h6>Total Transactions</h6>
                        <h4>{{ $summary['total_transactions'] ?? 0 }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-2 mb-2">
                <div class="card h-100">
                    <div class="card-body">
                        <h6>Total Amount</h6>
                        <h4 class="text-primary">Rs {{ number_format($summary['total_amount'] ?? 0, 2) }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-2 mb-2">
                <div class="card border-success h-100">
                    <div class="card-body">
                        <h6>Order Payments (Received)</h6>
                        <h4 class="text-success">Rs {{ number_format($summary['orders_payments'] ?? 0, 2) }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-2 mb-2">
                <div class="card border-success h-100">
                    <div class="card-body">
                        <h6>Sewing Payments (Received)</h6>
                        <h4 class="text-success">Rs {{ number_format($summary['sewing_orders_payments'] ?? 0, 2) }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-2 mb-2">
                <div class="card border-info h-100">
                    <div class="card-body">
                        <h6>Purchase Payments (Made)</h6>
                        <h4 class="text-info">Rs {{ number_format($summary['purchases_payments'] ?? 0, 2) }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-2 mb-2">
                <div class="card border-info h-100">
                    <div class="card-body">
                        <h6>Worker Payment (Expense)</h6>
                        <h4 class="text-warning">Rs {{ number_format($summary['worker_payments'] ?? 0, 2) }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-lg-2 mb-2">
                <div class="card border-info h-100">
                    <div class="card-body">
                        <h6>Total Expenses</h6>
                        <h4 class="text-danger">Rs {{ number_format($summary['expenses'] ?? 0, 2) }}</h4>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Method Breakdown -->
        @if (isset($summary['by_method']) && $summary['by_method']->count() > 0)
            <div class="row align-items-stretch mb-3">
                <div class="col-md-12">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="mb-0">Payment Method Breakdown</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($summary['by_method'] as $method => $amount)
                                    <div class="col-md-3 col-lg-2 mb-2">
                                        <div class="card bg-light h-100">
                                            <div class="card-body p-2">
                                                <small
                                                    class="text-muted">{{ ucfirst(str_replace('_', ' ', $method)) }}</small>
                                                <h6 class="mb-0">Rs {{ number_format($amount, 2) }}</h6>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Transactions Table -->
        <div class="card">
            <div class="card-header ">
                <h5 class="mb-0">Transactions</h5>
            </div>
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Date & Time</th>
                                <th>Type</th>
                                <th>Reference</th>
                                <th>Amount</th>
                                <th>Payment Method</th>
                                <th>Person/Reference</th>
                                <th>Notes</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transactions as $transaction)
                                <tr>
                                    <td>{{ $transaction->payment_date->format('Y-m-d h:i A') }}</td>
                                    <td style="text-transform: capitalize">
                                        @if ($transaction->payable_type === 'App\Models\Order')
                                            @if ($transaction->type === 'refund')
                                                <span class="badge bg-secondary">Order refund</span>
                                            @else
                                                <span class="badge bg-success">Order payment</span>
                                            @endif
                                            @if ($transaction->payable)
                                                <br><small><a
                                                        href="{{ route('orders.show', $transaction->payable->id) }}">{{ $transaction->payable->order_number }}</a></small>
                                            @endif
                                        @elseif($transaction->payable_type === 'App\Models\User')
                                            <span class="badge bg-warning">Worker Payment</span>
                                            @if ($transaction->payable)
                                                <br><small>{{ $transaction->payable->name }}</small>
                                            @endif
                                        @elseif($transaction->payable_type === 'App\Models\SewingOrder')
                                            <span class="badge bg-primary">Sewing Payment</span>
                                        @else
                                            <span class="badge bg-info">Purchase Payment</span>
                                            @if ($transaction->payable)
                                                <br><small>Purchase #{{ $transaction->payable->id }}</small>
                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if ($transaction->payable_type === 'App\Models\Order')
                                            <a
                                                href="{{ route('orders.show', $transaction->payable->id) }}">{{ $transaction->payable->order_number }}</a>
                                            @php
                                                $order = $transaction->payable;
                                                $orderTotalPaid = $order->payments
                                                    ? $order->payments->sum('amount')
                                                    : 0;
                                                $orderRemaining = max(0, $order->total_amount - $orderTotalPaid);
                                            @endphp
                                            <br><small class="text-muted">Total: Rs
                                                {{ number_format($order->total_amount, 2) }} |
                                                Remaining: Rs {{ number_format($orderRemaining, 2) }}</small>
                                        @elseif($transaction->payable_type === 'App\Models\User')
                                            <span class="badge bg-warning">Worker Payment</span>
                                            <br><small>{{ $transaction->payable->name }}</small>
                                        @elseif($transaction->payable_type === 'App\Models\SewingOrder')
                                            <span class="badge bg-primary">Sewing Payment</span>
                                        @else
                                            Purchase #{{ $transaction->payable->id }}
                                            @php
                                                $purchase = $transaction->payable;
                                                $purchaseTotal =
                                                    $purchase->quantity_meters * $purchase->price_per_meter;
                                                $purchasePaid = $purchase->payments
                                                    ? $purchase->payments->sum('amount')
                                                    : 0;
                                                $purchaseRemaining = max(0, $purchaseTotal - $purchasePaid);
                                            @endphp
                                            <br><small class="text-muted">Total: Rs {{ number_format($purchaseTotal, 2) }}
                                                |
                                                Remaining: Rs {{ number_format($purchaseRemaining, 2) }}</small>
                                        @endif
                                    </td>
                                    <td><strong>Rs {{ number_format($transaction->amount, 2) }}</strong></td>
                                    <td>
                                        <span
                                            class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $transaction->payment_method)) }}</span>
                                    </td>
                                    <td>{{ $transaction->person_reference ?? 'N/A' }}</td>
                                    <td>{{ $transaction->notes ?? 'N/A' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No transactions found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>



        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Expenses</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Amount</th>
                                        <th>Added By</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($expenses ?? [] as $expense)
                                        <tr>
                                            <td>{{ \Carbon\Carbon::parse($expense->date)->format('d M, Y h:i A') }}</td>
                                            <td>{{ $expense->title }}</td>
                                            <td>{{ $expense->category ?? '-' }}</td>
                                            <td><strong>Rs {{ number_format($expense->amount, 2) }}</strong></td>
                                            <td>{{ $expense->user->name ?? 'Unknown' }}</td>
                                            <td>{{ $expense->notes ?? '-' }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted">No expenses found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @if (($expenses ?? null) && method_exists($expenses, 'links'))
                            <div class="mt-3">
                                {{ $expenses->links('pagination::bootstrap-5') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
