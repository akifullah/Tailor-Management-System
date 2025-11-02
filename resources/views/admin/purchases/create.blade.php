@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="py-3">
        <h4 class="fs-18 fw-semibold mb-0">Add Stock Purchase</h4>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('purchases.store') }}" method="POST" id="purchaseForm">
        @csrf
        <div class="row mb-3">
            <div class="col-md-3">
                <label>Supplier *</label>
                <select name="supplier_id" class="form-control" required>
                    <option value="">Select Supplier</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label>Product *</label>
                <select name="product_id" class="form-control" required>
                    <option value="">Select Product</option>
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label>Quantity (Meters) *</label>
                <input type="number" name="quantity_meters" class="form-control" min="0.01" step="0.01" required />
            </div>
            <div class="col-md-2">
                <label>Price per Meter *</label>
                <input type="number" name="price_per_meter" class="form-control" min="0" step="0.01" required />
            </div>
            <div class="col-md-2">
                <label>Reference #</label>
                <input type="text" name="reference_number" class="form-control" maxlength="191" />
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-8">
                <label>Notes</label>
                <textarea name="notes" class="form-control" maxlength="500"></textarea>
            </div>
            <div class="col-md-4 d-flex align-items-end">
                <button type="submit" class="btn btn-success">Add Stock</button>
                <a href="{{ route('purchases.index') }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </div>
    </form>
</div>
@endsection
