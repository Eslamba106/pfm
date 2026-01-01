@extends('layouts.back-end.app')
@php
    $lang = session()->get('locale');
@endphp

@section('title')
    {{ ui_change('create_block_management' , 'property_config') }}
@endsection
@push('css_or_js')
    <link href="{{ asset('assets/back-end/css/tags-input.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #dedede;
            border: 1px solid #dedede;
            border-radius: 2px;
            color: #222;
            display: flex;
            gap: 4px;
            align-items: center;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                {{-- <img width="20px" src="{{ asset('/assets/back-end/img/property.jpg') }}" alt=""> --}}
                {{ ui_change('create_block_management' , 'property_config')  }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.property_config.inline-menu')

        <!-- Form -->
        <form class="product-form text-start" action="{{ route('block_management.store') }}" method="POST"
            enctype="multipart/form-data" id="product_form">
            @csrf


            <!-- general setup -->
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        {{-- <img width="20px" src="{{ asset('/assets/back-end/img/property.jpg') }}" class="mb-1"
                            alt=""> --}}
                        <h4 class="mb-0">{{ ui_change('general_info' , 'property_config') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12 col-lg-4 col-xl-12">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ ui_change('property' , 'property_config') }}
                                </label>
                                <select class="js-select2-custom form-control" id="property_management_id"
                                    name="property_management_id" required>
                                    <option selected>{{ ui_change('select' , 'property_config') }}</option>
                                    @foreach ($property_managements as $property_management)
                                        <option value="{{ $property_management->id }}">{{ $property_management->name . ' - ' . $property_management->code }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('property_management_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- {{ dd($blocks) }} --}}
                        <div class="col-md-12 col-lg-4 col-xl-12">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ ui_change('blocks' , 'property_config') }}
                                </label>
                                <select class="js-select2-custom form-control" id="block_list" name="block_id[]" disabled
                                    required multiple>
                                    @foreach ($blocks as $block)
                                        <option value="{{ $block->id }}">{{ $block->name . ' - ' . $block->code }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('block_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <div class="row justify-content-end gap-3 mt-3 mx-1">
                <button type="reset" class="btn btn-secondary px-5">{{ ui_change('reset' , 'property_config') }}</button>
                <button type="submit" class="btn btn--primary px-5">{{ ui_change('submit' , 'property_config') }}</button>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script src="{{ asset('assets/back-end') }}/js/tags-input.min.js"></script>
    <script src="{{ asset('assets/back-end/js/spartan-multi-image-picker.js') }}"></script>

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
        $('#property_management_id').on('change', function() {
            var property_management = $('#property_management_id').val();


            $.ajax({
                url: "{{ route('get_blocks_by_property') }}",
                type: "GET",
                dataType: "json",
                data: {
                    property_management_id: property_management,

                },
                success: function(data) {
                    $('#block_list').removeAttr('disabled');
                    $('#block_list').empty();
                    if (data.length > 0) {
                        $.each(data, function(index, block) {
                            $('#block_list').append(
                                `<option value="${block.id}">${block.name + ' - ' +block.code }</option>`
                            );
                        });


                    } else {
                        $('#block_list').append(
                            '<tr><td colspan="10">No units found matching.</td></tr>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: ", error);
                    alert("An error occurred while processing your request.");
                }
            });
        });
    </script>
@endpush
