@extends('admin.layouts.app')

@section('content')
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
                    <div class="col-md-10">
                        <label>Customer</label>
                        <select name="customer_id" class="form-control" id="customerSelect">
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                    {{ $customer->name }}
                                </option>
                            @endforeach
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

    @if($customerId && $customerSummary)
    <!-- Customer Summary -->
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
                            <th>Payment Status</th>
                            <th>Items Status</th>
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
                            </td>
                            <td>
                                @if($totalItems > 0)
                                    @if($itemsCompleted == $totalItems)
                                        <span class="badge bg-success">All Done</span>
                                    @else
                                        <span class="badge bg-info">{{ $itemsCompleted }}/{{ $totalItems }} Done</span>
                                        <br>
                                        <small class="text-muted">
                                            @if($itemsProgress > 0)
                                                <span class="badge bg-warning">{{ $itemsProgress }} Progress</span>
                                            @endif
                                            @if($itemsPending > 0)
                                                <span class="badge bg-secondary">{{ $itemsPending }} Pending</span>
                                            @endif
                                        </small>
                                    @endif
                                @else
                                    <span class="text-muted">No items</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">View</a>
                                @if($remaining > 0)
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addPaymentModal{{ $order->id }}">
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
                        <tr>
                            <th colspan="2" class="text-end">Remaining Amount:</th>
                            <th class="text-{{ ($customerSummary['total_remaining'] ?? 0) > 0 ? 'warning' : 'success' }}">
                                Rs {{ number_format($customerSummary['total_remaining'] ?? 0, 2) }}
                            </th>
                            <th colspan="3"></th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    @endif

    <!-- Add Payment Modals -->
    @foreach($customerOrders as $order)
    @php
        $totalPaid = $order->payments->sum('amount');
        $remaining = $order->total_amount - $totalPaid;
    @endphp
    @if($remaining > 0)
    <div class="modal fade" id="addPaymentModal{{ $order->id }}" tabindex="-1" aria-labelledby="addPaymentModalLabel{{ $order->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPaymentModalLabel{{ $order->id }}">
                        <i class="mdi mdi-cash text-success me-2"></i>Add Payment to Order
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="paymentForm{{ $order->id }}" data-order-id="{{ $order->id }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="payable_type" value="order">
                        <input type="hidden" name="payable_id" value="{{ $order->id }}">
                        
                        <div class="mb-3">
                            <label class="form-label">Amount (Rs) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="amount" id="paymentAmount{{ $order->id }}" 
                                       step="0.01" min="0.01" max="{{ $remaining }}" 
                                       value="{{ number_format($remaining, 2, '.', '') }}" required>
                                <button type="button" class="btn btn-outline-secondary" onclick="setMaxAmount{{ $order->id }}()">Max</button>
                            </div>
                            <small class="text-muted">Remaining: Rs <span id="remainingAmount{{ $order->id }}">{{ number_format($remaining, 2) }}</span></small>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Payment Method <span class="text-danger">*</span></label>
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
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    @endif

    @if(!$customerId)
    <div class="card">
        <div class="card-body text-center text-muted">
            <p>Please select a customer to view their transactions.</p>
        </div>
    </div>
    @endif
</div>

@section('js')
<script>
@foreach($customerOrders as $order)
@php
    $totalPaid = $order->payments->sum('amount');
    $remaining = $order->total_amount - $totalPaid;
@endphp
@if($remaining > 0)
function setMaxAmount{{ $order->id }}() {
    const remaining = {{ number_format($remaining, 2, '.', '') }};
    $('#paymentAmount{{ $order->id }}').val(remaining.toFixed(2));
}
@endif
@endforeach

$(document).ready(function() {
    @foreach($customerOrders as $order)
    @php
        $totalPaid = $order->payments->sum('amount');
        $remaining = $order->total_amount - $totalPaid;
    @endphp
    @if($remaining > 0)
    $('#paymentForm{{ $order->id }}').on('submit', function(e) {
        e.preventDefault();
        const form = $(this);
        const orderId = form.data('order-id');
        const formData = form.serialize();
        
        $.ajax({
            url: '{{ route("payments.store") }}',
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
                    alert('Error: ' + (response.message || 'Failed to add payment'));
                }
            },
            error: function(xhr) {
                const errors = xhr.responseJSON?.errors || {};
                let errorMsg = 'Failed to add payment. ';
                if (Object.keys(errors).length > 0) {
                    errorMsg += Object.values(errors).flat().join(', ');
                } else {
                    errorMsg += xhr.responseJSON?.message || 'Please try again.';
                }
                alert(errorMsg);
            }
        });
    });
    @endif
    @endforeach
});
</script>
@endsection
@endsection

