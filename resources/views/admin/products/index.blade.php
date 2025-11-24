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
                <div class="mb-3">
                    <form id="productSearchForm" method="GET" action="">
                        <div class="row g-2  align-items-end">
                            <div class="col-sm-3 col-lg-2">
                                <label for="search_type" class="form-label">Search Type</label>
                                <select name="type" id="search_type" class="form-select" required>
                                    <option value="">-- Select Type --</option>
                                    <option value="title" {{ request('type') == 'title' ? 'selected' : '' }}>Product Title
                                    </option>
                                    <option value="id" {{ request('type') == 'id' ? 'selected' : '' }}>Product ID
                                    </option>
                                    {{-- <option value="barcode" {{ request('type') == 'barcode' ? 'selected' : '' }}>Barcode</option> --}}
                                </select>
                            </div>
                            <div class="col-sm-3 col-lg-2">
                                <label for="search_value" class="form-label">Input Value</label>
                                <input type="text" required name="value" id="search_value" class="form-control"
                                    value="{{ request('value') }}" placeholder="Enter value">
                            </div>
                            <div class="col-md-1 align-self-end">
                                <div class="d-flex gap-1">
                                    <button type="submit" class="btn px-2 btn-primary">Search</button>
                                    <a href="{{ route(Route::currentRouteName()) }}"
                                        class="btn px-2 btn-secondary">Reset</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered data-table">
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
                            @if ($products->isNotEmpty())
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
                            @else
                                <tr>
                                    <td colspan="10" class="text-center">No products found.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
