@extends('admin.layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="py-3">
            <h4 class="fs-18 fw-semibold mb-0">Add Stock Purchase</h4>
        </div>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('purchases.store') }}" method="POST" id="purchaseForm">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Supplier *</label>
                    <select name="supplier_id" id="supplier_id" class="form-control" required>
                        <option value="">Select Supplier</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Product *</label>
                    <select name="product_id" id="product_id" class="form-control" required>
                        <option value="">Select Product</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Quantity (Meters) *</label>
                    <input type="number" name="quantity_meters" id="quantity_meters" class="form-control" min="0.01"
                        step="0.01" required />
                </div>
                <div class="col-md-2">
                    <label>Price per Meter *</label>
                    <input type="number" name="price_per_meter" id="price_per_meter" class="form-control" min="0"
                        step="0.01" required />
                </div>
                <div class="col-md-2">
                    <label>Reference #</label>
                    <input type="text" name="reference_number" class="form-control" maxlength="191" />
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-12">
                    <div class="card bg-light">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Total Amount:</strong>
                                    <h5 class="text-primary mb-0" id="totalAmount">Rs 0.00</h5>
                                </div>
                                <div class="col-md-8">
                                    <label>Notes</label>
                                    <textarea name="notes" class="form-control" maxlength="500" rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr>
            <h5 class="mb-3">Payment Information</h5>

            <div class="row mb-3">
                {{-- <div class="col-md-3">
                    <label class="form-label">Payment Method *</label>
                    <select name="payment_method" id="payment_method" class="form-control" required>
                        <option value="cash">Cash</option>
                        <option value="online">Online</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="cheque">Cheque</option>
                    </select>
                </div> --}}

                <div class="col-md-3">
                    <label class="form-label">Payment Status</label>
                    <select name="payment_status" id="payment_status" class="form-select">
                        <option value="">No Payment</option>
                        <option value="full">Full Payment</option>
                        <option value="partial">Partial Payment</option>
                    </select>
                </div>
                <div class="col-md-3" id="paid_amount_div" style="display: none;">
                    <label>Paid Amount (Rs) <span class="text-danger">*</span></label>
                    <input type="number" name="paid_amount" id="paid_amount" class="form-control" min="0.01"
                        step="0.01" />
                    <small class="text-muted">Remaining: Rs <span id="remaining_amount_display">0.00</span></small>
                </div>
                <div class="col-md-3" id="payment_method_div" style="display: none;">
                    <label>Payment Method <span class="text-danger">*</span></label>
                    <select name="payment_method" id="payment_method_duplicate" class="form-select">
                        <option value="">Select Method</option>
                        <option value="cash">Cash</option>
                        <option value="online">Online</option>
                        <option value="bank_transfer">Bank Transfer</option>
                        <option value="cheque">Cheque</option>
                    </select>
                </div>
                <div class="col-md-3" id="payment_date_div" style="display: none;">
                    <label>Payment Date <span class="text-danger">*</span></label>
                    <input type="datetime-local" name="payment_date" id="payment_date" class="form-control"
                        value="{{ now()->format('Y-m-d\TH:i') }}" />
                </div>
            </div>

            <div class="row mb-3">
                {{-- <div class="col-md-6" id="person_reference_div" style="">
                    <label>Person + Reference</label>
                    <input type="text" name="person_reference" class="form-control"
                        placeholder="e.g., John Doe - INV-123" />
                </div> --}}

                {{-- <div class="col-md-6" id="payment_notes_div" style="">
                <label>Payment Notes</label>
                <textarea name="payment_notes" class="form-control" rows="2"></textarea>
            </div> --}}
            </div>

            <div class="row mb-3">
                <div class="col-md-12 d-flex justify-content-end">
                    <a href="{{ route('purchases.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-success">Add Stock Purchase</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        // Explanation:
        // The infinite recursion/stack overflow occurred because calculateTotal calls updatePaymentFields, 
        // and updatePaymentFields also calls calculateTotal. 
        // This mutual recursion never terminates.
        // 
        // The fix: calculateTotal should ONLY do calculation & DOM update, not call updatePaymentFields.
        // ONLY input listeners and updatePaymentFields should call calculateTotal (never vice-versa).

        function calculateTotal() {
            const quantity = parseFloat(document.getElementById('quantity_meters').value) || 0;
            const price = parseFloat(document.getElementById('price_per_meter').value) || 0;
            const total = quantity * price;
            document.getElementById('totalAmount').textContent = 'Rs ' + total.toFixed(2);
            return total;
        }

        function updatePaymentFields() {
            const paymentStatus = document.getElementById('payment_status').value;
            const total = calculateTotal();
            const paidAmountDiv = document.getElementById('paid_amount_div');
            const paymentMethodDiv = document.getElementById('payment_method_div');
            const paymentDateDiv = document.getElementById('payment_date_div');
            // These are commented out in the UI but left for future use 
            // const personReferenceDiv = document.getElementById('person_reference_div');
            // const paymentNotesDiv = document.getElementById('payment_notes_div');
            const paidAmountInput = document.getElementById('paid_amount');
            // For the duplicate payment_method select (when payment info shown):
            const paymentMethodInput = document.getElementById('payment_method_duplicate');

            if (paymentStatus === 'full') {
                paidAmountDiv.style.display = 'block';
                paidAmountInput.value = total.toFixed(2);
                paidAmountInput.removeAttribute('required');
                paidAmountInput.readOnly = true;
                paidAmountInput.removeAttribute('max');
                paymentMethodDiv.style.display = 'block';
                paymentMethodInput.setAttribute('required', 'required');
                paymentDateDiv.style.display = 'block';
                document.getElementById('payment_date').setAttribute('required', 'required');
                // document.getElementById('person_reference_div').style.display = 'block';
                // document.getElementById('payment_notes_div').style.display = 'block';
                document.getElementById('remaining_amount_display').textContent = '0.00';
            } else if (paymentStatus === 'partial') {
                paidAmountInput.value = ""
                paidAmountInput.readOnly = false;
                paidAmountDiv.style.display = 'block';
                paidAmountInput.setAttribute('required', 'required');
                paidAmountInput.setAttribute('max', total.toFixed(2));
                if (!paidAmountInput.value || parseFloat(paidAmountInput.value) > total) {
                    paidAmountInput.value = '';
                }
                paymentMethodDiv.style.display = 'block';
                paymentMethodInput.setAttribute('required', 'required');
                paymentDateDiv.style.display = 'block';
                document.getElementById('payment_date').setAttribute('required', 'required');
                // document.getElementById('person_reference_div').style.display = 'block';
                // document.getElementById('payment_notes_div').style.display = 'block';
                updateRemainingAmount();
            } else {
                paidAmountInput.readOnly = false;
                paidAmountDiv.style.display = 'none';
                paymentMethodDiv.style.display = 'none';
                paymentDateDiv.style.display = 'none';
                // document.getElementById('person_reference_div').style.display = 'none';
                // document.getElementById('payment_notes_div').style.display = 'none';
                paidAmountInput.value = '';
                paidAmountInput.removeAttribute('required');
                paymentMethodInput.removeAttribute('required');
                document.getElementById('payment_date').removeAttribute('required');
                document.getElementById('remaining_amount_display').textContent = total.toFixed(2);
            }
        }

        function updateRemainingAmount() {
            const total = calculateTotal();
            const paid = parseFloat(document.getElementById('paid_amount').value) || 0;
            const remaining = Math.max(0, total - paid);
            document.getElementById('remaining_amount_display').textContent = remaining.toFixed(2);

            // Validate paid amount doesn't exceed total
            const paidAmountInput = document.getElementById('paid_amount');
            if (paid > total) {
                paidAmountInput.value = total;
                paidAmountInput.setCustomValidity('Paid amount cannot exceed total amount');
            } else {
                paidAmountInput.setCustomValidity('');
            }
        }

        // Event listeners
        document.getElementById('quantity_meters').addEventListener('input', function() {
            calculateTotal();
            updatePaymentFields();
        });
        document.getElementById('price_per_meter').addEventListener('input', function() {
            calculateTotal();
            updatePaymentFields();
        });
        document.getElementById('payment_status').addEventListener('change', updatePaymentFields);
        document.getElementById('paid_amount').addEventListener('input', updateRemainingAmount);

        // Calculate total and set payment fields on page load
        calculateTotal();
        updatePaymentFields();
    </script>
@endsection
