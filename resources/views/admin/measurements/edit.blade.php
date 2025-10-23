@extends('admin.layouts.app')

@section('content')
    <div class="container-fluid">

        <div class="py-3 d-flex align-items-center justify-content-between">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Edit Measurements</h4>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="row">
            <div class="col-12">
                <form action="{{ route('measurements.update', $measurement->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-3">
                                    <label>Customer</label>
                                    <select name="customer_id" class="form-select" required>
                                        <option value="">Select Customer</option>
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}" {{ $measurement->customer_id == $customer->id ? 'selected' : '' }}>
                                                {{ $customer->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label>Type</label>
                                    <select id="type" name="type" class="form-select" required>
                                        <option value="">Select Type</option>
                                        @foreach (['pant', 'shirt', 'shirt_pant', 'kameez', 'shalwar', 'kameez_shalwar', 'coat', 'waistcoat'] as $type)
                                            <option value="{{ $type }}" {{ $measurement->type == $type ? 'selected' : '' }}>
                                                {{ ucfirst(str_replace('_', ' / ', $type)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="form-fields" class="mt-3 row g-3"></div>

                            <div class="col-12 mb-4">
                                <label>Notes</label>
                                <textarea name="notes" id="notes" rows="5"
                                    class="form-control">{{ $measurement->notes }}</textarea>
                            </div>

                            <div class="text-end">
                                <button class="btn btn-primary">Update</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        const options = {
            pant: {
                fields: [{
                    label: "Waist",
                    name: 'pant_Waist',
                    type: 'input'
                },
                {
                    label: "Seat / Hip",
                    name: 'pant_seat_hip',
                    type: 'input'
                },
                {
                    label: "Bottom",
                    name: 'pant_Bottom',
                    type: 'input'
                },
                {
                    label: "Length",
                    name: 'pant_Length',
                    type: 'input'
                },
                {
                    label: "Fit",
                    name: 'pant_Fit',
                    type: 'select',
                    options: ['Slim', 'Regular', 'Loose']
                },
                {
                    label: "Pocket Style",
                    name: 'pant_pocket_style',
                    type: 'select',
                    options: ['Cross', 'Straight']
                }
                ]
            },

            shirt: {
                fields: [{
                    label: "Neck",
                    name: 'shirt_Neck',
                    type: 'input'
                },
                {
                    label: "Chest",
                    name: 'shirt_Chest',
                    type: 'input'
                },
                {
                    label: "Waist",
                    name: 'shirt_Waist',
                    type: 'input'
                },
                {
                    label: "Shoulder",
                    name: 'shirt_Shoulder',
                    type: 'input'
                },
                {
                    label: "Sleeve",
                    name: 'shirt_Sleeve',
                    type: 'input'
                },
                {
                    label: "Cuff",
                    name: 'shirt_Cuff',
                    type: 'input'
                },
                {
                    label: "Shirt Length",
                    name: 'shirt_length',
                    type: 'input'
                },
                {
                    label: "Fit",
                    name: 'shirt_Fit',
                    type: 'select',
                    options: ['Slim', 'Regular']
                },
                {
                    label: "Collar",
                    name: 'shirt_collar',
                    type: 'select',
                    options: ['Spread', 'Button-down', 'Mandarin']
                },
                {
                    label: "Cuffs",
                    name: 'shirt_Cuffs',
                    type: 'select',
                    options: ['Single', 'Double']
                },
                {
                    label: "Pocket",
                    name: 'shirt_Pocket',
                    type: 'select',
                    options: ['0', '1', '2']
                },
                {
                    label: "Daman",
                    name: 'shirt_Daman',
                    type: 'select',
                    options: ['Gool', 'Sada']
                }
                ]
            },

            kameez: {
                fields: [{
                    label: "Length",
                    name: 'kameez_Length',
                    type: 'input'
                },
                {
                    label: "Sleeve",
                    name: 'kameez_Sleeve',
                    type: 'input'
                },
                {
                    label: "Sleeve",
                    name: 'kameez_Sleeve',
                    type: 'input'
                },
                {
                    label: "Collar",
                    name: 'kameez_Collar',
                    type: 'select',
                    options: ['Collar', 'Short Collar', 'Nokdar Collar']
                },
                {
                    label: "Bann",
                    name: 'kameez_Bann',
                    type: 'select',
                    options: ['Full Ban Cut', 'Full Ban Gool', 'Half Ban Cut', 'Half Ban Gool', 'Kabali Ban',
                        'Design Ban'
                    ]
                },
                {
                    label: "Cuff",
                    name: 'kameez_Cuff',
                    type: 'select',
                    options: ['Sada', 'Gool', 'Sada Cut', 'Studd Kaag Gool', 'Studd Kaag Sada', 'Studd Double',
                        'Cuff 2 Kaag', 'Chk Patae Kaag', 'Bagair Chk Patae', 'Chk Patae 2 Kaag'
                    ]
                },
                {
                    label: "Stitching",
                    name: 'kameez_Stitching',
                    type: 'select',
                    options: ['Simple', 'Chamak', 'Double Chamak', 'Double Simple', 'Conquer Stitch']
                },
                {
                    label: "Pocket",
                    name: 'kameez_Pocket',
                    type: 'select',
                    options: ['Side 1 Pocket', 'Side 2 Pocket', 'Front 1 Pocket', 'Front 2 Pocket',
                        'Front 2 Pocket Tash'
                    ]
                },
                {
                    label: "Daman",
                    name: 'kameez_Daman',
                    type: 'select',
                    options: ['Sada', 'Gool']
                },
                {
                    label: "Asteen",
                    name: 'kameez_Asteen',
                    type: 'select',
                    options: ['No Palet', 'One Palet', 'Two Palet']
                },
                {
                    label: "Buttons",
                    name: 'kameez_Buttons',
                    type: 'select',
                    options: ['1', '2', '3', '4', '5']
                },
                {
                    label: "Button Style",
                    name: 'kameez_Button_Style',
                    type: 'select',
                    options: ['Simple', 'Design']
                }
                ]
            },

            shalwar: {
                fields: [{
                    label: "Length",
                    name: 'shalwar_Length',
                    type: 'input'
                },
                {
                    label: "Pancha",
                    name: 'shalwar_Pancha',
                    type: 'input'
                },
                {
                    label: "Shalwar Type",
                    name: 'shalwar_type',
                    type: 'select',
                    options: ['Kundo Wala', 'Bagair Kundo Wala']
                },
                {
                    label: "Asin Width",
                    name: 'shalwar_Asin_Width',
                    type: 'input'
                },
                {
                    label: "Shalwar Pockets",
                    name: 'shalwar_Shalwar_Pockets',
                    type: 'select',
                    options: ['One', 'Two']
                },
                {
                    label: "Paint Pocket",
                    name: 'shalwar_Paint_Pocket',
                    type: 'input'
                }
                ]
            },

            coat: {
                fields: [{
                    label: "Chest",
                    name: 'coat_Chest',
                    type: 'input'
                },
                {
                    label: "Waist",
                    name: 'coat_Waist',
                    type: 'input'
                },
                {
                    label: "Hip",
                    name: 'coat_Hip',
                    type: 'input'
                },
                {
                    label: "Shoulder",
                    name: 'coat_Shoulder',
                    type: 'input'
                },
                {
                    label: "Sleeve",
                    name: 'coat_Sleeve',
                    type: 'input'
                },
                {
                    label: "Half Back",
                    name: 'coat_Half_Back',
                    type: 'input'
                },
                {
                    label: "Chok",
                    name: 'coat_Chok',
                    type: 'select',
                    options: ['None', 'Single', 'Double']
                },
                {
                    label: "Fit",
                    name: 'coat_Fit',
                    type: 'select',
                    options: ['Slim', 'Regular']
                },
                {
                    label: "Buttons",
                    name: 'coat_Buttons',
                    type: 'select',
                    options: ['1', '2', '3']
                }
                ]
            },

            waistcoat: {
                fields: [{
                    label: "Chest",
                    name: 'waistcoat_Chest',
                    type: 'input'
                },
                {
                    label: "Waist",
                    name: 'waistcoat_Waist',
                    type: 'input'
                },
                {
                    label: "Shoulder",
                    name: 'waistcoat_Shoulder',
                    type: 'input'
                },
                {
                    label: "Length",
                    name: 'waistcoat_Length',
                    type: 'input'
                },
                {
                    label: "Neck Depth",
                    name: 'waistcoat_Neck_Depth',
                    type: 'input'
                },
                {
                    label: "Buttons",
                    name: 'waistcoat_Buttons',
                    type: 'select',
                    options: ['1', '2', '3', '4', '5']
                },
                {
                    label: "Style",
                    name: 'waistcoat_Style',
                    type: 'select',
                    options: ['Simple', 'Design']
                }
                ]
            },


            shirt_pant: {
                combine: ['shirt', 'pant']
            },

            kameez_shalwar: {
                combine: ["kameez", "shalwar"]
            }

        };

        const typeSelect = document.getElementById('type');
        const formContainer = document.getElementById('form-fields');
        const oldValues = @json($measurement->data ?? []); // assume 'data' column stores JSON of field values
        console.log(oldValues);
        function safeName(str) {
            return str.toString().trim().toLowerCase().replace(/[^a-z0-9]+/g, '_');
        }

        function renderFields(type) {
            formContainer.innerHTML = '';
            if (!type || !options[type]) return;

            const selectedSets = options[type].combine || [type];
            selectedSets.forEach(setName => {
                const set = options[setName];
                if (!set) return;

                const heading = `
                    <div class="col-12 mt-3">
                        <h5 class="fw-bold">${setName.charAt(0).toUpperCase() + setName.slice(1)} Measurements</h5>
                    </div>`;
                formContainer.insertAdjacentHTML('beforeend', heading);

                set.fields.forEach(field => {
                    const key = safeName(field.name);
                    const value = oldValues[key] || '';
                    let inputHTML = '';

                    if (field.type === 'select') {
                        const optionsHTML = field.options.map(opt =>
                            `<option value="${opt}" ${opt === value ? 'selected' : ''}>${opt}</option>`
                        ).join('');
                        inputHTML = `<select name="${key}" class="form-select">${optionsHTML}</select>`;
                    } else {
                        inputHTML = `<input type="text" name="${key}" value="${value}" class="form-control" placeholder="${field.label}" />`;
                    }

                    const fieldHTML = `
                        <div class="col-md-3 mb-2">
                            <label class="form-label">${field.label}</label>
                            ${inputHTML}
                        </div>`;
                    formContainer.insertAdjacentHTML('beforeend', fieldHTML);
                });
            });
        }

        typeSelect.addEventListener('change', e => renderFields(e.target.value));

        if (typeSelect.value) renderFields(typeSelect.value);
    </script>
@endsection