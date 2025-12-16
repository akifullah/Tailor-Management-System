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
                                <div class="row g-2 align-items-end">
                                    <div class="col-sm-3 col-lg-2 ">
                                        <label for="search_type" class="form-label">Search By</label>
                                        <select name="type" id="search_type" class="form-select" required>
                                            <option value="">-- Select Type --</option>
                                            <option value="name" {{ request('type') == 'name' ? 'selected' : '' }}> Name
                                            </option>
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
                                    <div class="col-sm-3 col-lg-2">
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

                        <table id="datatable-buttons"
                            class="table data-table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>#ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Worker Type</th>
                                    <th>Roles & Permissions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($users->isNotEmpty())
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>
                                                <p class="d-inline-block align-middle mb-0 text-capitalize">
                                                    <span>{{ $user->name }}</span>
                                                </p>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td class="text-capitalize">{{ $user->phone }}</td>
                                            <td class="text-capitalize">{{ $user->worker_type }}</td>
                                            <td>
                                                <div class="mb-2">
                                                    <strong>Roles:</strong>
                                                    @if ($user->roles->count() > 0)
                                                        <div class="d-flex flex-wrap gap-1 mt-1">
                                                            @foreach ($user->roles as $role)
                                                                <span
                                                                    class="badge bg-info-subtle text-info">{{ $role->name }}</span>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <span class="text-muted">No roles</span>
                                                    @endif
                                                </div>
                                                <div>
                                                    <strong>Permissions:</strong>
                                                    @if ($user->permissions->count() > 0)
                                                        <div class="d-flex flex-wrap gap-1 mt-1">
                                                            @foreach ($user->permissions as $permission)
                                                                <span
                                                                    class="badge bg-success-subtle text-success">{{ $permission->name }}</span>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <span class="text-muted">No permissions</span>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <button onclick="handleEdit({{ $user }})"
                                                    class="btn btn-sm bg-primary-subtle me-1" data-bs-toggle="tooltip"
                                                    data-bs-original-title="Edit">
                                                    <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                                </button>
                                                @can('manage-roles-permissions')
                                                    <button
                                                        onclick="handleAssignRolesPermissions({{ $user->id }}, {{ json_encode(['roles' => $user->roles->pluck('id')->toArray(), 'permissions' => $user->permissions->pluck('id')->toArray()]) }})"
                                                        class="btn btn-sm bg-warning-subtle me-1" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Assign Roles & Permissions">
                                                        <i class="mdi mdi-shield-account fs-14 text-warning"></i>
                                                    </button>
                                                @endcan

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
                                        <td colspan="7" class="text-center text-muted">No user found.</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!-- Assign Roles & Permissions Modal -->
        <div class="modal fade" id="assignRolesPermissionsModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="assignRolesPermissionsModalLabel">Assign Roles & Permissions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="assignRolesPermissionsForm" autocomplete="off">
                            <input type="hidden" name="user_id" id="user_id" value="">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label class="form-label">Roles</label>
                                    <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                                        @if ($roles->count() > 0)
                                            @foreach ($roles as $role)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="roles[]"
                                                        value="{{ $role->id }}" id="role_{{ $role->id }}">
                                                    <label class="form-check-label" for="role_{{ $role->id }}">
                                                        {{ $role->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-muted mb-0">No roles available. <a
                                                    href="{{ route('roles.index') }}">Create roles first</a></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Permissions</label>
                                    <div class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                                        @if ($permissions->count() > 0)
                                            @foreach ($permissions as $permission)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="permissions[]"
                                                        value="{{ $permission->id }}"
                                                        id="user_permission_{{ $permission->id }}">
                                                    <label class="form-check-label"
                                                        for="user_permission_{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-muted mb-0">No permissions available. <a
                                                    href="{{ route('permissions.index') }}">Create permissions first</a>
                                            </p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Assign</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
                                    <label for="worker_type" class="form-label">Worker Type</label>
                                    <select class="form-select text-capitalize" id="worker_type_id" name="worker_type_id" required>
                                        <option disabled selected>Select Worker Type</option>
                                        @if ($worker_types->isNotEmpty())
                                            {
                                            @foreach ($worker_types as $type)
                                                <option value="{{ $type-> id }}">{{ $type->type }}</option>
                                            @endforeach
                                            }
                                        @endif
                                        {{-- <option value="cutter">Cutter</option>
                                        <option value="wiscot maker">Wiscot Maker</option>
                                        <option value="suit maker">Suit Maker</option>
                                        <option value="coat maker">Coat Maker</option> --}}
                                    </select>
                                </div>


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
                email,
                worker_type_id
            } = user;
            setValById("id", id)
            setValById("name", name)
            setValById("email", email)
            setValById("phone", phone)
            setValById("worker_type_id", worker_type_id)

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

        function handleAssignRolesPermissions(userId, userData) {
            $('#assignRolesPermissionsModal').modal('show');
            setValById("user_id", userId);

            // Uncheck all roles and permissions first
            $('input[name="roles[]"]').prop('checked', false);
            $('input[name="permissions[]"]').prop('checked', false);

            // Check the user's current roles
            if (userData && userData.roles) {
                userData.roles.forEach(function(roleId) {
                    $(`input[name="roles[]"][value="${roleId}"]`).prop('checked', true);
                });
            }

            // Check the user's current permissions
            if (userData && userData.permissions) {
                userData.permissions.forEach(function(permissionId) {
                    $(`input[name="permissions[]"][value="${permissionId}"]`).prop('checked', true);
                });
            }
        }
    </script>
    <script>
        function handleCreateUser() {
            setValById("id", "")
            setValById("name", "")
            setValById("email", "")
            setValById("phone", "")
            setValById("worker_type", "")
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

            // Handle assign roles and permissions form
            $("#assignRolesPermissionsForm").on('submit', function(e) {
                e.preventDefault();
                let $form = $("#assignRolesPermissionsForm");
                var $btn = $form.find("button[type=submit]");
                $btn.prop("disabled", true);

                const userId = $("#user_id").val();

                $.ajax({
                    url: "{{ route('users.assign-roles-permissions', ':id') }}".replace(':id',
                        userId),
                    type: "POST",
                    data: $form.serialize(),
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#assignRolesPermissionsModal').modal('hide');
                            location.reload();
                        } else {
                            alert(response.message || "Assignment failed.");
                            $btn.prop("disabled", false);
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;
                        alert(response?.message || "Error assigning roles and permissions.");
                        $btn.prop("disabled", false);
                    }
                });
            });

        });
    </script>
@endsection
