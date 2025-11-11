@extends('admin.layouts.app')


@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <div class="py-3 d-flex align-items-center justify-content-between">
        <div class="flex-grow-1">
        </div>

        {{-- <button data-bs-toggle="modal" data-bs-target='#userModal' class="btn btn-primary btn-sm"
            onclick="handleCreateCustomer()">Add Customer</button> --}}

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
                    <h5>Customer Informations</h5>
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <p><strong>Old Id: </strong>#{{ $customer->customer_id }}</p>
                            <p><strong>Id: </strong> #{{ $customer->id }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Name: </strong> {{ $customer->name }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Email: </strong> {{ $customer->email }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Phone: </strong> {{ $customer->phone }}</p>
                        </div>
                        <div class="col-md-3">
                            <p><strong>Address: </strong> {{ $customer->address }}</p>
                        </div>
                    </div>


                    <div class="mt-5">
                        <h4 class="fs-18 fw-semibold m-0">Customers Measurements:</h4>
                        <hr>



                        <div class="row ps-2">
                            @foreach ($customer?->measurements as $measurement)
                                <div class="col-md-12">
                                    <div class="d-flex align-items-center justify-content-between my-2">
                                        <h5 class="text-capitalize fw-bold">Type:
                                            {{ str_replace('_', ' ', $measurement->type) }}
                                        </h5>
                                        <div>
                                            <a href="{{ route('measurements.edit', $measurement->id) }}"
                                                class="btn btn-sm bg-primary-subtle" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit">
                                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                            </a>
                                            <form action="{{ route('measurements.destroy', $measurement->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf @method('DELETE')
                                                <button onclick="return confirm('Delete this measurement?')"
                                                    class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Delete">
                                                    <i class="mdi mdi-delete fs-14 text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- Nested measurement data display --}}
                                @if(is_array($measurement->data) || is_object($measurement->data))
                                    @foreach ($measurement->data as $groupKey => $fields)
                                        <h4 class="mt-3 mb-1  text-capitalize" style="font-weight: 700;">
                                            {{ str_replace('_', ' ', $groupKey) }}
                                        </h4>
                                        <table class="table table-bordered table-striped mb-2">
                                            <thead>
                                                <tr>
                                                    <th>Measurement</th>
                                                    <th>Value</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @if(is_array($fields) || is_object($fields))
                                                @foreach ($fields as $key => $item)
                                                    <tr>
                                                        <td class="text-capitalize" style="width: 400px">
                                                            {{ Str::title(str_replace('_', ' ', $key)) }}
                                                        </td>
                                                        <td>{{ $item }}</td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="2">{{ $fields }}</td>
                                                </tr>
                                            @endif
                                            </tbody>
                                        </table>
                                    @endforeach
                                @else
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>Measurement</th>
                                                <th>Value</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="2">{{ $measurement->data }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif

                                <div class="col-12">
                                    <p class="text-capitalize"><strong>Notes: </strong>{{ $measurement?->notes }}</p>
                                </div>
                                <hr />
                            @endforeach
                        </div>

                        {{-- {{ dd($customer?->measurements) }} --}}


                    </div>



                </div>

            </div>



        </div>
    </div>

    <div class="modal fade" id="userModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Add Customer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="userForm" autocomplete="off">
                        <input type="hidden" name="id" id="id" autocomplete="off" value="">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Enter Full Name">
                                </div>
                            </div><!--end col-->
                            <div class="col-xxl-6">
                                <div>
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" id="phone"
                                        placeholder="Enter phone">
                                </div>
                            </div>
                            <div class="col-xxl-12">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="Enter your email">
                            </div><!--end col-->
                            <div class="col-xxl-12">
                                <label for="address" class="form-label">Address</label>
                                <input type="address" class="form-control" id="address" name="address" value=""
                                    placeholder="Enter Address" autocomplete="off">
                            </div><!--end col-->
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="submit_btn">Submit</button>
                                </div>
                            </div><!-- end col -->
                        </div><!-- end row -->
                    </form> <!-- end form -->
                </div> <!-- end modal body -->
            </div> <!-- end modal content -->
        </div>
    </div>


</div> <!-- container-fluid -->
@endsection



@section('js')
    <script>
        function setValById(id, val) {
            let $input = $(`#${id}`).val(val);
        }

        function handleEdit(user) {
            $('#userModal').modal('show');

            const {
                id,
                name,
                phone,
                email,
                address
            } = user;
            setValById("id", id)
            setValById("name", name)
            setValById("email", email)
            setValById("phone", phone)
            setValById("address", address)

            $("#userModalLabel").text("Edit Customer");
            $("#submit_btn").text("Update");


        }


        function handleDelete(id) {
            if (confirm("Are you sure! you want to delete?")) {
                $.ajax({
                    url: "{{ route('customers.destroy', ':id') }}".replace(':id', id),
                    type: 'DELETE',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function (response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.message || "Delete failed.");
                        }
                    },
                    error: function (xhr) {
                        alert("Error deleting user.");
                    }
                });
            }
        }
    </script>
    <script>
        function handleCreateCustomer() {
            setValById("id", "")
            setValById("name", "")
            setValById("email", "")
            setValById("phone", "")
            setValById("address", "")

            $('#userModal').modal('show');
            $("#userModalLabel").text("Add Customer");
            $("#submit_btn").text("Submit");


        }

        $(document).ready(function () {
            $("#userForm").on('submit', function (e) {
                e.preventDefault();
                let $form = $("#userForm");
                // Serialize the form as an array and log it
                var formArray = $form.serializeArray();

                // Remove previous errors
                $form.find('.text-danger').remove();

                $.ajax({
                    url: "{{ route('customers.store') }}",
                    type: "POST",
                    data: formArray,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function (response) {
                        if (response.success) {
                            // Redirect to dashboard or wherever
                            location.reload();
                        } else {
                            const errors = response?.errors;


                            Object.keys(errors).forEach(function (key) {
                                var input = $form.find('[id="' + key + '"]');
                                if (input.length) {
                                    input.after(
                                        '<div class="text-danger" style="font-size: 13px;">' +
                                        errors[key][0] + '</div>');
                                }
                            });
                        }
                    },

                    // showError(xhr.responseJSON && xhr.responseJSON.message ? xhr
                    //     .responseJSON.message : "Login failed.");
                });

                function showError(msg) {
                    // Show error somewhere at the top of the form
                    if ($form.find('.form-error').length === 0) {
                        $form.prepend('<div class="form-error text-danger mb-3" style="font-size: 14px;">' +
                            msg + '</div>');
                    } else {
                        $form.find('.form-error').html(msg);
                    }
                }

            });

        });
    </script>
@endsection