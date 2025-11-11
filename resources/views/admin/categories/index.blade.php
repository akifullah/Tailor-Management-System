@extends('admin.layouts.app')


@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Categories</h4>
            </div>

            <button data-bs-toggle="modal" data-bs-target='#createModal' class="btn btn-primary btn-sm"
                onclick="handleCreate()">Add Category</button>

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
                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $category)
                                    <tr>
                                        <td>
                                            <p class="d-inline-block align-middle mb-0">
                                                <span>{{ $category->name }}</span>
                                            </p>
                                        </td>
                                        <td style="width: 150px">
                                            <button onclick="handleEdit({{ $category }})" class="btn btn-sm bg-primary-subtle me-1"
                                                data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                            </button>
                                            <button onclick="handleDelete({{ $category->id }})" class="btn btn-sm bg-danger-subtle"
                                                data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                                <i class="mdi mdi-delete fs-14 text-danger"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="createModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Add Brand</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="createForm" autocomplete="off">
                            <input type="hidden" name="id" id="id" autocomplete="off" value="">
                            <div class="row g-3">
                                <div class="col-xxl-12">
                                    <div>
                                        <label for="name" class="form-label">Category Name</label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Enter Category Name">
                                    </div>
                                </div><!--end col-->

                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">Submit</button>
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

        function handleEdit(data) {
            $('#createModal').modal('show');

            $("#createModalLabel").text("Edit Category");
            $("#submitBtn").text("Update");


            const {
                id,
                name,
            } = data;
            setValById("id", id)
            setValById("name", name)
        }


        function handleDelete(id) {
            if (confirm("Are you sure! you want to delete?")) {
                $.ajax({
                    url: "{{ route('categories.destroy', ':id') }}".replace(':id', id),
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
        function handleCreate() {
            setValById("id", "")
            setValById("name", "")
            $("#createModalLabel").text("Add Category");
            $("#submitBtn").text("Submit");
        }


        $(document).ready(function () {
            $("#createForm").on('submit', function (e) {
                e.preventDefault();
                let $form = $("#createForm");
                var $btn = $form.find("button[type=submit]");
                $btn.prop("disabled", true);
                // Serialize the form as an array and log it
                var formArray = $form.serializeArray();

                // Remove previous errors
                $form.find('.text-danger').remove();

                $.ajax({
                    url: "{{ route('categories.store') }}",
                    type: "POST",
                    data: $form.serialize(),
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
                            // showError(response.message || "Login failed.");
                            $btn.prop("disabled", false);
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