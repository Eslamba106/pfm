@extends('layouts.back-end.app')

@section('title', ui_change('edit_unit_management' , 'property_config'))
@php
    $lang = Session::get('locale');
@endphp
@push('css_or_js')
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                {{-- <img src="{{ asset(main_path() . 'back-end/img/inhouse-product-list.png') }}" alt=""> --}}
                {{ ui_change('edit_unit_management' , 'property_config') }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.property_config.inline-menu')

        <!-- Form -->
        <form class="product-form text-start" action="{{ route('unit_management.update' , $selected_unit->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <!-- general setup -->
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        
                        <h4 class="mb-0">{{ ui_change('edit_unit_management' , 'property_config') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ ui_change('property' , 'property_config') }}
                                </label>
                                <select class="js-select2-custom form-control" name="property" id="property" disabled required>
                                    <option  >{{ ui_change('select' , 'property_config') }}
                                    </option>
                                    @foreach ($property as $property_item)
                                        <option value="{{ $property_item->id }}" @if($selected_unit->property_management_id ==  $property_item->id ) selected @endif >
                                            {{ $property_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ ui_change('blocks' , 'property_config') }}
                                </label>
                                <select class="js-select2-custom form-control" name="block" required disabled >
                                    <option selected>{{ ui_change('select' , 'property_config') }} </option>
                                    @foreach ($blocks as $block_item)
                                        <option value="{{ $block_item->id }}" @if($selected_unit->block_management_id ==  $block_item->id ) selected @endif >
                                            {{ $block_item->block->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ ui_change('floors' , 'property_config') }}
                                </label>
                                <select class="js-select2-custom form-control" name="floor" id="floor" required
                                    disabled>
                                    <option selected>{{ ui_change('select' , 'property_config') }}
                                    </option>
                                    @foreach ($floors as $floor_item)
                                        <option value="{{ $floor_item->id }}"  @if($selected_unit->floor_management_id ==  $floor_item->id ) selected @endif >
                                            {{ $floor_item->floor_management_main->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ ui_change('unit' , 'property_config') }}
                                </label>
                                <select class="js-select2-custom form-control" disabled name="start_up_unit" id="start_up_unit"
                                    required disabled>
                                    <option selected>{{ ui_change('select' , 'property_config') }}
                                    </option>
                                    @foreach ($units as $unit_item)
                                        <option value="{{ $unit_item->id }}"
                                            @if ($unit_item->id == $selected_unit->unit_id) selected @endif>
                                            {{ $unit_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-3">

                            <div class="form-group">
                                <label>{{ ui_change('unit_description' , 'property_config') }}</label>
                                <select name="unit_description" class="js-select2-custom form-control"
                                    id="general_unit_description">
                                    <option value="0" >{{ ui_change('no_applicable' , 'property_config') }}</option>
                                    @foreach ($unit_descriptions as $unit_description_item)
                                        <option value="{{ $unit_description_item->id }}"  @if($selected_unit->unit_description_id ==  $unit_description_item->id ) selected @endif >
                                            {{ $unit_description_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ ui_change('unit_type' , 'property_config') }}</label>
                                <select name="unit_type" class="js-select2-custom form-control" id="general_unit_type">
                                    <option value="0" >{{ ui_change('no_applicable' , 'property_config') }}</option>
                                    @foreach ($unit_types as $unit_type_item)
                                        <option value="{{ $unit_type_item->id }}" @if($selected_unit->unit_type_id ==  $unit_type_item->id ) selected @endif >{{ $unit_type_item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ ui_change('unit_condition' , 'property_config') }}</label>
                                <select name="unit_condition" class="js-select2-custom form-control"
                                    id="general_unit_condition">
                                    <option value="0" >{{ ui_change('no_applicable' , 'property_config') }}</option>
                                    @foreach ($unit_conditions as $unit_condition_item)
                                        <option value="{{ $unit_condition_item->id }}" @if($selected_unit->unit_condition_id ==  $unit_condition_item->id ) selected @endif >{{ $unit_condition_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ ui_change('view' , 'property_config') }}</label>
                                <select name="view" class="js-select2-custom form-control" id="general_view">
                                    <option value="0">{{ ui_change('no_applicable' , 'property_config') }}</option>
                                    @foreach ($views as $view_item)
                                        <option value="{{ $view_item->id }}"  @if($selected_unit->view_id ==  $view_item->id ) selected @endif > {{ $view_item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label>{{ ui_change('unit_parking' , 'property_config') }}</label>
                                <select name="unit_parking" class="js-select2-custom form-control"
                                    id="general_unit_parking">
                                    <option value="0" >{{ ui_change('no_applicable' , 'property_config') }}</option>
                                    @foreach ($unit_parkings as $unit_parking_item)
                                        <option value="{{ $unit_parking_item->id }}" @if($selected_unit->unit_parking_id ==  $unit_parking_item->id ) selected @endif>{{ $unit_parking_item->name }}
                                        </option>
                                    @endforeach
                                </select>

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
@endpush
