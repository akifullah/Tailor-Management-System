@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3">
            <div class="d-flex justify-content-between align-items-center">

                <h4 class="fs-18 fw-semibold mb-0">Sewing Order Details</h4>

                @if (!in_array($sewingOrder->order_status, ['cancelled', 'delivered']))
                    <div class="my-3">
                        <label for="order_status" class="form-label mb-0 fw-semibold me-2">Update Status:</label>
                        <form id="orderStatusForm" action="{{ route('sewing-orders.update-status', $sewingOrder->id) }}"
                            method="POST" class="d-flex align-items-center gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="order_status" id="order_status" class="form-select form-select-sm w-auto"
                                required>
                                <option value="pending" {{ $sewingOrder->order_status == 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="completed" {{ $sewingOrder->order_status == 'completed' ? 'selected' : '' }}>
                                    Completed</option>
                                <option value="delivered" {{ $sewingOrder->order_status == 'delivered' ? 'selected' : '' }}>
                                    Delivered</option>
                                <option value="cancelled" {{ $sewingOrder->order_status == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                            <button type="submit" class="btn btn-primary btn-sm">Update</button>
                        </form>
                    </div>
                @endif
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const form = document.getElementById('orderStatusForm');
                        const select = document.getElementById('order_status');
                        let lastStatus = "{{ $sewingOrder->order_status }}";

                        form.addEventListener('submit', function(e) {
                            const newStatus = select.value;
                            if (newStatus === 'delivered') {
                                if (!confirm('Are you sure you want to mark this order as Delivered?')) {
                                    select.value = lastStatus;
                                    e.preventDefault();
                                    return false;
                                }
                            }
                            if (newStatus === 'cancelled') {
                                if (!confirm('Are you sure you want to cancel this order?.')) {
                                    select.value = lastStatus;
                                    e.preventDefault();
                                    return false;
                                }
                            }
                        });
                    });
                </script>
            </div>
        </div>

    </div>

    <!-- Alert Container -->
    <div id="alertContainer" style="position: fixed; top: 80px; right: 20px; z-index: 9999; min-width: 300px;"></div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Sewing Order Number:</strong> {{ $sewingOrder->sewing_order_number ?? 'N/A' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Order Date:</strong>
                            {{ $sewingOrder->order_date ? $sewingOrder->order_date->format('Y-m-d') : 'N/A' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Customer:</strong> {{ $sewingOrder->customer->name ?? 'N/A' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Phone:</strong> {{ $sewingOrder->customer->phone ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Delivery Date:</strong>
                            {{ $sewingOrder->delivery_date ? $sewingOrder->delivery_date->format('Y-m-d') : 'N/A' }}
                        </div>
                        <div class="col-md-6">
                            <strong>Order Status:</strong>
                            <span
                                class="badge bg-{{ in_array($sewingOrder->order_status, ['completed', 'delivered']) ? 'success' : ($sewingOrder->order_status == 'cancelled' ? 'danger' : 'warning') }}">
                                {{ ucfirst(str_replace('_', ' ', $sewingOrder->order_status)) }}
                            </span>
                        </div>
                    </div>

                    <hr>

                    <h5>Sewing Order Items</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Sewing Price</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Assigned To</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sewingOrder->items as $item)
                                    <tr
                                        style="background-color: {{ $item->status == 'cancelled' ? 'rgba(255, 0, 0, 0.1)' : '' }} ;">
                                        <td>{{ $item->product_name }}</td>
                                        <td>Rs {{ number_format($item->sewing_price, 2) }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>Rs {{ number_format($item->total_price, 2) }}</td>
                                        <td>
                                            {{ $item->worker->name ?? 'Not Assigned' }}
                                            @if ($item->assign_note)
                                                <p class="text-muted mb-0" style="font-size: 14px;">Notes:
                                                    {{ $item->assign_note }}</p>
                                            @endif
                                        </td>
                                        <td>
                                            <span
                                                class="badge bg-{{ ['pending' => 'warning', 'on_hold' => 'warning', 'in_progress' => 'warning', 'completed' => 'success', 'cancelled' => 'danger', 'delivered' => 'success'][$item->status] ?? 'warning' }}">
                                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                            </span>


                                            @if (!in_array($item->status, ['cancelled', 'delivered']))
                                                <select class="form-select form-select-sm status-select"
                                                    data-item-id="{{ $item->id }}"
                                                    style="width: auto; display: inline-block;">
                                                    <option value="pending"
                                                        {{ $item->status == 'pending' ? 'selected' : '' }}>Pending
                                                    </option>
                                                    {{-- <option value="on_hold"
                                                            {{ $item->status == 'on_hold' ? 'selected' : '' }}>On Hold
                                                        </option> --}}
                                                    <option value="in_progress"
                                                        {{ $item->status == 'in_progress' ? 'selected' : '' }}>In
                                                        Progress
                                                    </option>
                                                    <option value="completed"
                                                        {{ $item->status == 'completed' ? 'selected' : '' }}>
                                                        Completed</option>
                                                    <option value="cancelled"
                                                        {{ $item->status == 'cancelled' ? 'selected' : '' }}>
                                                        Cancelled</option>
                                                    <option value="delivered"
                                                        {{ $item->status == 'delivered' ? 'selected' : '' }}>
                                                        Delivered</option>
                                                </select>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($item->customer_measurement)
                                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#measurementModal{{ $item->id }}">
                                                    View Measurement
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Grand Total:</strong></td>
                                    <td><strong>Rs {{ number_format($sewingOrder->total_amount, 2) }}</strong></td>
                                    <td colspan="3"></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <hr>
                    {{-- Payment & Refund Calculations with Safe Null Checks --}}
                    @php
                        // Safe-get collections, fallback to empty if null
                        $payments = $sewingOrder->payments ?? collect([]);
                        $refunds = $sewingOrder->refunds ?? collect([]);
                        $totalPaid = $payments ? $payments->where('type', 'payment')->sum('amount') : 0;
                        $totalRefunded = $payments ? $payments->where('type', 'refund')->sum('amount') : 0;
                        $remaining = $sewingOrder->total_amount - $totalPaid + $totalRefunded;
                    @endphp
                    <div class="row mt-3">
                        <div class="col-md-12 d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Payment Information</h5>
                            <div>
                                @if ($remaining > 0)
                                    <button type="button" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal"
                                        data-bs-target="#addPaymentModal">
                                        <i class="mdi mdi-plus"></i> Add Payment
                                    </button>
                                @endif
                                {{-- <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#addRefundModal">
                                        <i class="mdi mdi-minus"></i> Add Refund
                                    </button> --}}
                            </div>
                        </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-3">
                            <strong>Total Amount:</strong><br>
                            <span class="fs-16 fw-semibold">Rs
                                {{ number_format($sewingOrder->total_amount, 2) }}</span>
                        </div>
                        <div class="col-md-3">
                            <strong>Total Paid:</strong><br>
                            {{-- <span class="fs-16 fw-semibold text-success">Rs {{ number_format($totalPaid, 2) }}</span> --}}
                            <span class="fs-16 fw-semibold text-success">Rs
                                {{ number_format(($totalPaid ?? 0) - ($totalRefunded ?? 0), 2) }}</span>
                        </div>
                        <div class="col-md-3">
                            <strong>Total Refunded:</strong><br>
                            <span class="fs-16 fw-semibold text-danger">Rs
                                {{ number_format($totalRefunded, 2) }}</span>
                        </div>
                        <div class="col-md-3">
                            <strong>Remaining:</strong><br>
                            <span class="fs-16 fw-semibold text-{{ $remaining > 0 ? 'warning' : 'success' }}">
                                Rs {{ number_format($remaining, 2) }}
                            </span>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3 offset-md-9">
                            <strong>Payment Status:</strong><br>
                            <span class="badge bg-{{ $remaining <= 0 ? 'success' : 'warning' }}">
                                {{ $remaining <= 0 ? 'Paid' : 'Pending' }}
                            </span>
                        </div>
                    </div>

                    @if (!empty($payments) && $payments->count() > 0)
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <h6>Payment History</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Date & Time</th>
                                                <th>Amount</th>
                                                <th>Method</th>
                                                <th>Person / Reference</th>
                                                <th>Notes / Reason</th>
                                                <th>Status / Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($payments as $payment)
                                                <tr>
                                                    <td>
                                                        @if ($payment->type === 'refund')
                                                            {{ optional($payment->payment_date ?? $payment->refund_date)->format('Y-m-d h:i A') }}
                                                        @else
                                                            {{ optional($payment->payment_date)->format('Y-m-d h:i A') }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($payment->type === 'refund')
                                                            <span class="text-danger">
                                                                - Rs {{ number_format($payment->amount, 2) }}
                                                            </span>
                                                        @else
                                                            <strong>Rs
                                                                {{ number_format($payment->amount, 2) }}</strong>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $payment->type === 'refund' ? 'bg-danger' : 'bg-success' }}">
                                                            {{ ucfirst(str_replace('_', ' ', $payment->payment_method ?? ($payment->refund_method ?? 'cash'))) }}
                                                            @if ($payment->type === 'refund')
                                                                (Refund)
                                                            @else
                                                                (Payment)
                                                            @endif
                                                        </span>
                                                    </td>
                                                    <td>{{ $payment->person_reference ?? 'N/A' }}</td>
                                                    <td>
                                                        @if ($payment->type === 'refund')
                                                            {!! nl2br(e($payment->refund_reason ?? ($payment->notes ?? 'N/A'))) !!}
                                                        @else
                                                            {{ $payment->notes ?? 'N/A' }}
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($payment->type === 'payment')
                                                            @php
                                                                $alreadyRefunded = \App\Models\Payment::where(
                                                                    'refund_for_payment_id',
                                                                    $payment->id,
                                                                )
                                                                    ->where('type', 'refund')
                                                                    ->sum('amount');
                                                                $availableToRefund =
                                                                    $payment->amount - $alreadyRefunded;
                                                            @endphp
                                                            @if ($availableToRefund > 0)
                                                                <button type="button" class="btn btn-sm"
                                                                    style="background-color:#16A34A; color:#fff;"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#refundModal{{ $payment->id }}">
                                                                    <i class="mdi mdi-cash-refund me-1"></i> Refund
                                                                </button>
                                                            @else
                                                                <span class="badge bg-secondary">Refunded</span>
                                                            @endif
                                                        @else
                                                            <span class="badge bg-danger">Refunded</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach

                                            <tr>
                                                <th colspan="1" class="text-end">
                                                    Total Paid:
                                                </th>
                                                <th colspan="5">
                                                    <h5 class="text-success fw-bold mb-0">
                                                        Rs {{ number_format($totalPaid ?? 0, 2) }}
                                                    </h5>
                                                </th>
                                            </tr>

                                            <tr>
                                                <th colspan="1" class="text-end">
                                                    Total Refunded:
                                                </th>
                                                <th colspan="5">
                                                    <h5 class="text-danger fw-bold mb-0">
                                                        -{{ number_format($totalRefunded ?? 0, 2) }}
                                                    </h5>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th colspan="1" class="text-end">
                                                    Total Net Paid:
                                                </th>
                                                <th colspan="5">
                                                    <h5 class="text-success fw-bold mb-0">
                                                        {{ number_format(($totalPaid ?? 0) - ($totalRefunded ?? 0), 2) }}
                                                    </h5>
                                                </th>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('sewing-orders.index') }}" class="btn btn-secondary">Back to Sewing
                            Orders</a>
                        <button onclick="window.print()" class="btn btn-primary">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Add Payment Modal -->
    <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPaymentModalLabel">
                        <i class="mdi mdi-cash text-success me-2"></i>Add Payment to Sewing Order
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="paymentForm">
                    @csrf
                    <input type="hidden" name="order_id" value="{{ $sewingOrder->id }}">
                    <div class="modal-body">
                        <input type="hidden" name="payable_type" value="sewing_order">
                        <input type="hidden" name="payable_id" value="{{ $sewingOrder->id }}">

                        @php
                            $payments = $sewingOrder->payments ?? collect([]);
                            $totalPaid = $payments ? $payments->where('type', 'payment')->sum('amount') : 0;
                            $totalRefunded = $payments ? $payments->where('type', 'refund')->sum('amount') : 0;
                            $remaining = max(0, $sewingOrder->total_amount - $totalPaid + $totalRefunded);
                        @endphp
                        <div class="mb-3">
                            <label class="form-label">Amount (Rs) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="amount" id="paymentAmount"
                                    step="0.01" min="0.01" max="{{ $remaining }}"
                                    value="{{ number_format($remaining, 2, '.', '') }}" required>
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="setMaxAmount()">Max</button>
                            </div>
                            <small class="text-muted">Remaining: Rs <span
                                    id="remainingAmount">{{ number_format($remaining, 2) }}</span></small>
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

    <!-- Add Refund Modal (general refund for sewing_order)-->
    <div class="modal fade" id="addRefundModal" tabindex="-1" aria-labelledby="addRefundModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addRefundModalLabel">
                        <i class="mdi mdi-cash-refund text-danger me-2"></i>Add Refund to Sewing Order
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="refundForm">
                    @csrf
                    <input type="hidden" name="sewing_order_id" value="{{ $sewingOrder->id }}">
                    <div class="modal-body">
                        <input type="hidden" name="refundable_type" value="sewing_order">
                        <input type="hidden" name="refundable_id" value="{{ $sewingOrder->id }}">

                        @php
                            $payments = $sewingOrder->payments ?? collect([]);
                            $totalPaid = $payments ? $payments->where('type', 'payment')->sum('amount') : 0;
                            $totalRefunded = $payments ? $payments->where('type', 'refund')->sum('amount') : 0;
                            $maxRefund = max(0, $totalPaid - $totalRefunded);
                        @endphp
                        <div class="mb-3">
                            <label class="form-label">Amount (Rs) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="amount" id="refundAmount"
                                    step="0.01" min="0.01" max="{{ $maxRefund }}"
                                    value="{{ number_format($maxRefund, 2, '.', '') }}" required>
                                <button type="button" class="btn btn-outline-secondary"
                                    onclick="setMaxRefund()">Max</button>
                            </div>
                            <small class="text-muted">Refundable: Rs <span
                                    id="refundableAmount">{{ number_format($maxRefund, 2) }}</span></small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Refund Method <span class="text-danger">*</span></label>
                            <select class="form-select" name="refund_method" required>
                                <option value="cash" selected>Cash</option>
                                <option value="online">Online</option>
                                <option value="bank_transfer">Bank Transfer</option>
                                <option value="cheque">Cheque</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Person + Reference</label>
                            <input type="text" class="form-control" name="person_reference"
                                placeholder="e.g., John Doe - REF-123">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date & Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" name="refund_date"
                                value="{{ now()->format('Y-m-d\TH:i') }}" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" name="notes" rows="2"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Submit Refund</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Per-payment refund modals --}}
    @foreach ($sewingOrder->payments as $payment)
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
                                <h5 class="modal-title">Create Refund for Payment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form id="refundForm{{ $payment->id }}">
                                @csrf
                                <input type="hidden" name="refund_for_payment_id" value="{{ $payment->id }}">
                                <input type="hidden" name="sewing_order_id" value="{{ $sewingOrder->id }}">
                                <input type="hidden" name="refundable_type" value="sewing_order">
                                <input type="hidden" name="refundable_id" value="{{ $sewingOrder->id }}">
                                <div class="modal-body">
                                    {{-- <div class="mb-3">
                                        <label class="form-label">Payment Amount</label>
                                        <input type="text" class="form-control"
                                            value="Rs {{ number_format($payment->amount, 2) }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Already Refunded</label>
                                        <input type="text" class="form-control"
                                            value="Rs {{ number_format($alreadyRefunded, 2) }}" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Available to Refund <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control"
                                            id="availableRefund{{ $payment->id }}"
                                            value="Rs {{ number_format($availableToRefund, 2) }}" readonly>
                                    </div> --}}
                                    <div class="mb-3">
                                        <label class="form-label">Refund Amount (Rs) <span
                                                class="text-danger">*</span></label>
                                        <input type="number" class="form-control" name="amount"
                                            id="refundAmount{{ $payment->id }}" step="0.01" min="0.01"
                                            max="{{ number_format($availableToRefund, 2, '.', '') }}"
                                            value="{{ number_format($availableToRefund, 2, '.', '') }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Refund Reason</label>
                                        <textarea class="form-control" name="refund_reason" rows="2"></textarea>
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
                                    <button type="submit" class="btn btn-danger">Create Refund</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        @endif
    @endforeach

    <!-- Measurement Modals -->
    @foreach ($sewingOrder->items as $itemIndex => $item)
        @if ($item->customer_measurement)
            @php
                // Handle measurement data - could be array or JSON string
                $measurement = $item->customer_measurement;
                if (is_string($measurement)) {
                    $measurement = json_decode($measurement, true) ?? [];
                }

                // Parse the nested data field if it's a JSON string
$measurementData = [];
if (isset($measurement['data'])) {
    if (is_string($measurement['data'])) {
        $measurementData = json_decode($measurement['data'], true) ?? [];
    } elseif (is_array($measurement['data'])) {
        $measurementData = $measurement['data'];
                    }
                }
            @endphp
            <div class="modal fade" id="measurementModal{{ $item->id }}" tabindex="-1"
                aria-labelledby="measurementModalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="measurementModalLabel{{ $item->id }}">
                                Measurement Details: {{ ucfirst(str_replace('_', ' ', $measurement['type'] ?? 'N/A')) }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @php
                                // $measurement['data'] is now a nested keyed array like ['kameez' => [...], 'shalwar' => [...]]
                                $dataGroups = [];
                                if (isset($measurement['data'])) {
                                    // Handle if $measurement['data'] is still JSON string (sometimes double-encoded)
                                    if (is_string($measurement['data'])) {
                                        $decoded = json_decode($measurement['data'], true);
                                        if (is_array($decoded)) {
                                            $dataGroups = $decoded;
                                        }
                                    } elseif (is_array($measurement['data'])) {
                                        $dataGroups = $measurement['data'];
                                    } elseif (is_object($measurement['data'])) {
                                        $dataGroups = (array) $measurement['data'];
                                    }
                                }
                            @endphp

                            @if (!empty($dataGroups))
                                <div class="table-responsive">
                                    @foreach ($dataGroups as $groupLabel => $groupFields)
                                        <h4 class="mt-3 text-center" style="font-weight: 700;">
                                            {{ ucfirst($groupLabel) }}
                                        </h4>
                                        <table class="table table-bordered table-striped mb-2">
                                            <thead>
                                                <tr>
                                                    <th style="width: 50%">Field</th>
                                                    <th style="width: 50%">Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($groupFields as $fieldKey => $fieldValue)
                                                    <tr>
                                                        <td class="text-capitalize">
                                                            <strong>{{ str_replace('_', ' ', ucwords($fieldKey, '_')) }}</strong>
                                                        </td>
                                                        <td>{{ $fieldValue ?? 'N/A' }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endforeach
                                </div>
                            @else
                                <div class="alert alert-info">
                                    No measurement data available.
                                </div>
                            @endif

                            @if (!empty($measurement['notes']))
                                <div class="mt-3">
                                    <strong>Notes:</strong>
                                    <p class="mt-2">{{ $measurement['notes'] }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if ($item->assign_note)
            <div class="modal fade" id="noteModal{{ $item->id }}" tabindex="-1"
                aria-labelledby="noteModalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="noteModalLabel{{ $item->id }}">
                                Assignment Note
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p>{{ $item->assign_note }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

@endsection

@section('js')
    <script>
        function showAlert(message, type = 'success') {
            const alertContainer = document.getElementById('alertContainer');
            const alertId = 'alert-' + Date.now();
            const alertClass = type === 'success' ? 'alert-success' : 'alert-danger';
            const icon = type === 'success' ? '<i class="mdi mdi-check-circle me-2"></i>' :
                '<i class="mdi mdi-alert-circle me-2"></i>';

            const alertHTML = `
        <div id="${alertId}" class="alert ${alertClass} alert-dismissible fade show" role="alert">
            ${icon}${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;

            alertContainer.innerHTML = alertHTML;

            setTimeout(function() {
                const alertElement = document.getElementById(alertId);
                if (alertElement) {
                    const bsAlert = new bootstrap.Alert(alertElement);
                    bsAlert.close();
                    setTimeout(function() {
                        location.reload();
                    }, 300);
                }
            }, 3000);
        }

        function setMaxAmount() {
            const remaining = parseFloat(document.getElementById('remainingAmount').textContent.replace(/[^0-9.-]+/g, ''));
            document.getElementById('paymentAmount').value = remaining.toFixed(2);
        }

        function setMaxRefund() {
            const refundable = parseFloat(document.getElementById('refundableAmount').textContent.replace(/[^0-9.-]+/g,
                ''));
            document.getElementById('refundAmount').value = refundable.toFixed(2);
        }

        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.textContent = 'Processing...';

            fetch('{{ route('payments.store') }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('addPaymentModal'));
                        modal.hide();
                        window.location.reload();
                    } else {
                        alert('Error: ' + data.message);
                        submitButton.disabled = false;
                        submitButton.textContent = 'Submit Payment';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                    submitButton.disabled = false;
                    submitButton.textContent = 'Submit Payment';
                });
        });

        document.getElementById('paymentAmount').addEventListener('input', function() {
            const remaining = parseFloat(document.getElementById('remainingAmount').textContent.replace(
                /[^0-9.-]+/g, ''));
            const entered = parseFloat(this.value) || 0;

            if (entered > remaining) {
                this.setCustomValidity('Amount cannot exceed remaining amount');
            } else {
                this.setCustomValidity('');
            }
        });

        document.getElementById('refundForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            submitButton.disabled = true;
            submitButton.textContent = 'Processing...';

            // Use the payments.refund route for the general refund form;
            // Patch: the sewing order does NOT have a Payment model for the refund, so find the latest payment to refund against.
            fetch('{{ route('payments.refund', ['payment' => $sewingOrder->payments->where('type', 'payment')->last()?->id ?? 0]) }}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('addRefundModal'));
                        modal.hide();
                        window.location.reload();
                    } else {
                        alert('Error: ' + data.message);
                        submitButton.disabled = false;
                        submitButton.textContent = 'Submit Refund';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                    submitButton.disabled = false;
                    submitButton.textContent = 'Submit Refund';
                });
        });

        document.getElementById('refundAmount').addEventListener('input', function() {
            const refundable = parseFloat(document.getElementById('refundableAmount').textContent.replace(
                /[^0-9.-]+/g, ''));
            const entered = parseFloat(this.value) || 0;

            if (entered > refundable) {
                this.setCustomValidity('Amount cannot exceed refundable amount');
            } else {
                this.setCustomValidity('');
            }
        });

        // Add Ajax for per-payment refund forms
        @foreach ($sewingOrder->payments as $payment)
            @if ($payment->type === 'payment')
                @php
                    $alreadyRefunded = \App\Models\Payment::where('refund_for_payment_id', $payment->id)->where('type', 'refund')->sum('amount');
                    $availableToRefund = $payment->amount - $alreadyRefunded;
                @endphp
                @if ($availableToRefund > 0)
                    document.getElementById('refundForm{{ $payment->id }}').addEventListener('submit', function(e) {
                        e.preventDefault();

                        const formData = new FormData(this);
                        const submitButton = this.querySelector('button[type="submit"]');
                        submitButton.disabled = true;
                        submitButton.textContent = 'Processing...';

                        // Use the payments.refund route for per-payment refund forms
                        fetch('{{ route('payments.refund', ['payment' => $payment->id]) }}', {
                                method: 'POST',
                                body: formData,
                                headers: {
                                    'X-Requested-With': 'XMLHttpRequest',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                }
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    const modal = bootstrap.Modal.getInstance(document.getElementById(
                                        'refundModal{{ $payment->id }}'));
                                    modal.hide();
                                    window.location.reload();
                                } else {
                                    alert('Error: ' + data.message);
                                    submitButton.disabled = false;
                                    submitButton.textContent = 'Create Refund';
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('An error occurred. Please try again.');
                                submitButton.disabled = false;
                                submitButton.textContent = 'Create Refund';
                            });
                    });

                    document.getElementById('refundAmount{{ $payment->id }}').addEventListener('input', function() {
                        const refundable = parseFloat(document.getElementById('availableRefund{{ $payment->id }}')
                            .value.replace(
                                /[^0-9.-]+/g, ''));
                        const entered = parseFloat(this.value) || 0;

                        if (entered > refundable) {
                            this.setCustomValidity('Amount cannot exceed available to refund');
                        } else {
                            this.setCustomValidity('');
                        }
                    });
                @endif
            @endif
        @endforeach
    </script>

    <script>
        $(document).ready(function() {
            $('.status-select').on('change', function() {
                const itemId = $(this).data('item-id');
                const status = $(this).val();
                if (status == "cancelled" && !confirm("Are you sure you want to cancel this item?")) {
                    $(this).val("");
                    return;
                }
                $.ajax({
                    url: `/sewing-order-items/${itemId}/status`,
                    method: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status,
                        _method: 'PUT'
                    },
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert('Failed to update status');
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr);
                        alert('Failed to update status. Please try again.');
                    }
                });
            });
        });
    </script>
@endsection
