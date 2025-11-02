@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="py-3">
        <h4 class="fs-18 fw-semibold mb-0">Sales Report</h4>
    </div>

    <div class="card">
        <div class="card-header">
            <h5>Filter</h5>
        </div>
        <div class="card-body">
            <form method="GET" class="row">
                <div class="col-md-4">
                    <label>Date From</label>
                    <input type="date" name="date_from" class="form-control" value="{{ request('date_from') }}">
                </div>
                <div class="col-md-4">
                    <label>Date To</label>
                    <input type="date" name="date_to" class="form-control" value="{{ request('date_to') }}">
                </div>
                <div class="col-md-4">
                    <label>&nbsp;</label><br>
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('reports.sales') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5>Sales Summary</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <p><strong>Total Orders:</strong> {{ $summary['total_sales'] }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Total Revenue:</strong> {{ number_format($summary['total_revenue'], 2) }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Cash Payments:</strong> {{ number_format($summary['cash_payments'], 2) }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Online Payments:</strong> {{ number_format($summary['online_payments'], 2) }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Full Payments:</strong> {{ number_format($summary['full_payments'], 2) }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Partial Payments:</strong> {{ number_format($summary['partial_payments'], 2) }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Pending Amount:</strong> {{ number_format($summary['pending_amount'], 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Orders List</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Payment Method</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{ $order->order_number }}</td>
                                    <td>{{ $order->order_date }}</td>
                                    <td>{{ $order->customer->name }}</td>
                                    <td>{{ number_format($order->total_amount, 2) }}</td>
                                    <td><span class="badge bg-{{ $order->payment_method == 'online' ? 'info' : 'success' }}">{{ ucfirst($order->payment_method) }}</span></td>
                                    <td><span class="badge bg-{{ $order->payment_status == 'full' ? 'success' : 'warning' }}">{{ ucfirst($order->payment_status) }}</span></td>
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

