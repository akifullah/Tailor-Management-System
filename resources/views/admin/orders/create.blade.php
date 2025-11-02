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
                                <select name="customer_id" class="form-control" required>
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Order Date *</label>
                                <input type="date" name="order_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Payment Method *</label>
                                <select name="payment_method" class="form-control" required>
                                    <option value="cash">Cash</option>
                                    <option value="online">Online</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Payment Status *</label>
                                <select name="payment_status" id="payment_status" class="form-control" required>
                                    <option value="full">Full Payment</option>
                                    <option value="partial">Partial Payment</option>
                                </select>
                            </div>
                            <div class="col-md-4" id="partial_amount_div" style="display:none;">
                                <label class="form-label">Partial Amount</label>
                                <input type="number" step="0.01" name="partial_amount" id="partial_amount" class="form-control" value="0">
                            </div>
                        </div>

                        <hr>

                        <h5>Order Items</h5>
                        <div id="orderItems">
                            <div class="row mb-2 item-row">
                                <div class="col-md-3">
                                    <label class="form-label product-label">Product <span class="product-required">*</span></label>
                                    <select name="items[0][product_id]" class="form-control product-select" required onchange="loadProductPrice(this)">
                                        <option value="">Select Product (Optional if customer brings fabric)</option>
                                        @foreach($products as $product)
                                        <option value="{{ $product->id }}" 
                                            data-price="{{ $product->sell_price }}"
                                            data-stock="{{ $product->available_meters }}">
                                            {{ $product->title }} ({{ $product->available_meters }}m)
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="form-check mt-2">
                                        <input class="form-check-input customer-fabric-check" type="checkbox" name="items[0][is_from_inventory]" value="1" id="is_from_inventory_0" checked onchange="handleCustomerFabric(this)">
                                        <label class="form-check-label" for="is_from_inventory_0">
                                            Use Inventory Stock
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Sell Price *</label>
                                    <input type="number" step="0.01" name="items[0][sell_price]" class="form-control sell-price" required onchange="calculateTotal(this)">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Quantity (Meters) *</label>
                                    <input type="number" step="0.01" name="items[0][quantity_meters]" class="form-control quantity" required onchange="calculateTotal(this)">
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label">Total</label>
                                    <input type="text" class="form-control item-total" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label">&nbsp;</label><br>
                                    <button type="button" class="btn btn-danger btn-sm remove-item">Remove</button>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-info" onclick="addItemRow()">Add Item</button>

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
    let itemCount = 1;

    $('#payment_status').on('change', function() {
        if ($(this).val() === 'partial') {
            $('#partial_amount_div').show();
        } else {
            $('#partial_amount_div').hide();
        }
    });

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
            productRows[pid].push({row: $(this), qtyInput: qtyInput});
        });
        // Clear previous warning
        $('.item-row .qty-error').remove();
        $('.item-row .quantity').removeClass('is-invalid');
        // For every product, show warning on all rows if total exceeds stock
        $.each(productTotals, function(pid, total) {
            if (total > productStocks[pid]) {
                productRows[pid].forEach(function(obj) {
                    if (obj.qtyInput.parent().find('.qty-error').length === 0) {
                        obj.qtyInput.after('<div class="qty-error text-danger small">Total requested for this product exceeds available stock ('+productStocks[pid]+'m).</div>');
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
        const html = `
            <div class="row mb-2 item-row">
                <div class="col-md-3">
                    <label class="form-label product-label">Product <span class="product-required">*</span></label>
                    <select name="items[${itemCount}][product_id]" class="form-control product-select" required onchange="loadProductPrice(this)">
                        <option value="">Select Product (Optional if customer brings fabric)</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" 
                            data-price="{{ $product->sell_price }}"
                            data-stock="{{ $product->available_meters }}">
                            {{ $product->title }} ({{ $product->available_meters }}m)
                        </option>
                        @endforeach
                    </select>
                    <div class="form-check mt-2">
                        <input class="form-check-input customer-fabric-check" type="checkbox" name="items[${itemCount}][is_from_inventory]" value="1" id="is_from_inventory_${itemCount}" checked onchange="handleCustomerFabric(this)">
                        <label class="form-check-label" for="is_from_inventory_${itemCount}">
                            Use Inventory Stock
                        </label>
                    </div>
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
                <div class="col-md-3">
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
            alert('Order not allowed: One or more products have total quantity > available meters. Please fix highlighted rows.');
            e.preventDefault();
            return false;
        }
    });
</script>
@endsection

