@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-center justify-content-between">
            <h4 class="fs-18 fw-semibold mb-0">Edit Sewing Order #{{ $sewingOrder->sewing_order_number }}</h4>
            <a href="{{ route('sewing-orders.show', $sewingOrder->id) }}" class="btn btn-secondary btn-sm">Back to Order</a>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('sewing-orders.update', $sewingOrder->id) }}" method="POST"
                            id="sewingOrderEditForm" autocomplete="off">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Customer *</label>
                                    <select id="customer_id" name="customer_id" class="form-select select2" required>
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                data-measurement='@json($customer->measurements)'
                                                {{ $sewingOrder->customer_id == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->name }} | {{ $customer->phone }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Order Date *</label>
                                    <input type="date" name="order_date" class="form-control"
                                        value="{{ $sewingOrder->order_date?->format('Y-m-d') }}" required>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label">Delivery Date</label>
                                    <input type="date" name="delivery_date" class="form-control"
                                        value="{{ $sewingOrder->delivery_date?->format('Y-m-d') }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Order Status</label>
                                    <select name="order_status" class="form-select" required
                                        {{ $sewingOrder->order_status === 'cancelled' ? 'disabled' : '' }}>
                                        @foreach (['pending', 'in_progress', 'completed', 'on_hold', 'cancelled', 'delivered'] as $status)
                                            <option value="{{ $status }}"
                                                {{ $sewingOrder->order_status === $status ? 'selected' : '' }}>
                                                {{ ucfirst(str_replace('_', ' ', $status)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @if ($sewingOrder->order_status === 'cancelled')
                                        <input type="hidden" value="{{ $sewingOrder->order_status }}" name="order_status">
                                    @endif
                                    @error('order_status')
                                        {{ $message }}
                                    @enderror
                                </div>
                                {{-- <div class="col-md-8">
                                    <label class="form-label">Cancellation Reason (if any)</label>
                                    <input type="text" name="cancellation_reason" class="form-control"
                                        value="{{ $sewingOrder->cancellation_reason }}">
                                </div> --}}
                            </div>

                            <hr>
                            <h5>Sewing Order Items</h5>
                            <div id="sewingOrderItems"></div>
                            <button type="button" class="btn btn-info mb-3" onclick="addItemRow()">Add Item</button>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <div class="card bg-light mb-0">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <strong>Total Order Amount:</strong>
                                                    <h5 class="text-primary mb-0">Rs <span
                                                            id="payment_total_display">0.00</span></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Order Notes</label>
                                    <textarea name="notes" class="form-control" rows="2">{{ $sewingOrder->notes }}</textarea>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Grand Total: Rs <span id="grandTotal">0.00</span></h4>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">Save Changes</button>
                                <a href="{{ route('sewing-orders.show', $sewingOrder->id) }}"
                                    class="btn btn-secondary">Cancel</a>
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
        let customerMeasurements = [];
        const workers = @json($workers);
        const itemsData = @json($itemsPayload ?? []);

        function parseMeasurementsFromSelect() {
            const option = document.querySelector('#customer_id')?.selectedOptions[0];
            if (!option) {
                customerMeasurements = [];
                return;
            }
            const data = option.getAttribute('data-measurement');
            try {
                customerMeasurements = JSON.parse(data);
            } catch (e) {
                customerMeasurements = data || [];
            }
            if (!Array.isArray(customerMeasurements)) {
                customerMeasurements = [];
            }
        }

        function measurementOptions(selectedId = null) {
            let options = '<option value=\"\">Select a Measurement</option>';
            customerMeasurements.forEach((m) => {
                const id = m?.id ?? m?.measurement_id ?? '';
                const label = m?.name ?? m?.type ?? `Measurement ${id}`;
                const selected = selectedId && String(selectedId) === String(id) ? 'selected' : '';
                options += `<option value=\"${id}\" ${selected}>${label}</option>`;
            });
            return options;
        }

        function workerOptions(selected = []) {
            const selectedSet = new Set((selected || []).map(String));
            return workers.map((w) => {
                const isSelected = selectedSet.has(String(w.id)) ? 'selected' : '';
                return `<option value=\"${w.id}\" ${isSelected}>${w.name}</option>`;
            }).join('');
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
        }

        function addItemRow(prefill = {}) {
            if (!$('#customer_id').val()) {
                alert('Please select a customer first');
                return;
            }

            let measurementOpts = measurementOptions(prefill.measurement_id);

            const html = `
            <div class=\"row align-items-end mb-2 item-row border-bottom pb-2 position-relative\">
                <input type=\"hidden\" name=\"items[${itemCount}][id]\" value=\"${prefill.id ?? ''}\">
                <div class=\"col-md-2\">
                    <label class=\"form-label\">Product Name *</label>
                    <input type=\"text\" name=\"items[${itemCount}][product_name]\" class=\"form-control\" value=\"${prefill.product_name ?? ''}\" required>
                </div>
                <div class=\"col-md-2\">
                    <label class=\"form-label\">Color</label>
                    <input type=\"text\" name=\"items[${itemCount}][color]\" class=\"form-control\" value=\"${prefill.color ?? ''}\">
                </div>
                <div class=\"col-md-1\">
                    <label class=\"form-label\">Sewing Price *</label>
                    <input type=\"number\" step=\"0.01\" name=\"items[${itemCount}][sewing_price]\" class=\"form-control sewing-price\" value=\"${prefill.sewing_price ?? ''}\" required onchange=\"calculateTotal(this)\">
                </div>
                <div class=\"col-md-1\">
                    <label class=\"form-label\">Qty *</label>
                    <input type=\"number\" name=\"items[${itemCount}][qty]\" class=\"form-control quantity\" value=\"${prefill.qty ?? 1}\" required min=\"1\" max=\"20\" onchange=\"calculateTotal(this)\">
                </div>
                <div class=\"col-md-2\">
                    <label class=\"form-label\">Customer Measurement</label>
                    <select name=\"items[${itemCount}][customer_measurement]\" class=\"form-select measurement-select\" required>
                        ${measurementOpts}
                    </select>
                </div>
                <div class=\"col-md-2\">
                    <label class=\"form-label\">Assign To Worker</label>
                    <select name=\"items[${itemCount}][assign_to][]\" class=\"form-select select2\" multiple required>
                        ${workerOptions(prefill.assign_to ?? [])}
                    </select>
                </div>
                <div class=\"col-md-1\">
                    <label class=\"form-label\">Total</label>
                    <input type=\"text\" class=\"form-control item-total\" readonly>
                </div>
                <div class=\"col-md-1 d-flex align-items-center\">
                    <button type=\"button\" class=\"btn btn-danger btn-sm remove-item w-100\">Remove</button>
                </div>
            </div>
            `;
            $('#sewingOrderItems').append(html);
            $('#sewingOrderItems .select2').last().select2();
            calculateTotal($('#sewingOrderItems .item-row').last().find('.sewing-price'));
            itemCount++;
        }

        $(document).ready(function() {
            parseMeasurementsFromSelect();

            $('#customer_id').on('change', function() {
                parseMeasurementsFromSelect();
                $('#sewingOrderItems select.measurement-select').each(function() {
                    const selectedVal = $(this).val();
                    $(this).html(measurementOptions(selectedVal));
                });
            });

            $('#payment_status').on('change', function() {
                if ($(this).val() === 'partial') {
                    $('#partial_amount_div').show();
                    $('#partial_amount').prop('required', false);
                } else {
                    $('#partial_amount_div').hide();
                    $('#partial_amount').prop('required', false).val('');
                    $('#remaining_amount_display').text('0.00');
                }
            });

            $('#payment_status').trigger('change');

            $('#sewingOrderForm').on('submit', function(e) {
                if ($('.item-row').length === 0) {
                    alert('Please add at least one item');
                    e.preventDefault();
                    return false;
                }
            });

            // Prefill existing items
            if (itemsData.length) {
                itemsData.forEach((item) => addItemRow(item));
            }
            updateGrandTotal();
        });

        $(document).on('input change', '.item-row .quantity, .item-row .sewing-price', function() {
            calculateTotal(this);
        });

        $(document).on('click', '.remove-item', function() {
            $(this).closest('.item-row').remove();
            updateGrandTotal();
        });
    </script>
@endsection
