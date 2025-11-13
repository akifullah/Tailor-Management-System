@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3">
            <h4 class="fs-18 fw-semibold mb-0">Sewing Order Details</h4>
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
                                <strong>Order Date:</strong> {{ $sewingOrder->order_date ? $sewingOrder->order_date->format('Y-m-d') : 'N/A' }}
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
                                <strong>Delivery Date:</strong> {{ $sewingOrder->delivery_date ? $sewingOrder->delivery_date->format('Y-m-d') : 'N/A' }}
                            </div>
                            <div class="col-md-6">
                                <strong>Order Status:</strong> 
                                <span class="badge bg-{{ $sewingOrder->order_status == 'completed' ? 'success' : ($sewingOrder->order_status == 'in_progress' ? 'warning' : 'secondary') }}">
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
                                        <tr>
                                            <td>{{ $item->product_name }}</td>
                                            <td>Rs {{ number_format($item->sewing_price, 2) }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>Rs {{ number_format($item->total_price, 2) }}</td>
                                            <td>{{ $item->worker->name ?? 'Not Assigned' }}</td>
                                            <td>
                                                <span class="badge bg-{{ $item->status == 'completed' ? 'success' : ($item->status == 'in_progress' ? 'warning' : 'secondary') }}">
                                                    {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if ($item->customer_measurement)
                                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#measurementModal{{ $item->id }}">
                                                        View Measurement
                                                    </button>
                                                @endif
                                                @if ($item->assign_note)
                                                    <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#noteModal{{ $item->id }}">
                                                        View Note
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
                        
                        <div class="row mt-3">
                            <div class="col-md-12 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Payment Information</h5>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addPaymentModal">
                                    <i class="mdi mdi-plus"></i> Add Payment
                                </button>
                            </div>
                        </div>
                        
                        @php
                            $totalPaid = $sewingOrder->payments->sum('amount');
                            $remaining = $sewingOrder->total_amount - $totalPaid;
                        @endphp
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <strong>Total Amount:</strong><br>
                                <span class="fs-16 fw-semibold">Rs {{ number_format($sewingOrder->total_amount, 2) }}</span>
                            </div>
                            <div class="col-md-3">
                                <strong>Total Paid:</strong><br>
                                <span class="fs-16 fw-semibold text-success">Rs {{ number_format($totalPaid, 2) }}</span>
                            </div>
                            <div class="col-md-3">
                                <strong>Remaining:</strong><br>
                                <span class="fs-16 fw-semibold text-{{ $remaining > 0 ? 'warning' : 'success' }}">
                                    Rs {{ number_format($remaining, 2) }}
                                </span>
                            </div>
                            <div class="col-md-3">
                                <strong>Payment Status:</strong><br>
                                <span class="badge bg-{{ $remaining <= 0 ? 'success' : 'warning' }}">
                                    {{ $remaining <= 0 ? 'Paid' : 'Pending' }}
                                </span>
                            </div>
                        </div>

                        @if ($sewingOrder->payments->count() > 0)
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <h6>Payment History</h6>
                                    <div class="table-responsive">
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
                                                @foreach ($sewingOrder->payments as $payment)
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
                                </div>
                            </div>
                        @endif

                        @if ($sewingOrder->notes)
                            <div class="mt-3">
                                <strong>Notes:</strong> {{ $sewingOrder->notes }}
                            </div>
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('sewing-orders.index') }}" class="btn btn-secondary">Back to Sewing Orders</a>
                            <button onclick="window.print()" class="btn btn-primary">Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Payment Modal -->
    <div class="modal fade" id="addPaymentModal" tabindex="-1" aria-labelledby="addPaymentModalLabel" aria-hidden="true">
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
                    <div class="modal-body">
                        <input type="hidden" name="payable_type" value="sewing_order">
                        <input type="hidden" name="payable_id" value="{{ $sewingOrder->id }}">
                        
                        @php
                            $totalPaid = $sewingOrder->payments->sum('amount');
                            $remaining = max(0, $sewingOrder->total_amount - $totalPaid);
                        @endphp
                        <div class="mb-3">
                            <label class="form-label">Amount (Rs) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <input type="number" class="form-control" name="amount" id="paymentAmount" 
                                       step="0.01" min="0.01" max="{{ $remaining }}" 
                                       value="{{ number_format($remaining, 2, '.', '') }}" required>
                                <button type="button" class="btn btn-outline-secondary" onclick="setMaxAmount()">Max</button>
                            </div>
                            <small class="text-muted">Remaining: Rs <span id="remainingAmount">{{ number_format($remaining, 2) }}</span></small>
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
            <div class="modal fade" id="measurementModal{{ $item->id }}" tabindex="-1" aria-labelledby="measurementModalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="measurementModalLabel{{ $item->id }}">
                                Measurement Details: {{ ucfirst(str_replace('_', ' ', $measurement['type'] ?? 'N/A')) }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @php
                                // $measurement['data'] is now a nested keyed array like ['kameez' => [...], 'shalwar' => [...]]
                                $dataGroups = [];
                                // $measurement['data'] is an object of objects: ['kameez' => [...], 'shalwar' => [...]]
                                // If it's a JSON string, decode it. If already array/object, use directly.
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
                                                        <td class="text-capitalize"><strong>{{ str_replace('_', ' ', ucwords($fieldKey, '_')) }}</strong></td>
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
            <div class="modal fade" id="noteModal{{ $item->id }}" tabindex="-1" aria-labelledby="noteModalLabel{{ $item->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="noteModalLabel{{ $item->id }}">
                                Assignment Note
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
    const icon = type === 'success' ? '<i class="mdi mdi-check-circle me-2"></i>' : '<i class="mdi mdi-alert-circle me-2"></i>';
    
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

document.getElementById('paymentForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitButton = this.querySelector('button[type="submit"]');
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
    const remaining = parseFloat(document.getElementById('remainingAmount').textContent.replace(/[^0-9.-]+/g, ''));
    const entered = parseFloat(this.value) || 0;
    
    if (entered > remaining) {
        this.setCustomValidity('Amount cannot exceed remaining amount');
    } else {
        this.setCustomValidity('');
    }
});
</script>
@endsection
