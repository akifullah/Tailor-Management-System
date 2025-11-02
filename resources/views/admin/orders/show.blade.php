@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="py-3">
        <h4 class="fs-18 fw-semibold mb-0">Order Details</h4>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Order Number:</strong> {{ $order->order_number }}
                        </div>
                        <div class="col-md-6">
                            <strong>Date:</strong> {{ $order->order_date }}
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <strong>Customer:</strong> {{ $order->customer->name }}
                        </div>
                        <div class="col-md-6">
                            <strong>Phone:</strong> {{ $order->customer->phone ?? 'N/A' }}
                        </div>
                    </div>

                    <hr>

                    <h5>Order Items</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Quantity (Meters)</th>
                                    <th>Price</th>
                                    <th>Source</th>
                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product ? $item->product->title : 'Custom Item' }}</td>
                                    <td>{{ $item->quantity_meters }}</td>
                                    <td>{{ number_format($item->sell_price, 2) }}</td>
                                    <td>
                                        @if($item->is_from_inventory)
                                            <span class="badge bg-success">Inventory</span>
                                        @else
                                            <span class="badge bg-info">Customer's Fabric</span>
                                        @endif
                                    </td>
                                    <td>{{ number_format($item->total_price, 2) }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td colspan="4" class="text-end"><strong>Grand Total:</strong></td>
                                    <td><strong>{{ number_format($order->total_amount, 2) }}</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <strong>Payment Method:</strong> 
                            <span class="badge bg-{{ $order->payment_method == 'online' ? 'info' : 'success' }}">
                                {{ ucfirst($order->payment_method) }}
                            </span>
                        </div>
                        <div class="col-md-6">
                            <strong>Payment Status:</strong> 
                            <span class="badge bg-{{ $order->payment_status == 'full' ? 'success' : 'warning' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </div>
                    </div>

                    @if($order->payment_status == 'partial')
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <strong>Paid Amount:</strong> {{ number_format($order->partial_amount, 2) }}
                        </div>
                        <div class="col-md-6">
                            <strong>Remaining:</strong> {{ number_format($order->remaining_amount, 2) }}
                        </div>
                    </div>
                    @endif

                    @if($order->notes)
                    <div class="mt-3">
                        <strong>Notes:</strong> {{ $order->notes }}
                    </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Back to Orders</a>
                        <button onclick="window.print()" class="btn btn-primary">Print</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

