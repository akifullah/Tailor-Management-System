@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold mb-0">Products</h4>
            </div>
            <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm">Add Product</a>
        </div>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Supplier</th>
                                <th>Purchase Price</th>
                                <th>Sell Price</th>
                                <th>Available Meters</th>
                                <th>Barcode</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->title }}</td>
                                    <td>{{ $product->brand->name ?? '' }}</td>
                                    <td>{{ $product->category->name ?? '' }}</td>
                                    <td>{{ $product->supplier->name ?? '' }}</td>
                                    <td>{{ $product->purchase_price }}</td>
                                    <td>{{ $product->sell_price }}</td>
                                    <td>{{ $product->available_meters }}</td>
                                    <td>{{ $product->barcode }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', $product) }}"
                                            class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
