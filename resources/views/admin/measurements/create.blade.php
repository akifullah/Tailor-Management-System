@extends('admin.layouts.app')


@section('content')
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

                            @if ($selectedCustomer)
                                <div class="text-end">

                                    <a class="btn btn-success"
                                        href="{{ route('orders.create.withCustomer', ['customer' => $selectedCustomer->id]) }}">Create
                                        Order</a>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-md-2 mb-3">
                                    <label>Customer</label>
                                    @if ($selectedCustomer)
                                        <!-- Show disabled select for display -->
                                        <select class="form-select" disabled>
                                            <option value="{{ $selectedCustomer->id }}" selected>
                                                {{ $selectedCustomer->name }}
                                            </option>
                                        </select>
                                        <input type="hidden" name="customer_id" value="{{ $selectedCustomer->id }}">
                                    @else
                                        <!-- Allow user to select manually -->
                                        <select name="customer_id" class="form-select select2" required>
                                            <option value="">Select Customer</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }} |
                                                    {{ $customer->phone }}</option>
                                            @endforeach
                                        </select>
                                    @endif
                                </div>
                                <div class="col-md-2 mb-3">
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
                                        {{-- <option value="shirt_pant">Pant/Shirt</option> --}}
                                        <option value="kameez">Kameez</option>
                                        <option value="shalwar">Shalwar</option>
                                        <option value="kameez_shalwar">Kameez/Shalwar</option>
                                        <option value="coat">Coat</option>
                                        <option value="waistcoat">Waistcoat</option>
                                    </select>
                                </div>
                            </div>


                            <div id="form-fields" class="mt-3 row g-3"></div>


                            <div class="my-3">
                                <h5>Style</h5>
                                <div class="row">

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: پٹی تفصیل</label>
                                            <select class="form-select" name="style_patty" id="">
                                                <option value="">Select from list</option>
                                                <option value="عام پٹی">عام پٹی</option>
                                                <option value="عام پٹی دائیں طرف">عام پٹی دائیں طرف</option>
                                                <option value="عام پٹی نوکدار">عام پٹی نوکدار</option>
                                                <option value="چار بٹن پٹی">چار بٹن پٹی</option>
                                                <option value="پانچ بٹن">پانچ بٹن</option>
                                                <option value="چھ بٹن پٹی">چھ بٹن پٹی</option>
                                                <option value="سادہ پٹی">سادہ پٹی</option>
                                                <option value="گم پٹی">گم پٹی</option>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="style_patty_width">: پٹی چھوڑائی </label>
                                            <input type="text" class="form-control" name="style_patty_width"
                                                id="style_patty_width" placeholder="Enter Patty Width">
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="style_patty_length">: پٹی لمبائی</label>
                                            <input type="text" class="form-control" name="style_patty_length"
                                                id="style_patty_length" placeholder="Enter Patty Length">
                                        </div>
                                    </div>



                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: کالر/بین کی تفصیل</label>
                                            <select class="form-select" name="style_collar" id="">
                                                <option value="">Select from list</option>
                                                <option value="عام کالر">عام کالر</option>
                                                <option value="انگلش کالر">انگلش کالر</option>
                                                <option value="گلہ بند">گلہ بند</option>
                                                <option value="شارٹ کالر">شارٹ کالر</option>
                                                <option value="نوکدار کالر">نوکدار کالر</option>
                                                <option value="گلہ سادہ ہاف">گلہ سادہ ہاف</option>
                                                <option value="گلہ سادہ ہاف گول">گلہ سادہ ہاف گول</option>
                                                <option value="گلہ سادہ کٹ">گلہ سادہ کٹ</option>
                                                <option value="گلہ سادہ گول">گلہ سادہ گول</option>
                                                <option value="مغزی والا گلہ">مغزی والا گلہ</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: کالر/بین کی چھوڑائی</label>
                                            <input type="text" class="form-control" name="style_collar_width"
                                                id="style_collar_width" placeholder="Enter collar Width">
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: سامنے جیب تفصیل</label>
                                            <select class="form-select" name="style_front_pocket" id="">
                                                <option value="">Select from list</option>
                                                <option value="عام جیب">عام جیب</option>
                                                <option value="بغیر جیب">بغیر جیب</option>
                                                <option value="پاکٹ کے اندر پاکٹ">پاکٹ کے اندر پاکٹ</option>
                                                <option value="سامنے جیب دائیں طرف">سامنے جیب دائیں طرف</option>
                                                <option value="سادہ جیب">سادہ جیب</option>
                                                <option value="بغیر لیبل عام جیب">بغیر لیبل عام جیب</option>
                                                <option value="عام جیب 5'' / 5.5">عام جیب 5'' / 5.5</option>
                                                <option value="عام جیب 5.25/5.75">عام جیب 5.25/5.75</option>
                                                <option value="عام جیب 5.5/6">عام جیب 5.5/6</option>
                                                <option value="عام ڈبل جیب">عام ڈبل جیب</option>
                                                <option value="تاش والا سنگل جیب">تاش والا سنگل جیب</option>
                                                <option value="تاش والا ڈبل جیب">تاش والا ڈبل جیب</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="style_front_pocket_width">: سامنے جیب چھوڑائی </label>
                                            <input type="text" class="form-control" name="style_front_pocket_width"
                                                id="style_front_pocket_width" placeholder="Enter front pocket Width">
                                        </div>
                                    </div>
                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="style_front_pocket_length">: سامنے جیب لمبائی </label>
                                            <input type="text" class="form-control" name="style_front_pocket_length"
                                                id="style_front_pocket_length" placeholder="Enter front pocket Length">
                                        </div>
                                    </div>


                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: سائیڈ جیب تفصیل</label>
                                            <select class="form-select" name="style_side_pocket" id="">
                                                <option value="">Select from list</option>
                                                <option value="ایک جیب">ایک جیب</option>
                                                <option value="ڈبل جیب">ڈبل جیب</option>
                                                <option value="بغیر سائیڈ جیب">بغیر سائیڈ جیب</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: کف کی تفصیل</label>
                                            <select class="form-select" name="style_cuff" id="">
                                                <option value="">Select from list</option>
                                                <option value="سیدھا کف">سیدھا کف</option>
                                                <option value="گول کف">گول کف</option>
                                                <option value="گول آستین بکرم والا">گول آستین بکرم والا</option>
                                                <option value="گول آستین بغیر بکرم">گول آستین بغیر بکرم</option>
                                                <option value="کابلی آستین">کابلی آستین</option>
                                                <option value="محراب والا آستین">محراب والا آستین</option>
                                                <option value="چاک والا محراب آستین">چاک والا محراب آستین</option>
                                                <option value="کنی والا استین">کنی والا استین</option>
                                                <option value="ڈبل سٹڈ">ڈبل سٹڈ</option>
                                                <option value="سنگل سٹڈ گول">سنگل سٹڈ گول</option>
                                                <option value="سنگل سٹڈ سیدھا">سنگل سٹڈ سیدھا</option>
                                                <option value="کراس کٹ کف">کراس کٹ کف</option>
                                                <option value="دو بٹن سیدھا کف">دو بٹن سیدھا کف</option>
                                                <option value="دو بٹن گول کف">دو بٹن گول کف</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: آستین کی تفصیل</label>
                                            <select class="form-select" name="style_sleeve" id="">
                                                <option value="">Select from list</option>
                                                <option value="آستین بغیر پلیٹ">آستین بغیر پلیٹ</option>
                                                <option value="آستین دو پیلٹ">آستین دو پیلٹ</option>
                                                <option value="آستین ایک پلیٹ">آستین ایک پلیٹ</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: چاک پٹی تفصیل</label>
                                            <select class="form-select" name="style_chak_patti" id="">
                                                <option value="">Select from list</option>
                                                <option value="چاک پٹی کاج">چاک پٹی کاج</option>
                                                <option value="چاک پٹی دو کاج">چاک پٹی دو کاج</option>
                                                <option value="بغیر چاک پٹی">بغیر چاک پٹی</option>
                                                <option value="چاک پٹی نوکدار">چاک پٹی نوکدار</option>
                                                <option value="بغیر چاک پٹی کاج">بغیر چاک پٹی کاج</option>
                                                <option value="بغیر چاک">بغیر چاک</option>
                                                <option value="سائیڈ دو چاک">سائیڈ دو چاک</option>
                                                <option value="بیک درمیان سنگل چاک">بیک درمیان سنگل چاک</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: دامن کی تفصیل</label>
                                            <select class="form-select" name="style_daman" id="">
                                                <option value="">Select from list</option>
                                                <option value="گھیرا سادہ">گھیرا سادہ</option>
                                                <option value="گھیرا گول">گھیرا گول</option>
                                                <option value="گول دامن">گول دامن</option>
                                                <option value="کراس کٹ دامن">کراس کٹ دامن</option>
                                                <option value="سیدھا دامن">سیدھا دامن</option>
                                                <option value="گھیرا سادہ ڈبل سلائی">گھیرا سادہ ڈبل سلائی</option>
                                                <option value="گھیرا گول ڈبل سلائی">گھیرا گول ڈبل سلائی</option>
                                                <option value="ترپائی والا گھیرا">ترپائی والا گھیرا</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: شلوار کی تفصیل</label>
                                            <select class="form-select" name="style_shalwar" id="">
                                                <option value="">Select from list</option>
                                                <option value="کندھوں والا شلوار">کندھوں والا شلوار</option>
                                                <option value="بلوچی شلوار">بلوچی شلوار</option>
                                                <option value="فل سائز شلوار">فل سائز شلوار</option>
                                                <option value="بغیر کندھوں والا شلوار">بغیر کندھوں والا شلوار</option>
                                                <option value="پینٹ ڈیزائن شلوار">پینٹ ڈیزائن شلوار</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: شلوار جیب کی تفصیل</label>
                                            <select class="form-select" name="style_shalwar_jeeb" id="">
                                                <option value="">Select from list</option>
                                                <option value="شلوار جیب زپ والا">شلوار جیب زپ والا</option>
                                                <option value="شلوار جیب بغیر زپ والا">شلوار جیب بغیر زپ والا</option>
                                                <option value="دو جیب">دو جیب</option>
                                                <option value="شلوار جیب بڑا سائز">شلوار جیب بڑا سائز</option>
                                            </select>
                                        </div>
                                    </div>




                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: پانچہ ڈیزائن</label>
                                            <select class="form-select" name="style_pancha_design" id="">
                                                <option value="">Select from list</option>
                                                <option value="سنگل سلائی والا">سنگل سلائی والا</option>
                                                <option value="دو سلائی والا">دو سلائی والا</option>
                                                <option value="عام سلائی">عام سلائی</option>
                                                <option value="123 سلائی والا">123 سلائی والا</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: سلائی کی تفصیل</label>
                                            <select class="form-select" name="style_stitching_detail" id="">
                                                <option value="">Select from list</option>
                                                <option value="سادہ سلائی">سادہ سلائی</option>
                                                <option value="چمک تار سلائی">چمک تار سلائی</option>
                                                <option value="کنکر سادہ سلائی">کنکر سادہ سلائی</option>
                                                <option value="چمک تار کنکر سلائی">چمک تار کنکر سلائی</option>
                                                <option value="سادہ ڈبل سلائی">سادہ ڈبل سلائی</option>
                                                <option value="چمک تار ڈبل سلائی">چمک تار ڈبل سلائی</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: بٹن کی تفصیل</label>
                                            <select class="form-select" name="style_button_detail" id="">
                                                <option value="">Select from list</option>
                                                <option value="ہم رنگ بٹن">ہم رنگ بٹن</option>
                                                <option value="عام بٹن سادہ">عام بٹن سادہ</option>
                                                <option value="لکڑی والا ڈیزائن">لکڑی والا ڈیزائن</option>
                                                <option value="سٹیل والا بٹن">سٹیل والا بٹن</option>
                                                <option value="چھوٹا بٹن عام/ ڈیزائن">چھوٹا بٹن عام/ ڈیزائن</option>
                                                <option value="بڑا بٹن">بڑا بٹن</option>
                                                <option value="سنگل بٹن">سنگل بٹن</option>
                                                <option value="دو بٹن">دو بٹن</option>
                                                <option value="تین بٹن">تین بٹن</option>
                                                <option value="فولڈنگ دو بٹن">فولڈنگ دو بٹن</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">:کپڑوں کی اقسام</label>
                                            <select class="form-select" name="style_cloth_type" id="">
                                                <option value="">Select from list</option>
                                                <option value="مکمل کرتہ سلائی">مکمل کرتہ سلائی</option>
                                                <option value="کف آستین والا کرتہ">کف آستین والا کرتہ</option>
                                                <option value="نارمل سوٹ">نارمل سوٹ</option>
                                                <option value="مکمل سادہ سوٹ">مکمل سادہ سوٹ</option>
                                                <option value="کرتہ ڈیزائن">کرتہ ڈیزائن</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2 mb-3">
                                        <div class="form-group">
                                            <label for="">: گلہ کی تفصیل</label>
                                            <select class="form-select" name="style_gala_detail" id="">
                                                <option value="">Select from list</option>
                                                <option value="گلہ بند">گلہ بند</option>
                                                <option value="گلہ گول">گلہ گول</option>
                                                <option value="گلہ وی V">گلہ وی V</option>
                                                <option value="گلہ بند گول بین">گلہ بند گول بین</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>
                            </div>


                            <div class="col-12 mb-4">
                                <label for="">Notes</label>
                                <textarea name="notes" id="notes" placeholder="Enter Extra Notes" rows="5" class="form-control"></textarea>
                            </div>

                            <div class="text-end">
                                <button class="btn btn-primary">Save</button>
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
                            input_type: 'input',
                            // extra_fields: [{
                            //     label: "Length Extra",
                            //     name: "kameez_Length_extra1"
                            // }]
                        },
                        {
                            label: "Shoulder",
                            name: 'kameez_shoulder',
                            input_type: 'input',
                            // extra_fields: [{
                            //     label: "Shoulder Extra",
                            //     name: "kameez_shoulder_extra1"
                            // }]
                        },

                        {
                            label: "Sleeve",
                            name: 'kameez_sleeve',
                            input_type: 'input',
                            // extra_fields: [{
                            //     label: "Sleeve Extra",
                            //     name: "kameez_sleeve_extra1"
                            // }]
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
                            // extra_fields: [{
                            //     label: "Chest Extra",
                            //     name: "kameez_chest_extra1"
                            // }]
                        },
                        {
                            label: "Waist",
                            name: 'kameez_waist',
                            input_type: 'input',
                            // extra_fields: [{
                            //     label: "Waist Extra",
                            //     name: "kameez_waist_extra1"
                            // }]
                        },
                        {
                            label: "Width",
                            name: 'kameez_width',
                            input_type: 'input',
                        },

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
                        // {
                        //     label: "Asin Width",
                        //     name: 'shalwar_asin_width',
                        //     input_type: 'input'
                        // },
                    ]
                }
            },

            coat: {
                coat: {
                    fields: [{
                            label: "Length",
                            name: 'coat_length',
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
                            label: "Half Back",
                            name: 'coat_half_back',
                            input_type: 'input'
                        },
                        {
                            label: "Single Shoulder",
                            name: 'single_shoulder',
                            input_type: 'input',
                        },

                    ]
                }
            },

            waistcoat: {
                waistcoat: {
                    fields: [{
                            label: "Length",
                            name: 'waistcoat_length',
                            input_type: 'input'
                        },
                        {
                            label: "Shoulder",
                            name: 'waistcoat_shoulder',
                            input_type: 'input'
                        },
                        {
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
                            label: "Hip",
                            name: 'waistcoat_hip',
                            input_type: 'input'
                        },
                        {
                            label: "Coller",
                            name: 'waistcoat_coller',
                            input_type: 'input'
                        },

                        {
                            label: "Single Shoulder",
                            name: 'waistcoat_single_shoulder',
                            input_type: 'input',
                        },
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


        
        options["shirt_pant"] = {
            shirt: {
                ...options?.shirt?.shirt
            },
            pant: {
                ...options?.pant?.pant
            },
        }
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

        $("#type").change(function(e) {
            let value = e.target.value;
            renderFields(value);
        });

        function safeName(str) {
            return str.toString().trim().toLowerCase().replace(/[^a-z0-9]+/g, '_');
        }

        function renderFields(type) {
            formContainer.innerHTML = '';
            if (!type || !options[type]) return;

            // In new structure, if the type has a 'combine', it refers to other keys (like shirt_pant)
            const selectedSets = options[type].combine || Object.keys(options[type]);

            selectedSets.forEach(setName => {
                // Each set is nested, e.g. options.pant.pant.fields
                const set = options[type][setName] || options[setName]?.[setName];
                if (!set || !set.fields) return;

                // Section heading
                const heading = `
            <div class="col-12 mt-3">
                <h5 class="fw-bold">${setName.charAt(0).toUpperCase() + setName.slice(1)} Measurements</h5>
            </div>
        `;
                formContainer.insertAdjacentHTML('beforeend', heading);

                // Loop through fields
                set.fields.forEach(field => {
                    let inputHTML = '';

                    if (field.input_type === 'select') {
                        const optionsHTML = field.options
                            .map(opt => `<option value="${opt}">${opt}</option>`)
                            .join('');
                        inputHTML =
                            `<select name="${safeName(field.name)}" class="form-select select">${optionsHTML}</select>`;
                    } else {
                        inputHTML =
                            `<input type="text" name="${safeName(field.name)}" class="form-control text-capitalize" placeholder="${field.label}" />`;
                    }

                    const fieldHTML = `<div class="col-md-3 col-xl-2 mb-2">
                                            <label class="form-label text-capitalize">${field.label}</label>
                                            ${inputHTML}
                                        </div>`;
                    formContainer.insertAdjacentHTML('beforeend', fieldHTML);

                    // extra fields
                    if (field.extra_fields && Array.isArray(field.extra_fields)) {
                        field.extra_fields.forEach(extra => {
                            const extraHTML = `<div class="col-md-3 col-xl-2 mb-2">
                                                    <label class="form-label text-capitalize">${extra.label}</label>
                                                    <input type="text"
                                                        name="${safeName(extra.name)}"
                                                        class="form-control text-capitalize"
                                                        placeholder="${extra.label}" />
                                                </div>`;
                            formContainer.insertAdjacentHTML("beforeend", extraHTML);
                        });
                    }
                });
            });
        }

        // Auto-render if pre-selected
        if (typeSelect.value) renderFields(typeSelect.value);
    </script>
@endsection
