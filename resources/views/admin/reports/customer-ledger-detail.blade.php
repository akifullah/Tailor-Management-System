@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="py-3">
        <h4 class="fs-18 fw-semibold mb-0">Customer Ledger: {{ $customer->name }}</h4>
        <div class="text-muted mb-2">Phone: {{ $customer->phone }}, Address: {{ $customer->address }}</div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>Orders & Payments</h5>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date</th>
                            <th>Amount</th>
                            <th>Paid</th>
                            <th>Pending</th>
                            <th>Status</th>
                            <th>Items</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_number }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ number_format($order->total_amount,2) }}</td>
                            <td>{{ $order->payment_status ==='partial' ? number_format($order->partial_amount,2) : number_format($order->total_amount,2) }}</td>
                            <td>{{ $order->payment_status ==='partial' ? number_format($order->remaining_amount,2) : '0.00' }}</td>
                            <td>{{ ucfirst($order->payment_status) }}</td>
                            <td>
                              <ul class="mb-0">
                                @foreach($order->items as $item)
                                <li>{{ $item->product->title }}: {{ $item->quantity_meters }}m × {{ number_format($item->sell_price,2) }} = {{ number_format($item->total_price,2) }}</li>
                                @endforeach
                              </ul>
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
    <a href="{{ route('reports.customers') }}" class="btn btn-secondary">Back to Ledger</a>
</div>
@endsection
