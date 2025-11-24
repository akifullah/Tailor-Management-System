@extends('admin.layouts.app')


@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Measurements</h4>
            </div>

            <a href="{{ route('measurements.create') }}" class="btn btn-primary btn-sm">
                Add Measurement
            </a>

        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <!-- Button Datatable -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">

                        <form action="{{ route('measurements.index') }}" method="GET"
                            class="row g-2 align-items-end mb-3">
                            <div class="col-md-2">
                                <label for="customer_id" class="form-label">Filter by Customer</label>
                                <select name="customer_id" id="customer_id" class="form-select select2">
                                    <option value="">All Customers</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->id }}"
                                            {{ request('customer_id') == $customer->id ? 'selected' : '' }}>
                                            {{ $customer->name }} | {{ $customer->phone }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label for="type" class="form-label">Filter by Type</label>
                                <select name="type" id="type" class="form-select">
                                    <option value="">All Types</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}"
                                            {{ request('type') == $type ? 'selected' : '' }}>
                                            {{ ucfirst($type) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('measurements.index') }}" class="btn btn-secondary">Reset</a>
                            </div>
                        </form>


                        <table id="datatable-buttons" class="table mt-4 table-striped table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Type</th>
                                    <th>Notes</th>
                                    <th>Created</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($measurements as $m)
                                    <tr>
                                        <td>{{ $m->id }}</td>
                                        <td>{{ $m->customer->name ?? '—' }}</td>
                                        <td>{{ ucfirst($m->type) }}</td>
                                        <td>{{ Str::limit($m->notes, 40) }}</td>
                                        <td>{{ $m->created_at->format('d M Y') }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('measurements.edit', $m) }}"
                                                class="btn btn-sm bg-primary-subtle" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit">
                                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                            </a>
                                            <form action="{{ route('measurements.destroy', $m) }}" method="POST"
                                                class="d-inline">
                                                @csrf @method('DELETE')
                                                <button onclick="return confirm('Delete this measurement?')"
                                                    class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Delete">
                                                    <i class="mdi mdi-delete fs-14 text-danger"></i>
                                                </button>

                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center text-muted py-4">No measurements found.</td>
                                    </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
@endsection
