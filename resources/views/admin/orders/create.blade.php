@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="fs-18 fw-semibold mb-0">Create New Order</h4>
                <button data-bs-toggle="modal" data-bs-target='#userModal' class="btn btn-primary btn-sm"
                    onclick="handleCreateCustomer()">Add Customer</button>
            </div>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('orders.store') }}" method="POST" id="orderForm" autocomplete="off">
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
                                                    {{ $customer->name }} | {{ $customer->phone }} |
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
                                                    {{ $customer->name }} | {{ $customer->phone }}</p>
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
                            </div>
                            <hr>
                            <h5>Order Items</h5>
                            <div id="orderItems"></div>
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

                            <div class="row mb-3" id="payment_method_row">
                                <div class="col-md-3">
                                    <label class="form-label">Payment Method <span
                                            id="payment_method_required">*</span></label>
                                    <select name="payment_method" id="payment_method" class="form-control">
                                        {{-- <option disabled value="">Select Payment Method</option> --}}
                                        <option value="cash" selected>Cash</option>
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


    <div class="modal fade" id="userModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Add Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm" autocomplete="off">
                        <input type="hidden" name="id" id="id" autocomplete="off" value="">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="customer_id" class="form-label">Customer Old ID</label>
                                    <input type="number" name="customer_id" class="form-control" id="customer_id"
                                        placeholder="Customer Old ID">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Enter Full Name" required>
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone"
                                        placeholder="Enter phone" required>
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter your email">
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="address" class="form-control" id="address" name="address" value=""
                                    placeholder="Enter Address" autocomplete="off">
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="submit_btn">Submit</button>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </form> <!-- end form -->
                </div> <!-- end modal body -->
            </div> <!-- end modal content -->
        </div>
    </div>


@endsection

@section('js')
    <script>
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
        }

        $("#customer_id").on("change", function() {
            getCustomerMeasurement(this);
        });

        $(document).ready(function() {
            const select = $("#customer_id")[0];
            if (select?.value) {
                getCustomerMeasurement(select);
            }

            // -- PATCH START: Payment section UX for required/focus/error on partial_amount --

            // Initially hide and remove required from partial amount
            $('#partial_amount_div').hide();
            $('#partial_amount').prop('required', false);

            // Function to handle payment status changes
            function handlePaymentStatusChange() {
                const paymentStatus = $('#payment_status').val();

                if (paymentStatus === 'partial') {
                    $('#partial_amount_div').show();
                    $('#payment_method_row').show();
                    $('#payment_method').prop('required', true);
                    $('#payment_method_required').show();

                    // Remove required by default, only add required on focus
                    $('#partial_amount').prop('required', false);

                    // Attach focus event (only once)
                    $('#partial_amount').off('focus.addreq').on('focus.addreq', function() {
                        if ($('#payment_status').val() === 'partial') {
                            $(this).prop('required', true);
                            const grandTotal = parseFloat($('#grandTotal').text()) || 0;
                            $('#remaining_amount_display').text(grandTotal);
                        }
                    });

                    // Remove invalid flag on focus (if user was blocked because "is not focusable")
                    $('#partial_amount').on('focus', function() {
                        this.setCustomValidity('');
                    });

                } else if (paymentStatus === 'full') {
                    $('#partial_amount_div').hide();
                    $('#partial_amount').prop('required', false).val('');
                    $('#remaining_amount_display').text('0.00');
                    $('#payment_method_row').show();
                    $('#payment_method').prop('required', true);
                    $('#payment_method_required').show();
                } else if (paymentStatus === 'no_payment') {
                    $('#partial_amount_div').hide();
                    $('#partial_amount').prop('required', false).val('');
                    $('#remaining_amount_display').text('0.00');
                    $('#payment_method_row').show();
                    $('#payment_method').prop('required', false).val('cash');
                    $('#payment_method_required').hide();
                }
            }

            $('#payment_status').on('change', handlePaymentStatusChange);

            // Initialize on page load
            handlePaymentStatusChange();

            // Update remaining amount when partial amount changes
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

        function loadProductPrice(select) {
            const option = $(select).find(':selected');
            const price = option.data('price');
            const stock = option.data('stock');
            const row = $(select).closest('.item-row');

            // always from inventory
            row.find('.sell-price').val(price || '');
            if (stock && stock <= 0) {
                alert('Product is out of stock!');
            }

            calculateTotal(select);
            checkAllQuantities();
        }

        function checkAllQuantities() {
            let productTotals = {};
            let productStocks = {};
            let productRows = {};
            $('.item-row').each(function(i) {
                const select = $(this).find('.product-select');
                const pid = select.val();
                if (!pid) return;
                // always from inventory, so always check
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
            $('.item-row .qty-error').remove();
            $('.item-row .quantity').removeClass('is-invalid');
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
            if ($('#payment_status').val() === 'partial') {
                updateRemainingAmount();
            }
        }

        // Remove handleCustomerFabric since the checkbox is removed and it's not needed.
        // function handleCustomerFabric(checkbox) {...}  (REMOVED)

        function addItemRow() {
            // if(!$("#customer_id").val()) {
            //     alert("Please select a customer");
            //     return;
            // }
            const html = `
            <div class="row align-items-end mb-2 item-row border-bottom pb-2 position-relative">
                <div class="col-md-2">
                    <label class="form-label product-label">Product <span class="product-required">*</span></label>
                    <select name="items[${itemCount}][product_id]" class="form-select select2 product-select" required onchange="loadProductPrice(this)">
                        <option value="">Select Product</option>
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
                <button type="button" class="btn btn-danger btn-sm remove-item position-absolute w-auto  top-0 end-0">Remove</button>
            </div>
        `;
            $('#orderItems').append(html);
            itemCount++;
        }

        $(document).on('input change', '.item-row .quantity, .item-row .product-select', function() {
            calculateTotal(this);
        });

        $(document).on('click', '.remove-item', function() {
            $(this).closest('.item-row').remove();
            updateGrandTotal();
            checkAllQuantities();
        });

        // Block form submit if any total qty for any product > stock (only for items from inventory)
        $('#orderForm').on('submit', function(e) {
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

            // Extra: Focus partial amount if it's partial and missing, to avoid "not focusable" browser error
            if ($('#payment_status').val() === 'partial' && ($('#partial_amount_div').is(':hidden') || !$(
                    '#partial_amount')[0].checkValidity())) {
                $('#partial_amount_div').show();
                setTimeout(function() {
                    $('#partial_amount').focus();
                }, 50);
            }
        });
    </script>




    <script>
        function setValById(id, val) {
            let $input = $(`#${id}`).val(val);
        }

        function handleEdit(user) {
            $('#userModal').modal('show');
            console.log(user)
            const {
                id,
                customer_id,
                name,
                phone,
                email,
                address
            } = user;
            setValById("id", id)
            setValById("customer_id", customer_id)
            setValById("name", name)
            setValById("email", email)
            setValById("phone", phone)
            setValById("address", address)

            $("#userModalLabel").text("Edit Customer");
            $("#submit_btn").text("Update");


        }


        function handleDelete(id) {
            if (confirm("Are you sure! you want to delete?")) {
                $.ajax({
                    url: "{{ route('customers.destroy', ':id') }}".replace(':id', id),
                    type: 'DELETE',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.message || "Delete failed.");
                        }
                    },
                    error: function(xhr) {
                        alert("Error deleting user.");
                    }
                });
            }
        }
    </script>
    <script>
        function handleCreateCustomer() {
            setValById("id", "")
            setValById("name", "")
            setValById("email", "")
            setValById("phone", "")
            setValById("address", "")

            $('#userModal').modal('show');
            $("#userModalLabel").text("Add Customer");
            $("#submit_btn").text("Submit");


        }

        $(document).ready(function() {
            $("#userForm").on('submit', function(e) {
                e.preventDefault();
                let $form = $("#userForm");
                // Serialize the form as an array and log it
                var formArray = $form.serializeArray();

                // Remove previous errors
                $form.find('.text-danger').remove();

                $.ajax({
                    url: "{{ route('customers.store') }}",
                    type: "POST",
                    data: formArray,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        if (response.success) {
                            // Redirect to dashboard or wherever
                            location.reload();
                        } else {
                            const errors = response?.errors;


                            Object.keys(errors).forEach(function(key) {
                                var input = $form.find('[id="' + key + '"]');
                                if (input.length) {
                                    input.after(
                                        '<div class="text-danger" style="font-size: 13px;">' +
                                        errors[key][0] + '</div>');
                                }
                            });
                        }
                    },

                    // showError(xhr.responseJSON && xhr.responseJSON.message ? xhr
                    //     .responseJSON.message : "Login failed.");
                });

                function showError(msg) {
                    // Show error somewhere at the top of the form
                    if ($form.find('.form-error').length === 0) {
                        $form.prepend('<div class="form-error text-danger mb-3" style="font-size: 14px;">' +
                            msg + '</div>');
                    } else {
                        $form.find('.form-error').html(msg);
                    }
                }

            });

        });
    </script>
@endsection
