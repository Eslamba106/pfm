@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
@endphp
@section('title', __('roles.edit_cost_center_category'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                {{-- <img width="60" src="{{ asset('assets/back-end/img/' . 'cost_center_category.jpg') }}" alt=""> --}}
                {{ __('roles.edit_cost_center_category') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ __('roles.edit_cost_center_category') }}
                    </div>
                    <div class="card-body" style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route('cost_center_category.update' , $cost_center_category->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="form-group">
                                <input type="hidden" id="id">
                                <label class="title-color" for="name">{{ __('property_master.name') }}<span
                                        class="text-danger"> *</span> </label>
                                <input type="text" name="name" value="{{ $cost_center_category->name }}" class="form-control"
                                    placeholder="{{ __('roles.enter_cost_center_category_name') }}">
                            </div>
                            <div class="form-group">
                                <label class="title-color" for="code">
                                    {{ __('property_master.code') }} 

                                </label>
                                <div class="input-group">
                                    <input type="text" value="{{ $cost_center_category->code }}" name="code" class="form-control"
                                        placeholder="{{ __('roles.enter_cost_center_category_code') }}">

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="title-color" for="status">
                                    {{ __('general.status') }}
                                </label>
                                <div class="input-group">
                                    <input type="radio" name="status" class="mr-3 ml-3" value="active" 
                                        @if($cost_center_category->status == 'active') checked @endif>
                                    <label class="title-color" for="status">
                                        {{ __('general.active') }}
                                    </label>
                                
                                    <input type="radio" name="status" class="mr-3 ml-3" value="inactive" 
                                        @if($cost_center_category->status == 'inactive') checked @endif>
                                    <label class="title-color" for="status">
                                        {{ __('general.inactive') }}
                                    </label>
                                </div>
                                
                            </div>



                            <div class="d-flex flex-wrap gap-2 justify-content-end">
                                <button type="reset" class="btn btn-secondary">{{ __('general.reset') }}</button>
                                <button type="submit" class="btn btn--primary">{{ __('general.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
