@extends('admin.layouts.app')


@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Users</h4>
            </div>

            <button data-bs-toggle="modal" data-bs-target='#userModal' class="btn btn-primary btn-sm"
                onclick="handleCreateUser()">Add User</button>

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

                        <div class="mb-3">
                            <form id="searchForm" method="GET" action="">
                                <div class="row g-2 justify-content-end align-items-end">
                                    <div class="col-md-2">
                                        <label for="search_type" class="form-label">Search By</label>
                                        <select name="type" id="search_type" class="form-select" required>
                                            <option value="">-- Select Type --</option>
                                            <option value="name" {{ request('type') == 'name' ? 'selected' : '' }}> Name</option>
                                            {{-- <option value="id"
                                                {{ request('type') == 'id' ? 'selected' : '' }}>User Old ID
                                            </option> --}}
                                            <option value="id" {{ request('type') == 'id' ? 'selected' : '' }}>
                                                ID</option>
                                            <option value="phone" {{ request('type') == 'phone' ? 'selected' : '' }}>
                                                Phone</option>
                                            <option value="email" {{ request('type') == 'email' ? 'selected' : '' }}>
                                                Email</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <label for="search_value" class="form-label">Input Value</label>
                                        <input type="text" required name="value" id="search_value" class="form-control"
                                            value="{{ request('value') }}" placeholder="Enter value">
                                    </div>
                                    <div class="col-md-1 align-self-end">
                                        <div class="d-flex gap-1">
                                            <button type="submit" class="btn px-2 btn-primary">Search</button>
                                            <a href="{{ route(Route::currentRouteName()) }}"
                                                class="btn px-2 btn-secondary">Reset</a>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>

                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($users->isNotEmpty())
                                @foreach ($users as $user)
                                <tr>
                                        <td>{{ $user->id }}</td>
                                        <td>
                                            <p class="d-inline-block align-middle mb-0">
                                                <span>{{ $user->name }}</span>
                                            </p>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                        <td>
                                            <button onclick="handleEdit({{ $user }})"
                                                class="btn btn-sm bg-primary-subtle me-1" data-bs-toggle="tooltip"
                                                data-bs-original-title="Edit">
                                                <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                            </button>
                                            <button onclick="handleDelete({{ $user->id }})"
                                                class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip"
                                                data-bs-original-title="Delete">
                                                <i class="mdi mdi-delete fs-14 text-danger"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach

                                @else
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No user found.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="userModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="userModalLabel">Add User</h5>
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
                                <div class="col-xxl-6">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="Enter your email">
                                </div><!--end col-->
                                <div class="col-xxl-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        value="" placeholder="Enter password" autocomplete="off">
                                </div><!--end col-->
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
                email
            } = user;
            setValById("id", id)
            setValById("name", name)
            setValById("email", email)
            setValById("phone", phone)

            $("#password").removeAttr("required");
        }


        function handleDelete(id) {
            if (confirm("Are you sure! you want to delete?")) {
                $.ajax({
                    url: "{{ route('users.destroy', ':id') }}".replace(':id', id),
                    type: 'DELETE',
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            alert(response.message || "Delete failed.");
                        }
                    },
                    error: function(xhr) {
                        alert("Error deleting user.");
                    }
                });
            }
        }
    </script>
    <script>
        function handleCreateUser() {
            setValById("id", "")
            setValById("name", "name")
            setValById("email", "email")
            setValById("phone", "phone")
            setValById("password", "")
        }

        $(document).ready(function() {
            $("#userForm").on('submit', function(e) {
                e.preventDefault();
                let $form = $("#userForm");
                var $btn = $form.find("button[type=submit]");
                $btn.prop("disabled", true);
                // Serialize the form as an array and log it
                var formArray = $form.serializeArray();

                // Remove previous errors
                $form.find('.text-danger').remove();

                $.ajax({
                    url: "{{ route('users.store') }}",
                    type: "POST",
                    data: $form.serialize(),
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        if (response.success) {
                            // Redirect to dashboard or wherever
                            location.reload();
                        } else {
                            const errors = response?.errors;


                            Object.keys(errors).forEach(function(key) {
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
