@extends('layouts.back-end.app')
@section('title', ui_change('add_new_floor' , 'porperty_master'))
@php
    $lang = Session::get('locale');
@endphp
@push('css_or_js')
    <link href="{{ asset('assets/back-end') }}/css/select2.min.css" rel="stylesheet" />
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
                {{-- <img width="20" src="{{ asset('/assets/back-end/img/floors.png') }}" alt=""> --}}
                {{ ui_change('add_new_floor','property_master') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body" style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route('floor.floor_multiple_store') }}" method="post">
                            @csrf
                            <div class="container mt-3">
                                <div class="p-2 bg-primary text-white custom-shadow rounded">
                                    <div class="bg-success-subtle p-2 rounded">
                                        <span class="fw-bold">{{ ui_change('floor_no_prefill_with_zero' ,'property_master') }}
                                            :</span>
                                        <span class="text-danger">{{ ui_change(  $fill_zero ,'property_master') }} ####</span>
                                        <span class="fw-bold ms-3">{{ ui_change('no_of_digits_width' ,'property_master') }} :</span>
                                        <span class="text-danger">{{ $width }} ####</span>
                                        <span class="fw-bold ms-3">{{ ui_change('start_floor_no' ,'property_master') }} :</span>
                                        <span>{{ $start_floor_no }} ####</span>
                                        <span class="fw-bold ms-3">{{ ui_change('floor_code_prefix' ,'property_master') }} :</span>
                                        <span class="text-danger">{{ $floor_code_prefix }} ####</span>
                                        <span class="fw-bold ms-3">{{ ui_change('status','property_master') }}</span>
                                        <span class="text-success">{{ ui_change($status,'property_master') }}</span>
                                    </div>
                                </div>

                                <input type="hidden" name="fill_zero" value="{{ $fill_zero }}">
                                <input type="hidden" name="start_floor_no" value="{{ $start_floor_no }}">
                                <input type="hidden" name="floor_code_prefix" value="{{ $floor_code_prefix }}">
                                <input type="hidden" name="no_of_floors" value="{{ $no_of_floors }}">
                                <input type="hidden" name="width" value="{{ $width }}">
                                <input type="hidden" name="floor_code_prefix_status"
                                    value="{{ $floor_code_prefix_status }}">
                                {{-- <input type="hidden" name="floor_code_prefix" value="{{ $floor_code_prefix }}"> --}}
                                <input type="hidden" name="status" value="{{ $status }}">
                                <div class="p-3 bg-primary text-white custom-shadow rounded mt-4"> 
                                    <div class="row g-2">
                                        
                                        @for ($i = 0, $ii = $no_of_floors; $i < $ii; $i++)
                                            <div class="col-md-4">
                                                @if (isset($floor_code_prefix))
                                                <label class="fw-bold mb-2 mt-1">{{ ui_change('code','property_master') }}<span
                                                    class="text-danger">*</span></label>
                                                    <input type="text" name="floor_code[]" class="form-control"
                                                        value="{{ (isset($floor_code_prefix) ? $floor_code_prefix : '') .
                                                            (isset($width) ? str_pad($i + $start_floor_no, $width, '0', STR_PAD_LEFT) : $i + $start_floor_no) }}">
                                                @endif
                                                @if (isset($floor_name_prefix))
                                                <label class="fw-bold mb-2 mt-1">{{ ui_change('name','property_master') }}<span
                                                    class="text-danger">*</span></label>
                                                    <input type="text" name="floor_name[]" class="form-control mt-1"
                                                        value="{{ (isset($floor_name_prefix) ? $floor_name_prefix : '') .
                                                            (isset($width) ? str_pad($i + $start_floor_no, $width, '0', STR_PAD_LEFT) : $i + $start_floor_no) }}">
                                                @endif
                                                <label class="fw-bold mb-2 mt-1">{{ ui_change('number','property_master') }}<span
                                                    class="text-danger">*</span></label>
                                                <input type="text" name="floors[]" class="form-control mt-1"
                                                    value="{{ isset($width) ? str_pad($i + $start_floor_no, $width, '0', STR_PAD_LEFT) : $i + $start_floor_no }}">

                                            </div>
                                        @endfor
                                        {{-- @endif  @if (isset($floor_code)) --}}
                                    </div>
                                </div>

                            </div>
                            <div class="d-flex gap-3 justify-content-end mt-3">
                                <button type="reset" id="reset"
                                    class="btn btn-secondary px-4">{{ ui_change('reset','property_master') }}</button>
                                <button type="submit" class="btn btn--primary px-4">{{ ui_change('submit','property_master') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="legend">
        <span class="legend-item floors">Floors</span>
        <span class="legend-item empty-units">Empty Units</span>
        <span class="legend-item enquired-units">Enquired Units</span>
        <span class="legend-item proposed-units">Proposed Units</span>
        <span class="legend-item booked-units">Booked Units</span>
        <span class="legend-item agreement-units">Agreement Units</span>
    </div>

    <div class="block-container">
        <h2>Block: Block A</h2>
        <div class="block-layout">
            <div class="floor">Ground Floor</div>
            <div class="unit enquired">STORE001</div>
            <div class="unit agreement">STORE002</div>
            <div class="unit enquired">STORE003</div>
            <div class="unit enquired">STORE004</div>

            <div class="floor">FLR004</div>
            <div class="floor">FLR003</div>
            <div class="floor">FLR002</div>
            <div class="floor">FLR001</div>
            <div class="unit agreement">STORE005</div>
        </div>
    </div> --}}
@endsection
