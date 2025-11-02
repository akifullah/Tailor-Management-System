@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="py-3">
        <h4 class="fs-18 fw-semibold mb-0">Supplier Ledger</h4>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Filter</h5>
        </div>
        <div class="card-body">
            <form method="GET" class="row">
                <div class="col-md-4">
                    <label>Supplier</label>
                    <select name="supplier_id" class="form-control">
                        <option value="">All Suppliers</option>
                        @foreach($allSuppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label>&nbsp;</label><br>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('reports.suppliers') }}" class="btn btn-secondary">Reset</a>
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
                                    <th>Supplier Name</th>
                                    <th>Phone</th>
                                    <th>Total Products</th>
                                    <th>Total Stock (Meters)</th>
                                    <th>Total Stock Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($suppliers as $supplier)
                                <tr>
                                    <td>{{ $supplier['name'] }}</td>
                                    <td>{{ $supplier['phone'] ?? 'N/A' }}</td>
                                    <td>{{ $supplier['total_products'] }}</td>
                                    <td>{{ number_format($supplier['total_stock_meters'], 2) }}</td>
                                    <td>{{ number_format($supplier['total_stock_value'], 2) }}</td>
                                    <td>
                                        <a href="{{ route('reports.suppliers.ledger', $supplier['id']) }}" class="btn btn-primary btn-sm">View Purchases</a>
                                    </td>
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

