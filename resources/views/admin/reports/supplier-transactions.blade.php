@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold mb-0">Supplier Transactions Report</h4>
            </div>
        </div>

        <!-- Filters -->
        <div class="card mb-3">
            <div class="card-body">
                <form method="GET" action="{{ route('reports.supplier-transactions') }}">
                    <div class="row">
                        <div class="col-md-10">
                            <label>Supplier</label>
                            <select name="supplier_id" class="form-control select2" id="supplierSelect">
                                <option value="">Select Supplier</option>
                                @foreach ($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}"
                                        {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                                        {{ $supplier->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary me-2">Filter</button>
                            <a href="{{ route('reports.supplier-transactions') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if ($supplierId && $supplierSummary)
            <!-- Supplier Summary -->
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
                            <h4 class="text-info">Rs {{ number_format($supplierSummary['total_purchase_amount'] ?? 0, 2) }}
                            </h4>
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
                            <h4 class="text-warning">Rs {{ number_format($supplierSummary['total_remaining'] ?? 0, 2) }}
                            </h4>
                            <small class="text-muted">{{ $supplierSummary['pending_purchases'] ?? 0 }} pending
                                purchases</small>
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
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supplierPurchases as $purchase)
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
                                            @if ($remaining <= 0)
                                                <span class="badge bg-success">Paid</span>
                                            @else
                                                <span class="badge bg-warning">Pending</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($remaining > 0)
                                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#addPaymentModal{{ $purchase->id }}">
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

            <!-- Supplier Payment History -->
            @if ($supplierPayments->count() > 0)
                <div class="card mb-3">
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
                                    @foreach ($supplierPayments as $payment)
                                        <tr>
                                            <td>{{ $payment->payment_date->format('Y-m-d H:i A') }}</td>
                                            <td>#{{ $payment->payable_id }}</td>
                                            <td>
                                                @if ($payment->payable && $payment->payable->product)
                                                    {{ $payment->payable->product->title ?? 'N/A' }}
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td><strong>Rs {{ number_format($payment->amount, 2) }}</strong></td>
                                            <td>
                                                <span
                                                    class="badge bg-secondary">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</span>
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
                                    @if ($supplierSummary)
                                        <tr>
                                            <th colspan="3" class="text-end">Remaining Amount:</th>
                                            <th
                                                class="text-{{ ($supplierSummary['total_remaining'] ?? 0) > 0 ? 'warning' : 'success' }}">
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

            <!-- Add Payment Modals -->
            @foreach ($supplierPurchases as $purchase)
                @php
                    $totalAmount = $purchase->quantity_meters * $purchase->price_per_meter;
                    $totalPaid = $purchase->payments->sum('amount');
                    $remaining = $totalAmount - $totalPaid;
                @endphp
                @if ($remaining > 0)
                    <div class="modal fade" id="addPaymentModal{{ $purchase->id }}" tabindex="-1"
                        aria-labelledby="addPaymentModalLabel{{ $purchase->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addPaymentModalLabel{{ $purchase->id }}">
                                        <i class="mdi mdi-cash text-success me-2"></i>Add Payment to Purchase
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="paymentForm{{ $purchase->id }}" data-purchase-id="{{ $purchase->id }}">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="hidden" name="payable_type" value="purchase">
                                        <input type="hidden" name="payable_id" value="{{ $purchase->id }}">

                                        <div class="mb-3">
                                            <label class="form-label">Amount (Rs) <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="number" class="form-control" name="amount"
                                                    id="paymentAmount{{ $purchase->id }}" step="0.01" min="0.01"
                                                    max="{{ $remaining }}"
                                                    value="{{ number_format($remaining, 2, '.', '') }}" required>
                                                <button type="button" class="btn btn-outline-secondary"
                                                    onclick="setMaxAmount{{ $purchase->id }}()">Max</button>
                                            </div>
                                            <small class="text-muted">Remaining: Rs <span
                                                    id="remainingAmount{{ $purchase->id }}">{{ number_format($remaining, 2) }}</span></small>
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
                                            <label class="form-label">Date & Time <span
                                                    class="text-danger">*</span></label>
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
        @endif

        @if (!$supplierId)
            <div class="card">
                <div class="card-body text-center text-muted">
                    <p>Please select a supplier to view their transactions.</p>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('js')
    <script>
        @foreach ($supplierPurchases as $purchase)
            @php
                $totalAmount = $purchase->quantity_meters * $purchase->price_per_meter;
                $totalPaid = $purchase->payments->sum('amount');
                $remaining = $totalAmount - $totalPaid;
            @endphp
            @if ($remaining > 0)
                function setMaxAmount{{ $purchase->id }}() {
                    const remaining = {{ number_format($remaining, 2, '.', '') }};
                    $('#paymentAmount{{ $purchase->id }}').val(remaining.toFixed(2));
                }
            @endif
        @endforeach

        $(document).ready(function() {
            @foreach ($supplierPurchases as $purchase)
                @php
                    $totalAmount = $purchase->quantity_meters * $purchase->price_per_meter;
                    $totalPaid = $purchase->payments->sum('amount');
                    $remaining = $totalAmount - $totalPaid;
                @endphp
                @if ($remaining > 0)
                    $('#paymentForm{{ $purchase->id }}').on('submit', function(e) {
                        e.preventDefault();
                        const form = $(this);
                        const purchaseId = form.data('purchase-id');
                        const formData = form.serialize();

                        $.ajax({
                            url: '{{ route('payments.store') }}',
                            method: 'POST',
                            data: formData + '&payable_type=purchase&payable_id=' + purchaseId,
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
        });
    </script>
@endsection
