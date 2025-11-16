@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="py-3">
        <h4 class="fs-18 fw-semibold mb-0">Inventory Tracking History</h4>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Filter</h5>
        </div>
        <div class="card-body">
            <form method="GET" class="row">
                <div class="col-md-3">
                    <label>Product</label>
                    <select name="product_id" class="form-control">
                        <option value="">All Products</option>
                        @foreach($products as $product)
                        <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>{{ $product->title }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Type</label>
                    <select name="type" class="form-control">
                        <option value="">All Types</option>
                        <option value="purchase" {{ request('type') == 'purchase' ? 'selected' : '' }}>Purchase</option>
                        <option value="sale" {{ request('type') == 'sale' ? 'selected' : '' }}>Sale</option>
                        <option value="adjustment" {{ request('type') == 'adjustment' ? 'selected' : '' }}>Adjustment</option>
                        <option value="return" {{ request('type') == 'return' ? 'selected' : '' }}>Return</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label>Date From</label>
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-2">
                    <label>Date To</label>
                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-2">
                    <label>&nbsp;</label><br>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('reports.inventory-history') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Product</th>
                                    <th>Type</th>
                                    <th>Quantity (Meters)</th>
                                    <th>Balance</th>
                                    <th>Reference</th>
                                    <th>Notes</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($transactions as $txn)
                                <tr>
                                    <td>{{ $txn->created_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ $txn?->product?->title }}</td>
                                    <td>
                                        @if($txn->type == 'purchase')
                                            <span class="badge bg-success">Purchase</span>
                                        @elseif($txn->type == 'sale')
                                            <span class="badge bg-primary">Sale</span>
                                        @elseif($txn->type == 'return')
                                            <span class="badge bg-danger">Return</span>
                                        @else
                                            <span class="badge bg-warning">Adjustment</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($txn->quantity_meters, 2) }}</td>
                                    <td>{{ number_format($txn->balance_meters, 2) }}</td>
                                    <td>{{ $txn->reference_number ?? 'N/A' }}</td>
                                    <td>{{ $txn->notes }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

