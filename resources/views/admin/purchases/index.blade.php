@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="py-3 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold mb-0">Purchase & Stock-In Ledger</h4>
        </div>
        <a href="{{ route('purchases.create') }}" class="btn btn-primary btn-sm">Add Stock Purchase</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Supplier</th>
                            <th>Quantity (Meters)</th>
                            <th>Price/Meter</th>
                            <th>Total Amount</th>
                            <th>Paid</th>
                            <th>Remaining</th>
                            <th>Reference #</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchases as $purchase)
                            @php
                                $totalAmount = $purchase->price_per_meter * $purchase->quantity_meters;
                                $totalPaid = $purchase->payments->sum('amount');
                                $remaining = $totalAmount - $totalPaid;
                            @endphp
                            <tr>
                                <td>{{ $purchase->created_at->format('Y-m-d H:i') }}</td>
                                <td>{{ $purchase->product->title ?? '-' }}</td>
                                <td>{{ $purchase->supplier->name ?? '-' }}</td>
                                <td>{{ number_format($purchase->quantity_meters,2) }}</td>
                                <td>Rs {{ number_format($purchase->price_per_meter,2) }}</td>
                                <td><strong>Rs {{ number_format($totalAmount, 2) }}</strong></td>
                                <td>
                                    <span class="text-success">Rs {{ number_format($totalPaid, 2) }}</span>
                                </td>
                                <td>
                                    <span class="text-{{ $remaining > 0 ? 'warning' : 'success' }}">
                                        Rs {{ number_format($remaining, 2) }}
                                    </span>
                                    @if($remaining > 0)
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-success">Paid</span>
                                    @endif
                                </td>
                                <td>{{ $purchase->reference_number ?? '-' }}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#addPaymentModal{{ $purchase->id }}"
                                            @if($remaining <= 0) disabled title="Fully Paid" @endif>
                                        <i class="mdi mdi-cash"></i> Payment
                                    </button>
                                    @if($purchase->payments->count() > 0)
                                        <button type="button" class="btn btn-sm btn-info" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#paymentHistoryModal{{ $purchase->id }}">
                                            <i class="mdi mdi-history"></i> History
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
    </div>
</div>

<!-- Payment Modals -->
@foreach($purchases as $purchase)
    @php
        $totalAmount = $purchase->price_per_meter * $purchase->quantity_meters;
        $totalPaid = $purchase->payments->sum('amount');
        $remaining = $totalAmount - $totalPaid;
    @endphp
    
    <!-- Add Payment Modal -->
    <div class="modal fade" id="addPaymentModal{{ $purchase->id }}" tabindex="-1" aria-labelledby="addPaymentModalLabel{{ $purchase->id }}" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addPaymentModalLabel{{ $purchase->id }}">
                        <i class="mdi mdi-cash text-success me-2"></i>Add Payment to Supplier
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="payment-form" data-purchase-id="{{ $purchase->id }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="payable_type" value="purchase">
                        <input type="hidden" name="payable_id" value="{{ $purchase->id }}">
                        
                        <div class="mb-3">
                            <label class="form-label">Amount (Rs) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control payment-amount" 
                                       name="amount" 
                                       step="0.01" min="0.01" max="{{ $remaining }}" 
                                       value="{{ number_format($remaining, 2, '.', '') }}" required>
                                <button type="button" class="btn btn-outline-secondary" onclick="setMaxAmount({{ $purchase->id }})">Max</button>
                            </div>
                            <small class="text-muted">Remaining: Rs <span class="remaining-amount-{{ $purchase->id }}">{{ number_format($remaining, 2) }}</span></small>
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
    
    <!-- Payment History Modal -->
    @if($purchase->payments->count() > 0)
        <div class="modal fade" id="paymentHistoryModal{{ $purchase->id }}" tabindex="-1" aria-labelledby="paymentHistoryModalLabel{{ $purchase->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="paymentHistoryModalLabel{{ $purchase->id }}">
                            Payment History - {{ $purchase->supplier->name ?? 'Supplier' }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <strong>Total Amount:</strong> Rs {{ number_format($totalAmount, 2) }}
                            </div>
                            <div class="col-md-4">
                                <strong>Total Paid:</strong> <span class="text-success">Rs {{ number_format($totalPaid, 2) }}</span>
                            </div>
                            <div class="col-md-4">
                                <strong>Remaining:</strong> <span class="text-{{ $remaining > 0 ? 'warning' : 'success' }}">Rs {{ number_format($remaining, 2) }}</span>
                            </div>
                        </div>
                        
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Date & Time</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Person / Reference</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchase->payments as $payment)
                                    <tr>
                                        <td>{{ $payment->payment_date->format('Y-m-d h:i A') }}</td>
                                        <td><strong>Rs {{ number_format($payment->amount, 2) }}</strong></td>
                                        <td>
                                            <span class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</span>
                                        </td>
                                        <td>{{ $payment->person_reference ?? 'N/A' }}</td>
                                        <td>{{ $payment->notes ?? 'N/A' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
    // Set max amount button
    function setMaxAmount(purchaseId) {
        const remaining = parseFloat(document.querySelector('.remaining-amount-' + purchaseId).textContent.replace(/[^0-9.-]+/g, ''));
        const modal = document.querySelector('#addPaymentModal' + purchaseId);
        const amountInput = modal.querySelector('.payment-amount');
        amountInput.value = remaining.toFixed(2);
    }

    // Handle payment form submission
    document.querySelectorAll('.payment-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const submitButton = this.querySelector('button[type="submit"]');
            const purchaseId = this.getAttribute('data-purchase-id');
            submitButton.disabled = true;
            submitButton.textContent = 'Processing...';
            
            fetch('{{ route("payments.store") }}', {
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
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addPaymentModal' + purchaseId));
                    modal.hide();
                    
                    // Reload page to show updated payment information
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
    });
</script>
@endsection
