@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h2>Add Product</h2>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label>Brand</label>
            <select name="brand_id" class="form-control" required>
                <option value="">Select Brand</option>
                @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label>Purchase Price</label>
            <input type="number" step="0.01" name="purchase_price" class="form-control" value="{{ old('purchase_price') }}" required>
        </div>
        <div class="mb-3">
            <label>Sell Price</label>
            <input type="number" step="0.01" name="sell_price" class="form-control" value="{{ old('sell_price') }}" required>
        </div>
        <div class="mb-3">
            <label>Available Meters</label>
            <input type="number" step="0.01" name="available_meters" class="form-control" value="{{ old('available_meters') }}" required>
        </div>
        <div class="mb-3">
            <label>Barcode</label>
            <input type="text" name="barcode" class="form-control" value="{{ old('barcode') }}">
        </div>
        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
