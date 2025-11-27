@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Workers Ledger Summary</h4>
            </div>
        </div>

        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Worker</th>
                            <th>Email</th>
                            <th>Total Paid To Worker</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($workers as $index => $worker)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $worker->name }}</td>
                                <td>{{ $worker->email }}</td>
                                <td>Rs {{ number_format($worker->ledger_summary['paid'] ?? 0, 2) }}</td>
                                <td>
                                    <a href="{{ route('admin.workers.ledger.show', $worker->id) }}" class="btn btn-sm btn-primary">View Ledger</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">No workers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
