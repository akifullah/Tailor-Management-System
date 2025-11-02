@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="py-3">
        <h4 class="fs-18 fw-semibold mb-0">Customer Ledger</h4>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Filter</h5>
        </div>
        <div class="card-body">
            <form method="GET" class="row">
                <div class="col-md-4">
                    <label>Customer</label>
                    <select name="customer_id" class="form-control">
                        <option value="">All Customers</option>
                        @foreach($allCustomers as $customer)
                        <option value="{{ $customer->id }}" {{ request('customer_id') == $customer->id ? 'selected' : '' }}>{{ $customer->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label>&nbsp;</label><br>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('reports.customers') }}" class="btn btn-secondary">Reset</a>
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
                                    <th>Customer Name</th>
                                    <th>Phone</th>
                                    <th>Total Orders</th>
                                    <th>Total Spent</th>
                                    <th>Last Order Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $customer['name'] }}</td>
                                    <td>{{ $customer['phone'] ?? 'N/A' }}</td>
                                    <td>{{ $customer['total_orders'] }}</td>
                                    <td>{{ number_format($customer['total_spent'], 2) }}</td>
                                    <td>{{ $customer['last_order_date'] ?? 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('reports.customers.ledger', $customer['id']) }}" class="btn btn-sm btn-primary">View Details</a>
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

