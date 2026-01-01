@extends('layouts.back-end.app')
@section('title', ui_change('add_new_unit' , 'property_master'))
@php
    $lang = Session::get('locale');
@endphp
@push('css_or_js')
    <link href="{{ asset('/assets/back-end') }}/css/select2.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .custom-shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                {{-- <img width="20" src="{{ asset('//assets/back-end/img/units.png') }}" alt=""> --}}
                {{ ui_change('add_new_unit' , 'property_master') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body" style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route('unit.unit_multiple_store') }}" method="post">
                            @csrf
                            <div class="container mt-3">
                                <div class="p-2 bg-primary text-white custom-shadow rounded">
                                    <div class="bg-success-subtle p-2 rounded">
                                        <span class="fw-bold">{{ ui_change('unit_no_prefill_with_zero' , 'property_master') }}
                                            :</span>
                                        <span class="text-danger">{{ ui_change($fill_zero, 'property_master' ) }} ####</span>
                                        <span class="fw-bold ms-3">{{ ui_change('no_of_digits_width' , 'property_master') }} :</span>
                                        <span class="text-danger">{{ $width }} ####</span>
                                        <span class="fw-bold ms-3">{{ ui_change('start_unit_no' , 'property_master') }} :</span>
                                        <span>{{ $start_unit_no }} ####</span>
                                        <span class="fw-bold ms-3">{{ ui_change('unit_code_prefix' , 'property_master') }} :</span>
                                        <span class="text-danger">{{ $unit_code_prefix }} ####</span>
                                        <span class="fw-bold ms-3">{{ ui_change('status' , 'property_master') }}</span>
                                        <span class="text-success">{{ ui_change($status , 'property_master' ) }}</span>
                                    </div>
                                </div>

                                <input type="hidden" name="fill_zero" value="{{ $fill_zero }}">
                                <input type="hidden" name="start_unit_no" value="{{ $start_unit_no }}">
                                <input type="hidden" name="unit_code_prefix" value="{{ $unit_code_prefix }}">
                                <input type="hidden" name="no_of_units" value="{{ $no_of_units }}">
                                <input type="hidden" name="width" value="{{ $width }}">
                                <input type="hidden" name="unit_code_prefix_status"
                                    value="{{ $unit_code_prefix_status }}">
                                <input type="hidden" name="status" value="{{ $status }}">
                                <div class="p-3 bg-primary text-white custom-shadow rounded mt-4">
                                    
                                    <div class="row g-2">
                                            @for ($i = 0, $ii = $no_of_units; $i < $ii; $i++)
                                                <div class="col-md-4">
                                                    @if (isset($unit_code_prefix))
                                                    <label class="fw-bold mb-2">{{ ui_change('code' , 'property_master') }}<span
                                                        class="text-danger">*</span></label>
                                                    <input type="text" name="unit_code[]" class="form-control"
                                                        value="{{ (isset($unit_code_prefix) ? $unit_code_prefix : '') .
                                                            (isset($width) ? str_pad($i + $start_unit_no, $width, '0', STR_PAD_LEFT) : $i + $start_unit_no) }}">
                                                        @endif 
                                                        @if (isset($unit_name_prefix))
                                                        <label class="fw-bold mb-2 mt-2">{{ ui_change('name' , 'property_master') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="unit_name[]" class="form-control mt-2"
                                                        value="{{ (isset($unit_name_prefix) ? $unit_name_prefix : '') .
                                                            (isset($width) ? str_pad($i + $start_unit_no, $width, '0', STR_PAD_LEFT) : $i + $start_unit_no) }}">
                                                        @endif
                                                        <label class="fw-bold mb-2 mt-1">{{ ui_change('number' , 'property_master') }}<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="units[]" class="form-control mt-2"
                                                        value="{{  (isset($width) ? str_pad($i + $start_unit_no, $width, '0', STR_PAD_LEFT) : $i + $start_unit_no) }}">
                                                     
                                                </div>
                                            @endfor
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex gap-3 justify-content-end mt-3">
                                <button type="reset" id="reset"
                                    class="btn btn-secondary px-4">{{ ui_change('reset' , 'property_master') }}</button>
                                <button type="submit" class="btn btn--primary px-4">{{ ui_change('submit' , 'property_master') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
