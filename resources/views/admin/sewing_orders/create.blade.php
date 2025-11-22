@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3">
            <h4 class="fs-18 fw-semibold mb-0">Create New Sewing Order</h4>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('sewing-orders.store') }}" method="POST" id="sewingOrderForm"
                            autocomplete="off">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Customer *</label>
                                    @if ($selectedCustomer)
                                        <select id="customer_id" class="form-select select2" disabled>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    {{ $selectedCustomer->id == $customer->id ? 'selected' : '' }}
                                                    data-measurement='@json($customer->measurements)'>
                                                    {{ $customer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input type="hidden" name="customer_id" value="{{ $selectedCustomer->id }}">
                                    @else
                                        <select id="customer_id" name="customer_id" class="form-select select2" required>
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    data-measurement='@json($customer->measurements)'>
                                                    {{ $customer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Order Date *</label>
                                    <input type="date" name="order_date" class="form-control" value="{{ date('Y-m-d') }}"
                                        required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Delivery Date</label>
                                    <input type="date" name="delivery_date" class="form-control" required>
                                </div>
                            </div>
                            <hr>
                            <h5>Sewing Order Items</h5>
                            <div id="sewingOrderItems"></div>
                            <button type="button" class="btn btn-info mb-3" onclick="addItemRow()">Add Item</button>

                            <hr>
                            <h5 class="mb-3">Payment Information</h5>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card bg-light mb-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>Total Order Amount:</strong>
                                                    <h5 class="text-primary mb-0">Rs <span
                                                            id="payment_total_display">0.00</span></h5>
                                                </div>
                                                <div class="col-md-3">
                                                    <strong>Payment Status:</strong>
                                                    <select name="payment_status" id="payment_status"
                                                        class="form-control mt-1" required>
                                                        <option value="no_payment" selected>No Payment</option>
                                                        <option value="partial">Partial Payment</option>
                                                        <option value="full">Full Payment</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3" id="partial_amount_div" style="display:none;">
                                                    <strong>Paid Amount:</strong>
                                                    <input type="number" step="0.01" name="partial_amount"
                                                        id="partial_amount" class="form-control mt-1" min="0.01"
                                                        value="0">
                                                    <small class="text-muted">Remaining: Rs <span
                                                            id="remaining_amount_display">0.00</span></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-3">
                                    <label class="form-label">Payment Method *</label>
                                    <select name="payment_method" id="payment_method" class="form-control" required>
                                        <option value="cash">Cash</option>
                                        <option value="online">Online</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                        <option value="cheque">Cheque</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">Payment Date</label>
                                    <input type="datetime-local" name="payment_date" id="payment_date" class="form-control"
                                        value="{{ now()->format('Y-m-d\TH:i') }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Person + Reference</label>
                                    <input type="text" name="person_reference" class="form-control"
                                        placeholder="e.g., John Doe - INV-123">
                                </div>
                            </div>

                            {{-- <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Payment Notes</label>
                                    <textarea name="payment_notes" class="form-control" rows="2"></textarea>
                                </div>
                            </div> --}}

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Order Notes</label>
                                    <textarea name="notes" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Grand Total: Rs <span id="grandTotal">0.00</span></h4>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">Create Sewing Order</button>
                                <a href="{{ route('sewing-orders.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let itemCount = 1;
        let customerMeasurements = null;

        function getCustomerMeasurement(selectElement) {
            const option = $(selectElement).find(":selected");
            const measurementData = option.attr("data-measurement");

            let measurements;
            try {
                measurements = JSON.parse(measurementData);
            } catch (err) {
                measurements = measurementData;
            }

            let ms = document.createElement("select");
            ms.className = "form-select";
            ms.required = true;
            ms.name = `items[${itemCount}][customer_measurement]`;

            let options = `<option value="">Select a Measurement</option>`;

            measurements?.forEach((m) => {
                options += `<option value='${JSON.stringify(m)}'>${String(m?.type ?? '')}</option>`;
            });

            ms.innerHTML = options;

            // Save reference for later
            customerMeasurements = measurements;
        }

        $("#customer_id").on("change", function() {
            customerMeasurements = null;
            const option = $(this).find(":selected");
            const measurementData = option.attr("data-measurement");
            try {
                customerMeasurements = JSON.parse(measurementData);
            } catch (err) {
                customerMeasurements = measurementData;
            }
        });

        $(document).ready(function() {
            const select = $("#customer_id")[0];
            if (select?.value) {
                const option = $(select).find(":selected");
                const measurementData = option.attr("data-measurement");
                try {
                    customerMeasurements = JSON.parse(measurementData);
                } catch (err) {
                    customerMeasurements = measurementData;
                }
            }

            $('#partial_amount_div').hide();
            $('#partial_amount').prop('required', false);

            $('#payment_status').on('change', function() {
                if ($(this).val() === 'partial') {
                    $('#partial_amount_div').show();
                    $('#partial_amount').prop('required', false);
                    $('#partial_amount').off('focus.addreq').on('focus.addreq', function() {
                        if ($('#payment_status').val() === 'partial') {
                            $(this).prop('required', true);
                            const grandTotal = parseFloat($('#grandTotal').text()) || 0;
                            $('#remaining_amount_display').text(grandTotal.toFixed(2));
                        }
                    });
                } else {
                    $('#partial_amount_div').hide();
                    $('#partial_amount').prop('required', false).val('');
                    $('#remaining_amount_display').text('0.00');
                }
            });

            $('#payment_status').trigger('change');

            $('#partial_amount').on('input', function() {
                updateRemainingAmount();
            });
        });

        function updateRemainingAmount() {
            const grandTotal = parseFloat($('#grandTotal').text()) || 0;
            const paidAmount = parseFloat($('#partial_amount').val()) || 0;
            const remaining = Math.max(0, grandTotal - paidAmount);
            $('#remaining_amount_display').text(remaining.toFixed(2));
            $('#payment_total_display').text(grandTotal.toFixed(2));

            $('#partial_amount').attr('max', grandTotal.toFixed(2));

            const partialAmountInput = $('#partial_amount');
            if ($('#payment_status').val() === 'partial') {
                if (paidAmount > grandTotal) {
                    partialAmountInput[0].setCustomValidity('Paid amount cannot exceed total amount');
                } else {
                    partialAmountInput[0].setCustomValidity('');
                }
            } else {
                partialAmountInput[0].setCustomValidity('');
            }
        }

        function calculateTotal(element) {
            const row = $(element).closest('.item-row');
            const price = parseFloat(row.find('.sewing-price').val()) || 0;
            const qty = parseFloat(row.find('.quantity').val()) || 0;
            const total = price * qty;
            row.find('.item-total').val(total.toFixed(2));
            updateGrandTotal();
        }

        function updateGrandTotal() {
            let grandTotal = 0;
            $('.item-total').each(function() {
                grandTotal += parseFloat($(this).val()) || 0;
            });
            $('#grandTotal').text(grandTotal.toFixed(2));
            $('#payment_total_display').text(grandTotal.toFixed(2));
            if ($('#payment_status').val() === 'partial') {
                updateRemainingAmount();
            }
        }

        function addItemRow() {
            if (!$("#customer_id").val()) {
                alert("Please select a customer first");
                return;
            }

            let measurementOptions = '<option value="">Select a Measurement</option>';
            if (customerMeasurements && customerMeasurements.length > 0) {
                customerMeasurements.forEach((m) => {
                    measurementOptions += `<option value='${JSON.stringify(m)}'>${String(m?.type ?? '')}</option>`;
                });
            }

            const html = `
            <div class="row align-items-end mb-2 item-row border-bottom pb-2 position-relative">
                <div class="col-md-2">
                    <label class="form-label">Product Name *</label>
                    <input type="text" name="items[${itemCount}][product_name]" class="form-control" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Color</label>
                    <input type="text" name="items[${itemCount}][color]" class="form-control">
                </div>
                <div class="col-md-1">
                    <label class="form-label">Sewing Price *</label>
                    <input type="number" step="0.01" name="items[${itemCount}][sewing_price]" class="form-control sewing-price" required onchange="calculateTotal(this)">
                </div>
                <div class="col-md-1">
                    <label class="form-label">Qty *</label>
                    <input type="number" name="items[${itemCount}][qty]" class="form-control quantity" required min="1" max="20" onchange="calculateTotal(this)">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Customer Measurement</label>
                    <select name="items[${itemCount}][customer_measurement]" class="form-select measurement-select" required>
                        ${measurementOptions}
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Assign To Worker</label>
                    <select name="items[${itemCount}][assign_to]" class="form-select" required>
                        <option value="">Select Worker</option>
                        @foreach ($workers as $worker)
                        <option value="{{ $worker->id }}">{{ $worker->name }}</option>
                        @endforeach
                    </select>
                </div>
              
                <div class="col-md-1">
                    <label class="form-label">Total</label>
                    <input type="text" class="form-control item-total" readonly>
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-item position-absolute w-auto top-0 end-0">Remove</button>
            </div>
        `;
            $('#sewingOrderItems').append(html);
            itemCount++;
        }

        $(document).on('input change', '.item-row .quantity, .item-row .sewing-price', function() {
            calculateTotal(this);
        });

        $(document).on('click', '.remove-item', function() {
            $(this).closest('.item-row').remove();
            updateGrandTotal();
        });

        $('#sewingOrderForm').on('submit', function(e) {
            if ($('.item-row').length === 0) {
                alert('Please add at least one item');
                e.preventDefault();
                return false;
            }

            if ($('#payment_status').val() === 'partial' && ($('#partial_amount_div').is(':hidden') || !$(
                    '#partial_amount')[0].checkValidity())) {
                $('#partial_amount_div').show();
                setTimeout(function() {
                    $('#partial_amount').focus();
                }, 50);
            }
        });
    </script>
@endsection
