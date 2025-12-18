@extends('admin.layouts.app')


@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Worker Types</h4>
            </div>

            <a href="{{ route('workers.types.create') }}" class="btn btn-primary btn-sm"
                >Add Worker Type</a>

        </div>



        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body table-responsive">
                      
                        <table id="datatable-buttons"
                            class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Type</th>
                                    <th>Worker Cost</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($workerTypes->isNotEmpty())
                                    @foreach ($workerTypes as $workerType)
                                        <tr>
                                            <td>{{ $workerType->id }}</td>
                                            <td>
                                                <p class="d-inline-block align-middle mb-0 text-capitalize">
                                                    <span>{{ $workerType->type }}</span>
                                                </p>
                                            </td>
                                            <td class="text-capitalize"> Rs. {{ $workerType->worker_cost }}</td>
                                            <td>{{ $workerType->description }}</td>
                                            <td>
                                                <a href="{{ route('workers.types.edit', $workerType->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                                {{-- <a href="javascript:void(0)" onclick="handleDelete({{ $workerType->id }})" class="btn btn-sm btn-danger">Delete</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="7" class="text-center text-muted">No worker type found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
@endsection



@section('js')
    <script>
        function handleDelete(id) {
            if (confirm("Are you sure! you want to delete?")) {
                $.ajax({
                    url: "{{ route('workers.types.destroy', ':id') }}".replace(':id', id),
                    type: 'post',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.message || "Delete failed.");
                        }
                    }                    
                });
            }
        }
    </script>
@endsection
