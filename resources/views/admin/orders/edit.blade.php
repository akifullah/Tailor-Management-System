@extends('admin.layouts.app')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-md-8">
            <h4 class="fs-18 fw-semibold">Edit Order - {{ $order->order_number }}</h4>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-secondary">Back</a>
        </div>
    </div>

    <form id="editOrderFullForm" action="{{ route('orders.update', $order->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card mb-4">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Order Date</label>
                        <input type="date" name="order_date" class="form-control" value="{{ old('order_date', $order->order_date?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Delivery Date</label>
                        <input type="date" name="delivery_date" class="form-control" value="{{ old('delivery_date', $order->delivery_date?->format('Y-m-d')) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Delivery Status</label>
                        <select name="delivery_status" class="form-select">
                            @php $statuses = ['pending','progress','completed','delivered','cancelled','returned']; @endphp
                            @foreach($statuses as $s)
                                <option value="{{ $s }}" {{ $order->delivery_status === $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <h5>Items</h5>
                <div id="orderItems"></div>
                <button type="button" class="btn btn-info" id="addItemBtn">Add Item</button>
                {{-- Hidden template for existing items (populated by JS on load) --}}

                <hr>
               

                <input type="hidden" name="new_items_json" id="newItemsJson">

            </div>
            <div class="card-footer text-end">
                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-secondary">Cancel</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
</div>

@endsection

@section('js')
<script>
    (function(){
        'use strict';
        // Copy core functionality from create view: dynamic item rows, totals and validation
        let itemCount = 0;
        const orderItemsContainer = document.getElementById('orderItems');

        // Build initial rows from server-side items
        const existingItems = [];
        @foreach($order->items as $item)
            existingItems.push({
                id: '{{ $item->id }}',
                product_id: '{{ $item->product_id }}',
                product_name: `{!! addslashes($item->product?->title ?? 'Custom Item') !!}`,
                sell_price: '{{ $item->sell_price }}',
                quantity_meters: '{{ $item->quantity_meters }}',
                is_from_inventory: '{{ $item->is_from_inventory ? 1 : 0 }}'
            });
        @endforeach

        function renderExistingItems() {
            existingItems.forEach(function(it) {
                const html = itemRowHtmlExisting(it);
                orderItemsContainer.insertAdjacentHTML('beforeend', html);
                itemCount++;
            });
            updateGrandTotal();
        }

        function itemRowHtmlExisting(it) {
            // product select with preselected value
            const productOptions = `
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}" data-price="{{ $product->sell_price }}" data-stock="{{ $product->available_meters }}" ${it.product_id == '{{ $product->id }}' ? 'selected' : ''}>{{ $product->title }} ({{ $product->available_meters }}m)</option>
                @endforeach
            `;

            return `
            <div class="row align-items-end mb-2 item-row border-bottom pb-2 position-relative">
                <div class="col-md-2">
                    <label class="form-label product-label">Product</label>
                    <select name="items[${it.id}][product_id]" class="form-select product-select" onchange="loadProductPrice(this)">
                        ${productOptions}
                    </select>
                    <input type="hidden" name="items[${it.id}][id]" value="${it.id}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Sell Price *</label>
                    <input type="number" step="0.01" name="items[${it.id}][sell_price]" class="form-control sell-price" onchange="calculateTotal(this)" value="${it.sell_price}" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Quantity (Meters) *</label>
                    <input type="number" step="0.01" name="items[${it.id}][quantity_meters]" class="form-control quantity" onchange="calculateTotal(this)" value="${it.quantity_meters}" required>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Total</label>
                    <input type="text" class="form-control item-total" value="${it.sell_price * it.quantity_meters}" readonly>
                </div>
                <div class="col-md-2 d-none">
                    <label class="form-label">From Inventory</label>
                    <div class="form-check">
                        <input type="hidden" name="items[${it.id}][is_from_inventory]" value="1">
                        <input type="checkbox" name="items[${it.id}][is_from_inventory]" class="form-check-input inv-check" value="1" ${it.is_from_inventory == 1 ? 'checked' : ''}>
                    </div>
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-item position-absolute w-auto top-0 end-0">Remove</button>
            </div>
            `;
        }

        function addItemRow() {
            const html = `
            <div class="row align-items-end mb-2 item-row border-bottom pb-2 position-relative">
                <div class="col-md-2">
                    <label class="form-label product-label">Product <span class="product-required">*</span></label>
                    <select name="new_items[${itemCount}][product_id]" class="form-select product-select" required onchange="loadProductPrice(this)">
                        <option value="">Select Product</option>
                        @foreach ($products as $product)
                        <option value="{{ $product->id }}" data-price="{{ $product->sell_price }}" data-stock="{{ $product->available_meters }}">{{ $product->title }} ({{ $product->available_meters }}m)</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Sell Price *</label>
                    <input type="number" step="0.01" name="new_items[${itemCount}][sell_price]" class="form-control sell-price" required onchange="calculateTotal(this)">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Quantity (Meters) *</label>
                    <input type="number" step="0.01" name="new_items[${itemCount}][quantity_meters]" class="form-control quantity" required onchange="calculateTotal(this)">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Total</label>
                    <input type="text" class="form-control item-total" readonly>
                </div>
                <div class="col-md-2 d-none">
                    <label class="form-label">From Inventory</label>
                    <div class="form-check">
                        <input type="text" name="new_items[${itemCount}][is_from_inventory]" value="1">
                        <input type="checkbox" checked name="new_items[${itemCount}][is_from_inventory]" class="form-check-input" value="1">
                    </div>
                </div>
                <button type="button" class="btn btn-danger btn-sm remove-item position-absolute w-auto top-0 end-0">Remove</button>
            </div>
            `;
            orderItemsContainer.insertAdjacentHTML('beforeend', html);
            itemCount++;
        }

        document.getElementById('addItemBtn').addEventListener('click', addItemRow);

        // delegated events
        document.addEventListener('change', function(e) {
            if (e.target && e.target.matches('.product-select')) {
                loadProductPrice(e.target);
            }
        });

        document.addEventListener('input', function(e) {
            if (e.target && e.target.matches('.quantity, .sell-price')) {
                calculateTotal(e.target);
            }
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.matches('.remove-item')) {
                const row = e.target.closest('.item-row');
                // If this row contains existing item id, mark it for removal by adding hidden input
                const idInput = row.querySelector('input[name^="items["]');
                if (idInput) {
                    // add a hidden remove_items[] input to the form
                    const removeInput = document.createElement('input');
                    removeInput.type = 'hidden';
                    removeInput.name = 'remove_items[]';
                    removeInput.value = idInput.value;
                    document.getElementById('editOrderFullForm').appendChild(removeInput);
                }
                row.remove();
                updateGrandTotal();
            }
        });

        function loadProductPrice(select) {
            const option = select.querySelector(':checked');
            const price = option?.dataset?.price || 0;
            const stock = option?.dataset?.stock || 0;
            const row = select.closest('.item-row');
            const sellInput = row.querySelector('.sell-price');
            if (sellInput && (!sellInput.value || sellInput.value == 0)) sellInput.value = price;
            calculateTotal(select);
            checkAllQuantities();
        }

        function calculateTotal(element) {
            const row = element.closest ? element.closest('.item-row') : $(element).closest('.item-row')[0];
            const price = parseFloat(row.querySelector('.sell-price').value) || 0;
            const qty = parseFloat(row.querySelector('.quantity').value) || 0;
            const totalEl = row.querySelector('.item-total');
            if (totalEl) totalEl.value = (price * qty).toFixed(2);
            updateGrandTotal();
            checkAllQuantities();
        }

        function updateGrandTotal() {
            let grandTotal = 0;
            document.querySelectorAll('.item-total').forEach(function(el) {
                grandTotal += parseFloat(el.value) || 0;
            });
            // place grand total if present
            let gt = document.getElementById('grandTotal');
            if (gt) gt.textContent = grandTotal.toFixed(2);
        }

        function checkAllQuantities() {
            const totals = {};
            const stocks = {};
            // gather totals per product
            document.querySelectorAll('.item-row').forEach(function(row) {
                const select = row.querySelector('.product-select');
                if (!select) return;
                const pid = select.value;
                if (!pid) return;
                const stock = parseFloat(select.querySelector('option:checked')?.dataset?.stock) || 0;
                const qty = parseFloat(row.querySelector('.quantity').value) || 0;
                totals[pid] = (totals[pid] || 0) + qty;
                stocks[pid] = stock;
            });
            // clear errors
            document.querySelectorAll('.qty-error').forEach(e => e.remove());
            document.querySelectorAll('.quantity').forEach(e => e.classList.remove('is-invalid'));
            Object.keys(totals).forEach(function(pid) {
                if (totals[pid] > (stocks[pid] || 0)) {
                    // mark rows for this pid
                    document.querySelectorAll('.item-row').forEach(function(row) {
                        const select = row.querySelector('.product-select');
                        if (select && select.value == pid) {
                            const qtyInput = row.querySelector('.quantity');
                            if (!qtyInput.parentElement.querySelector('.qty-error')) {
                                const err = document.createElement('div');
                                err.className = 'qty-error text-danger small';
                                err.textContent = 'Total requested for this product exceeds available stock.';
                                qtyInput.parentElement.appendChild(err);
                            }
                            qtyInput.classList.add('is-invalid');
                        }
                    });
                }
            });
        }

        // initialize existing rows
        renderExistingItems();

        // on submit validate quantities
        document.getElementById('editOrderFullForm').addEventListener('submit', function(e) {
            checkAllQuantities();
            if (document.querySelectorAll('.quantity.is-invalid').length > 0) {
                alert('Cannot save: one or more quantities exceed available stock. Fix errors and try again.');
                e.preventDefault();
                return false;
            }
        });

    })();
</script>
@endsection
