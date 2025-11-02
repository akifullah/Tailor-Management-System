@extends('admin.layouts.app')
@section('content')
<div class="container-fluid">
    <div class="py-3">
        <h4 class="fs-18 fw-semibold mb-0">Supplier Purchases Ledger: {{ $supplier->name }}</h4>
        <span class="text-muted d-block mb-2">Phone: {{ $supplier->phone }}</span>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product</th>
                            <th>Quantity (Meters)</th>
                            <th>Price/Meter</th>
                            <th>Reference #</th>
                            <th>Notes</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($purchases as $p)
                            <tr>
                                <td>{{ $p->created_at->format('Y-m-d H:i') }}</td>
                                <td>{{ $p->product->title ?? '-' }}</td>
                                <td>{{ number_format($p->quantity_meters,2) }}</td>
                                <td>{{ number_format($p->price_per_meter,2) }}</td>
                                <td>{{ $p->reference_number }}</td>
                                <td>{{ $p->notes }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('reports.suppliers') }}" class="btn btn-secondary">Back to Supplier Ledger</a>
</div>
@endsection
