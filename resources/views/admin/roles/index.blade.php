@extends('admin.layouts.app')

@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Roles</h4>
            </div>

            <button data-bs-toggle="modal" data-bs-target='#roleModal' class="btn btn-primary btn-sm"
                onclick="handleCreateRole()">Add Role</button>
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
                                            <option value="name" {{ request('type') == 'name' ? 'selected' : '' }}>Name</option>
                                            <option value="id" {{ request('type') == 'id' ? 'selected' : '' }}>ID</option>
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
                                    <th>Permissions</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($roles->isNotEmpty())
                                @foreach ($roles as $role)
                                <tr>
                                    <td>{{ $role->id }}</td>
                                    <td>
                                        <p class="d-inline-block align-middle mb-0 text-capitalize">
                                            <span>{{ $role->name }}</span>
                                        </p>
                                    </td>
                                    <td>
                                        @if($role->permissions->count() > 0)
                                            <div class="d-flex flex-wrap gap-1">
                                                @foreach($role->permissions as $permission)
                                                    <span class="badge bg-primary-subtle text-primary">{{ $permission->name }}</span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-muted">No permissions</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button onclick="handleEdit({{ $role->id }})"
                                            class="btn btn-sm bg-primary-subtle me-1" data-bs-toggle="tooltip"
                                            data-bs-original-title="Edit">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </button>
                                        <button onclick="handleDelete({{ $role->id }})"
                                            class="btn btn-sm bg-danger-subtle" data-bs-toggle="tooltip"
                                            data-bs-original-title="Delete">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No roles found.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Role Modal -->
        <div class="modal fade" id="roleModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="roleModalLabel">Add Role</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="roleForm" autocomplete="off">
                            <input type="hidden" name="id" id="id" autocomplete="off" value="">
                            <div class="row g-3">
                                <div class="col-12">
                                    <div>
                                        <label for="name" class="form-label">Role Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" id="name"
                                            placeholder="Enter Role Name" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label class="form-label">Permissions</label>
                                    <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                                        @if($permissions->count() > 0)
                                            @foreach($permissions as $permission)
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="checkbox" name="permissions[]" 
                                                        value="{{ $permission->id }}" id="permission_{{ $permission->id }}">
                                                    <label class="form-check-label" for="permission_{{ $permission->id }}">
                                                        {{ $permission->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        @else
                                            <p class="text-muted mb-0">No permissions available. <a href="{{ route('permissions.index') }}">Create permissions first</a></p>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="hstack gap-2 justify-content-end">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
@endsection

@section('js')
    <script>
        const permissions = @json($permissions);

        function setValById(id, val) {
            $(`#${id}`).val(val);
        }

        function handleEdit(roleId) {
            $.ajax({
                url: "{{ route('roles.show', ':id') }}".replace(':id', roleId),
                type: 'GET',
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                success: function(response) {
                    $('#roleModal').modal('show');
                    setValById("id", response.id);
                    setValById("name", response.name);
                    
                    // Uncheck all permissions first
                    $('input[name="permissions[]"]').prop('checked', false);
                    
                    // Check the permissions that belong to this role
                    if (response.permissions && response.permissions.length > 0) {
                        response.permissions.forEach(function(permission) {
                            $(`#permission_${permission.id}`).prop('checked', true);
                        });
                    }
                },
                error: function(xhr) {
                    alert("Error loading role data.");
                }
            });
        }

        function handleDelete(id) {
            if (confirm("Are you sure! you want to delete this role?")) {
                $.ajax({
                    url: "{{ route('roles.destroy', ':id') }}".replace(':id', id),
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
                        const response = xhr.responseJSON;
                        alert(response?.message || "Error deleting role.");
                    }
                });
            }
        }

        function handleCreateRole() {
            setValById("id", "");
            setValById("name", "");
            $('input[name="permissions[]"]').prop('checked', false);
        }

        $(document).ready(function() {
            $("#roleForm").on('submit', function(e) {
                e.preventDefault();
                let $form = $("#roleForm");
                var $btn = $form.find("button[type=submit]");
                $btn.prop("disabled", true);

                // Remove previous errors
                $form.find('.text-danger').remove();

                $.ajax({
                    url: "{{ route('roles.store') }}",
                    type: "POST",
                    data: $form.serialize(),
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        if (response.success) {
                            location.reload();
                        } else {
                            const errors = response?.errors;
                            if (errors) {
                                Object.keys(errors).forEach(function(key) {
                                    var input = $form.find('[name="' + key + '"]');
                                    if (input.length) {
                                        input.after(
                                            '<div class="text-danger" style="font-size: 13px;">' +
                                            errors[key][0] + '</div>');
                                    }
                                });
                            }
                            $btn.prop("disabled", false);
                        }
                    },
                    error: function(xhr) {
                        const response = xhr.responseJSON;
                        if (response && response.errors) {
                            Object.keys(response.errors).forEach(function(key) {
                                var input = $form.find('[name="' + key + '"]');
                                if (input.length) {
                                    input.after(
                                        '<div class="text-danger" style="font-size: 13px;">' +
                                        response.errors[key][0] + '</div>');
                                }
                            });
                        }
                        $btn.prop("disabled", false);
                    }
                });
            });
        });
    </script>
@endsection

