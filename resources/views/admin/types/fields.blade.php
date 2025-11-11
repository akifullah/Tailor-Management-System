@extends('admin.layouts.app')


@section('content')
    <!-- Start Content-->
    <div class="container-fluid">

        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Fields</h4>
            </div>

            <button data-bs-toggle="modal" data-bs-target='#typeModal' class="btn btn-primary btn-sm"
                onclick="handleCreateType()">Add Type</button>
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
                        <form id="fieldForm">
                            <div class="row">
                                <div class="col-md-6 col-lg-4 mb-3 text-capitalize">
                                    <label for="type">Select Type</label>
                                    <select name="type" id="type" class="form-select text-capitalize">
                                        <option value="" selected disabled>Select Type</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->id }}">{{ str_replace("_", " ", $type->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div id="field-container">
                                <div class="row">
                                    <div class="mb-3 col-md-3">
                                        <label for="label">Label</label>
                                        <input type="text" name="label" class="form-control" required>
                                    </div>

                                    <div class="mb-3 col-md-3">
                                        <label for="name">Name (e.g. pant_waist)</label>
                                        <input type="text" name="name" class="form-control" required>
                                    </div>

                                    <div class="mb-3 col-md-3">
                                        <label for="input_type">Input Type</label>
                                        <select name="input_type" class="form-control" required>
                                            <option value="input">Input</option>
                                            <option value="select">Select</option>
                                        </select>
                                    </div>

                                    <div class="mb-3 col-md-3">
                                        <label for="options">Options (comma separated)</label>
                                        <input type="text" name="options" class="form-control"
                                            placeholder="e.g. Slim, Regular, Loose">
                                    </div>
                                </div>

                            </div>

                        </form>


                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Is Combined</th>
                                    <th>Combine With</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($types as $type)
                                <tr>
                                    <td>{{ $type->name }}</td>
                                    <td>{{ $type->is_combined == '1' ? 'Yes' : 'No' }}</td>
                                    <td class="text-capitalize">
                                        @php
                                        $combineArr = json_decode($type->combine, true);
                                        if (!is_array($combineArr)) {
                                        $combineArr = $type->combine ? array_map('trim', explode(',', $type->combine)) : [];
                                        }
                                        @endphp
                                        {{ implode(', ', $combineArr) }}
                                    </td>
                                    <td>
                                        <button onclick="handleEdit({{ $type }})" class="btn btn-sm bg-primary-subtle me-1"
                                            data-bs-toggle="tooltip" data-bs-original-title="Edit">
                                            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i>
                                        </button>
                                        <button onclick="handleDelete({{ $type->id }})" class="btn btn-sm bg-danger-subtle"
                                            data-bs-toggle="tooltip" data-bs-original-title="Delete">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </button>
                                    </td>

                                </tr>
                                @endforeach --}}

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <div class="modal fade" id="typeModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTitle">Add Type</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="typeForm" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="id" id="id" class="form-control">
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Name Prefix</label>
                                <input type="text" name="name_prefix" id="name_prefix" class="form-control" required>
                            </div>

                            <div class="mb-3 form-check">
                                <input type="checkbox" name="is_combined" value="1" class="form-check-input"
                                    id="is_combined">
                                <label for="is_combined" class="form-check-label">Is Combined?</label>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Combine (comma separated)</label>
                                <input type="text" name="combine" id="combine" class="form-control"
                                    placeholder="e.g. shirt, pant">
                            </div>

                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" id="submit_btn">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div> <!-- end modal body -->
                </div> <!-- end modal content -->
            </div>
        </div>


    </div> <!-- container-fluid -->
@endsection



@section('js')
    <script>

        $("#type").on("change", function () {
            let typeId = $(this).val();
            $.ajax({
                url: "{{ route('field.byType', ':id') }}".replace(':id', typeId),
                type: 'GET',
                success: function (response) {
                    let fieldContainer = $("#field-container");
                    fieldContainer.empty();


                    let fieldHtml = '';
                    response.data.forEach(function (field) {

                        fieldHtml += `
                         <div class="row">
                                        <div class="mb-3 col-md-3">
                                            <label for="label">${field.label}</label>
                                            <input type="text" name="[label]" value="${field.label}" class="form-control" required>
                                        </div>

                                        <div class="mb-3 col-md-3">
                                            <label for="name">Name (e.g. pant_waist)</label>
                                            <input type="text" name="[name]" value="${field.name}" class="form-control" required>
                                        </div>

                                        <div class="mb-3 col-md-3">
                                            <label for="input_type">Input Type</label>
                                            <select name="[input_type]" class="form-control" required>
                                                <option ${field.input_type == "input" ? "selected" : ""} value="input">Input</option>
                                                <option ${field.input_type == "select" ? "selected" : ""} value="select">Select</option>
                                            </select>
                                        </div>

                                        <div class="mb-3 col-md-3">
                                            <label for="options">Options (comma separated)</label>
                                            <input type="text" name="[options]" class="form-control"
                                            value="${field.options ? field.options?.join(',') : ""}"
                                                placeholder="e.g. Slim, Regular, Loose">
                                        </div>
                                    </div>`
                    });
                    // jQuery append
                    $(fieldContainer).append(fieldHtml);

                },
                error: function (xhr) {
                    alert("Error fetching fields.");
                }
            });
        });


        function handleCreateType() {
            setValById("id", "")
            setValById("name", "")
            setValById("email", "")
            setValById("phone", "")
            setValById("address", "")

            $('#typeModal').modal('show');
            $("#modalTitle").text("Add Type");
            $("#submit_btn").text("Submit");


        }


        function handleDelete(id) {
            if (confirm("Are you sure! you want to delete?")) {
                $.ajax({
                    url: "{{ route('types.destroy', ':id') }}".replace(':id', id),
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

@endsection