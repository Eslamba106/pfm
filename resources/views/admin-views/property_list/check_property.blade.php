@extends('layouts.back-end.app')
@php
    $lang = session()->get('locale');
    $currentUrl = url()->current();
    $segments = explode('/', $currentUrl);
    $id = end($segments);
    $proposal_id = end($segments);
@endphp

@section('title')
    {{ __('general.check_property') }}
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
                {{ __('general.check_property') }}
            </h2>
        </div> 
                @include('admin-views.inline_menu.property_transaction.inline-menu')

        <div class="col-lg-8 col-xl-12">
            <!-- Card -->
            @foreach ($properties as $property_item)
                <div class="card h-100 m-2">
                    <!-- Body -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('property_management.property_name') }} :
                                    <strong>{{ $property_item->name ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('property_management.property_code') }} :
                                    <strong>{{ $property_item->code ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('property_management.type_of_ownership') }} :
                                    <strong>{{ $property_item->type_of_ownership ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('property_master.property_type') }} :
                                    <strong>
                                        {{-- {{ dd($property_item->property_types) }} --}}
                                        @foreach ($property_item->property_types as $property_type_item)
                                            {{ $property_type_item->name  ?? __('general.not_available') }},
                                        @endforeach
                                    </strong></span>
                            </div>
                        </div>



                        <div class="row mt-2">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('property_management.building_no') }} :
                                    <strong>{{ $property_item->building_no ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('property_management.block_no') }} :
                                    <strong>{{ $property_item->block_no ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('property_management.road') }} :
                                    <strong>{{ $property_item->road ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('companies.location') }} :
                                    <strong>
                                        {{ $property_item->location  ?? __('general.not_available') }},
                                    </strong>
                                </span>
                            </div>
                        </div>



                        <div class="row mt-2">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('property_management.city') }} :
                                    <strong>{{ $property_item->city ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('property_management.established_on') }} :
                                    <strong>{{ $property_item->established_on ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('property_management.registration_on') }} :
                                    <strong>{{ $property_item->registration_on ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('property_management.tax_no') }} :
                                    <strong>
                                        {{ $property_item->tax_no  ?? __('general.not_available') }},
                                    </strong>
                                </span>
                            </div>
                        </div>



                        <!-- End Row -->
                    </div>
                    <!-- End Body -->

                <div class="row justify-content-end gap-3 mt-3 mb-2 mx-1">
                    <a href="{{ route('general_property_image_view' , [$property_item->id ]) }}"   class="btn btn-secondary px-5">{{ __('general.view_image') }}</a>
                    <a href="{{ route('general_property_list_view' , [$property_item->id  ]) }}"  class="btn btn--primary px-5">{{ __('general.list_view') }}</a>
                </div>
            </div>
            <hr>
            @endforeach
            <!-- End Card -->
        </div>
        {{-- </div> --}}
    </div>
@endsection
@push('script')
    <script src="{{ asset('assets/back-end') }}/js/tags-input.min.js"></script>
    <script src="{{ asset('assets/back-end/js/spartan-multi-image-picker.js') }}"></script>
@endpush
