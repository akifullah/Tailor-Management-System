@extends('admin.layouts.app')


@section('content')
    <style>
        .select2-container--default .select2-selection--single {
            background-color: #2b2b2b;
            border: 1px solid #444;
            color: #fff;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #fff;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #fff transparent transparent transparent;
        }

        .select2-dropdown {
            background-color: #2b2b2b;
            border-color: #444;
            color: #fff;
        }

        .select2-results__option--highlighted {
            background-color: #555 !important;
            color: #fff !important;
        }

        body.dark .select2-container--default .select2-selection--single {
            background-color: #1e1e1e;
            border-color: #333;
            color: #f1f1f1;
        }

        body.dark .select2-dropdown {
            background-color: #1e1e1e;
            color: #f1f1f1;
        }
    </style>

    <!-- Start Content-->
    <div class="container-fluid">

        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Add Measurements</h4>
            </div>

            {{-- <button data-bs-toggle="modal" data-bs-target='#userModal' class="btn btn-primary btn-sm"
                onclick="handleCreateCustomer()">Add Measurements</button> --}}

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
                <form action="{{ route('measurements.store') }}" method="POST">
                    @csrf
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Customer</label>
                                    <select name="customer_id" class="form-select" required>
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Type</label>
                                    {{-- <select id="type" name="type" class="form-select text-capitalize">
                                        <option value="">Select Type</option>
                                        @foreach ($types as $type)
                                            <option value="{{ $type->name }}">{{ str_replace('_', ' ', $type->name) }}</option>
                                        @endforeach
                                    </select> --}}
                                    <select id="type" name="type" class="form-select">
                                        <option value="">Select Type</option>
                                        <option value="pant">Pant</option>
                                        <option value="shirt">Shirt</option>
                                        {{-- <option value="shirt_pant">Shirt/Shirt</option> --}}
                                        <option value="kameez">Kameez</option>
                                        <option value="shalwar">Shalwar</option>
                                        {{-- <option value="kameez_shalwar">Kameez/Shalwar</option> --}}
                                        <option value="coat">Coat</option>
                                        <option value="waistcoat">Waistcoat</option>
                                    </select>
                                </div>
                            </div>


                            <div id="form-fields" class="mt-3 row g-3"></div>

                            <div class="col-12 mb-4">
                                <label for="">Notes</label>
                                <textarea name="notes" id="notes" placeholder="Enter Extra Notes" rows="5"
                                    class="form-control"></textarea>
                            </div>

                            <div class="text-end">
                                <button class="btn btn-primary">Save</button>
                            </div>

                        </div>
                        {{-- <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Customer</label>
                                    <select name="customer_id" class="form-select" required>
                                        <!-- populate from customers -->
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Type</label>
                                    <select name="type" class="form-select" required>
                                        <option value="pant">Pant</option>
                                        <option value="shirt">Shirt</option>
                                        <option value="kameez">Kameez</option>
                                        <option value="shalwar">Shalwar</option>
                                        <option value="coat">Coat</option>
                                        <option value="waistcoat">Waistcoat</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Fit</label>
                                    <select name="fit" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="Slim">Slim</option>
                                        <option value="Regular">Regular</option>
                                        <option value="Loose">Loose</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row mt-3">
                                @foreach (['length', 'chest', 'waist', 'hip', 'shoulder', 'sleeve', 'cuff', 'bottom'] as
                                $field)
                                <div class="col-md-3 mb-3">
                                    <label>{{ ucfirst($field) }}</label>
                                    <input type="number" step="0.01" name="{{ $field }}" class="form-control"
                                        placeholder="in inches">
                                </div>
                                @endforeach
                            </div>

                            <div class="row mt-3">
                                @foreach (['daman', 'patae', 'ban', 'stitching', 'asteen', 'btn_style', 'chok', 'style'] as
                                $field)
                                <div class="col-md-3 mb-3">
                                    <label>{{ ucfirst($field) }}</label>
                                    <input type="text" name="{{ $field }}" class="form-control">
                                </div>
                                @endforeach
                            </div>

                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <label>Seat</label>
                                    <input type="number" step="0.01" name="seat" class="form-control">
                                </div>
                                <div class="col-md-3">
                                    <label>Pocket Type</label>
                                    <select name="pocket_type" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="Cross">Cross</option>
                                        <option value="Straight">Straight</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Shalwar Type</label>
                                    <select name="shalwar_type" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="Kundo wala">Kundo wala</option>
                                        <option value="Bagair kundo wala">Bagair kundo wala</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label>Shalwar Asin</label>
                                    <input type="number" step="0.01" name="shalwar_asin" class="form-control">
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label>Shalwar Width</label>
                                    <input type="number" step="0.01" name="shalwar_width" class="form-control">
                                </div>
                            </div>




                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <label>Collar</label>
                                    <select name="collar" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="Spread">Spread</option>
                                        <option value="Button-down">Button-down</option>
                                        <option value="Mandarin">Mandarin</option>
                                        <option value="Kabali">Kabali</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Neck Depth</label>
                                    <input type="number" step="0.01" name="neck_depth" class="form-control">
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label>Half Back</label>
                                    <input type="number" step="0.01" name="half_back" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>Fit Type</label>
                                    <input type="text" name="fit_type" class="form-control" placeholder="e.g. coat fit">
                                </div>
                            </div>


                            <div class="row mt-3">
                                <div class="col-md-4">
                                    <label>Buttons</label>
                                    <input type="number" name="buttons" class="form-control">
                                </div>
                                <div class="col-md-4">
                                    <label>Pocket Style</label>
                                    <select name="pocket_style" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="Cross">Cross</option>
                                        <option value="Straight">Straight</option>
                                        <option value="Side">Side</option>
                                        <option value="Front">Front</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label>Pocket Count</label>
                                    <select name="pocket_count" class="form-select">
                                        <option value="">-- Select --</option>
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>
                            </div>



                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>


                        </div> --}}
                    </div>
                </form>
            </div>
        </div>

    </div> <!-- container-fluid -->
@endsection

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        const options = {
            pant: {
                fields: [{
                    label: "Waist",
                    name: 'pant_Waist',
                    input_type: 'input'
                },
                {
                    label: "Seat / Hip",
                    name: 'pant_seat_hip',
                    input_type: 'input'
                },
                {
                    label: "Bottom",
                    name: 'pant_Bottom',
                    input_type: 'input'
                },
                {
                    label: "Length",
                    name: 'pant_Length',
                    input_type: 'input'
                },
                {
                    label: "Fit",
                    name: 'pant_Fit',
                    input_type: 'select',
                    options: ['Slim', 'Regular', 'Loose']
                },
                {
                    label: "Pocket Style",
                    name: 'pant_pocket_style',
                    input_type: 'select',
                    options: ['Cross', 'Straight']
                }
                ]
            },

            shirt: {
                fields: [{
                    label: "Neck",
                    name: 'shirt_Neck',
                    input_type: 'input'
                },
                {
                    label: "Chest",
                    name: 'shirt_Chest',
                    input_type: 'input'
                },
                {
                    label: "Waist",
                    name: 'shirt_Waist',
                    input_type: 'input'
                },
                {
                    label: "Shoulder",
                    name: 'shirt_Shoulder',
                    input_type: 'input'
                },
                {
                    label: "Sleeve",
                    name: 'shirt_Sleeve',
                    input_type: 'input'
                },
                {
                    label: "Cuff",
                    name: 'shirt_Cuff',
                    input_type: 'input'
                },
                {
                    label: "Shirt Length",
                    name: 'shirt_length',
                    input_type: 'input'
                },
                {
                    label: "Fit",
                    name: 'shirt_Fit',
                    input_type: 'select',
                    options: ['Slim', 'Regular']
                },
                {
                    label: "Collar",
                    name: 'shirt_collar',
                    input_type: 'select',
                    options: ['Spread', 'Button-down', 'Mandarin']
                },
                {
                    label: "Cuffs",
                    name: 'shirt_Cuffs',
                    input_type: 'select',
                    options: ['Single', 'Double']
                },
                {
                    label: "Pocket",
                    name: 'shirt_Pocket',
                    input_type: 'select',
                    options: ['0', '1', '2']
                },
                {
                    label: "Daman",
                    name: 'shirt_Daman',
                    input_type: 'select',
                    options: ['Gool', 'Sada']
                }
                ]
            },

            kameez: {
                fields: [{
                    label: "Length",
                    name: 'kameez_Length',
                    input_type: 'input'
                },
                {
                    label: "Sleeve",
                    name: 'kameez_Sleeve',
                    input_type: 'input'
                },
                {
                    label: "Sleeve",
                    name: 'kameez_Sleeve',
                    input_type: 'input'
                },
                {
                    label: "Collar",
                    name: 'kameez_Collar',
                    input_type: 'select',
                    options: ['Collar', 'Short Collar', 'Nokdar Collar']
                },
                {
                    label: "Bann",
                    name: 'kameez_Bann',
                    input_type: 'select',
                    options: ['Full Ban Cut', 'Full Ban Gool', 'Half Ban Cut', 'Half Ban Gool', 'Kabali Ban',
                        'Design Ban'
                    ]
                },
                {
                    label: "Cuff",
                    name: 'kameez_Cuff',
                    input_type: 'select',
                    options: ['Sada', 'Gool', 'Sada Cut', 'Studd Kaag Gool', 'Studd Kaag Sada', 'Studd Double',
                        'Cuff 2 Kaag', 'Chk Patae Kaag', 'Bagair Chk Patae', 'Chk Patae 2 Kaag'
                    ]
                },
                {
                    label: "Stitching",
                    name: 'kameez_Stitching',
                    input_type: 'select',
                    options: ['Simple', 'Chamak', 'Double Chamak', 'Double Simple', 'Conquer Stitch']
                },
                {
                    label: "Pocket",
                    name: 'kameez_Pocket',
                    input_type: 'select',
                    options: ['Side 1 Pocket', 'Side 2 Pocket', 'Front 1 Pocket', 'Front 2 Pocket',
                        'Front 2 Pocket Tash'
                    ]
                },
                {
                    label: "Daman",
                    name: 'kameez_Daman',
                    input_type: 'select',
                    options: ['Sada', 'Gool']
                },
                {
                    label: "Asteen",
                    name: 'kameez_Asteen',
                    input_type: 'select',
                    options: ['No Palet', 'One Palet', 'Two Palet']
                },
                {
                    label: "Buttons",
                    name: 'kameez_Buttons',
                    input_type: 'select',
                    options: ['1', '2', '3', '4', '5']
                },
                {
                    label: "Button Style",
                    name: 'kameez_Button_Style',
                    input_type: 'select',
                    options: ['Simple', 'Design']
                }
                ]
            },

            shalwar: {
                fields: [{
                    label: "Length",
                    name: 'shalwar_Length',
                    input_type: 'input'
                },
                {
                    label: "Pancha",
                    name: 'shalwar_Pancha',
                    input_type: 'input'
                },
                {
                    label: "Shalwar Type",
                    name: 'shalwar_type',
                    input_type: 'select',
                    options: ['Kundo Wala', 'Bagair Kundo Wala']
                },
                {
                    label: "Asin Width",
                    name: 'shalwar_Asin_Width',
                    input_type: 'input'
                },
                {
                    label: "Shalwar Pockets",
                    name: 'shalwar_Shalwar_Pockets',
                    input_type: 'select',
                    options: ['One', 'Two']
                },
                {
                    label: "Paint Pocket",
                    name: 'shalwar_Paint_Pocket',
                    input_type: 'input'
                }
                ]
            },

            coat: {
                fields: [{
                    label: "Chest",
                    name: 'coat_Chest',
                    input_type: 'input'
                },
                {
                    label: "Waist",
                    name: 'coat_Waist',
                    input_type: 'input'
                },
                {
                    label: "Hip",
                    name: 'coat_Hip',
                    input_type: 'input'
                },
                {
                    label: "Shoulder",
                    name: 'coat_Shoulder',
                    input_type: 'input'
                },
                {
                    label: "Sleeve",
                    name: 'coat_Sleeve',
                    input_type: 'input'
                },
                {
                    label: "Half Back",
                    name: 'coat_Half_Back',
                    input_type: 'input'
                },
                {
                    label: "Chok",
                    name: 'coat_Chok',
                    input_type: 'select',
                    options: ['None', 'Single', 'Double']
                },
                {
                    label: "Fit",
                    name: 'coat_Fit',
                    input_type: 'select',
                    options: ['Slim', 'Regular']
                },
                {
                    label: "Buttons",
                    name: 'coat_Buttons',
                    input_type: 'select',
                    options: ['1', '2', '3']
                }
                ]
            },

            waistcoat: {
                fields: [{
                    label: "Chest",
                    name: 'waistcoat_Chest',
                    input_type: 'input'
                },
                {
                    label: "Waist",
                    name: 'waistcoat_Waist',
                    input_type: 'input'
                },
                {
                    label: "Shoulder",
                    name: 'waistcoat_Shoulder',
                    input_type: 'input'
                },
                {
                    label: "Length",
                    name: 'waistcoat_Length',
                    input_type: 'input'
                },
                {
                    label: "Neck Depth",
                    name: 'waistcoat_Neck_Depth',
                    input_type: 'input'
                },
                {
                    label: "Buttons",
                    name: 'waistcoat_Buttons',
                    input_type: 'select',
                    options: ['1', '2', '3', '4', '5']
                },
                {
                    label: "Style",
                    name: 'waistcoat_Style',
                    input_type: 'select',
                    options: ['Simple', 'Design']
                }
                ]
            },


            shirt_pant: {
                combine: ['shirt', 'pant']
            },

            kameez_shalwar: {
                combine: ["kameez", "shalwar"]
            },

        };
        const typeSelect = document.getElementById('type');

        $("#type").change(function (e) {
            let value = e.target.value;
            renderFields(value)

            // $.ajax({
            //     url: "{{ route('type.get') }}",
            //     method: "GET",
            //     success: function (response) {
            //         console.log(response);
            //         options = response;
            //         setTimeout(() => {
            //             renderFields(value)
            //         }, 200);
            //     },
            //     error: function (xhr) {
            //         console.error(xhr.responseText);
            //         alert("An error occurred.");
            //     }
            // });
        });

        const formContainer = document.getElementById('form-fields');

        function safeName(str) {
            return str.toString().trim().toLowerCase().replace(/[^a-z0-9]+/g, '_');
        }


        function renderFields(type) {
            console.log("Type ", type)
            console.log("options ", options)

            formContainer.innerHTML = '';
            if (!type || !options[type]) return;

            const selectedSets = options[type].combine || [type];
            selectedSets.forEach(setName => {
                const set = options[setName];
                console.log("options ", setName)
                console.log("selected ", set)

                if (!set) return;
                // Add heading for this section
                const heading = `
                                                                            <div class="col-12 mt-3">
                                                                                <h5 class="fw-bold">${setName.charAt(0).toUpperCase() + setName.slice(1)} Measurements</h5>
                                                                            </div>
                                                                        `;
                formContainer.insertAdjacentHTML('beforeend', heading);

                // Loop through each field in that set
                set.fields.forEach(field => {
                    let inputHTML = '';

                    // Choose input type
                    if (field.input_type === 'select') {
                        const optionsHTML = field.options.map(opt =>
                            `<option value="${opt}">${opt}</option>`).join('');
                        inputHTML =
                            `<select name="${safeName(field.name)}" class="form-select select">${optionsHTML}</select>`;
                    } else {
                        inputHTML =
                            `<input type="text" name="${safeName(field.name)}" class="form-control text-capitalize " placeholder="${field.label}" />`;
                    }

                    // Add label + input inside a wrapper
                    const fieldHTML = `
                                                                                <div class="col-md-3 mb-2">
                                                                                    <label class="form-label text-capitalize">${field.label}</label>
                                                                                    ${inputHTML}
                                                                                </div>
                                                                            `;
                    formContainer.insertAdjacentHTML('beforeend', fieldHTML);
                });
            });
        }

        // When dropdown changes
        typeSelect.addEventListener('change', e => renderFields(e.target.value));

        // Show fields if something is already selected
        if (typeSelect.value) renderFields(typeSelect.value);

        // function renderFields(type) {
        //     formContainer.innerHTML = '';
        //     if (!type || !options[type]) return;

        //     const selectedSets = options[type].combine || [type];
        //     console.log(selectedSets)
        //     selectedSets.forEach(key => {
        //         const set = options[key];
        //         if (!set) return;
        //         console.log(set);
        //         console.log(key);

        //         // Add heading for section
        //         const heading = document.createElement('h5');
        //         heading.classList.add('col-12', 'mt-3', 'fw-bold');
        //         heading.textContent = key.charAt(0).toUpperCase() + key.slice(1) + ' Measurements';
        //         formContainer.appendChild(heading);

        //         // Render all fields
        //         set.fields.forEach(field => {
        //             const wrapper = document.createElement('div');
        //             wrapper.classList.add('col-md-4', 'mb-2');

        //             const label = document.createElement('label');
        //             label.classList.add('form-label');
        //             label.setAttribute('for', safeName(field.name));
        //             label.textContent = field.name;

        //             let input;
        //             if (field.type === 'select') {
        //                 input = document.createElement('select');
        //                 input.classList.add('form-select');
        //                 input.id = input.name = safeName(field.name);
        //                 field.options.forEach(opt => {
        //                     const option = document.createElement('option');
        //                     option.value = opt;
        //                     option.textContent = opt;
        //                     input.appendChild(option);
        //                 });
        //             } else {
        //                 input = document.createElement('input');
        //                 input.type = 'text';
        //                 input.id = input.name = safeName(field.name);
        //                 input.placeholder = field.name;
        //                 input.classList.add('form-control');
        //             }

        //             wrapper.appendChild(label);
        //             wrapper.appendChild(input);
        //             formContainer.appendChild(wrapper);
        //         });
        //     });
        // }

        // typeSelect.addEventListener('change', e => renderFields(e.target.value));

        // if (typeSelect.value) renderFields(typeSelect.value);

        // $(document).ready(function() {
        //     $('.select').select2();
        // });
    </script>

    {{--
    <script>
        // Valid JS object (not PHP =>)
        const options = {
            pant: {
                fields: [

                    {
                        name: 'Waist',
                        input_type: 'input'
                    },
                    {
                        name: 'Seat / Hip',
                        input_type: 'input'
                    },
                    {
                        name: 'Bottom',
                        input_type: 'input'
                    },
                    {
                        name: 'Length',
                        input_type: 'input'
                    },
                    {
                        name: 'Fit',
                        input_type: 'select',
                        options: ['Slim', 'Regular', 'Loose']
                    },
                    {
                        name: 'Pocket Style',
                        input_type: 'select',
                        options: ['Cross', 'Straight']
                    }
                ]
            },

            shirt: {
                fields: [{
                    name: 'Neck',
                    input_type: 'input'
                },
                {
                    name: 'Chest',
                    input_type: 'input'
                },
                {
                    name: 'Waist',
                    input_type: 'input'
                },
                {
                    name: 'Shoulder',
                    input_type: 'input'
                },
                {
                    name: 'Sleeve',
                    input_type: 'input'
                },
                {
                    name: 'Cuff',
                    input_type: 'input'
                },
                {
                    name: 'Shirt Length',
                    input_type: 'input'
                },
                {
                    name: 'Fit',
                    input_type: 'select',
                    options: ['Slim', 'Regular']
                },
                {
                    name: 'Collar',
                    input_type: 'select',
                    options: ['Spread', 'Button-down', 'Mandarin']
                },
                {
                    name: 'Cuffs',
                    input_type: 'select',
                    options: ['Single', 'Double']
                },
                {
                    name: 'Pocket',
                    input_type: 'select',
                    options: ['0', '1', '2']
                },
                {
                    name: 'Daman',
                    input_type: 'select',
                    options: ['Gool', 'Sada']
                }
                ]
            },

            kameez: {
                fields: [{
                    name: 'Length',
                    input_type: 'input'
                },
                {
                    name: 'Sleeve',
                    input_type: 'input'
                },
                {
                    name: 'Shoulder',
                    input_type: 'input'
                },
                {
                    name: 'Collar',
                    input_type: 'select',
                    options: ['Collar', 'Short Collar', 'Nokdar Collar']
                },
                {
                    name: 'Bann',
                    input_type: 'select',
                    options: ['Full Ban Cut', 'Full Ban Gool', 'Half Ban Cut', 'Half Ban Gool', 'Kabali Ban',
                        'Design Ban'
                    ]
                },
                {
                    name: 'Cuff',
                    input_type: 'select',
                    options: ['Sada', 'Gool', 'Sada Cut', 'Studd Kaag Gool', 'Studd Kaag Sada', 'Studd Double',
                        'Cuff 2 Kaag', 'Chk Patae Kaag', 'Bagair Chk Patae', 'Chk Patae 2 Kaag'
                    ]
                },
                {
                    name: 'Stitching',
                    input_type: 'select',
                    options: ['Simple', 'Chamak', 'Double Chamak', 'Double Simple', 'Conquer Stitch']
                },
                {
                    name: 'Pocket',
                    input_type: 'select',
                    options: ['Side 1 Pocket', 'Side 2 Pocket', 'Front 1 Pocket', 'Front 2 Pocket',
                        'Front 2 Pocket Tash'
                    ]
                },
                {
                    name: 'Daman',
                    input_type: 'select',
                    options: ['Sada', 'Gool']
                },
                {
                    name: 'Asteen',
                    input_type: 'select',
                    options: ['No Palet', 'One Palet', 'Two Palet']
                },
                {
                    name: 'Buttons',
                    input_type: 'select',
                    options: ['1', '2', '3', '4', '5']
                },
                {
                    name: 'Button Style',
                    input_type: 'select',
                    options: ['Simple', 'Design']
                }
                ]
            },

            shalwar: {
                fields: [{
                    name: 'Length',
                    input_type: 'input'
                },
                {
                    name: 'Pancha',
                    input_type: 'input'
                },
                {
                    name: 'Select Field',
                    input_type: 'select',
                    options: ['Kundo Wala', 'Bagair Kundo Wala']
                },
                {
                    name: 'Asin Width',
                    input_type: 'input'
                },
                {
                    name: 'Shalwar Pockets',
                    input_type: 'select',
                    options: ['One', 'Two']
                },
                {
                    name: 'Paint Pocket',
                    input_type: 'input'
                }
                ]
            },

            coat: {
                fields: [{
                    name: 'Chest',
                    input_type: 'input'
                },
                {
                    name: 'Waist',
                    input_type: 'input'
                },
                {
                    name: 'Hip',
                    input_type: 'input'
                },
                {
                    name: 'Shoulder',
                    input_type: 'input'
                },
                {
                    name: 'Sleeve',
                    input_type: 'input'
                },
                {
                    name: 'Half Back',
                    input_type: 'input'
                },
                {
                    name: 'Chok',
                    input_type: 'select',
                    options: ['None', 'Single', 'Double']
                },
                {
                    name: 'Fit',
                    input_type: 'select',
                    options: ['Slim', 'Regular']
                },
                {
                    name: 'Buttons',
                    input_type: 'select',
                    options: ['1', '2', '3']
                }
                ]
            },

            waistcoat: {
                fields: [{
                    name: 'Chest',
                    input_type: 'input'
                },
                {
                    name: 'Waist',
                    input_type: 'input'
                },
                {
                    name: 'Shoulder',
                    input_type: 'input'
                },
                {
                    name: 'Length',
                    input_type: 'input'
                },
                {
                    name: 'Neck Depth',
                    input_type: 'input'
                },
                {
                    name: 'Buttons',
                    input_type: 'select',
                    options: ['1', '2', '3', '4', '5']
                },
                {
                    name: 'Style',
                    input_type: 'select',
                    options: ['Simple', 'Design']
                }
                ]
            }
        };

        const typeSelect = document.getElementById('type');
        const formContainer = document.getElementById('form-fields');

        // Helper: create a safe name attribute (no spaces, lowercased)
        function safeName(str) {
            return str.toString().trim().toLowerCase().replace(/[^a-z0-9]+/g, '_');
        }

        function renderFields(type) {
            formContainer.innerHTML = '';

            if (!type || !options[type]) {
                return;
            }

            const fields = options[type].fields;
            fields.forEach(field => {
                const labelHtml = `<label class="form-label" for="${safeName(field.name)}">${field.name}</label>`;
                let inputHtml = '';

                if (field.type === 'select') {
                    inputHtml = `<select id="${safeName(field.name)}" name="${safeName(field.name)}" class="form-select">
                                                                        ${field.options.map(opt => `<option value="${opt}">${opt}</option>`).join('')}
                                                                      </select>`;
                } else {
                    // default text input; change type to number if you prefer numeric fields
                    inputHtml =
                        `<input id="${safeName(field.name)}" type="text" name="${safeName(field.name)}" class="form-control" placeholder="${field.name}" />`;
                }

                const wrapper = `<div class="col-md-4">${labelHtml}${inputHtml}</div>`;
                formContainer.innerHTML += wrapper;
            });
        }

        // attach event
        typeSelect.addEventListener('change', (e) => {
            renderFields(e.target.value);
        });

        // optional: render initial type if already selected
        if (typeSelect.value) {
            renderFields(typeSelect.value);
        }
    </script> --}}

    {{--
    <script>
        function setValById(id, val) {
            let $input = $(`#${id}`).val(val);
            console.log($input); // Log the DOM element instead of the jQuery wrapper
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
                    input_type: 'DELETE',
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
                console.log(formArray);

                // Remove previous errors
                $form.find('.text-danger').remove();

                $.ajax({
                    url: "{{ route('customers.store') }}",
                    input_type: "POST",
                    data: formArray,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function (response) {
                        if (response.success) {
                            // Redirect to dashboard or wherever
                            location.reload();
                        } else {
                            console.log(response)
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
    </script> --}}
@endsection