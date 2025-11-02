@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="py-3 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold mb-0">Purchase & Stock-In Ledger</h4>
        </div>
        <a href="{{ route('purchases.create') }}" class="btn btn-primary btn-sm">Add Stock Purchase</a>
    </div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Supplier</th>
                            <th>Quantity (Meters)</th>
                            <th>Price/Meter</th>
                            <th>Reference #</th>
                            <th>Notes</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchases as $purchase)
                            <tr>
                                <td>{{ $purchase->created_at->format('Y-m-d H:i') }}</td>
                                <td>{{ $purchase->product->title ?? '-' }}</td>
                                <td>{{ $purchase->supplier->name ?? '-' }}</td>
                                <td>{{ number_format($purchase->quantity_meters,2) }}</td>
                                <td>{{ number_format($purchase->price_per_meter,2) }}</td>
                                <td>{{ $purchase->reference_number }}</td>
                                <td>{{ $purchase->notes }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
