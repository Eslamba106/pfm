@extends('super_admin.layouts.app')
@section('title')
    {{ ui_change('confirm_company') }}
@endsection
@php
    $lang = session()->get('locale');
@endphp
@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                {{-- <img src="{{ asset(main_path() . 'back-end/img/inhouse-product-list.png') }}" alt=""> --}}
                {{ ui_change('confirm_company') }}
            </h2>
        </div>


        <div class="mb-5"></div>
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <form id="signature-form" action="{{ route('admin.requests.ApproveConfirm', $company->id) }}" method="post"
                enctype="multipart/form-data">
                @csrf
                @method('patch')
                <!-- general setup -->
                <div class="card mt-3 rest-part">
                    <div class="card-header">
                        <div class="d-flex gap-2">
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('companies.name') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" value="{{ $company->name }}" name="name">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="company_id" class="title-color">{{ __('companies.company_id') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" value="{{ $company->company_id }}"
                                        name="company_id" readonly>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name"
                                        class="title-color">{{ ui_change('monthly_subscription_per_user') }}<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <input type="number" class="form-control"  step="0.001" 
                                        value="{{ number_format($company->schema?->user_charge , 3) }}" name="monthly_subscription_user">
                                        {{-- <input type="number" class="form-control"  step="0.001" 
                                            value="{{ number_format($company->monthly_subscription_user , 3) ?? number_format($company->schema?->user_charge , 3) }}" name="monthly_subscription_user">
                                     --}}
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name"
                                        class="title-color">{{ ui_change('monthly_subscription_per_building') }}<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <input type="number" class="form-control"  step="0.001" 
                                        value="{{  number_format($company->schema?->building_charge , 3) }}"
                                        name="monthly_subscription_building">
                                    {{-- <input type="number" class="form-control"  step="0.001" 
                                        value="{{ number_format($company->monthly_subscription_building , 3) ?? number_format($company->schema?->building_charge , 3) }}"
                                        name="monthly_subscription_building"> --}}
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name"
                                        class="title-color">{{ ui_change('monthly_subscription_per_unit') }}<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <input type="number" class="form-control"  step="0.001" 
                                        value="{{   number_format($company->schema?->unit_charge , 3) }}"
                                        name="monthly_subscription_units">
                                    {{-- <input type="number" class="form-control"  step="0.001" 
                                        value="{{ number_format($company->monthly_subscription_units , 3) ?? number_format($company->schema?->unit_charge , 3) }}"
                                        name="monthly_subscription_units"> --}}
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name"
                                        class="title-color">{{ ui_change('monthly_subscription_per_branch') }}<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <input type="number" class="form-control"  step="0.001" 
                                        value="{{ number_format($company->schema?->branch_charge , 3) }}"
                                        name="monthly_subscription_branches">
                                    {{-- <input type="number" class="form-control"  step="0.001" 
                                        value="{{ number_format($company->monthly_subscription_branches , 3) ?? number_format($company->schema?->branch_charge , 3) }}"
                                        name="monthly_subscription_branches"> --}}
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ ui_change('setup_cost') }}<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <input type="number" class="form-control"  step="0.001"  value="{{  number_format($company->schema?->setup_cost , 3) }}"
                                        name="setup_cost">
                                    {{-- <input type="number" class="form-control"  step="0.001"  value="{{ number_format($company->setup_cost , 3) ?? number_format($company->schema?->setup_cost , 3) }}"
                                        name="setup_cost"> --}}
                                </div>
                            </div>
                            
 
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name"
                                        class="title-color">{{ __('companies.company_applicable_date') }}<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <input type="text" class="form-control company_applicable_date"
                                        {{-- value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $company->company_applicable_date)->format('d/m/Y') ?? \Carbon\Carbon::now()->format('d/m/Y')  }}" --}} name="company_applicable_date">
                                </div>
                            </div>
                             
                            
                        </div>
                        
                    </div>
                </div>
                <div class="card mt-3 rest-part">
                    <div class="card-header">
                        <div class="d-flex gap-2">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                          
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('companies.user_count') }}<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{ $company->user_count }}"
                                        name="user_count">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('companies.branches_count') }}<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{ $company->branches_count }}"
                                        name="branches_count">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('companies.buildings_count') }}<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{ $company->building_count }}"
                                        name="buildings_count">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('companies.units_count') }}<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <input type="text" class="form-control" value="{{ $company->units_count }}"
                                        name="units_count">
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('companies.creation_date') }}<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <input type="text" class="form-control creation_date"
                                        value="{{ $company->creation_date }}" name="creation_date">
                                </div>
                            </div>
 
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name"
                                        class="title-color">{{ __('companies.company_applicable_date') }}<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <input type="text" class="form-control company_applicable_date"
                                        {{-- value="{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $company->company_applicable_date)->format('d/m/Y') ?? \Carbon\Carbon::now()->format('d/m/Y')  }}" --}} name="company_applicable_date">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label class="title-color">{{ __('companies.user_name') }}<span class="text-danger">
                                            *</span></label>
                                    <input type="text" class="form-control" value="{{ $user->user_name }}"
                                        name="user_name">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label class="title-color">{{ __('companies.email') }}<span class="text-danger">
                                            *</span></label>
                                    <input type="text" class="form-control" value="{{ $user->email }}"
                                        name="email">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <label class="title-color">{{ __('companies.password') }}<span class="text-danger">
                                        *</span></label>

                                <div class="form-group input-group input-group-merge">

                                    <input type="password" class="js-toggle-password form-control" name="password"
                                        id="signupSrPassword" placeholder="{{ __('8+_characters_required') }}"
                                        aria-label="8+ characters required" value="{{ $user->my_name }}" required
                                        data-msg="Your password is invalid. Please try again."
                                        data-hs-toggle-password-options='{
                                                "target": "#changePassTarget",
                                                "defaultClass": "tio-hidden-outlined",
                                                "showClass": "tio-visible-outlined",
                                                "classChangeTarget": "#changePassIcon"
                                                }'>
                                    <div id="changePassTarget" class="input-group-append">
                                        <a class="input-group-text" href="javascript:">
                                            <i id="changePassIcon" class="tio-visible-outlined"></i>
                                        </a>
                                    </div>
                                </div>
                            </div> 
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="phone_dail_code"
                                        class="title-color">{{ __('companies.dail_code') }}</label>
                                    <select class="js-select2-custom form-control" name="phone_dail_code">
                                        <option selected value="">{{ __('general.select') }}</option>
                                        @foreach ($dail_code_main as $item_dail_code)
                                            <option value="{{ $item_dail_code->dial_code }}"
                                                {{ $item_dail_code->dial_code == $company->phone_dail_code ? 'selected' : '' }}>
                                                {{ '+' . $item_dail_code->dial_code }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('general.phone') }}</label>
                                    <input type="text" class="form-control" value="{{ $company->phone }}"
                                        name="phone">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-body">
                        <h5 class="mb-0 text-capitalize d-flex align-items-center gap-2 border-bottom pb-3 mb-4 pl-4">

                            {{ __('general.general_info') }}
                        </h5>
                        <div class="row">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('companies.country') }}<span
                                            class="text-danger"> *</span>
                                    </label>
                                    <select class="js-select2-custom form-control" name="countryid" required>
                                        <option value="{{ old('countryid') }}" selected>{{ __('general.select') }}
                                        </option>
                                        @foreach ($country as $c)
                                            <option value="{{ $c->id }}"
                                                {{ $c->id == $company->countryid ? 'selected' : '' }}>
                                                {{ $c->country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('companies.country_code') }}
                                    </label>
                                    <input type="text" class="form-control form-control-user"
                                        value="{{ $company->countryCode }}" name="countryCode" readonly>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('companies.region') }}
                                    </label>
                                    <input type="text" class="form-control form-control-user"
                                        value="{{ $company->master_region?->name }}" readonly name="region" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('companies.currency_name') }}
                                    </label>
                                    <input type="text" class="form-control form-control-user"
                                        value="{{ $company->currency }}" readonly name="currency" required>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('companies.symbol') }}
                                    </label>
                                    <input type="text" class="form-control form-control-user"
                                        value="{{ $company->symbol }}" readonly name="symbol" required>

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name"
                                        class="title-color">{{ __('companies.international_currency_code') }}
                                    </label>
                                    <input type="text" class="form-control form-control-user"
                                        value="{{ $company->currency_code }}" readonly name="international_currency_code"
                                        required>

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('companies.denomination_name') }}
                                    </label>
                                    <input type="text" class="form-control form-control-user"
                                        value="{{ $company->denomination }}" readonly name="denomination" required>

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('companies.no_of_decimals') }}
                                    </label>
                                    <input readonly type="text" name="decimals" class="form-control"
                                        value="{{ $company->decimals }}">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end gap-3 mt-3 mx-1">
                    <button type="reset" class="btn btn-secondary px-5">{{ __('general.reset') }}</button>
                    <button type="submit" class="btn btn--primary px-5">{{ ui_change('confirm') }}</button>
                </div>
            </form>
        </div>
    </div>

    
    @if (Session::has('success'))
        <script>
            swal("Message", "{{ Session::get('success') }}", 'success', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            swal("Message", "{{ Session::get('info') }}", 'info', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
@endsection
@push('script')
    <script src="{{ asset('assets/back-end') }}/js/tags-input.min.js"></script>
    <script src="{{ asset('assets/back-end/js/spartan-multi-image-picker.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('select[name="tax_type"]').on('change', function() {
                let status = $(this).val();
                if (status == 1) {
                    $(".tax_status_html").removeClass('d-none');
                } else {
                    $(".tax_status_html").addClass('d-none');
                }
            });
        });
        // document.addEventListener("DOMContentLoaded", function() {
        //     document.querySelectorAll("input, textarea").forEach(input => {
        //         let savedValue = localStorage.getItem(input.name);
        //         if (savedValue) {
        //             input.value = savedValue;
        //         }

        //         input.addEventListener("input", () => {
        //             localStorage.setItem(input.name, input.value);
        //         });
        //     });
        // });
    </script>
    <script>
        flatpickr("#financial_year_start", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
        flatpickr("#booking_beging_with", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
        flatpickr("#tax_registration_date", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
        flatpickr(".company_applicable_date", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
        flatpickr(".creation_date", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
        $(function() {
            $('#color_switcher').click(function() {
                var checkBoxes = $("#color_switcher");
                if ($('#color_switcher').prop('checked')) {
                    $('.color_image_column').removeClass('d-none');
                    $('.additional_image_column').removeClass('col-md-9');
                    $('.additional_image_column').addClass('col-md-12');
                    $('#color_wise_image').show();
                    $('#additional_Image_Section .col-md-4').addClass('col-lg-2');
                } else {
                    $('.color_image_column').addClass('d-none');
                    $('.additional_image_column').addClass('col-md-9');
                    $('.additional_image_column').removeClass('col-md-12');
                    $('#color_wise_image').hide();
                    $('#additional_Image_Section .col-md-4').removeClass('col-lg-2');
                }
            });

            $("#coba").spartanMultiImagePicker({
                fieldName: 'images[]',
                maxCount: 15,
                rowHeight: 'auto',
                groupClassName: 'col-6 col-md-4 col-lg-3 col-xl-2',
                maxFileSize: '',
                placeholderImage: {
                    image: '{{ asset('assets/back-end/img/400x400/img2.jpg') }}',
                    width: '100%',
                },
                dropFileLabel: "Drop Here",
                onAddRow: function(index, file) {

                },
                onRenderedPreview: function(index) {

                },
                onRemoveRow: function(index) {

                },
                onExtensionErr: function(index, file) {
                    toastr.error('{{ __('please_only_input_png_or_jpg_type_file') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                },
                onSizeErr: function(index, file) {
                    toastr.error('{{ __('file_size_too_big') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        function readURLSeal(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewerSeal').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function() {
            readURL(this);
        });
        $("#customFileUploadSeal").change(function() {
            readURLSeal(this);
        });


        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });
    </script>
    <script>
        $(document).on('ready', function() {
            // INITIALIZATION OF SHOW PASSWORD
            // =======================================================
            $('.js-toggle-password').each(function() {
                new HSTogglePassword(this).init()
            });

            // INITIALIZATION OF FORM VALIDATION
            // =======================================================
            $('.js-validate').each(function() {
                $.HSCore.components.HSValidation.init($(this));
            });
        });
    </script>
    <script>
        function getRequest(route, id, type) {
            $.get({
                url: route,
                dataType: 'json',
                success: function(data) {
                    if (type == 'select') {
                        $('#' + id).empty().append(data.select_tag);
                    }
                },
            });
        }

        $('input[name="colors_active"]').on('change', function() {
            if (!$('input[name="colors_active"]').is(':checked')) {
                $('#colors-selector').prop('disabled', true);
            } else {
                $('#colors-selector').prop('disabled', false);
            }
        });

        $('#choice_attributes').on('change', function() {
            $('#customer_choice_options').html(null);
            $.each($("#choice_attributes option:selected"), function() {
                add_more_customer_choice_option($(this).val(), $(this).text());
            });
        });

        function add_more_customer_choice_option(i, name) {
            let n = name.split(' ').join('');
            $('#customer_choice_options').append(
                '<div class="col-md-6"><div class="form-group"><input type="hidden" name="choice_no[]" value="' + i +
                '"><label class="title-color">' + n + '</label><input type="text" name="choice[]" value="' + n +
                '" hidden><div class=""><input type="text" class="form-control" name="choice_options_' + i +
                '[]" placeholder="{{ __('enter_choice_values') }}" data-role="tagsinput" onchange="update_sku()"></div></div></div>'
            );

            $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
        }

        $('#colors-selector').on('change', function() {
            update_sku();
            $('#color_switcher').prop('checked') {
                color_wise_image($('#colors-selector'));
            }
            $('.remove_button').on('click', function() {
                alert('ok');
                $(this).parents('.upload_images').find('.color_image').attr('src',
                    '{{ asset('assets/back-end/img/400x400/img2.jpg') }}')
            })
        });


        function color_wise_image(t) {
            let colors = t.val();
            $('#color_wise_image').html('')
            $.each(colors, function(key, value) {
                let value_id = value.replace('#', '');
                let color = "color_image_" + value_id;

                html = `<div class="col-sm-12 col-md-4">
                            <div class="custom_upload_input position-relative border-dashed-2">
                                <input type="file" name="` + color +
                    `" class="custom-upload-input-file" id="color-img-upload-` + value_id + `" data-index="1" data-imgpreview="additional_Image_${value_id}"
                                    accept=".jpg, .webp, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required onchange="uploadColorImage(this)">

                                <div class="position-absolute right-0 top-0 d-flex gap-2">
                                    <label for="color-img-upload-` + value_id + `" class="delete_file_input_css btn btn-outline-danger btn-sm square-btn position-relative" style="background: ${value};border-color: ${value};color:#fff">
                                        <i class="tio-edit"></i>
                                    </label>

                                    <span class="delete_file_input btn btn-outline-danger btn-sm square-btn position-relative" style="display: none">
                                        <i class="tio-delete"></i>
                                    </span>
                                </div>

                                <div class="img_area_with_preview position-absolute z-index-2 border-0">
                                    <img id="additional_Image_${value_id}" class="h-auto aspect-1 bg-white" src="img" onerror="this.classList.add('d-none')">
                                </div>
                                <div class="position-absolute h-100 top-0 w-100 d-flex align-content-center justify-content-center">
                                    <div class="d-flex flex-column justify-content-center align-items-center">
                                        <img src="{{ asset('assets/back-end/img/icons/product-upload-icon.svg') }}" class="w-50">
                                        <h3 class="text-muted">{{ __('Upload_Image') }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>`;

                $('#color_wise_image').append(html);

                $('.delete_file_input').click(function() {
                    let $parentDiv = $(this).parent().parent();
                    $parentDiv.find('input[type="file"]').val('');
                    $parentDiv.find('.img_area_with_preview img').attr("src", " ");
                    $(this).hide();
                });

                $('.custom-upload-input-file').on('change', function() {
                    if (parseFloat($(this).prop('files').length) != 0) {
                        let $parentDiv = $(this).closest('div');
                        $parentDiv.find('.delete_file_input').fadeIn();
                    }
                });

                uploadColorImage();
            });
        }

        function uploadColorImage(thisData = null) {
            if (thisData) {
                document.getElementById(thisData.dataset.imgpreview).setAttribute("src", window.URL.createObjectURL(thisData
                    .files[0]));
                document.getElementById(thisData.dataset.imgpreview).classList.remove('d-none');
            }
        }




        $(document).ready(function() {
            // color select select2
            $('.color-var-select').select2({
                templateResult: colorCodeSelect,
                templateSelection: colorCodeSelect,
                escapeMarkup: function(m) {
                    return m;
                }
            });

            function colorCodeSelect(state) {
                var colorCode = $(state.element).val();
                if (!colorCode) return state.text;
                return "<span class='color-preview' style='background-color:" + colorCode + ";'></span>" + state
                    .text;
            }
        });
    </script>



    <script>
        $(document).ready(function() {
            $('select[name="countryid"]').on('change', function() {
                var country_master_id = $(this).val();
                if (country_master_id) {
                    $.ajax({
                        url: "{{ route('admin.get_country_master', ':id') }}".replace(':id',
                            country_master_id),
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                console.log(data)
                                $('input[name="countryCode"]').empty();
                                $('input[name="countryCode"]').removeAttr('disabled');
                                $('input[name="countryCode"]').val(data.country_code);
                                $('input[name="region"]').empty();
                                $('input[name="region"]').removeAttr('disabled');
                                $('input[name="region"]').val(data.region.name);
                                $('input[name="currency"]').empty();
                                $('input[name="currency"]').removeAttr('disabled');
                                $('input[name="currency"]').val(data.currency_name);
                                $('input[name="symbol"]').empty();
                                $('input[name="symbol"]').removeAttr('disabled');
                                $('input[name="symbol"]').val(data.currency_symbol);
                                $('input[name="international_currency_code"]').empty();
                                $('input[name="international_currency_code"]').removeAttr(
                                    'disabled');
                                $('input[name="international_currency_code"]').val(data
                                    .international_currency_code);
                                $('input[name="denomination"]').empty();
                                $('input[name="denomination"]').removeAttr('disabled');
                                $('input[name="denomination"]').val(data.denomination_name);
                                $('input[name="decimals"]').empty();
                                $('input[name="decimals"]').removeAttr('disabled');
                                $('input[name="decimals"]').val(data.no_of_decimals);


                            } else {}
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                        }
                    });
                }

            });


        });
    </script>

    {{-- ck editor --}}
    <script src="{{ asset('/') }}vendor/ckeditor/ckeditor/ckeditor.js"></script>
    <script src="{{ asset('/') }}vendor/ckeditor/ckeditor/adapters/jquery.js"></script>

    {{-- ck editor --}}
@endpush
