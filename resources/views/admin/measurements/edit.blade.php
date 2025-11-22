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
                                            <option value="{{ $customer->id }}"
                                                {{ $measurement->customer_id == $customer->id ? 'selected' : '' }}>
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
                                            <option value="{{ $type }}"
                                                {{ $measurement->type == $type ? 'selected' : '' }}>
                                                {{ ucfirst(str_replace('_', ' / ', $type)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div id="form-fields" class="mt-3 row g-3"></div>

                            @php
                                $style = $measurement->style;
                                if ($style !== null) {
                                    $style = json_decode($style, true);
                                }

                            @endphp


                            <div class="my-3">
                                <h5>Style</h5>
                                <div class="row">

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: پٹی تفصیل</label>
                                            <select class="form-select" name="style_patty" id="">
                                                <option value="">Select from list</option>
                                                @foreach (['عام پٹی', 'چار بٹن پٹی', 'پانچ بٹن', 'چھ بٹن پٹی', 'سادہ پٹی', 'گم پٹی'] as $optionValue)
                                                    <option value="{{ $optionValue }}"
                                                        {{ isset($style['style_patty']) && $style['style_patty'] == $optionValue ? 'selected' : '' }}>
                                                        {{ $optionValue }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: کالر/بین کی تفصیل</label>
                                            <select class="form-select" name="style_collar" id="">
                                                <option value="">Select from list</option>
                                                @foreach (['عام کالر', 'شارٹ کالر', 'نوکدار کالر', 'گلہ سادہ ہاف', 'گلہ سادہ ہاف گول', 'گلہ سادہ کٹ', 'گلہ سادہ گول', 'مغزی والا گلہ'] as $optionValue)
                                                    <option value="{{ $optionValue }}"
                                                        {{ isset($style['style_collar']) && $style['style_collar'] == $optionValue ? 'selected' : '' }}>
                                                        {{ $optionValue }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: سامنے جیب تفصیل</label>
                                            <select class="form-select" name="style_front_pocket" id="">
                                                <option value="">Select from list</option>
                                                @foreach (['عام جیب', 'بغیر جیب', 'سادہ جیب', 'بغیر لیبل عام جیب', "عام جیب 5'' / 5.5", 'عام جیب 5.25/5.75', 'عام جیب 5.5/6', 'عام ڈبل جیب', 'تاش والا سنگل جیب', 'تاش والا ڈبل جیب'] as $optionValue)
                                                    <option value="{{ $optionValue }}"
                                                        {{ isset($style['style_front_pocket']) && $style['style_front_pocket'] == $optionValue ? 'selected' : '' }}>
                                                        {{ $optionValue }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: سائیڈ جیب تفصیل</label>
                                            <select class="form-select" name="style_side_pocket" id="">
                                                <option value="">Select from list</option>
                                                @foreach (['ایک جیب', 'ڈبل جیب', 'بغیر سائیڈ جیب'] as $optionValue)
                                                    <option value="{{ $optionValue }}"
                                                        {{ isset($style['style_side_pocket']) && $style['style_side_pocket'] == $optionValue ? 'selected' : '' }}>
                                                        {{ $optionValue }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: کف کی تفصیل</label>
                                            <select class="form-select" name="style_cuff" id="">
                                                <option value="">Select from list</option>
                                                @foreach (['سیدھا کف', 'گول کف', 'گول آستین بکرم والا', 'گول آستین بغیر بکرم', 'کابلی آستین', 'محراب والا آستین', 'چاک والا محراب آستین', 'کنی والا استین', 'ڈبل سٹڈ', 'سنگل سٹڈ گول', 'سنگل سٹڈ سیدھا', 'کراس کٹ کف', 'دو بٹن سیدھا کف', 'دو بٹن گول کف'] as $optionValue)
                                                    <option value="{{ $optionValue }}"
                                                        {{ isset($style['style_cuff']) && $style['style_cuff'] == $optionValue ? 'selected' : '' }}>
                                                        {{ $optionValue }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: آستین کی تفصیل</label>
                                            <select class="form-select" name="style_sleeve" id="">
                                                <option value="">Select from list</option>
                                                @foreach (['آستین بغیر پلیٹ', 'آستین دو پیلٹ', 'آستین ایک پلیٹ'] as $optionValue)
                                                    <option value="{{ $optionValue }}"
                                                        {{ isset($style['style_sleeve']) && $style['style_sleeve'] == $optionValue ? 'selected' : '' }}>
                                                        {{ $optionValue }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: چاک پٹی تفصیل</label>
                                            <select class="form-select" name="style_chak_patti" id="">
                                                <option value="">Select from list</option>
                                                @foreach (['چاک پٹی کاج', 'چاک پٹی دو کاج', 'بغیر چاک پٹی', 'چاک پٹی نوکدار', 'بغیر چاک پٹی کاج'] as $optionValue)
                                                    <option value="{{ $optionValue }}"
                                                        {{ isset($style['style_chak_patti']) && $style['style_chak_patti'] == $optionValue ? 'selected' : '' }}>
                                                        {{ $optionValue }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: دامن کی تفصیل</label>
                                            <select class="form-select" name="style_daman" id="">
                                                <option value="">Select from list</option>
                                                @foreach (['گھیرا سادہ', 'گھیرا گول', 'گھیرا سادہ ڈبل سلائی', 'گھیرا گول ڈبل سلائی', 'ترپائی والا گھیرا'] as $optionValue)
                                                    <option value="{{ $optionValue }}"
                                                        {{ isset($style['style_daman']) && $style['style_daman'] == $optionValue ? 'selected' : '' }}>
                                                        {{ $optionValue }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: شلوار کی تفصیل</label>
                                            <select class="form-select" name="style_shalwar" id="">
                                                <option value="">Select from list</option>
                                                @foreach (['کندھوں والا شلوار', 'بلوچی شلوار', 'فل سائز شلوار', 'بغیر کندھوں والا شلوار', 'پینٹ ڈیزائن شلوار'] as $optionValue)
                                                    <option value="{{ $optionValue }}"
                                                        {{ isset($style['style_shalwar']) && $style['style_shalwar'] == $optionValue ? 'selected' : '' }}>
                                                        {{ $optionValue }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: شلوار جیب کی تفصیل</label>
                                            <select class="form-select" name="style_shalwar_jeeb" id="">
                                                <option value="">Select from list</option>
                                                @foreach (['شلوار جیب زپ والا', 'شلوار جیب بغیر زپ والا', 'دو جیب', 'شلوار جیب بڑا سائز'] as $optionValue)
                                                    <option value="{{ $optionValue }}"
                                                        {{ isset($style['style_shalwar_jeeb']) && $style['style_shalwar_jeeb'] == $optionValue ? 'selected' : '' }}>
                                                        {{ $optionValue }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>




                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: پانچہ ڈیزائن</label>
                                            <select class="form-select" name="style_pancha_design" id="">
                                                <option value="">Select from list</option>
                                                @foreach (['سنگل سلائی والا', 'دو سلائی والا', 'عام سلائی', '123 سلائی والا'] as $optionValue)
                                                    <option value="{{ $optionValue }}"
                                                        {{ isset($style['style_pancha_design']) && $style['style_pancha_design'] == $optionValue ? 'selected' : '' }}>
                                                        {{ $optionValue }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: سلائی کی تفصیل</label>
                                            <select class="form-select" name="style_stitching_detail" id="">
                                                <option value="">Select from list</option>
                                                @foreach (['سادہ سلائی', 'چمک تار سلائی', 'کنکر سادہ سلائی', 'چمک تار کنکر سلائی', 'سادہ ڈبل سلائی', 'چمک تار ڈبل سلائی'] as $optionValue)
                                                    <option value="{{ $optionValue }}"
                                                        {{ isset($style['style_stitching_detail']) && $style['style_stitching_detail'] == $optionValue ? 'selected' : '' }}>
                                                        {{ $optionValue }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: بٹن کی تفصیل</label>
                                            <select class="form-select" name="style_button_detail" id="">
                                                <option value="">Select from list</option>
                                                @foreach (['ہم رنگ بٹن', 'عام بٹن سادہ', 'لکڑی والا ڈیزائن', 'سٹیل والا بٹن', 'چھوٹا بٹن عام/ ڈیزائن', 'بڑا بٹن'] as $optionValue)
                                                    <option value="{{ $optionValue }}"
                                                        {{ isset($style['style_button_detail']) && $style['style_button_detail'] == $optionValue ? 'selected' : '' }}>
                                                        {{ $optionValue }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">:کپڑوں کی اقسام</label>
                                            <select class="form-select" name="style_cloth_type" id="">
                                                <option value="">Select from list</option>
                                                @foreach (['مکمل کرتہ سلائی', 'کف آستین والا کرتہ', 'نارمل سوٹ', 'مکمل سادہ سوٹ', 'کرتہ ڈیزائن'] as $optionValue)
                                                    <option value="{{ $optionValue }}"
                                                        {{ isset($style['style_cloth_type']) && $style['style_cloth_type'] == $optionValue ? 'selected' : '' }}>
                                                        {{ $optionValue }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <div class="col-12 mb-4">
                                <label>Notes</label>
                                <textarea name="notes" id="notes" rows="5" class="form-control">{{ $measurement->notes }}</textarea>
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
                }
            },

            shirt: {
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
                }
            },

            kameez: {
                kameez: {
                    fields: [{
                            label: "Length",
                            name: 'kameez_Length',
                            input_type: 'input'
                        },
                        {
                            label: "Shoulder",
                            name: 'kameez_shoulder',
                            input_type: 'input'
                        },
                        {
                            label: "Sleeve",
                            name: 'kameez_sleeve',
                            input_type: 'input'
                        },
                        {
                            label: "Sleeve",
                            name: 'kameez_sleeve',
                            input_type: 'input'
                        },
                        {
                            label: "Collar",
                            name: 'kameez_collar',
                            input_type: 'input',
                        },
                        {
                            label: "Chest",
                            name: 'kameez_chest',
                            input_type: 'input',
                        },
                        {
                            label: "Waist",
                            name: 'kameez_waist',
                            input_type: 'input',
                        },
                        {
                            label: "Width",
                            name: 'kameez_width',
                            input_type: 'input',
                        },
                        // {
                        //     label: "Bann",
                        //     name: 'kameez_Bann',
                        //     input_type: 'select',
                        //     options: ['Full Ban Cut', 'Full Ban Gool', 'Half Ban Cut', 'Half Ban Gool',
                        //         'Kabali Ban', 'Design Ban'
                        //     ]
                        // },
                        // {
                        //     label: "Cuff",
                        //     name: 'kameez_Cuff',
                        //     input_type: 'select',
                        //     options: ['Sada', 'Gool', 'Sada Cut', 'Studd Kaag Gool', 'Studd Kaag Sada',
                        //         'Studd Double', 'Cuff 2 Kaag', 'Chk Patae Kaag', 'Bagair Chk Patae',
                        //         'Chk Patae 2 Kaag'
                        //     ]
                        // },
                        // {
                        //     label: "Stitching",
                        //     name: 'kameez_Stitching',
                        //     input_type: 'select',
                        //     options: ['Simple', 'Chamak', 'Double Chamak', 'Double Simple', 'Conquer Stitch']
                        // },
                        // {
                        //     label: "Pocket",
                        //     name: 'kameez_Pocket',
                        //     input_type: 'select',
                        //     options: ['Side 1 Pocket', 'Side 2 Pocket', 'Front 1 Pocket', 'Front 2 Pocket',
                        //         'Front 2 Pocket Tash'
                        //     ]
                        // },
                        // {
                        //     label: "Daman",
                        //     name: 'kameez_Daman',
                        //     input_type: 'select',
                        //     options: ['Sada', 'Gool']
                        // },
                        // {
                        //     label: "Asteen",
                        //     name: 'kameez_Asteen',
                        //     input_type: 'select',
                        //     options: ['No Palet', 'One Palet', 'Two Palet']
                        // },
                        // {
                        //     label: "Buttons",
                        //     name: 'kameez_Buttons',
                        //     input_type: 'select',
                        //     options: ['1', '2', '3', '4', '5']
                        // },
                        // {
                        //     label: "Button Style",
                        //     name: 'kameez_Button_Style',
                        //     input_type: 'select',
                        //     options: ['Simple', 'Design']
                        // }
                    ]
                }
            },

            shalwar: {
                shalwar: {
                    fields: [{
                            label: "Length",
                            name: 'shalwar_length',
                            input_type: 'input'
                        },
                        {
                            label: "Pancha",
                            name: 'shalwar_pancha',
                            input_type: 'input'
                        },
                        {
                            label: "Asin Width",
                            name: 'shalwar_asin_width',
                            input_type: 'input'
                        },
                    ]
                }
            },

            coat: {
                coat: {
                    fields: [{
                            label: "Chest",
                            name: 'coat_chest',
                            input_type: 'input'
                        },
                        {
                            label: "Waist",
                            name: 'coat_waist',
                            input_type: 'input'
                        },
                        {
                            label: "Hip",
                            name: 'coat_hip',
                            input_type: 'input'
                        },
                        {
                            label: "Shoulder",
                            name: 'coat_shoulder',
                            input_type: 'input'
                        },
                        {
                            label: "Sleeve",
                            name: 'coat_sleeve',
                            input_type: 'input'
                        },
                        {
                            label: "Half Back",
                            name: 'coat_half_back',
                            input_type: 'input'
                        },
                        {
                            label: "Chok",
                            name: 'coat_chok',
                            input_type: 'select',
                            options: ['None', 'Single', 'Double']
                        },
                        {
                            label: "Fit",
                            name: 'coat_fit',
                            input_type: 'select',
                            options: ['Slim', 'Regular']
                        },
                        {
                            label: "Buttons",
                            name: 'coat_buttons',
                            input_type: 'select',
                            options: ['1', '2', '3']
                        }
                    ]
                }
            },

            waistcoat: {
                waistcoat: {
                    fields: [{
                            label: "Chest",
                            name: 'waistcoat_chest',
                            input_type: 'input'
                        },
                        {
                            label: "Waist",
                            name: 'waistcoat_waist',
                            input_type: 'input'
                        },
                        {
                            label: "Shoulder",
                            name: 'waistcoat_shoulder',
                            input_type: 'input'
                        },
                        {
                            label: "Length",
                            name: 'waistcoat_length',
                            input_type: 'input'
                        },
                        {
                            label: "Neck Depth",
                            name: 'waistcoat_neck_depth',
                            input_type: 'input'
                        },
                        {
                            label: "Buttons",
                            name: 'waistcoat_buttons',
                            input_type: 'select',
                            options: ['1', '2', '3', '4', '5']
                        },
                        {
                            label: "Style",
                            name: 'waistcoat_style',
                            input_type: 'select',
                            options: ['Simple', 'Design']
                        }
                    ]
                }
            },

            shirt_pant: {
                shirt: {
                    ...this?.shirt?.shirt
                },
                pant: {
                    ...this?.pant?.pant
                }
            },

        };

        options["kameez_shalwar"] = {
            kameez: {
                ...options?.kameez?.kameez
            },
            shalwar: {
                ...options?.shalwar?.shalwar
            },
        }
        const typeSelect = document.getElementById('type');
        const formContainer = document.getElementById('form-fields');
        const oldValues =
            @json($measurement->data); // nested JSON, e.g. { kameez: { length: "1200", ... }, shalwar: {...} }


        function safeName(str) {
            return str.toString().trim().toLowerCase().replace(/[^a-z0-9]+/g, '_');
        }

        function renderFields(type) {
            formContainer.innerHTML = '';
            if (!type || !options[type]) return;

            // In new structure, if the type has a 'combine', it refers to other keys (like shirt_pant)
            const selectedSets = options[type].combine || Object.keys(options[type]);
            selectedSets.forEach(setName => {
                const set = options[type][setName] || options[setName]?.[setName];
                if (!set) return;

                const heading = `
            <div class="col-12 mt-3">
                <h5 class="fw-bold">${setName.charAt(0).toUpperCase() + setName.slice(1)} Measurements</h5>
            </div>`;
                formContainer.insertAdjacentHTML('beforeend', heading);

                set.fields.forEach(field => {
                    const key = safeName(field.name);
                    // Determine the prefix (kameez, shalwar, etc.)
                    const prefix = key.split('_')[0];
                    const nestedValue = oldValues[prefix] || {};
                    // remove the first word from any key that contains an underscore
                    let adjustedKey = key.includes('_') ? key.substring(key.indexOf('_') + 1) : key;
                    const value = nestedValue[adjustedKey] || '';

                    let inputHTML = '';
                    if (field.input_type === 'select') {
                        const optionsHTML = field.options.map(opt =>
                            `<option value="${opt}" ${opt === value ? 'selected' : ''}>${opt}</option>`
                        ).join('');
                        inputHTML = `<select name="${key}" class="form-select">${optionsHTML}</select>`;
                    } else {
                        inputHTML =
                            `<input type="text" name="${key}" value="${value}" class="form-control" placeholder="${field.label}" />`;
                    }

                    const fieldHTML = `
                <div class="col-md-3 col-xl-2 mb-2">
                    <label class="form-label">${field.label}</label>
                    ${inputHTML}
                </div>`;
                    formContainer.insertAdjacentHTML('beforeend', fieldHTML);
                });
            });
        }

        // Event listener for type change
        typeSelect.addEventListener('change', e => renderFields(e.target.value));

        // Render fields on page load if type is already selected
        if (typeSelect.value) renderFields(typeSelect.value);
    </script>
@endsection
