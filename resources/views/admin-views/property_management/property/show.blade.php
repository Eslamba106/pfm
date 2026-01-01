@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
@endphp
@section('title', ui_change('property' , 'property_config'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <h2 class="h1 mb-0 d-flex gap-2 align-items-center">
                {{-- <img width="60" src="{{ asset('/assets/back-end/img/property.jpg') }}" alt=""> --}}
                {{ ui_change('property' , 'property_config') }}
            </h2>
            {{-- <a href="{{ route('create') }}"
                class="btn btn--primary">{{ ui_change('add_new_property' , 'property_config') }}</a> --}}
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row  @if ($lang == 'ar') rtl text-start @else ltr @endif">

            <div class="col-md-12">
                <div class="card">
                    <div class="property-management">
                        <div class="content m-2 @if ($lang == 'ar') rtl @else ltr @endif">
                            <div class="row ">
                                <div class="col-md-3 ">
                                    <p><strong>{{ ui_change('code' , 'property_config') }} :</strong> {{ $property->code }}</p>
                                    <p><strong>{{ ui_change('building_no' , 'property_config') }} :</strong> {{ $property->building_no }}</p>
                                    <p><strong>{{ ui_change('city' , 'property_config') }}:</strong> {{ $property->city }}</p>
                                    <p><strong>{{ ui_change('municipality_no' , 'property_config') }} : </strong>@if($property->municipality_no != null)   {{ $property->municipality_no }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif</p>
                                    <p><strong>{{ ui_change('bank_no' , 'property_config') }} : </strong> @if($property->bank_no != null)   {{ $property->bank_no }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('email' , 'property_config') }}:</strong> @if($property->email != null)   {{ $property->email }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('insurance_period_from' , 'property_config') }} : </strong> @if($property->insurance_period_from != null )   {{ $property->insurance_period_from }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change("insurance_period_to" , 'property_config') }} : </strong> @if($property->insurance_period_to != null )   {{ $property->insurance_period_to   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change("premium_amount" , 'property_config') }} : </strong> @if($property->premium_amount != null )   {{ $property->premium_amount   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                </div>
                                <div class="col-md-3 ">
                                    <p><strong>{{ ui_change('name' , 'property_config') }} : </strong> @if($property->name != null )   {{ $property->name   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('block_no' , 'property_config') }} : </strong> @if($property->block_no != null )   {{ $property->block_no   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('established_on' , 'property_config') }} : </strong> @if($property->established_on != null )   {{ $property->established_on   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('electricity_no' , 'property_config') }} : </strong> @if($property->electricity_no != null )   {{ $property->electricity_no   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('contact_person' , 'property_config') }} : </strong> @if($property->contact_person != null )   {{ $property->contact_person   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('fax' , 'property_config') }} : </strong> @if($property->fax != null )   {{ "(".$property->dail_code_fax .")" . $property->fax   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('insurance_type' , 'property_config') }} : </strong> @if($property->insurance_type != null )   {{ $property->insurance_type   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('status' , 'property_config') }} : </strong> @if($property->status != null )   {{ ui_change( $property->status  , 'property_config')   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                </div>
                                <div class="col-md-3 ">
                                    <p><strong>{{ ui_change('type_of_ownership' , 'property_config') }} : </strong> @if($property->ownership_id != null )   {{ $property->ownership->name   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('road' , 'property_config') }} : </strong> @if($property->road != null )   {{ $property->road   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('registration_on' , 'property_config') }} : </strong> @if($property->registration_on != null )   {{ $property->registration_on   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('land_lord_name' , 'property_config') }} : </strong> @if($property->land_lord_name != null )   {{ $property->land_lord_name   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('telephone' , 'property_config') }} : </strong> @if($property->telephone != null )   {{ "(".$property->dail_code_telephone .")" . $property->telephone   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('total_area' , 'property_config') }} : </strong> @if($property->total_area != null )   {{ $property->total_area   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('insurance_policy_no' , 'property_config') }} : </strong> @if($property->insurance_policy_no != null )   {{ $property->insurance_policy_no   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('roles.Created_At' , 'property_config') }} : </strong> @if($property->created_at != null )   {{ $property->created_at->shortAbsoluteDiffForHumans()   }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                </div>
                                <div class="col-md-3 ">
                                    <p><strong>{{ ui_change('property_type' , 'property_config') }} : </strong> @if($property->property_type != null )   {{ $property->property_type }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('location' , 'property_config') }} : </strong> @if($property->location != null )   {{ $property->location }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('tax_no' , 'property_config') }} : </strong> @if($property->tax_no != null )   {{ $property->tax_no }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('bank_name' , 'property_config') }} : </strong> @if($property->bank_name != null )   {{ $property->bank_name }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('mobile_no' , 'property_config') }} : </strong> @if($property->mobile != null )   {{  "(".$property->dail_code_mobile .")" . $property->mobile }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('insurance_provider' , 'property_config') }} : </strong> @if($property->insurance_provider != null )   {{ $property->insurance_provider }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                    <p><strong>{{ ui_change('insurance_holder' , 'property_config') }} : </strong> @if($property->insurance_holder != null )   {{ $property->insurance_holder }} @else <span class="not-available"> {{ ui_change('not_available' , 'property_config') }}</span> @endif </p>
                                </div>
                            </div>

                        </div>


                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
