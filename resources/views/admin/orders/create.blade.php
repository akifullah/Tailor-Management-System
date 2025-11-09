@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3">
            <h4 class="fs-18 fw-semibold mb-0">Create New Order</h4>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
                            @csrf

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Customer *</label>
                                    {{-- <select id="customer_id" name="customer_id" class="form-control" required>
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}"
                                                data-measurement='@json($customer->measurements)'>{{ $customer->name }}
                                            </option>
                                        @endforeach
                                    </select> --}}
                                    @if ($selectedCustomer)
                                        <!-- Disabled select for display -->
                                        <select id="customer_id" class="form-select" disabled>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}"
                                                    {{ $selectedCustomer->id == $customer->id ? 'selected' : '' }}
                                                    data-measurement='@json($customer->measurements)'>
                                                    {{ $customer->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <!-- Hidden input to submit value -->
                                        <input type="hidden" name="customer_id" value="{{ $selectedCustomer->id }}">
                                    @else
                                        <!-- Normal select for user to choose -->
                                        <select id="customer_id" name="customer_id" class="form-select" required>
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
                                    <input type="date" name="delivery_date" class="form-control">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label class="form-label">Delivery Status</label>
                                    <select name="delivery_status" class="form-control">
                                        <option value="pending" selected>Pending</option>
                                        <option value="delivered">Delivered</option>
                                    </select>
                                </div>
                            </div>



                            <hr>

                            <h5>Order Items</h5>
                            <div id="orderItems">
                                {{-- <div class="row mb-2 item-row">
                                    <div class="col-md-3">
                                        <label class="form-label product-label">Product <span
                                                class="product-required">*</span></label>
                                        <select name="items[0][product_id]" class="form-control product-select" required
                                            onchange="loadProductPrice(this)">
                                            <option value="">Select Product (Optional if customer brings fabric)
                                            </option>
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" data-price="{{ $product->sell_price }}"
                                                    data-stock="{{ $product->available_meters }}">
                                                    {{ $product->title }} ({{ $product->available_meters }}m)
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="form-check mt-2">
                                            <input class="form-check-input customer-fabric-check" type="checkbox"
                                                name="items[0][is_from_inventory]" value="1" id="is_from_inventory_0"
                                                checked onchange="handleCustomerFabric(this)">
                                            <label class="form-check-label" for="is_from_inventory_0">
                                                Use Inventory Stock
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Sell Price *</label>
                                        <input type="number" step="0.01" name="items[0][sell_price]"
                                            class="form-control sell-price" required onchange="calculateTotal(this)">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Quantity (Meters) *</label>
                                        <input type="number" step="0.01" name="items[0][quantity_meters]"
                                            class="form-control quantity" required onchange="calculateTotal(this)">
                                    </div>
                                    <div class="col-md-2">
                                        <label class="form-label">Total</label>
                                        <input type="text" class="form-control item-total" readonly>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">&nbsp;</label><br>
                                        <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
                                    </div>
                                </div> --}}
                            </div>

                            <button type="button" class="btn btn-info" onclick="addItemRow()">Add Item</button>


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
                                                        <option value="full">Full Payment</option>
                                                        <option value="partial">Partial Payment</option>
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

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label class="form-label">Payment Notes</label>
                                    <textarea name="payment_notes" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <h4>Grand Total: <span id="grandTotal">0.00</span></h4>
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-success">Create Order</button>
                                <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
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
        // let custumerMeasurements = null

        // function getCustomerMeasurement() {
        //     const option = $(this).find(":selected");
        //     const measurementData = option.attr("data-measurement");

        //     let measurements;
        //     try {
        //         measurements = JSON.parse(measurementData);
        //     } catch (err) {
        //         measurements = measurementData;
        //     }

        //     let ms = document.createElement("select");
        //     ms.className = "form-select";
        //     ms.required = true;

        //     let options = `<option value="" >Select a Measurement</option>`;

        //     measurements?.forEach((m) => {
        //         options += `<option value="${JSON.stringify(m)}">${String(m?.type ?? '')}</option>`;
        //     });

        //     // Add all options at once
        //     ms.innerHTML = options;

        //     $("#orderItems").html("")

        //     // Debug log
        //     console.log(ms);
        //     custumerMeasurements = ms;
        //     console.log(custumerMeasurements)

        // }
        // $("#customer_id").on("change", getCustomerMeasurement);

        // getCustomerMeasurement();

        let itemCount = 1;



        let custumerMeasurements = null;

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


            let options = `<option value="">Select a Measurement</option>`;

            measurements?.forEach((m) => {
                options += `<option value='${JSON.stringify(m)}'>${String(m?.type ?? '')}</option>`;
            });

            ms.innerHTML = options;

            // Replace old measurement select
            $("#orderItems").html("");

            // Save reference for later
            custumerMeasurements = ms;
            console.log(custumerMeasurements);
        }

        // On change
        $("#customer_id").on("change", function() {
            getCustomerMeasurement(this);
        });

        // On page load / initial run
        $(document).ready(function() {
            const select = $("#customer_id")[0];
            if (select?.value) { // Only if a customer is selected
                getCustomerMeasurement(select);
            }
        });


        $('#payment_status').on('change', function() {
            if ($(this).val() === 'partial') {
                $('#partial_amount_div').show();
                $('#partial_amount').attr('required', 'required');
                updateRemainingAmount();
            } else {
                $('#partial_amount_div').hide();
                $('#partial_amount').removeAttr('required');
                $('#remaining_amount_display').text('0.00');
            }
        });

        // Update remaining amount when partial amount changes
        $('#partial_amount').on('input', function() {
            updateRemainingAmount();
        });

        // Update remaining amount when grand total changes
        function updateRemainingAmount() {
            const grandTotal = parseFloat($('#grandTotal').text()) || 0;
            const paidAmount = parseFloat($('#partial_amount').val()) || 0;
            const remaining = Math.max(0, grandTotal - paidAmount);
            $('#remaining_amount_display').text(remaining.toFixed(2));
            $('#payment_total_display').text(grandTotal.toFixed(2));

            // Set max attribute on partial amount input
            $('#partial_amount').attr('max', grandTotal.toFixed(2));

            // Validate paid amount doesn't exceed total
            const partialAmountInput = $('#partial_amount');
            if (paidAmount > grandTotal) {
                partialAmountInput[0].setCustomValidity('Paid amount cannot exceed total amount');
            } else {
                partialAmountInput[0].setCustomValidity('');
            }
        }

        function loadProductPrice(select) {
            const option = $(select).find(':selected');
            const price = option.data('price');
            const stock = option.data('stock');
            const row = $(select).closest('.item-row');
            const isFromInventory = row.find('.customer-fabric-check').is(':checked');

            // Only auto-fill price if using inventory stock
            if (isFromInventory) {
                row.find('.sell-price').val(price || '');
                if (stock && stock <= 0) {
                    alert('Product is out of stock!');
                }
            } else {
                // Customer brings own fabric - price should be custom (leave empty or let user enter)
                row.find('.sell-price').val('').attr('placeholder', 'Enter custom price');
            }
            calculateTotal(select);
            checkAllQuantities();
        }

        // New: Check all quantities grouped by product and show inline error if any exceed stock (only for items from inventory)
        function checkAllQuantities() {
            let productTotals = {};
            let productStocks = {};
            let productRows = {};
            // Gather totals (only for items where "Use Inventory Stock" is checked)
            $('.item-row').each(function(i) {
                const select = $(this).find('.product-select');
                const pid = select.val();
                if (!pid) return;
                const isFromInventory = $(this).find('.customer-fabric-check').is(':checked');
                if (!isFromInventory) return; // Skip items where customer brings own fabric
                const stock = parseFloat(select.find('option:selected').data('stock')) || 0;
                const qtyInput = $(this).find('.quantity');
                const qty = parseFloat(qtyInput.val() || 0);
                productTotals[pid] = (productTotals[pid] || 0) + qty;
                productStocks[pid] = stock;
                productRows[pid] = productRows[pid] || [];
                productRows[pid].push({
                    row: $(this),
                    qtyInput: qtyInput
                });
            });
            // Clear previous warning
            $('.item-row .qty-error').remove();
            $('.item-row .quantity').removeClass('is-invalid');
            // For every product, show warning on all rows if total exceeds stock
            $.each(productTotals, function(pid, total) {
                if (total > productStocks[pid]) {
                    productRows[pid].forEach(function(obj) {
                        if (obj.qtyInput.parent().find('.qty-error').length === 0) {
                            obj.qtyInput.after(
                                '<div class="qty-error text-danger small">Total requested for this product exceeds available stock (' +
                                productStocks[pid] + 'm).</div>');
                        }
                        obj.qtyInput.addClass('is-invalid');
                    });
                }
            });
        }

        function calculateTotal(element) {
            const row = $(element).closest('.item-row');
            const price = parseFloat(row.find('.sell-price').val()) || 0;
            const qty = parseFloat(row.find('.quantity').val()) || 0;
            row.find('.item-total').val((price * qty).toFixed(2));
            updateGrandTotal();
            checkAllQuantities();
        }

        function updateGrandTotal() {
            let grandTotal = 0;
            $('.item-total').each(function() {
                grandTotal += parseFloat($(this).val()) || 0;
            });
            $('#grandTotal').text(grandTotal.toFixed(2));
            $('#payment_total_display').text(grandTotal.toFixed(2));
            // Update remaining amount if partial payment is selected
            if ($('#payment_status').val() === 'partial') {
                updateRemainingAmount();
            }
        }

        function handleCustomerFabric(checkbox) {
            const row = $(checkbox).closest('.item-row');
            const isChecked = checkbox.checked;
            const label = $(checkbox).next('label');
            const select = row.find('.product-select');
            const priceInput = row.find('.sell-price');
            const productLabel = row.find('.product-label').first();
            if (productLabel.length === 0) {
                productLabel = row.find('.form-label').first();
            }

            if (isChecked) {
                label.text('Use Inventory Stock');
                row.find('.quantity').prop('required', true);
                select.prop('required', true);
                if (productLabel.length) {
                    productLabel.html('Product <span class="product-required">*</span>');
                }
                // If product is selected, auto-fill price from inventory
                if (select.val()) {
                    const price = select.find('option:selected').data('price');
                    priceInput.val(price || '').removeAttr('placeholder');
                }
            } else {
                label.text('Customer Brings Own Fabric');
                row.find('.quantity').removeClass('is-invalid');
                row.find('.qty-error').remove();
                select.prop('required', false);
                if (productLabel.length) {
                    productLabel.html('Product (Optional)');
                }
                // Clear auto-filled price, allow custom price entry
                priceInput.val('').attr('placeholder', 'Enter custom price');
                select.val(''); // Clear product selection
            }
            calculateTotal(checkbox);
            checkAllQuantities();
        }

        function addItemRow() {
            console.log(custumerMeasurements)
            const html = `
            <div class="row align-items-end mb-2 item-row border-bottom pb-2">
                <div class="col-md-2">
                     <div class="form-check mb-2">
                        <input class="form-check-input customer-fabric-check" type="checkbox" name="items[${itemCount}][is_from_inventory]" value="1" id="is_from_inventory_${itemCount}" checked onchange="handleCustomerFabric(this)">
                        <label class="form-check-label" for="is_from_inventory_${itemCount}">
                            Use Inventory Stock
                        </label>
                    </div>
                    
                    <label class="form-label product-label">Product <span class="product-required">*</span></label>
                    <select name="items[${itemCount}][product_id]" class="form-control product-select" required onchange="loadProductPrice(this)">
                        <option value="">Select Product (Optional if customer brings fabric)</option>
                        @foreach ($products as $product)
                        <option value="{{ $product->id }}" 
                            data-price="{{ $product->sell_price }}"
                            data-stock="{{ $product->available_meters }}">
                            {{ $product->title }} ({{ $product->available_meters }}m)
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Sell Price *</label>
                    <input type="number" step="0.01" name="items[${itemCount}][sell_price]" class="form-control sell-price" required onchange="calculateTotal(this)">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Quantity (Meters) *</label>
                    <input type="number" step="0.01" name="items[${itemCount}][quantity_meters]" class="form-control quantity" required onchange="calculateTotal(this)">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Total</label>
                    <input type="text" class="form-control item-total" readonly>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Status</label>
                    <select name="items[${itemCount}][status]" class="form-control">
                        <option value="pending" selected>Pending</option>
                        <option value="progress">Progress</option>
                        <option value="completed">Completed</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Select Measurement</label>
                    ${(function() {
                        // Clone the custumerMeasurements element to avoid mutating the original reference
                        if (!custumerMeasurements) return '';
                        // Create a clone
                        const ms = custumerMeasurements.cloneNode(true);
                        // Add the name attribute with the correct itemCount
                        ms.name = `items[${itemCount}][measurement]`;
                        return ms.outerHTML;
                    })()}
                </div>
                <div class="col-md-1">
                    <label class="form-label">&nbsp;</label><br>
                    <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
                </div>
            </div>
        `;
            $('#orderItems').append(html);
            itemCount++;
        }

        // Event: Also watch for input on every .quantity field for instant validation
        $(document).on('input change', '.item-row .quantity, .item-row .product-select', function() {
            calculateTotal(this); // Will also call checkAllQuantities as part of calculateTotal
        });

        $(document).on('click', '.remove-item', function() {
            $(this).closest('.item-row').remove();
            updateGrandTotal();
            checkAllQuantities();
        });

        // Block form submit if any total qty for any product > stock (only for items from inventory)
        $('#orderForm').on('submit', function(e) {
            // Remove required attribute from product selects where customer brings fabric
            $('.item-row').each(function() {
                const isFromInventory = $(this).find('.customer-fabric-check').is(':checked');
                const select = $(this).find('.product-select');
                if (!isFromInventory) {
                    select.prop('required', false);
                } else {
                    select.prop('required', true);
                }
            });

            checkAllQuantities();
            // Also check totals for items from inventory
            let productTotals = {};
            let productStocks = {};
            $('.item-row').each(function() {
                const select = $(this).find('.product-select');
                const pid = select.val();
                if (!pid) return;
                const isFromInventory = $(this).find('.customer-fabric-check').is(':checked');
                if (!isFromInventory) return;
                const stock = parseFloat(select.find('option:selected').data('stock')) || 0;
                const qty = parseFloat($(this).find('.quantity').val() || 0);
                productTotals[pid] = (productTotals[pid] || 0) + qty;
                productStocks[pid] = stock;
            });
            let hasError = false;
            $.each(productTotals, function(pid, total) {
                if (total > productStocks[pid]) {
                    hasError = true;
                }
            });
            if (hasError || $('.item-row .quantity.is-invalid').length > 0) {
                alert(
                    'Order not allowed: One or more products have total quantity > available meters. Please fix highlighted rows.'
                );
                e.preventDefault();
                return false;
            }
        });
    </script>
@endsection
