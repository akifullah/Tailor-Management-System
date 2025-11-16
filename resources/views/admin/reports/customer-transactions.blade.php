@extends('admin.layouts.app')

@section('content')
    <style>
        /* Custom refund highlight for table rows */
        /* .refund-row {
            background-color: rgba(255, 0, 0, 0.09) !important;
        } */
        /* Custom return highlight for table rows */
        /* .return-row {
            background-color: rgba(255, 174, 0, 0.14) !important;
        } */
    </style>
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold mb-0">Customer Transactions Report</h4>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('reports.customer-transactions') }}">
                    <div class="row">
                        <div class="col-md-4">
                            <label>Customer</label>
                            <select name="customer_id" class="form-control select2" id="customerSelect">
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} | {{ $customer->phone }} 
                                    </option>
                                @endforeach
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
                        <div class="col-md-2">
                            <label>Order Type</label>
                            <select name="order_type" class="form-control">
                                <option value="" {{ request('order_type') == '' ? 'selected' : '' }}>Both</option>
                                <option value="order" {{ request('order_type') == 'order' ? 'selected' : '' }}>Regular
                                    Order</option>
                                <option value="sewing_order"
                                    {{ request('order_type') == 'sewing_order' ? 'selected' : '' }}>Sewing Order</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label for="order_status" class="form-label">Order Status</label>
                            <select name="order_status" id="order_status" class="form-control">
                                <option value="">All Statuses</option>
                                <option value="pending" {{ request('order_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="completed" {{ request('order_status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="returned" {{ request('order_status') == 'returned' ? 'selected' : '' }}>Returned</option>
                                <option value="cancelled" {{ request('order_status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('reports.customer-transactions') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if ($customerId && $customerSummary)
            <!-- Customer Summary -->
            <div class="row align-items-stretch mb-3">
                <!-- COMBINED SUMMARY: Total Orders, Amount, Paid, Remaining (already present) -->
                <div class="col-md-3 mb-3">
                    <div class="card border-primary h-100">
                        <div class="card-body">
                            <h6>Total Orders</h6>
                            <h4 class="text-primary">{{ $customerSummary['total_orders'] ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-info h-100">
                        <div class="card-body">
                            <h6>Total Order Amount</h6>
                            <h4 class="text-info">Rs {{ number_format($customerSummary['total_order_amount'] ?? 0, 2) }}
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-success h-100">
                        <div class="card-body">
                            <h6>Total Paid</h6>
                            <h4 class="text-success">Rs {{ number_format($customerSummary['total_paid'] ?? 0, 2) }}</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3">
                    <div class="card border-warning h-100">
                        <div class="card-body">
                            <h6>Remaining Amount</h6>
                            <h4 class="text-warning">Rs {{ number_format($customerSummary['total_remaining'] ?? 0, 2) }}
                            </h4>
                            <small class="text-muted">{{ $customerSummary['pending_orders'] ?? 0 }} pending orders</small>
                        </div>
                    </div>
                </div>

                 <!-- INVENTORY ORDERS --> 
                <div class="col-md-3 mb-3">
                    <div class="card border-primary h-100">
                        <div class="card-body">
                            <h6>Inventory Orders</h6>
                            <ul class="mb-0" style="list-style:none;padding-left:0;">
                                <li><strong>Total Orders:</strong> <span>{{ $customerOrders->count() }}</span></li>
                                <li><strong>Total Order Amount:</strong> <span>Rs
                                        {{ number_format($customerOrders->sum('total_amount'), 2) }}</span></li>
                                @php
                                    $ordersTotalPaid = $customerOrders->sum(fn($order) => $order->payments()->where('type', 'payment')->sum('amount'));
                                    $ordersTotalRefunded = $customerOrders->sum(fn($order) => $order->payments()->where('type', 'refund')->sum('amount'));
                                    $ordersNetPaid = $ordersTotalPaid - $ordersTotalRefunded;
                                    $ordersRemaining = $customerOrders->sum('total_amount') - $ordersNetPaid;
                                @endphp
                                <li><strong>Total Paid:</strong> <span class="text-success">Rs
                                        {{ number_format($ordersTotalPaid, 2) }}</span>
                                </li>
                                @if ($ordersTotalRefunded > 0)
                                    <li><strong>Refunded:</strong> <span class="text-danger fw-bold bg-light rounded px-1 py-0">Rs
                                            {{ number_format($ordersTotalRefunded, 2) }}</span>
                                    </li>
                                    <li><strong>Net Paid:</strong> <span class="text-info">Rs
                                            {{ number_format($ordersNetPaid, 2) }}</span>
                                    </li>
                                @endif
                                <li><strong>Remaining:</strong> <span class="text-{{ $ordersRemaining > 0 ? 'warning' : 'success' }}">Rs
                                        {{ number_format($ordersRemaining, 2) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- SEWING ORDERS -->
                <div class="col-md-3 mb-3">
                    <div class="card border-info h-100">
                        <div class="card-body">
                            <h6>Sewing Orders</h6>
                            <ul class="mb-0" style="list-style:none;padding-left:0;">
                                <li><strong>Total Sewing Orders:</strong> <span>{{ $customerSewingOrders->count() }}</span>
                                </li>
                                <li><strong>Total Sewing Amount:</strong> <span>Rs
                                        {{ number_format($customerSewingOrders->sum('total_amount'), 2) }}</span></li>
                                @php
                                    $sewingTotalPaid = $customerSewingOrders->sum(fn($order) => $order->payments()->where('type', 'payment')->sum('amount'));
                                    $sewingTotalRefunded = $customerSewingOrders->sum(fn($order) => $order->payments()->where('type', 'refund')->sum('amount'));
                                    $sewingNetPaid = $sewingTotalPaid - $sewingTotalRefunded;
                                    $sewingRemaining = $customerSewingOrders->sum('total_amount') - $sewingNetPaid;
                                @endphp
                                <li><strong>Total Paid:</strong> <span class="text-success">Rs
                                        {{ number_format($sewingTotalPaid, 2) }}</span>
                                </li>
                                @if ($sewingTotalRefunded > 0)
                                    <li><strong>Refunded:</strong> <span class="text-danger fw-bold bg-light rounded px-1 py-0">Rs
                                            {{ number_format($sewingTotalRefunded, 2) }}</span>
                                    </li>
                                    <li><strong>Net Paid:</strong> <span class="text-info">Rs
                                            {{ number_format($sewingNetPaid, 2) }}</span>
                                    </li>
                                @endif
                                <li><strong>Remaining:</strong> <span class="text-{{ $sewingRemaining > 0 ? 'warning' : 'success' }}">Rs
                                        {{ number_format($sewingRemaining, 2) }}</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                
            </div>
        @endif

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
                                <th>Type</th>
                                <th>Order #</th>
                                <th>Order Date</th>
                                <th>Total Amount</th>
                                <th>Paid</th>
                                <th>Remaining</th>
                                <th>Payment Status</th>
                                <th>Items Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($customerOrders as $order)
                                    @php
                                        $totalPaid = $order->payments()->where('type', 'payment')->sum('amount');
                                        $totalRefunded = $order->payments()->where('type', 'refund')->sum('amount');
                                        $netPaid = $totalPaid - $totalRefunded;
                                        $remaining = $order->total_amount - $netPaid;
                                        $itemsPending = $order->items->where('status', 'pending')->count();
                                        $itemsProgress = $order->items->where('status', 'progress')->count();
                                        $itemsCompleted = $order->items->where('status', 'completed')->count();
                                        $totalItems = $order->items->count();
                                    @endphp
                                    <tr
                                        @if ($order->is_return) class="return-row" @endif
                                    >
                                        <td><span class="badge bg-primary">Order</span></td>
                                        <td>
                                            <a href="{{ route('orders.show', $order->id) }}">
                                                {{ $order->order_number }}
                                            </a>
                                        </td>
                                        <td>{{ $order->order_date }}</td>
                                        <td><strong>Rs {{ number_format($order->total_amount, 2) }}</strong></td>
                                        <td>
                                            <span class="text-success">Rs {{ number_format($totalPaid, 2) }}</span>
                                            @if ($totalRefunded > 0)
                                                <br><small class="text-danger fw-bold bg-light rounded px-1 py-0">Refunded: Rs {{ number_format($totalRefunded, 2) }}</small>
                                                <br><small class="text-info">Net: Rs {{ number_format($netPaid, 2) }}</small>
                                            @endif
                                        </td>
                                        <td class="text-{{ ($order->order_status == 'cancelled' || $order->is_return) ? 'secondary' : ($remaining > 0 ? 'warning' : ($remaining < 0 ? 'danger' : 'success')) }}">
                                            @if ($order->order_status == 'cancelled' || $order->is_return)
                                                <span class="badge bg-secondary">--</span>
                                            @else
                                                <strong>Rs {{ number_format($remaining, 2) }}</strong>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->order_status == 'cancelled')
                                                <span class="badge bg-danger">Cancelled</span>
                                            @elseif ($order->is_return)
                                                <span class="badge" style="background-color: #FFA300; color: black;">Returned</span>
                                            @elseif ($remaining <= 0)
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($totalItems > 0)
                                                @if ($itemsCompleted == $totalItems)
                                                    <span class="badge bg-success">All Done</span>
                                                @else
                                                    <span class="badge bg-success">{{ $itemsCompleted }}/{{ $totalItems }}
                                                        Done</span>
                                                    <br>
                                                    <small class="text-muted">
                                                        @if ($itemsProgress > 0)
                                                            <span class="badge bg-warning">{{ $itemsProgress }}
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
                                            <a href="{{ route('orders.show', $order->id) }}"
                                                class="btn btn-sm btn-primary">View</a>
                                            @if ($remaining > 0)
                                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#addPaymentModal{{ $order->id }}">
                                                    Add Payment
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach ($customerSewingOrders as $sewingOrder)
                                    @php
                                        $totalPaid = $sewingOrder->payments()->where('type', 'payment')->sum('amount');
                                        $totalRefunded = $sewingOrder->payments()->where('type', 'refund')->sum('amount');
                                        $netPaid = $totalPaid - $totalRefunded;
                                        $remaining = $sewingOrder->total_amount - $netPaid;
                                        $itemsPending = $sewingOrder->items->where('status', 'pending')->count();
                                        $itemsInProgress = $sewingOrder->items->where('status', 'in_progress', "on_hold", "cutter", "sewing")->count();
                                        $itemsCompleted = $sewingOrder->items->where('status', 'completed')->count();
                                        $totalItems = $sewingOrder->items->where("status", "!=", "cancelled")->count();
                                    @endphp
                                    <tr>
                                        <td><span class="badge bg-info">Sewing Order</span></td>
                                        <td>{{ $sewingOrder->sewing_order_number ?? 'N/A' }}</td>
                                        <td>{{ $sewingOrder->order_date ? $sewingOrder->order_date->format('Y-m-d') : 'N/A' }}
                                        </td>
                                        <td><strong>Rs {{ number_format($sewingOrder->total_amount, 2) }}</strong></td>
                                        <td>
                                            <span class="text-success">Rs {{ number_format($totalPaid, 2) }}</span>
                                            @if ($totalRefunded > 0)
                                                <br><small class="text-danger fw-bold bg-light rounded px-1 py-0">Refunded: Rs {{ number_format($totalRefunded, 2) }}</small>
                                                <br><small class="text-info">Net: Rs {{ number_format($netPaid, 2) }}</small>
                                            @endif
                                        </td>
                                        <td class="text-{{ $remaining > 0 ? 'warning' : ($remaining < 0 ? 'danger' : 'success') }}">
                                            <strong>Rs {{ number_format($remaining, 2) }}</strong>
                                        </td>
                                        <td>
                                            @if ($remaining <= 0)
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($totalItems > 0)
                                                @if ($itemsCompleted == $totalItems)
                                                    <span class="badge bg-success">All Done</span>
                                                @else
                                                    <span class="badge bg-success">{{ $itemsCompleted }}/{{ $totalItems }}
                                                        Done</span>
                                                    <br>
                                                    <small class="text-muted">
                                                        @if ($itemsInProgress > 0)
                                                            <span class="badge bg-warning">{{ $itemsInProgress }} In
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
                                            <a href="{{ route('sewing-orders.show', $sewingOrder->id) }}"
                                                class="btn btn-sm btn-primary">View</a>
                                            @if ($remaining > 0)
                                                <button type="button" class="btn btn-sm btn-success"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#addSewingPaymentModal{{ $sewingOrder->id }}">
                                                    Add Payment
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Customer Payment History -->
        @if ($customerPayments->count() > 0)
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
                                    <th>Type</th>
                                    <th>Order #</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Person/Reference</th>
                                    <th>Notes</th>
                                    {{-- <th>Actions</th> --}}
                                </tr>
                                {{-- <tr>
                                    <td colspan="8">
                                        <form method="GET" action="" class="form-inline">
                                            <input type="hidden" name="customer_id" value="{{ request('customer_id') }}" />
                                            <select name="refund_filter" class="form-control form-control-sm w-auto d-inline-block">
                                                <option value="" {{ request('refund_filter') === '' ? 'selected' : '' }}>All</option>
                                                <option value="refund" {{ request('refund_filter') === 'refund' ? 'selected' : '' }}>Only Refunds</option>
                                                <option value="payment" {{ request('refund_filter') === 'payment' ? 'selected' : '' }}>Only Payments</option>
                                            </select>
                                            <button type="submit" class="btn btn-sm btn-primary ms-2">Apply</button>
                                        </form>
                                    </td>
                                </tr> --}}
                            </thead>
                            <tbody>
                                @foreach ($customerPayments as $payment)
                                    @if (!request('refund_filter') || request('refund_filter') === $payment->type)
                                    <tr class="{{ $payment->type === 'refund' ? 'refund-row' : '' }}">
                                        <td>{{ $payment->payment_date->format('Y-m-d H:i A') }}</td>
                                        <td>
                                            @if ($payment->type === 'refund')
                                                <span class="badge bg-danger">Refund</span>
                                            @else
                                                <span class="badge bg-success">Payment</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($payment->payable)
                                                @if ($payment->payable_type == 'App\Models\Order')
                                                    <a
                                                        href="{{ route('orders.show', $payment->payable->id) }}">{{ $payment->payable->order_number }}</a>
                                                @elseif($payment->payable_type == 'App\Models\SewingOrder')
                                                    <a
                                                        href="{{ route('sewing-orders.show', $payment->payable->id) }}">{{ $payment->payable->sewing_order_number ?? 'N/A' }}</a>
                                                @else
                                                    N/A
                                                @endif
                                            @else
                                                N/A
                                            @endif
                                        </td>
                                        <td>
                                            <strong class="{{ $payment->type === 'refund' ? 'text-danger fw-bold bg-light rounded px-1 py-0' : 'text-success' }}">
                                                {{ $payment->type === 'refund' ? '-' : '' }}Rs {{ number_format($payment->amount, 2) }}
                                            </strong>
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</span>
                                        </td>
                                        <td>{{ $payment->person_reference ?? 'N/A' }}</td>
                                        <td>
                                            {{ $payment->notes ?? 'N/A' }}
                                            @if ($payment->refund_reason)
                                                <br><small class="text-danger fw-bold bg-light rounded px-1 py-0">Reason: {{ $payment->refund_reason }}</small>
                                            @endif
                                        </td>
                                        {{-- <td>
                                            @if ($payment->type === 'payment')
                                                @php
                                                    $alreadyRefunded = \App\Models\Payment::where('refund_for_payment_id', $payment->id)
                                                        ->where('type', 'refund')
                                                        ->sum('amount');
                                                    $availableToRefund = $payment->amount - $alreadyRefunded;
                                                @endphp
                                                @if ($availableToRefund > 0)
                                                    <button type="button" class="btn btn-sm btn-danger" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#refundModal{{ $payment->id }}">
                                                        Refund
                                                    </button>
                                                @endif
                                            @endif
                                        </td> --}}
                                    </tr>
                                    @endif
                                @endforeach
                            </tbody>
                            <tfoot>
                                @php
                                    $totalPayments = $customerPayments->where('type', 'payment')->sum('amount');
                                    $totalRefunds = $customerPayments->where('type', 'refund')->sum('amount');
                                    $netPayments = $totalPayments - $totalRefunds;
                                @endphp
                                <tr>
                                    <th colspan="3" class="text-end">Total Payments:</th>
                                    <th class="text-success">Rs {{ number_format($totalPayments, 2) }}</th>
                                    <th colspan="4"></th>
                                </tr>
                                @if ($totalRefunds > 0)
                                    <tr>
                                        <th colspan="3" class="text-end">Total Refunded:</th>
                                        <th class="text-danger fw-bold bg-light rounded px-1 py-0">Rs {{ number_format($totalRefunds, 2) }}</th>
                                        <th colspan="4"></th>
                                    </tr>
                                    <tr>
                                        <th colspan="3" class="text-end">Net Paid:</th>
                                        <th class="text-info">Rs {{ number_format($netPayments, 2) }}</th>
                                        <th colspan="4"></th>
                                    </tr>
                                @endif
                                <tr>
                                    <th colspan="3" class="text-end">Remaining Amount:</th>
                                    <th
                                        class="text-{{ ($customerSummary['total_remaining'] ?? 0) > 0 ? 'warning' : 'success' }}">
                                        Rs {{ number_format($customerSummary['total_remaining'] ?? 0, 2) }}
                                    </th>
                                    <th colspan="4"></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        <!-- Add Payment Modals for Regular Orders -->
        @foreach ($customerOrders as $order)
            @php
                $totalPaid = $order->payments->sum('amount');
                $remaining = $order->total_amount - $totalPaid;
            @endphp
            @if ($remaining > 0)
                <div class="modal fade" id="addPaymentModal{{ $order->id }}" tabindex="-1"
                    aria-labelledby="addPaymentModalLabel{{ $order->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addPaymentModalLabel{{ $order->id }}">
                                    <i class="mdi mdi-cash text-success me-2"></i>Add Payment to Order
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="paymentForm{{ $order->id }}" data-order-id="{{ $order->id }}">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="payable_type" value="order">
                                    <input type="hidden" name="payable_id" value="{{ $order->id }}">

                                    <div class="mb-3">
                                        <label class="form-label">Amount (Rs) <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="amount"
                                                id="paymentAmount{{ $order->id }}" step="0.01" min="0.01"
                                                max="{{ $remaining }}"
                                                value="{{ number_format($remaining, 2, '.', '') }}" required>
                                            <button type="button" class="btn btn-outline-secondary"
                                                onclick="setMaxAmount{{ $order->id }}()">Max</button>
                                        </div>
                                        <small class="text-muted">Remaining: Rs <span
                                                id="remainingAmount{{ $order->id }}">{{ number_format($remaining, 2) }}</span></small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Payment Method <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="payment_method" required>
                                            <option value="cash" selected>Cash</option>
                                            <option value="online">Online</option>
                                            <option value="bank_transfer">Bank Transfer</option>
                                            <option value="cheque">Cheque</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Person + Reference</label>
                                        <input type="text" class="form-control" name="person_reference"
                                            placeholder="e.g., John Doe - INV-123">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Date & Time <span class="text-danger">*</span></label>
                                        <input type="datetime-local" class="form-control" name="payment_date"
                                            value="{{ now()->format('Y-m-d\TH:i') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Notes</label>
                                        <textarea class="form-control" name="notes" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit Payment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <!-- Add Payment Modals for Sewing Orders -->
        @foreach ($customerSewingOrders as $sewingOrder)
            @php
                $totalPaid = $sewingOrder->payments->sum('amount');
                $remaining = $sewingOrder->total_amount - $totalPaid;
            @endphp
            @if ($remaining > 0)
                <div class="modal fade" id="addSewingPaymentModal{{ $sewingOrder->id }}" tabindex="-1"
                    aria-labelledby="addSewingPaymentModalLabel{{ $sewingOrder->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addSewingPaymentModalLabel{{ $sewingOrder->id }}">
                                    <i class="mdi mdi-cash text-success me-2"></i>Add Payment to Sewing Order
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form id="sewingPaymentForm{{ $sewingOrder->id }}"
                                data-sewing-order-id="{{ $sewingOrder->id }}">
                                @csrf
                                <div class="modal-body">
                                    <input type="hidden" name="payable_type" value="sewing_order">
                                    <input type="hidden" name="payable_id" value="{{ $sewingOrder->id }}">

                                    <div class="mb-3">
                                        <label class="form-label">Amount (Rs) <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="amount"
                                                id="sewingPaymentAmount{{ $sewingOrder->id }}" step="0.01"
                                                min="0.01" max="{{ $remaining }}"
                                                value="{{ number_format($remaining, 2, '.', '') }}" required>
                                            <button type="button" class="btn btn-outline-secondary"
                                                onclick="setMaxSewingAmount{{ $sewingOrder->id }}()">Max</button>
                                        </div>
                                        <small class="text-muted">Remaining: Rs <span
                                                id="sewingRemainingAmount{{ $sewingOrder->id }}">{{ number_format($remaining, 2) }}</span></small>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Payment Method <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select" name="payment_method" required>
                                            <option value="cash" selected>Cash</option>
                                            <option value="online">Online</option>
                                            <option value="bank_transfer">Bank Transfer</option>
                                            <option value="cheque">Cheque</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Person + Reference</label>
                                        <input type="text" class="form-control" name="person_reference"
                                            placeholder="e.g., John Doe - INV-123">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Date & Time <span class="text-danger">*</span></label>
                                        <input type="datetime-local" class="form-control" name="payment_date"
                                            value="{{ now()->format('Y-m-d\TH:i') }}" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Notes</label>
                                        <textarea class="form-control" name="notes" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit Payment</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        @if (!$customerId)
            <div class="card">
                <div class="card-body text-center text-muted">
                    <p>Please select a customer to view their transactions.</p>
                </div>
            </div>
        @endif

        <!-- Refund Modals -->
        @foreach ($customerPayments as $payment)
            @if ($payment->type === 'payment')
                @php
                    $alreadyRefunded = \App\Models\Payment::where('refund_for_payment_id', $payment->id)
                        ->where('type', 'refund')
                        ->sum('amount');
                    $availableToRefund = $payment->amount - $alreadyRefunded;
                @endphp
                @if ($availableToRefund > 0)
                    <div class="modal fade" id="refundModal{{ $payment->id }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title text-danger">Create Refund</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form id="refundForm{{ $payment->id }}">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label class="form-label">Payment Amount</label>
                                            <input type="text" class="form-control" value="Rs {{ number_format($payment->amount, 2) }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Already Refunded</label>
                                            <input type="text" class="form-control bg-danger bg-opacity-25 fw-bold" value="Rs {{ number_format($alreadyRefunded, 2) }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Available to Refund <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="availableRefund{{ $payment->id }}" 
                                                value="Rs {{ number_format($availableToRefund, 2) }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-danger">Refund Amount (Rs) <span class="text-danger">*</span></label>
                                            <input type="number" class="form-control border-2 border-danger" name="amount" 
                                                id="refundAmount{{ $payment->id }}" step="0.01" 
                                                min="0.01" max="{{ number_format($availableToRefund, 2, '.', '') }}" 
                                                value="{{ number_format($availableToRefund, 2, '.', '') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label text-danger">Refund Reason</label>
                                            <textarea class="form-control border-2 border-danger" name="refund_reason" rows="2"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Date & Time <span class="text-danger">*</span></label>
                                            <input type="datetime-local" class="form-control" name="payment_date"
                                                value="{{ now()->format('Y-m-d\TH:i') }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Notes</label>
                                            <textarea class="form-control" name="notes" rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Create Refund</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        @endforeach
    </div>
@endsection
@section('js')
    <script>
        @foreach ($customerOrders as $order)
            @php
                $totalPaid = $order->payments->sum('amount');
                $remaining = $order->total_amount - $totalPaid;
            @endphp
            @if ($remaining > 0)
                function setMaxAmount{{ $order->id }}() {
                    const remaining = {{ number_format($remaining, 2, '.', '') }};
                    $('#paymentAmount{{ $order->id }}').val(remaining.toFixed(2));
                }
            @endif
        @endforeach

        @foreach ($customerSewingOrders as $sewingOrder)
            @php
                $totalPaid = $sewingOrder->payments->sum('amount');
                $remaining = $sewingOrder->total_amount - $totalPaid;
            @endphp
            @if ($remaining > 0)
                function setMaxSewingAmount{{ $sewingOrder->id }}() {
                    const remaining = {{ number_format($remaining, 2, '.', '') }};
                    $('#sewingPaymentAmount{{ $sewingOrder->id }}').val(remaining.toFixed(2));
                }
            @endif
        @endforeach

        $(document).ready(function() {
            @foreach ($customerOrders as $order)
                @php
                    $totalPaid = $order->payments->sum('amount');
                    $remaining = $order->total_amount - $totalPaid;
                @endphp
                @if ($remaining > 0)
                    $('#paymentForm{{ $order->id }}').on('submit', function(e) {
                        e.preventDefault();
                        const form = $(this);
                        const orderId = form.data('order-id');
                        const formData = form.serialize();

                        $.ajax({
                            url: '{{ route('payments.store') }}',
                            method: 'POST',
                            data: formData + '&payable_type=order&payable_id=' + orderId,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    alert('Payment added successfully!');
                                    location.reload();
                                } else {
                                    alert('Error: ' + (response.message ||
                                        'Failed to add payment'));
                                }
                            },
                            error: function(xhr) {
                                const errors = xhr.responseJSON?.errors || {};
                                let errorMsg = 'Failed to add payment. ';
                                if (Object.keys(errors).length > 0) {
                                    errorMsg += Object.values(errors).flat().join(', ');
                                } else {
                                    errorMsg += xhr.responseJSON?.message ||
                                        'Please try again.';
                                }
                                alert(errorMsg);
                            }
                        });
                    });
                @endif
            @endforeach

            @foreach ($customerSewingOrders as $sewingOrder)
                @php
                    $totalPaid = $sewingOrder->payments->sum('amount');
                    $remaining = $sewingOrder->total_amount - $totalPaid;
                @endphp
                @if ($remaining > 0)
                    $('#sewingPaymentForm{{ $sewingOrder->id }}').on('submit', function(e) {
                        e.preventDefault();
                        const form = $(this);
                        const sewingOrderId = form.data('sewing-order-id');
                        const formData = form.serialize();

                        $.ajax({
                            url: '{{ route('payments.store') }}',
                            method: 'POST',
                            data: formData + '&payable_type=sewing_order&payable_id=' +
                                sewingOrderId,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    alert('Payment added successfully!');
                                    location.reload();
                                } else {
                                    alert('Error: ' + (response.message ||
                                        'Failed to add payment'));
                                }
                            },
                            error: function(xhr) {
                                const errors = xhr.responseJSON?.errors || {};
                                let errorMsg = 'Failed to add payment. ';
                                if (Object.keys(errors).length > 0) {
                                    errorMsg += Object.values(errors).flat().join(', ');
                                } else {
                                    errorMsg += xhr.responseJSON?.message ||
                                        'Please try again.';
                                }
                                alert(errorMsg);
                            }
                        });
                    });
                @endif
            @endforeach

            // Handle refund form submissions
            @foreach ($customerPayments as $payment)
                @if ($payment->type === 'payment')
                    @php
                        $alreadyRefunded = \App\Models\Payment::where('refund_for_payment_id', $payment->id)
                            ->where('type', 'refund')
                            ->sum('amount');
                        $availableToRefund = $payment->amount - $alreadyRefunded;
                    @endphp
                    @if ($availableToRefund > 0)
                        $('#refundForm{{ $payment->id }}').on('submit', function(e) {
                            e.preventDefault();
                            const form = $(this);
                            const submitButton = form.find('button[type="submit"]');
                            const originalText = submitButton.text();
                            
                            submitButton.prop('disabled', true).text('Processing...');
                            
                            const formData = form.serialize();
                            
                            $.ajax({
                                url: '{{ route("payments.refund", $payment->id) }}',
                                method: 'POST',
                                data: formData,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                    'X-Requested-With': 'XMLHttpRequest'
                                },
                                success: function(response) {
                                    if (response.success) {
                                        const modal = bootstrap.Modal.getInstance(document.getElementById('refundModal{{ $payment->id }}'));
                                        modal.hide();
                                        alert('Refund created successfully!');
                                        location.reload();
                                    } else {
                                        alert('Error: ' + (response.message || 'Failed to create refund'));
                                        submitButton.prop('disabled', false).text(originalText);
                                    }
                                },
                                error: function(xhr) {
                                    let errorMsg = 'Failed to create refund. ';
                                    if (xhr.responseJSON && xhr.responseJSON.message) {
                                        errorMsg += xhr.responseJSON.message;
                                    } else {
                                        errorMsg += 'Please try again.';
                                    }
                                    alert(errorMsg);
                                    submitButton.prop('disabled', false).text(originalText);
                                }
                            });
                        });
                    @endif
                @endif
            @endforeach
        });
    </script>
@endsection
