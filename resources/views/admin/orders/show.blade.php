@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3">
            <h4 class="fs-18 fw-semibold mb-0">Order Details</h4>
        </div>

        <!-- Alert Container -->
        <div id="alertContainer" style="position: fixed; top: 80px; right: 20px; z-index: 9999; min-width: 300px;"></div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Order Number:</strong> {{ $order->order_number }}
                            </div>
                            <div class="col-md-6">
                                <strong>Order Date:</strong> {{ $order->order_date }}
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Delivery Date:</strong> 
                                <input type="date" id="delivery_date" value="{{ $order->delivery_date ? $order->delivery_date->format('Y-m-d') : '' }}" 
                                       class="form-control form-control-sm d-inline-block" style="width: auto;" 
                                       onchange="updateOrderField('delivery_date', this.value)">
                            </div>
                            <div class="col-md-6">
                                <strong>Delivery Status:</strong>
                                <select id="delivery_status" class="form-control form-control-sm d-inline-block" style="width: auto;" 
                                        onchange="updateOrderField('delivery_status', this.value)">
                                    <option value="pending" {{ $order->delivery_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="delivered" {{ $order->delivery_status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <strong>Customer:</strong> {{ $order->customer->name ?? 'N/A' }}
                            </div>
                            <div class="col-md-6">
                                <strong>Phone:</strong> {{ $order->customer->phone ?? 'N/A' }}
                            </div>
                        </div>

                        <hr>

                        <h5>Order Items</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Measurement</th>
                                        <th>Quantity (Meters)</th>
                                        <th>Price</th>
                                        <th>Source</th>
                                        <th>Status</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $itemIndex => $item)
                                        <tr>
                                            <td>{{ $item->product ? $item->product->title : 'Custom Item' }}</td>
                                            <td>
                                                @if ($item->measurement)
                                                    <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#measurementModal{{ $itemIndex }}">
                                                        View Measurement
                                                    </button>
                                                @else
                                                    <span class="text-muted">N/A</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->quantity_meters }}</td>
                                            <td>{{ number_format($item->sell_price, 2) }}</td>
                                            <td>
                                                @if ($item->is_from_inventory)
                                                    <span class="badge bg-success">Inventory</span>
                                                @else
                                                    <span class="badge bg-info">Customer's Fabric</span>
                                                @endif
                                            </td>
                                            <td>
                                                <select class="form-control form-control-sm item-status d-inline-block" style="width: auto;" data-item-id="{{ $item->id }}" 
                                                        onchange="updateItemStatus({{ $item->id }}, this.value)">
                                                    <option value="pending" {{ ($item->status ?? 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                                                    <option value="progress" {{ ($item->status ?? 'pending') == 'progress' ? 'selected' : '' }}>Progress</option>
                                                    <option value="completed" {{ ($item->status ?? 'pending') == 'completed' ? 'selected' : '' }}>Completed</option>
                                                </select>
                                                <span class="badge status-badge bg-{{ ($item->status ?? 'pending') == 'completed' ? 'success' : (($item->status ?? 'pending') == 'progress' ? 'warning' : 'secondary') }} ms-1" data-item-id="{{ $item->id }}">
                                                    {{ ucfirst($item->status ?? 'pending') }}
                                                </span>
                                            </td>
                                            <td>{{ number_format($item->total_price, 2) }}</td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6" class="text-end"><strong>Grand Total:</strong></td>
                                        <td><strong>{{ number_format($order->total_amount, 2) }}</strong></td>
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
                            $totalPaid = $order->payments->sum('amount');
                            $remaining = $order->total_amount - $totalPaid;
                        @endphp
                        <div class="row mt-3">
                            <div class="col-md-3">
                                <strong>Total Amount:</strong><br>
                                <span class="fs-16 fw-semibold">Rs {{ number_format($order->total_amount, 2) }}</span>
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

                        @if ($order->payments->count() > 0)
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
                                                @foreach ($order->payments as $payment)
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

                        @if ($order->notes)
                            <div class="mt-3">
                                <strong>Notes:</strong> {{ $order->notes }}
                            </div>
                        @endif

                        <div class="mt-4">
                            <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
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
                        <i class="mdi mdi-cash text-success me-2"></i>Add Payment to Order
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="paymentForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="payable_type" value="order">
                        <input type="hidden" name="payable_id" value="{{ $order->id }}">
                        
                        @php
                            $totalPaid = $order->payments->sum('amount');
                            $remaining = max(0, $order->total_amount - $totalPaid);
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
    @foreach ($order->items as $itemIndex => $item)
        @if ($item->measurement)
            @php
                // Handle measurement data - could be array or JSON string
                $measurement = $item->measurement;
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
                
                // Convert keys to readable format (remove first word/type prefix, remove underscores, capitalize)
                $readableData = [];
                foreach ($measurementData as $key => $value) {
                    // Split by underscore
                    $parts = explode('_', $key);
                    // Remove the first part (type prefix like "kameez")
                    if (count($parts) > 1) {
                        array_shift($parts);
                    }
                    // Join remaining parts and capitalize
                    $readableKey = ucwords(implode(' ', $parts));
                    $readableData[$readableKey] = $value;
                }
            @endphp
            <div class="modal fade" id="measurementModal{{ $itemIndex }}" tabindex="-1" aria-labelledby="measurementModalLabel{{ $itemIndex }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="measurementModalLabel{{ $itemIndex }}">
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

                            {{-- <div class="row mt-3">
                                <div class="col-md-6">
                                    <strong>Created At:</strong>
                                    {{ isset($measurement['created_at']) ? \Carbon\Carbon::parse($measurement['created_at'])->format('Y-m-d H:i:s') : 'N/A' }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Updated At:</strong>
                                    {{ isset($measurement['updated_at']) ? \Carbon\Carbon::parse($measurement['updated_at'])->format('Y-m-d H:i:s') : 'N/A' }}
                                </div>
                            </div> --}}
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
// Function to show Bootstrap alert
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
    
    // Auto remove after 3 seconds and then refresh
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

function updateOrderField(field, value) {
    const fieldNames = {
        'delivery_date': 'Delivery Date',
        'delivery_status': 'Delivery Status'
    };
    const fieldName = fieldNames[field] || field;
    
    $.ajax({
        url: '{{ route("orders.update", $order->id) }}',
        method: 'PUT',
        data: {
            _token: '{{ csrf_token() }}',
            [field]: value
        },
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        },
        success: function(response) {
            if (response.success) {
                showAlert(`${fieldName} updated successfully!`, 'success');
            } else {
                showAlert('Failed to update ' + fieldName, 'danger');
            }
        },
        error: function(xhr) {
            const errorMsg = xhr.responseJSON?.message || 'Unknown error occurred';
            showAlert('Failed to update ' + fieldName + ': ' + errorMsg, 'danger');
        }
    });
}

function updateItemStatus(itemId, status) {
    // Build the URL - route is defined without 'admin' prefix
    const baseUrl = '{{ url("/") }}';
    const url = baseUrl + '/order-items/' + itemId + '/status';
    
    const statusNames = {
        'pending': 'Pending',
        'progress': 'In Progress',
        'completed': 'Completed'
    };
    const statusName = statusNames[status] || status;
    
    $.ajax({
        url: url,
        method: 'PUT',
        data: {
            _token: '{{ csrf_token() }}',
            status: status,
            _method: 'PUT'
        },
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                showAlert(`Item status updated to ${statusName} successfully!`, 'success');
            } else {
                showAlert('Failed to update item status', 'danger');
            }
        },
        error: function(xhr) {
            console.error('Error:', xhr);
            let errorMsg = 'Failed to update item status. ';
            if (xhr.responseJSON && xhr.responseJSON.message) {
                errorMsg += xhr.responseJSON.message;
            } else if (xhr.status === 404) {
                errorMsg += 'Route not found.';
            } else {
                errorMsg += 'Please try again.';
            }
            showAlert(errorMsg, 'danger');
        }
    });
}

        // Set max amount button
        function setMaxAmount() {
            const remaining = parseFloat(document.getElementById('remainingAmount').textContent.replace(/[^0-9.-]+/g, ''));
            document.getElementById('paymentAmount').value = remaining.toFixed(2);
        }

        // Handle payment form submission
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
                    // Close modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('addPaymentModal'));
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

        // Update remaining amount when payment amount changes
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
