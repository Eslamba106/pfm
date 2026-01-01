@extends('layouts.back-end.app')

@section('title', ui_change('create_unit_management' , 'property_config'))
@php
    $lang = Session::get('locale');
@endphp
@push('css_or_js')
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">
    <style>
        .unit-type-container {
            width: 80%;
            margin: auto;
            font-family: Arial, sans-serif;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        select {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
        }

        .unit-type-rows {
            border-top: 1px solid #ccc;
            padding-top: 15px;
        }

        .unit-type-row {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
            align-items: center;
        }

        .unit-type-row>div {
            flex: 1;
        }


        .unit-description-container {
            width: 80%;
            margin: auto;
            font-family: Arial, sans-serif;
        }

        .unit-description-rows {
            border-top: 1px solid #ccc;
            padding-top: 15px;
        }

        .unit-description-row {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
            align-items: center;
        }

        .unit-description-row>div {
            flex: 1;
        }

        .unit-condition-container {
            width: 80%;
            margin: auto;
            font-family: Arial, sans-serif;
        }

        .unit-condition-rows {
            border-top: 1px solid #ccc;
            padding-top: 15px;
        }

        .unit-condition-row {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
            align-items: center;
        }

        .unit-condition-row>div {
            flex: 1;
        }

        .unit-parking-container {
            width: 80%;
            margin: auto;
            font-family: Arial, sans-serif;
        }

        .unit-parking-rows {
            border-top: 1px solid #ccc;
            padding-top: 15px;
        }

        .unit-parking-row {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
            align-items: center;
        }

        .unit-parking-row>div {
            flex: 1;
        }

        .view-container {
            width: 80%;
            margin: auto;
            font-family: Arial, sans-serif;
        }

        .view-rows {
            border-top: 1px solid #ccc;
            padding-top: 15px;
        }

        .view-row {
            display: flex;
            gap: 15px;
            margin-bottom: 10px;
            align-items: center;
        }

        .view-row>div {
            flex: 1;
        }



        button {
            padding: 5px 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 3px;
        }

        button:hover {
            background-color: #218838;
        }

        .remove-row {
            background-color: #dc3545;
        }

        .remove-row:hover {
            background-color: #c82333;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                {{-- <img src="{{ asset(main_path() . 'back-end/img/inhouse-product-list.png') }}" alt=""> --}}
                {{ ui_change('create_unit_management' ,'property_config') }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.property_config.inline-menu')

        <!-- Form -->
        <form class="product-form text-start" action="{{ route('unit_management.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <!-- general setup -->
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        {{-- <img src="{{ asset(main_path() . 'back-end/img/shop-information.png') }}" class="mb-1"
                            alt=""> --}}
                        <h4 class="mb-0">{{ ui_change('create_unit_management', 'property_config') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ ui_change('property', 'property_config') }}
                                </label>
                                <select class="js-select2-custom form-control" name="property" id="property" required>
                                    <option selected disabled>{{ ui_change('select', 'property_config') }}
                                    </option>
                                    @foreach ($property as $property_item)
                                        <option value="{{ $property_item->id }}">
                                            {{ $property_item->name .' - '.$property_item->code  }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ ui_change('blocks', 'property_config') }}
                                </label>
                                <select class="js-select2-custom form-control" name="block" id="block" required
                                    disabled>
                                    <option selected>{{ ui_change('select', 'property_config') }}
                                    </option>
                                    @foreach ($blocks as $block_item)
                                        <option value="{{ $block_item->id }}">
                                            {{ $block_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ ui_change('floors', 'property_config') }}
                                </label>
                                <select class="js-select2-custom form-control" name="floor" id="floor" required
                                    disabled>
                                    <option selected>{{ ui_change('select', 'property_config') }}
                                    </option>
                                    @foreach ($floors as $floor_item)
                                        <option value="{{ $floor_item->id }}">
                                            {{ $floor_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ ui_change('start_up_unit', 'property_config') }}
                                </label>
                                <select class="js-select2-custom form-control" name="start_up_unit" id="start_up_unit"
                                    required disabled>
                                    <option selected>{{ ui_change('select', 'property_config') }}
                                    </option>
                                    @foreach ($units as $unit_item)
                                        <option value="{{ $unit_item->id }}">
                                            {{ $unit_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="token" class="title-color">{{ ui_change('Total_No._Unit_*', 'property_config') }}</label>
                                <input type="number" disabled class="form-control" name="unit_count" id="no_of_unit"
                                    required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <input type="hidden" name="status" value="approved">
                    <h5 class="mb-0 text-capitalize d-flex align-items-center gap-2 border-bottom pb-3 mb-4 pl-4">
                        {{-- <img width="30px" src="{{ asset('/assets/back-end/img/unit_description_main.jpg') }}" class="mb-1"
                            alt=""> --}}
                        {{ ui_change('unit_description', 'property_config') }}
                    </h5>
                    <div class="unit-description-container d-flex justify-content-between">
                        <div class="form-group  col-md-6 col-lg-4 col-xl-6 ">
                            <label>{{ ui_change('unit_description_mode', 'property_config') }}</label>
                            <div class="form-check form-check-inline">
                                <label class="m-1">
                                    <input type="radio" name="unit_description_mode" value="default"
                                        id="unit_description_mode_default" checked>
                                    {{ ui_change('default', 'property_config') }}
                                </label>
                                <label class="m-1">
                                    <input type="radio" disabled name="unit_description_mode"
                                        id="unit_description_mode_range" value="range">
                                    {{ ui_change('range', 'property_config') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group  col-md-6 col-lg-4 col-xl-6 general_unit_description">
                            <label>{{ ui_change('unit_description', 'property_config') }}</label>
                            <select name="unit_description[]" class="js-select2-custom form-control"
                                id="general_unit_description">
                                {{-- <option value="0" selected>{{ ui_change('property_management.no_applicable') }}</option> --}}
                                @foreach ($unit_descriptions as $unit_description_item)
                                    <option value="{{ $unit_description_item->id }}">{{ $unit_description_item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="unit-description-container d-none unit_description">
                        <div class="unit-description-rows" id="unit-description-container">
                            <div class="row unit-description-row">
                                <div>
                                    <label>{{ ui_change('unit_start', 'property_config') }}</label>
                                    <select class="js-select2-custom form-control unit-select-description-start"
                                        name="unit_start_unit_description[]">

                                    </select>
                                </div>
                                <div>
                                    <label>{{ ui_change('unit_end', 'property_config') }}</label>
                                    <select class="js-select2-custom form-control unit-select-description-end"
                                        name="unit_end_unit_description[]">

                                    </select>
                                </div>
                                <div>
                                    <label>{{ ui_change('unit_description', 'property_config') }}</label>
                                    <select class="js-select2-custom form-control" name="unit_description[]">
                                        @foreach ($unit_descriptions as $unit_description_item)
                                            <option value="{{ $unit_description_item->id }}">
                                                {{ $unit_description_item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <button type="button" id="add-more-unit-description" class="col-xl-12">+
                            {{ ui_change('add_more', 'property_config') }}</button>


                    </div>

                </div>

            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <input type="hidden" name="status" value="approved">
                    <h5 class="mb-0 text-capitalize d-flex align-items-center gap-2 border-bottom pb-3 mb-4 pl-4">
                        {{-- <img width="30px" src="{{ asset('/assets/back-end/img/unit_type.png') }}" class="mb-1"
                            alt=""> --}}
                        {{ ui_change('unit_type', 'property_config') }}
                    </h5>
                    <div class="unit-type-container d-flex justify-content-between">
                        <div class="form-group  col-md-6 col-lg-4 col-xl-6 ">
                            <label>{{ ui_change('unit_type_mode', 'property_config') }}</label>
                            <div class="form-check form-check-inline">
                                <label class="m-1">
                                    <input type="radio" name="unit_type_mode" value="default"
                                        id="unit_type_mode_default" checked>
                                    {{ ui_change('default', 'property_config') }}
                                </label>
                                <label class="m-1">
                                    <input type="radio" disabled name="unit_type_mode" id="unit_type_mode_range"
                                        value="range">
                                    {{ ui_change('range', 'property_config') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group  col-md-6 col-lg-4 col-xl-6 general_unit_type">
                            <label>{{ ui_change('unit_type', 'property_config') }}</label>
                            <select name="unit_type[]" class="js-select2-custom form-control" id="general_unit_type">
                                <option value="0" selected>{{ ui_change('no_applicable', 'property_config') }}</option>
                                @foreach ($unit_types as $unit_type_item)
                                    <option value="{{ $unit_type_item->id }}">{{ $unit_type_item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="unit-type-container d-none unit_type">
                        <div class="unit-type-rows" id="unit-type-container">
                            <div class="row unit-type-row">
                                <div>
                                    <label>{{ ui_change('unit_start', 'property_config') }}</label>
                                    <select class="js-select2-custom form-control unit-select-type-start"
                                        name="unit_start_unit_type[]">

                                    </select>
                                </div>
                                <div>
                                    <label>{{ ui_change('unit_end', 'property_config') }}</label>
                                    <select class="js-select2-custom form-control unit-select-type-end"
                                        name="unit_end_unit_type[]">

                                    </select>
                                </div>
                                <div>
                                    <label>{{ ui_change('unit_type', 'property_config') }}</label>
                                    <select class="js-select2-custom form-control" name="unit_type[]">
                                        @foreach ($unit_types as $unit_type_item)
                                            <option value="{{ $unit_type_item->id }}">{{ $unit_type_item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <button type="button" id="add-more-unit-type" class="col-xl-12">+
                            {{ ui_change('add_more', 'property_config') }}</button>


                    </div>

                </div>

            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <input type="hidden" name="status" value="approved">
                    <h5 class="mb-0 text-capitalize d-flex align-items-center gap-2 border-bottom pb-3 mb-4 pl-4">
                        {{-- <img width="30px" src="{{ asset('/assets/back-end/img/rooms.png') }}" class="mb-1"
                            alt=""> --}}
                        {{ ui_change('unit_condition', 'property_config') }}
                    </h5>
                    <div class="unit-condition-container d-flex justify-content-between">
                        <div class="form-group  col-md-6 col-lg-4 col-xl-6 ">
                            <label>{{ ui_change('unit_condition_mode', 'property_config') }}</label>
                            <div class="form-check form-check-inline">
                                <label class="m-1">
                                    <input type="radio" name="unit_condition_mode" value="default"
                                        id="unit_condition_mode_default" checked>
                                    {{ ui_change('default', 'property_config') }}
                                </label>
                                <label class="m-1">
                                    <input type="radio" disabled name="unit_condition_mode"
                                        id="unit_condition_mode_range" value="range">
                                    {{ ui_change('range', 'property_config') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group  col-md-6 col-lg-4 col-xl-6 general_unit_condition">
                            <label>{{ ui_change('unit_condition', 'property_config') }}</label>
                            <select name="unit_condition[]" class="js-select2-custom form-control"
                                id="general_unit_condition">
                                <option value="0" selected>{{ ui_change('no_applicable', 'property_config') }}</option>
                                @foreach ($unit_conditions as $unit_condition_item)
                                    <option value="{{ $unit_condition_item->id }}">{{ $unit_condition_item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="unit-condition-container d-none unit_condition">
                        <div class="unit-condition-rows" id="unit-condition-container">
                            <div class="row unit-condition-row">
                                <div>
                                    <label>{{ ui_change('unit_start', 'property_config') }}</label>
                                    <select class="js-select2-custom form-control unit-select-condition-start"
                                        name="unit_start_unit_condition[]">

                                    </select>
                                </div>
                                <div>
                                    <label>{{ ui_change('unit_end', 'property_config') }}</label>
                                    <select class="js-select2-custom form-control unit-select-condition-start"
                                        name="unit_end_unit_condition[]">

                                    </select>
                                </div>
                                <div>
                                    <label>{{ ui_change('unit_condition', 'property_config') }}</label>
                                    <select class="js-select2-custom form-control" name="unit_condition[]">
                                        @foreach ($unit_conditions as $unit_condition_item)
                                            <option value="{{ $unit_condition_item->id }}">
                                                {{ $unit_condition_item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <button type="button" id="add-more-unit-condition" class="col-xl-12">+
                            {{ ui_change('add_more', 'property_config') }}</button>


                    </div>

                </div>

            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <input type="hidden" name="status" value="approved">
                    <h5 class="mb-0 text-capitalize d-flex align-items-center gap-2 border-bottom pb-3 mb-4 pl-4">
                        {{-- <img width="30px" src="{{ asset('/assets/back-end/img/views.jpg') }}" class="mb-1"
                            alt=""> --}}
                        {{ ui_change('view', 'property_config') }}
                    </h5>
                    <div class="view-container d-flex justify-content-between">
                        <div class="form-group  col-md-6 col-lg-4 col-xl-6 ">
                            <label>{{ ui_change('view_mode', 'property_config') }}</label>
                            <div class="form-check form-check-inline">
                                <label class="m-1">
                                    <input type="radio" name="view_mode" value="default" id="view_mode_default"
                                        checked>
                                    {{ ui_change('default', 'property_config') }}
                                </label>
                                <label class="m-1">
                                    <input type="radio" disabled name="view_mode" id="view_mode_range" value="range">
                                    {{ ui_change('range', 'property_config') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group  col-md-6 col-lg-4 col-xl-6 general_view">
                            <label>{{ ui_change('view', 'property_config') }}</label>
                            <select name="view[]" class="js-select2-custom form-control" id="general_view">
                                <option value="0" selected>{{ ui_change('no_applicable', 'property_config') }}</option>
                                @foreach ($views as $view_item)
                                    <option value="{{ $view_item->id }}">{{ $view_item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="view-container d-none view">
                        <div class="view-rows" id="view-container">
                            <div class="row view-row">
                                <div>
                                    <label>{{ ui_change('unit_start', 'property_config') }}</label>
                                    <select class="js-select2-custom form-control unit-select-view-start"
                                        name="unit_start_view[]">

                                    </select>
                                </div>
                                <div>
                                    <label>{{ ui_change('unit_end', 'property_config') }}</label>
                                    <select class="js-select2-custom form-control unit-select-view-start"
                                        name="unit_end_view[]">

                                    </select>
                                </div>
                                <div>
                                    <label>{{ ui_change('view', 'property_config') }}</label>
                                    <select class="js-select2-custom form-control" name="view[]">
                                        @foreach ($views as $view_item)
                                            <option value="{{ $view_item->id }}">
                                                {{ $view_item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <button type="button" id="add-more-view" class="col-xl-12">+
                            {{ ui_change('add_more', 'property_config') }}</button>


                    </div>

                </div>

            </div>
            <div class="card mt-3">
                <div class="card-body">
                    <input type="hidden" name="status" value="approved">
                    <h5 class="mb-0 text-capitalize d-flex align-items-center gap-2 border-bottom pb-3 mb-4 pl-4">
                        {{-- <img width="30px" src="{{ asset('/assets/back-end/img/unit_parking.jpg') }}" class="mb-1"
                            alt=""> --}}
                        {{ ui_change('unit_parking', 'property_config') }}
                    </h5>
                    <div class="unit-parking-container d-flex justify-content-between">
                        <div class="form-group  col-md-6 col-lg-4 col-xl-6 ">
                            <label>{{ ui_change('unit_parking_mode', 'property_config') }}</label>
                            <div class="form-check form-check-inline">
                                <label class="m-1">
                                    <input type="radio" name="unit_parking_mode" value="default"
                                        id="unit_parking_mode_default" checked>
                                    {{ ui_change('default', 'property_config') }}
                                </label>
                                <label class="m-1">
                                    <input type="radio" disabled name="unit_parking_mode" id="unit_parking_mode_range"
                                        value="range">
                                    {{ ui_change('range', 'property_config') }}
                                </label>
                            </div>
                        </div>

                        <div class="form-group  col-md-6 col-lg-4 col-xl-6 general_unit_parking">
                            <label>{{ ui_change('unit_parking', 'property_config') }}</label>
                            <select name="unit_parking[]" class="js-select2-custom form-control"
                                id="general_unit_parking">
                                <option value="0" selected>{{ ui_change('no_applicable', 'property_config') }}</option>
                                @foreach ($unit_parkings as $unit_parking_item)
                                    <option value="{{ $unit_parking_item->id }}">{{ $unit_parking_item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="unit-parking-container d-none unit_parking">
                        <div class="unit-parking-rows" id="unit-parking-container">
                            <div class="row unit-parking-row">
                                <div>
                                    <label>{{ ui_change('unit_start', 'property_config') }}</label>
                                    <select class="js-select2-custom form-control  unit-select-parking-start"
                                        name="unit_start_unit_parking[]">

                                    </select>
                                </div>
                                <div>
                                    <label>{{ ui_change('unit_end', 'property_config') }}</label>
                                    <select class="js-select2-custom form-control unit-select-parking-start"
                                        name="unit_end_unit_parking[]">

                                    </select>
                                </div>
                                <div>
                                    <label>{{ ui_change('unit_parking', 'property_config') }}</label>
                                    <select class="js-select2-custom form-control" name="unit_parking[]">
                                        @foreach ($unit_parkings as $unit_parking_item)
                                            <option value="{{ $unit_parking_item->id }}">
                                                {{ $unit_parking_item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                        <button type="button" id="add-more-unit-parking" class="col-xl-12">+
                            {{ ui_change('add_more', 'property_config') }}</button>


                    </div>

                </div>

            </div>


            <div class="row justify-content-end gap-3 mt-3 mx-1">
                <button type="reset" class="btn btn-secondary px-5">{{ ui_change('reset', 'property_config') }}</button>
                <button type="submit" class="btn btn--primary px-5">{{ ui_change('submit', 'property_config') }}</button>
            </div>
        </form>



    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('select[name="property"]').on('change', function() {
                var property = $(this).val();
                if (property) {
                    $.ajax({
                        url: "{{ URL::to('unit_management/get_blocks_by_property_id') }}/" +
                            property,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('select[name="block"]').removeAttr('disabled');

                                // $('select[name="block"]').empty();
                                $('select[name="block"]').empty().append(
                                    '<option value=""  selected>{{ ui_change('select', 'property_config') }}</option>'
                                );
                                $.each(data, function(key, value) {
                                    $('select[name="block"]').append(
                                        '<option value="' + value.id + '">' + value
                                        .block.name + ' - ' + value.block.code + '</option>'
                                    )
                                })

                            } else {
                                // $('input[name="token"]').removeAttr('disabled')
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                            // $('input[name="token"]').removeAttr('disabled')
                            //
                        }
                    });
                }

            });
            $('select[name="block"]').on('change', function() {
                var block = $(this).val();
                if (block) {
                    $.ajax({
                        url: "{{ URL::to('unit_management/get_floors_by_block_id') }}/" + block,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('select[name="floor"]').removeAttr('disabled');

                                $('select[name="floor"]').empty().append(
                                    '<option value=""  selected>{{ ui_change('select' ,'property_config')  }}</option>'
                                );
                                $.each(data, function(key, value) {
                                    $('select[name="floor"]').append(
                                        '<option value="' + value.id +
                                        '">' + value
                                        .floor_management_main.name + ' - ' + value.floor_management_main.code+ '</option>'
                                    )
                                })

                            } else {
                                // $('input[name="token"]').removeAttr('disabled')
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                            // $('input[name="token"]').removeAttr('disabled')
                            //
                        }
                    });
                }

            });

            $('select[name="floor"]').on('change', function() {
                var floor = $(this).val();
                var block = $('select[name="block"]').val();
                var property = $('select[name="property"]').val();
                if (floor) {
                    $.ajax({
                        url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                            "/" + block + "/" + property,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('select[name="start_up_unit"]').removeAttr('disabled');

                                $('select[name="start_up_unit"]').empty().append(
                                    '<option value=""  selected>{{ ui_change('select' ,'property_config') }}</option>'
                                );
                                $.each(data, function(key, value) {
                                    $('select[name="start_up_unit"]').append(
                                        '<option value="' + value.id +
                                        '">' + value.name + '</option>'
                                    )
                                })

                            } else {
                                // $('input[name="token"]').removeAttr('disabled')
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                            // $('input[name="token"]').removeAttr('disabled')
                            //
                        }
                    });
                }

            });

            $('#start_up_unit').on('change', function() {
                $('#no_of_unit').removeAttr('disabled');
            })
            $('#no_of_unit').on('change', function() {
                $('#unit_type_mode_range').removeAttr('disabled');
                $('#unit_description_mode_range').removeAttr('disabled');
                $('#unit_condition_mode_range').removeAttr('disabled');
                $('#unit_parking_mode_range').removeAttr('disabled');
                $('#view_mode_range').removeAttr('disabled');
            })
            $('#unit_type_mode_default').on('click', function() {
                $('#general_unit_type').attr('disabled', false);
                $('.unit_type').addClass('d-none');
            })
            $('#unit_description_mode_default').on('click', function() {
                $('#general_unit_description').attr('disabled', false);
                $('.unit_description').addClass('d-none');
            })
            $('#unit_condition_mode_default').on('click', function() {
                $('#general_unit_condition').attr('disabled', false);
                $('.unit_condition').addClass('d-none');
            })
            $('#unit_parking_mode_default').on('click', function() {
                $('#general_unit_parking').attr('disabled', false);
                $('.unit_parking').addClass('d-none');
            })
            $('#view_mode_default').on('click', function() {
                $('#general_view').attr('disabled', false);
                $('.view').addClass('d-none');
            })

            $('#unit_type_mode_range').on('click', function() {
                $('#general_unit_type').attr('disabled', true);
                $('.unit_type').removeClass('d-none');
                var start_up_unit = $('#start_up_unit').val();
                var unit_count = $('#no_of_unit').val();

                var floor = $('select[name="floor"]').val();
                var block = $('select[name="block"]').val();
                var property = $('select[name="property"]').val();
                if (floor) {
                    $.ajax({
                        url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                            "/" + block + "/" + property,
                        type: "GET",
                        data: {
                            "start_up_unit": start_up_unit,
                            "unit_count": unit_count
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('select[name="unit_start_unit_type"]').removeAttr('disabled');

                                $('select[name="unit_start_unit_type"]').empty().append(
                                    '<option value=""  selected>{{ ui_change('select' ,'property_config') }}</option>'
                                );
                                $('select[name="unit_start_unit_type[]"]').empty();
                                $('select[name="unit_end_unit_type[]"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="unit_start_unit_type[]"]').append(
                                        '<option value="' + value.id +
                                        '">' + value.name + '</option>'
                                    )
                                    $('select[name="unit_end_unit_type[]"]').append(
                                        '<option value="' + value.id +
                                        '">' + value.name + '</option>'
                                    )
                                })

                            } else {
                                // $('input[name="token"]').removeAttr('disabled')
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                            // $('input[name="token"]').removeAttr('disabled')
                            //
                        }
                    });
                }


            })
            $('#unit_description_mode_range').on('click', function() {
                $('#general_unit_description').attr('disabled', true);
                $('.unit_description').removeClass('d-none');
                var start_up_unit = $('#start_up_unit').val();
                var unit_count = $('#no_of_unit').val();

                var floor = $('select[name="floor"]').val();
                var block = $('select[name="block"]').val();
                var property = $('select[name="property"]').val();
                if (floor) {
                    $.ajax({
                        url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                            "/" + block + "/" + property,
                        type: "GET",
                        data: {
                            "start_up_unit": start_up_unit,
                            "unit_count": unit_count
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('select[name="unit_start_unit_description"]').removeAttr(
                                    'disabled');

                                $('select[name="unit_start_unit_description"]').empty().append(
                                    '<option value=""  selected>{{ ui_change('select' ,'property_config') }}</option>'
                                );
                                $('select[name="unit_start_unit_description[]"]').empty();
                                $('select[name="unit_end_unit_description[]"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="unit_start_unit_description[]"]')
                                        .append(
                                            '<option value="' + value.id +
                                            '">' + value.name + '</option>'
                                        )
                                    $('select[name="unit_end_unit_description[]"]')
                                        .append(
                                            '<option value="' + value.id +
                                            '">' + value.name + '</option>'
                                        )
                                })

                            } else {}
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                        }
                    });
                }


            })
            $('#unit_condition_mode_range').on('click', function() {
                $('#general_unit_condition').attr('disabled', true);
                $('.unit_condition').removeClass('d-none');
                var start_up_unit = $('#start_up_unit').val();
                var unit_count = $('#no_of_unit').val();

                var floor = $('select[name="floor"]').val();
                var block = $('select[name="block"]').val();
                var property = $('select[name="property"]').val();
                if (floor) {
                    $.ajax({
                        url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                            "/" + block + "/" + property,
                        type: "GET",
                        data: {
                            "start_up_unit": start_up_unit,
                            "unit_count": unit_count
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('select[name="unit_start_unit_condition"]').removeAttr(
                                    'disabled');

                                $('select[name="unit_start_unit_condition"]').empty().append(
                                    '<option value=""  selected>{{ ui_change('select' ,'property_config') }}</option>'
                                );
                                $('select[name="unit_start_unit_condition[]"]').empty();
                                $('select[name="unit_end_unit_condition[]"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="unit_start_unit_condition[]"]')
                                        .append(
                                            '<option value="' + value.id +
                                            '">' + value.name + '</option>'
                                        )
                                    $('select[name="unit_end_unit_condition[]"]')
                                        .append(
                                            '<option value="' + value.id +
                                            '">' + value.name + '</option>'
                                        )
                                })

                            } else {}
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                        }
                    });
                }


            })
            $('#unit_parking_mode_range').on('click', function() {
                $('#general_unit_parking').attr('disabled', true);
                $('.unit_parking').removeClass('d-none');
                var start_up_unit = $('#start_up_unit').val();
                var unit_count = $('#no_of_unit').val();

                var floor = $('select[name="floor"]').val();
                var block = $('select[name="block"]').val();
                var property = $('select[name="property"]').val();
                if (floor) {
                    $.ajax({
                        url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                            "/" + block + "/" + property,
                        type: "GET",
                        data: {
                            "start_up_unit": start_up_unit,
                            "unit_count": unit_count
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('select[name="unit_start_unit_parking"]').removeAttr(
                                    'disabled');

                                $('select[name="unit_start_unit_parking"]').empty().append(
                                    '<option value=""  selected>{{ ui_change('select' ,'property_config') }}</option>'
                                );
                                $('select[name="unit_start_unit_parking[]"]').empty();
                                $('select[name="unit_end_unit_parking[]"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="unit_start_unit_parking[]"]')
                                        .append(
                                            '<option value="' + value.id +
                                            '">' + value.name + '</option>'
                                        )
                                    $('select[name="unit_end_unit_parking[]"]').append(
                                        '<option value="' + value.id +
                                        '">' + value.name + '</option>'
                                    )
                                })

                            } else {}
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                        }
                    });
                }


            })
            $('#view_mode_range').on('click', function() {
                $('#general_view').attr('disabled', true);
                $('.view').removeClass('d-none');
                var start_up_unit = $('#start_up_unit').val();
                var unit_count = $('#no_of_unit').val();

                var floor = $('select[name="floor"]').val();
                var block = $('select[name="block"]').val();
                var property = $('select[name="property"]').val();
                if (floor) {
                    $.ajax({
                        url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                            "/" + block + "/" + property,
                        type: "GET",
                        data: {
                            "start_up_unit": start_up_unit,
                            "unit_count": unit_count
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('select[name="unit_start_view"]').removeAttr('disabled');

                                $('select[name="unit_start_view"]').empty().append(
                                    '<option value=""  selected>{{ ui_change('select' ,'property_config') }}</option>'
                                );
                                $('select[name="unit_start_view[]"]').empty();
                                $('select[name="unit_end_view[]"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="unit_start_view[]"]').append(
                                        '<option value="' + value.id +
                                        '">' + value.name + '</option>'
                                    )
                                    $('select[name="unit_end_view[]"]').append(
                                        '<option value="' + value.id +
                                        '">' + value.name + '</option>'
                                    )
                                })

                            } else {}
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                        }
                    });
                }


            })


        });


        $(document).ready(function() {
   
            let addedUnitDescIds = [];
            let addedUnitTypeIds = [];
            let addedUnitCondIds = [];
            let addedUnitViewIds = [];
            let addedUnitParkIds = [];
           


            $('#add-more-unit-type').on('click', function() {
                var start_up_unit = $('#start_up_unit').val();
                var unit_count = $('#no_of_unit').val();

                var floor = $('select[name="floor"]').val();
                var block = $('select[name="block"]').val();
                var property = $('select[name="property"]').val();
                $('.unit-select-type-start option:selected, .unit-select-type-end option:selected').each(
                    function() {
                        const val = $(this).val();
                        if (val && !addedUnitTypeIds.includes(parseInt(val))) {
                            addedUnitTypeIds.push(parseInt(val));
                        }
                    });
                if (floor) {
                    $.ajax({
                        url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                            "/" + block + "/" + property,
                        type: "GET",
                        data: {
                            "start_up_unit": start_up_unit,
                            "unit_count": unit_count
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                var unitOptions = '';

                                $.each(data, function(key, value) {
                                    if (!addedUnitTypeIds.includes(value.id)) {
                                        unitOptions +=
                                            `<option value="${value.id}">${value.name}</option>`;
                                    }
                                });

                                if (unitOptions === '') {
                                    alert('You Dont Have Units');
                                    return;
                                }

                                const unitTypeRow = `
                    <div class="row unit-type-row mt-3">
                        <div class="col-md-3">
                            <label>Unit Start</label>
                            <select class="js-select2-custom form-control unit-select-type-start" name="unit_start_unit_type[]">
                                ${unitOptions}
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Unit End</label>
                            <select class="js-select2-custom form-control unit-select-type-end" name="unit_end_unit_type[]">
                                ${unitOptions}
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>{{ ui_change('unit_type' ,'property_config')  }}</label>
                            <select class="js-select2-custom form-control" name="unit_type[]">
                                @foreach ($unit_types as $unit_type_item)
                                <option value="{{ $unit_type_item->id }}">{{ $unit_type_item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-remove"><i class="tio-delete"></i></button>
                        </div>
                    </div>`;

                                $('#unit-type-container').append(unitTypeRow);
                                $('.js-select2-custom').select2();
                                $('.unit-select-start option:selected, .unit-select-type-end option:selected')
                                    .each(function() {
                                        const val = $(this).val();
                                        if (val && !addedUnitTypeIds.includes(val)) {
                                            addedUnitTypeIds.push(parseInt(val));
                                        }
                                    });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                        }
                    });
                }
            });
            $(document).on('click', '.btn-remove', function() {
                const parentRow = $(this).closest('.unit-type-row');
                const startUnitId = parentRow.find('.unit-select-start').val();
                const endUnitId = parentRow.find('.unit-select-end').val();
                addedUnitTypeIds = addedUnitTypeIds.filter(id => id != startUnitId && id != endUnitId);
                parentRow.remove();
            });
            $('#add-more-unit-condition').on('click', function() {
                var start_up_unit = $('#start_up_unit').val();
                var unit_count = $('#no_of_unit').val();

                var floor = $('select[name="floor"]').val();
                var block = $('select[name="block"]').val();
                var property = $('select[name="property"]').val();
                $('.unit-select-condition-start option:selected, .unit-select-condition-end option:selected')
                    .each(function() {
                        const val = $(this).val();
                        if (val && !addedUnitCondIds.includes(parseInt(val))) {
                            addedUnitCondIds.push(parseInt(val));
                        }
                    });
                if (floor) {
                    $.ajax({
                        url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                            "/" + block + "/" + property,
                        type: "GET",
                        data: {
                            "start_up_unit": start_up_unit,
                            "unit_count": unit_count
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                var unitOptions = '';

                                $.each(data, function(key, value) {
                                    if (!addedUnitCondIds.includes(value.id)) {
                                        unitOptions +=
                                            `<option value="${value.id}">${value.name}</option>`;
                                    }
                                });

                                if (unitOptions === '') {
                                    alert('You Dont Have Units');
                                    return;
                                }

                                const unitTypeRow = `
                    <div class="row unit-condition-row mt-3">
                        <div class="col-md-3">
                            <label>Unit Start</label>
                            <select class="js-select2-custom form-control unit-select-condition-start" name="unit_start_unit_condition[]">
                                ${unitOptions}
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Unit End</label>
                            <select class="js-select2-custom form-control unit-select-condition-end" name="unit_end_unit_condition[]">
                                ${unitOptions}
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>{{ ui_change('unit_condition' ,'property_config')  }}</label>
                            <select class="js-select2-custom form-control" name="unit_condition[]">
                                @foreach ($unit_conditions as $unit_condition_item)
                                <option value="{{ $unit_condition_item->id }}">{{ $unit_condition_item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-remove"><i class="tio-delete"></i></button>
                        </div>
                    </div>`;

                                $('#unit-condition-container').append(unitTypeRow);
                                $('.js-select2-custom').select2();
                                $('.unit-select-condition-start option:selected, .unit-select-condition-end option:selected')
                                    .each(function() {
                                        const val = $(this).val();
                                        if (val && !addedUnitCondIds.includes(val)) {
                                            addedUnitCondIds.push(parseInt(val));
                                        }
                                    });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                        }
                    });
                }
            });
            $(document).on('click', '.btn-remove', function() {
                const parentRow = $(this).closest('.unit-condition-row');
                const startUnitId = parentRow.find('.unit-select-condition-start').val();
                const endUnitId = parentRow.find('.unit-select-condition-end').val();
                addedUnitCondIds = addedUnitCondIds.filter(id => id != startUnitId && id != endUnitId);
                parentRow.remove();
            });
            $('#add-more-view').on('click', function() {
                var start_up_unit = $('#start_up_unit').val();
                var unit_count = $('#no_of_unit').val();

                var floor = $('select[name="floor"]').val();
                var block = $('select[name="block"]').val();
                var property = $('select[name="property"]').val();
                $('.unit-select-view-start option:selected, .unit-select-view-end option:selected').each(
                    function() {
                        const val = $(this).val();
                        if (val && !addedUnitViewIds.includes(parseInt(val))) {
                            addedUnitViewIds.push(parseInt(val));
                        }
                    });
                if (floor) {
                    $.ajax({
                        url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                            "/" + block + "/" + property,
                        type: "GET",
                        data: {
                            "start_up_unit": start_up_unit,
                            "unit_count": unit_count
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                var unitOptions = '';

                                $.each(data, function(key, value) {
                                    if (!addedUnitViewIds.includes(value.id)) {
                                        unitOptions +=
                                            `<option value="${value.id}">${value.name}</option>`;
                                    }
                                });

                                if (unitOptions === '') {
                                    alert('You Dont Have Units');
                                    return;
                                }

                                const unitTypeRow = `
                    <div class="row view-row mt-3">
                        <div class="col-md-3">
                            <label>Unit Start</label>
                            <select class="js-select2-custom form-control unit-select-view-start" name="unit_start_view[]">
                                ${unitOptions}
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Unit End</label>
                            <select class="js-select2-custom form-control unit-select-view-end" name="unit_end_view[]">
                                ${unitOptions}
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>{{ ui_change('view' ,'property_config')  }}</label>
                            <select class="js-select2-custom form-control" name="view[]">
                                @foreach ($views as $unit_view_item)
                                <option value="{{ $unit_view_item->id }}">{{ $unit_view_item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-remove"><i class="tio-delete"></i></button>
                        </div>
                    </div>`;

                                $('#view-container').append(unitTypeRow);
                                $('.js-select2-custom').select2();
                                $('.unit-select-view-start option:selected, .unit-select-view-end option:selected')
                                    .each(function() {
                                        const val = $(this).val();
                                        if (val && !addedUnitViewIds.includes(val)) {
                                            addedUnitViewIds.push(parseInt(val));
                                        }
                                    });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                        }
                    });
                }
            });
            $(document).on('click', '.btn-remove', function() {
                const parentRow = $(this).closest('.view-row');
                const startUnitId = parentRow.find('.unit-select-view-start').val();
                const endUnitId = parentRow.find('.unit-select-view-end').val();
                addedUnitViewIds = addedUnitViewIds.filter(id => id != startUnitId && id != endUnitId);
                parentRow.remove();
            });
            $('#add-more-unit-parking').on('click', function() {
                var start_up_unit = $('#start_up_unit').val();
                var unit_count = $('#no_of_unit').val();

                var floor = $('select[name="floor"]').val();
                var block = $('select[name="block"]').val();
                var property = $('select[name="property"]').val();
                $('.unit-select-parking-start option:selected, .unit-select-parking-end option:selected')
                    .each(function() {
                        const val = $(this).val();
                        if (val && !addedUnitParkIds.includes(parseInt(val))) {
                            addedUnitParkIds.push(parseInt(val));
                        }
                    });
                if (floor) {
                    $.ajax({
                        url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                            "/" + block + "/" + property,
                        type: "GET",
                        data: {
                            "start_up_unit": start_up_unit,
                            "unit_count": unit_count
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                var unitOptions = '';

                                $.each(data, function(key, value) {
                                    if (!addedUnitParkIds.includes(value.id)) {
                                        unitOptions +=
                                            `<option value="${value.id}">${value.name}</option>`;
                                    }
                                });

                                if (unitOptions === '') {
                                    alert('You Dont Have Units');
                                    return;
                                }

                                const unitTypeRow = `
                    <div class="row unit-parking-row mt-3">
                        <div class="col-md-3">
                            <label>Unit Start</label>
                            <select class="js-select2-custom form-control unit-select-parking-start" name="unit_start_unit_parking[]">
                                ${unitOptions}
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Unit End</label>
                            <select class="js-select2-custom form-control unit-select-parking-end" name="unit_end_unit_parking[]">
                                ${unitOptions}
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>{{ ui_change('unit_parking' ,'property_config')  }}</label>
                            <select class="js-select2-custom form-control" name="unit_parking[]">
                                @foreach ($unit_parkings as $unit_parking_item)
                                <option value="{{ $unit_parking_item->id }}">{{ $unit_parking_item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-remove"><i class="tio-delete"></i></button>
                        </div>
                    </div>`;

                                $('#unit-parking-container').append(unitTypeRow);
                                $('.js-select2-custom').select2();
                                $('.unit-select-parking-start option:selected, .unit-select-parking-end option:selected')
                                    .each(function() {
                                        const val = $(this).val();
                                        if (val && !addedUnitParkIds.includes(val)) {
                                            addedUnitParkIds.push(parseInt(val));
                                        }
                                    });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                        }
                    });
                }
            });
            $(document).on('click', '.btn-remove', function() {
                const parentRow = $(this).closest('.unit-parking-row');
                const startUnitId = parentRow.find('.unit-select-parking-start').val();
                const endUnitId = parentRow.find('.unit-select-parking-end').val();
                addedUnitDescIds = addedUnitDescIds.filter(id => id != startUnitId && id != endUnitId);
                parentRow.remove();
            });
            $('#add-more-unit-description').on('click', function() {
                var start_up_unit = $('#start_up_unit').val();
                var unit_count = $('#no_of_unit').val();

                var floor = $('select[name="floor"]').val();
                var block = $('select[name="block"]').val();
                var property = $('select[name="property"]').val();
                $('.unit-select-description-start option:selected, .unit-select-description-end option:selected')
                    .each(function() {
                        const val = $(this).val();
                        if (val && !addedUnitDescIds.includes(parseInt(val))) {
                            addedUnitDescIds.push(parseInt(val));
                        }
                    });
                if (floor) {
                    $.ajax({
                        url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                            "/" + block + "/" + property,
                        type: "GET",
                        data: {
                            "start_up_unit": start_up_unit,
                            "unit_count": unit_count
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                var unitOptions = '';

                                $.each(data, function(key, value) {
                                    if (!addedUnitDescIds.includes(value.id)) {
                                        unitOptions +=
                                            `<option value="${value.id}">${value.name}</option>`;
                                    }
                                });

                                if (unitOptions === '') {
                                    alert('You Dont Have Units');
                                    return;
                                }

                                const unitTypeRow = `
                    <div class="row unit-description-row mt-3">
                        <div class="col-md-3">
                            <label>Unit Start</label>
                            <select class="js-select2-custom form-control unit-select-description-start" name="unit_start_unit_description[]">
                                ${unitOptions}
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>Unit End</label>
                            <select class="js-select2-custom form-control unit-select-description-end" name="unit_end_unit_description[]">
                                ${unitOptions}
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label>{{ ui_change('unit_description' ,'property_config') }}</label>
                            <select class="js-select2-custom form-control" name="unit_description[]">
                                @foreach ($unit_descriptions as $unit_description_item)
                                <option value="{{ $unit_description_item->id }}">{{ $unit_description_item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button type="button" class="btn btn-danger btn-remove"><i class="tio-delete"></i></button>
                        </div>
                    </div>`;

                                $('#unit-description-container').append(unitTypeRow);
                                $('.js-select2-custom').select2();
                                $('.unit-select-description-start option:selected, .unit-select-description-end option:selected')
                                    .each(function() {
                                        const val = $(this).val();
                                        if (val && !addedUnitDescIds.includes(val)) {
                                            addedUnitDescIds.push(parseInt(val));
                                        }
                                    });
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                        }
                    });
                }
            });
            $(document).on('click', '.btn-remove', function() {
                const parentRow = $(this).closest('.unit-description-row');
                const startUnitId = parentRow.find('.unit-select-description-start').val();
                const endUnitId = parentRow.find('.unit-select-description-end').val();
                addedUnitDescIds = addedUnitDescIds.filter(id => id != startUnitId && id != endUnitId);
                parentRow.remove();
            });
 

        });
    </script>
@endpush
