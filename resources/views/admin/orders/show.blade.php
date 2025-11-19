@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3">
            <div class="d-flex justify-content-between  ">

                <h4 class="fs-18 fw-semibold mb-0">Order Details</h4>

                @if (!$order->is_return && $order->order_status !== 'cancelled')
                    <button type="button" class="btn fw-bold" style="background-color:#F59E0B; color:#000;"
                        data-bs-toggle="modal" data-bs-target="#returnOrderModal">
                        Return Order
                    </button>
                @endif

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
                                <strong>Order Number:</strong> {{ $order->order_number }}
                            </div>
                            <div class="col-md-6">
                                <strong>Order Date:</strong> {{ $order?->order_date?->format('Y-m-d') }}
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
                                        <th>Quantity (Meters)</th>
                                        <th>Price</th>
                                        <th>Source</th>
                                        <th>Total</th>
                                        <th>Return</th>
                                        {{-- <th>Actions</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $itemIndex => $item)
                                        <tr
                                            style="background-color: {{ $item->is_return ? 'rgba(255, 0, 0, 0.1)' : '' }} ;">
                                            <td>{{ $item->product ? $item->product->title : 'Custom Item' }}</td>
                                            <td>{{ $item->quantity_meters }}</td>
                                            <td>{{ number_format($item->sell_price, 2) }}</td>
                                            <td>
                                                @if ($item->is_from_inventory)
                                                    <span class="badge bg-success">Inventory</span>
                                                @else
                                                    <span class="badge bg-info">Customer's Fabric</span>
                                                @endif
                                            </td>
                                            <td>{{ number_format($item->total_price, 2) }}</td>
                                            <td>
                                                @if ($item->is_return)
                                                    <span class="badge bg-danger">Returned</span>
                                                @else
                                                    <span class="badge bg-success">Not Returned</span>
                                                @endif
                                            </td>
                                            {{-- <td>
                                                <a href="#" class="btn btn-sm" style="background-color:#F59E0B; color:#000;" data-bs-toggle="modal"
                                                    data-bs-target="#returnItemModal-{{ $item->id }}"
                                                    data-item-id="{{ $item->id }}"
                                                    data-order-id="{{ $order->id }}">Return it</a>
                                            </td> --}}

                                            <!-- Return Item Modal -->
                                            <div class="modal fade" id="returnItemModal-{{ $item->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title fw-normal" id="returnItemModalLabel">
                                                                Return Item
                                                                <strong>{{ $item->product->title ?? 'Custom Item' }}</strong>
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form class="return-item-form">
                                                            @csrf
                                                            <input type="hidden" name="order_item_id"
                                                                value="{{ $item->id }}">
                                                            <div class="modal-body">

                                                                <div class="mb-3">
                                                                    <label for="returnDate{{ $item->id }}"
                                                                        class="form-label">Return
                                                                        Date</label>
                                                                    <input type="date" name="return_date"
                                                                        id="returnDate{{ $item->id }}"
                                                                        class="form-control" value="{{ date('Y-m-d') }}"
                                                                        required>
                                                                </div>

                                                                <div class="mb-3">
                                                                    <label for="returnReason{{ $item->id }}"
                                                                        class="form-label">Return
                                                                        Reason</label>
                                                                    <textarea name="return_reason" id="returnReason{{ $item->id }}" rows="3" class="form-control"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger">Return
                                                                    Item</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </tr>
                                    @endforeach
                                    @php
                                        // Calculate original total (sum of all items, including returned ones)
                                        $originalTotal = $order->items->sum('total_price');
                                        $returnedAmount = $originalTotal - $order->total_amount;
                                    @endphp
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Total:</strong></td>
                                        <td><strong>Rs {{ number_format($originalTotal, 2) }}</strong></td>
                                    </tr>
                                    {{-- @if ($returnedAmount > 0)
                                        <tr>
                                            <td colspan="4" class="text-end"><strong class="text-danger">Returned Amount:</strong></td>
                                            <td><strong class="text-danger">-Rs {{ number_format($returnedAmount, 2) }}</strong></td>
                                        </tr>
                                    @endif --}}
                                    <tr>
                                        <td colspan="4" class="text-end"><strong>Current Total:</strong></td>
                                        <td><strong>Rs {{ number_format($order->total_amount, 2) }}</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <hr>

                        <div class="row mt-3">
                            <div class="col-md-12 d-flex justify-content-between align-items-center">
                                <h5 class="mb-0">Payment Information</h5>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addPaymentModal">
                                    <i class="mdi mdi-plus"></i> Add Payment
                                </button>
                            </div>
                        </div>

                        @php
                            // Calculate total paid (only payments, not refunds)
                            $totalPaid = $order->payments()->where('type', 'payment')->sum('amount');
                            // Calculate total refunded
                            $totalRefunded = $order->payments()->where('type', 'refund')->sum('amount');
                            // Net paid = total paid - total refunded
                            $netPaid = $totalPaid - $totalRefunded;
                            // Remaining = order total - net paid
                            $remaining = $order->total_amount - $netPaid;
                        @endphp
                        <div class="row mt-3">
                            <div class="col-md-3 col-lg-2">
                                <strong>Total Amount:</strong><br>
                                <span class="fs-16 fw-semibold">Rs {{ number_format($order->total_amount, 2) }}</span>
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <strong>Total Paid:</strong><br>
                                <span class="fs-16 fw-semibold text-success">Rs {{ number_format($netPaid, 2) }}</span>
                                {{-- @if ($totalRefunded > 0)
                                    <br><small class="text-danger">Refunded: Rs
                                        {{ number_format($totalRefunded, 2) }}</small>
                                    <br><small class="text-info">Net Paid: Rs {{ number_format($netPaid, 2) }}</small>
                                @endif --}}
                            </div>
                            <div class="col-md-3 col-lg-2">
                                <strong>Remaining:</strong><br>
                                <span class="fs-16 fw-semibold text-{{ $remaining > 0 ? 'warning' : 'success' }}">
                                    Rs {{ number_format($remaining, 2) }}
                                </span>
                            </div>

                            <div class="col-md-3 col-lg-2">
                                <strong>Total Refunded:</strong><br>
                                <span class="fs-16 fw-semibold text-danger">
                                    Rs {{ number_format($totalRefunded, 2) }}
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
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th>Payment Method</th>
                                                    <th>Person / Reference</th>
                                                    <th>Notes</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->payments as $payment)
                                                    <tr
                                                        style="background-color: {{ $payment->type === 'refund' ? 'rgba(255, 0, 0, 0.1)' : '' }};">
                                                        <td>{{ $payment->payment_date->format('Y-m-d h:i A') }}</td>
                                                        <td>
                                                            @if ($payment->type === 'refund')
                                                                <span class="badge bg-danger">Refund</span>
                                                            @else
                                                                <span class="badge bg-success">Payment</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <strong
                                                                class="{{ $payment->type === 'refund' ? 'text-danger' : 'text-success' }}">
                                                                {{ $payment->type === 'refund' ? '-' : '' }}Rs
                                                                {{ number_format($payment->amount, 2) }}
                                                            </strong>
                                                        </td>
                                                        <td>
                                                            <span
                                                                class="badge bg-info">{{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}</span>
                                                        </td>
                                                        <td>{{ $payment->person_reference ?? 'N/A' }}</td>
                                                        <td>
                                                            {{ $payment->notes ?? 'N/A' }}
                                                            @if ($payment->refund_reason)
                                                                <br><small class="text-danger">Reason:
                                                                    {{ $payment->refund_reason }}</small>
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
                                                            @elseif ($payment->type === 'refund')
                                                                <span class="badge bg-danger">Refunded</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <th colspan="2" class="text-end">
                                                        Total Paid:
                                                    </th>
                                                    <th colspan="5">
                                                        <h5 class="text-success fw-bold mb-0">
                                                            Rs {{ number_format($totalPaid, 2) }}
                                                        </h5>
                                                    </th>
                                                </tr>

                                                <tr>
                                                    <th colspan="2" class="text-end">
                                                        Total Refunded:
                                                    </th>
                                                    <th colspan="5">
                                                        <h5 class="text-danger fw-bold mb-0"> Rs
                                                            -{{ number_format($totalRefunded, 2) }}
                                                        </h5>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="2" class="text-end">
                                                        Total Net Paid:
                                                    </th>
                                                    <th colspan="5">
                                                        <h5 class="text-success fw-bold mb-0"> Rs
                                                            {{ number_format($netPaid, 2) }}</h5>
                                                    </th>
                                                </tr>
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
                            <a href="{{ route('orders.print', $order) }}" target="_blank" class="btn btn-primary">Print</a>

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
                            // Calculate total paid (only payments, not refunds)
                            $totalPaid = $order->payments()->where('type', 'payment')->sum('amount');
                            // Calculate total refunded
                            $totalRefunded = $order->payments()->where('type', 'refund')->sum('amount');
                            // Net paid = total paid - total refunded
                            $netPaid = $totalPaid - $totalRefunded;
                            // Remaining = order total - net paid
                            $remaining = max(0, $order->total_amount - $netPaid);
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
            <div class="modal fade" id="measurementModal{{ $itemIndex }}" tabindex="-1"
                aria-labelledby="measurementModalLabel{{ $itemIndex }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="measurementModalLabel{{ $itemIndex }}">
                                Measurement Details: {{ ucfirst(str_replace('_', ' ', $measurement['type'] ?? 'N/A')) }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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

                            {{-- <div class="row mt-3">
                                <div class="col-md-6">
                                    <strong>Created At:</strong>
                                    {{ isset($measurement['created_at']) ?
                                    \Carbon\Carbon::parse($measurement['created_at'])->format('Y-m-d H:i:s') : 'N/A' }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Updated At:</strong>
                                    {{ isset($measurement['updated_at']) ?
                                    \Carbon\Carbon::parse($measurement['updated_at'])->format('Y-m-d H:i:s') : 'N/A' }}
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

    <!-- Refund Modals -->
    @foreach ($order->payments as $payment)
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
                                <h5 class="modal-title">Create Refund</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <form id="refundForm{{ $payment->id }}">
                                @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
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
                                    </div>
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

    <!-- Return Order Modal -->
    <div class="modal fade" id="returnOrderModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Return Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form id="returnOrderForm">
                    @csrf
                    <div class="modal-body">
                        <div class="alert alert-warning" id="orderReturnPaymentAlert" style="display:none"></div>
                        <div class="mb-3">
                            <label class="form-label">Return Date <span class="text-danger">*</span></label>
                            <input type="date" name="return_date" class="form-control" value="{{ date('Y-m-d') }}"
                                required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Return Reason</label>
                            <textarea name="reason" class="form-control" rows="2"></textarea>
                        </div>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="refund" value="1"
                                id="refundCheckbox">
                            <label class="form-check-label" for="refundCheckbox">
                                Process Refund (Uncheck to NOT issue refund)
                            </label>
                        </div>
                        <div class="alert alert-info">
                            Returning this order will:
                            <ul class="mb-0">
                                <li>Mark status as "Return"</li>
                                <li>Mark items as returned</li>
                                <li>Restore inventory quantities</li>
                                <li>Process refunds for all payments (optional)</li>
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Return Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        // Function to show Bootstrap alert
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
                url: '{{ route('orders.update', $order->id) }}',
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
            const baseUrl = '{{ url('/') }}';
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
            const remaining = parseFloat(document.getElementById('remainingAmount').textContent.replace(
                /[^0-9.-]+/g, ''));
            const entered = parseFloat(this.value) || 0;

            if (entered > remaining) {
                this.setCustomValidity('Amount cannot exceed remaining amount');
            } else {
                this.setCustomValidity('');
            }
        });

        // Handle return item form submission with AJAX
        $(document).on('submit', '.return-item-form', function(e) {
            e.preventDefault();

            const form = $(this);
            const itemId = form.find('input[name="order_item_id"]').val();
            const submitButton = form.find('button[type="submit"]');
            const originalText = submitButton.text();

            submitButton.prop('disabled', true).text('Processing...');

            const formData = new FormData(this);

            $.ajax({
                url: '{{ url('/') }}/order-items/' + itemId + '/return',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    if (response.success) {
                        // Close modal
                        const modal = bootstrap.Modal.getInstance(form.closest('.modal')[0]);
                        modal.hide();

                        // Show success message
                        showAlert(response.message ||
                            'Item returned successfully. Refund processed if payment was made.',
                            'success');
                    } else {
                        showAlert('Error: ' + (response.message || 'Failed to return item'), 'danger');
                        submitButton.prop('disabled', false).text(originalText);
                    }
                },
                error: function(xhr) {
                    let errorMsg = 'Failed to return item. ';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg += xhr.responseJSON.message;
                    } else {
                        errorMsg += 'Please try again.';
                    }
                    showAlert(errorMsg, 'danger');
                    submitButton.prop('disabled', false).text(originalText);
                }
            });
        });

        // Handle refund form submissions
        @foreach ($order->payments as $payment)
            @if ($payment->type === 'payment')
                @php
                    $alreadyRefunded = \App\Models\Payment::where('refund_for_payment_id', $payment->id)->where('type', 'refund')->sum('amount');
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
                            url: '{{ route('payments.refund', $payment->id) }}',
                            method: 'POST',
                            data: formData,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            success: function(response) {
                                if (response.success) {
                                    const modal = bootstrap.Modal.getInstance(document.getElementById(
                                        'refundModal{{ $payment->id }}'));
                                    modal.hide();
                                    showAlert(response.message || 'Refund created successfully!',
                                        'success');
                                } else {
                                    showAlert('Error: ' + (response.message ||
                                        'Failed to create refund'), 'danger');
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
                                showAlert(errorMsg, 'danger');
                                submitButton.prop('disabled', false).text(originalText);
                            }
                        });
                    });
                @endif
            @endif
        @endforeach

        // Handle Return Order form submission
        $('#returnOrderForm').on('submit', function(e) {
            e.preventDefault();
            const form = $(this);
            const submitButton = form.find('button[type="submit"]');
            submitButton.prop('disabled', true).text('Processing...');
            const formData = form.serialize();
            $.ajax({
                url: '{{ route('orders.return', $order->id) }}',
                method: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-Requested-With': 'XMLHttpRequest'
                },
                success: function(response) {
                    if (response.success) {
                        const modal = bootstrap.Modal.getInstance(document.getElementById(
                            'returnOrderModal'));
                        modal.hide();
                        showAlert(response.message || 'Order returned successfully!', 'success');
                    } else {
                        showAlert('Error: ' + (response.message || 'Failed to return order'), 'danger');
                    }
                    submitButton.prop('disabled', false).text('Return Order');
                },
                error: function(xhr) {
                    let errorMsg = 'Failed to return order. ';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMsg += xhr.responseJSON.message;
                    } else {
                        errorMsg += 'Please try again.';
                    }
                    showAlert(errorMsg, 'danger');
                    submitButton.prop('disabled', false).text('Return Order');
                }
            });
        });

        // Calculate total payments for warning
        var totalPaid = {{ (int) $order->payments()->where('type', 'payment')->sum('amount') }};
        var paymentAlertBox = $('#orderReturnPaymentAlert');
        // On modal show, ensure payment warning logic applies on refund checkbox state
        $('#returnOrderModal').on('show.bs.modal', function() {
            togglePaymentWarning();
        });
        $('#refundCheckbox').on('change', togglePaymentWarning);

        function togglePaymentWarning() {
            if ($('#refundCheckbox').is(':checked')) {
                if (totalPaid > 0) {
                    paymentAlertBox.html(
                        `Payment Found: This order has a payment of Rs ${totalPaid.toFixed(2)}. A refund will be automatically processed when you return this order.`
                    ).show();
                } else {
                    paymentAlertBox.html('').hide();
                }
            } else {
                paymentAlertBox.html('').hide();
            }
        }
    </script>
@endsection
