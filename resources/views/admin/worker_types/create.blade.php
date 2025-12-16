@extends('admin.layouts.app')


@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Create Worker Types</h4>
            </div>

        </div>



        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="row">
            <div class="col-md-6">
                <div class="card">

                    <div class="card-body">
                    
                        <form action="{{ route('workers.types.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group mb-3">
                                        <label for="type">Type</label>
                                        <input type="text" class="form-control" id="type" name="type" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="worker_cost">Worker Cost</label>
                                        <input type="number" class="form-control" id="worker_cost" name="worker_cost" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="description">Description</label>
                                        <input type="text" class="form-control" id="description" name="description">
                                    </div>
                                    
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>  
                            </div>
                        </form>
                        </div>
                    </div>
                    </div>

                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
@endsection



@section('js')
    
@endsection
