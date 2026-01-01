@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
@endphp
@section('title', __('roles.edit_cost_center'))
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
                {{-- <img width="60" src="{{ asset('assets/back-end/img/' . 'cost_center.jpg') }}" alt=""> --}}
                {{ __('roles.edit_cost_center') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ __('roles.edit_cost_center') }}
                    </div>
                    <div class="card-body" style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route('cost_center.update' , $cost_center->id) }}" method="post">
                            @csrf
                            @method('patch')

                            <div class="form-group">
                                <div class="col-md-12 col-lg-4 col-xl-12"> 
                                    <label class="title-color" for="name">{{ __('property_master.name') }}<span
                                            class="text-danger"> *</span> </label>
                                    <input type="text" name="name" class="form-control" value="{{ $cost_center->name }}"
                                        placeholder="{{ __('roles.enter_cost_center_name') }}">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-12">
                                <div class="form-group">
                                    <label class="title-color" for="code">
                                        {{ __('property_master.code') }}<span class="text-danger"> *</span>

                                    </label>
                                    <div class="input-group">
                                        <input type="text" value="{{ $cost_center->code }}" name="code" class="form-control"
                                            placeholder="{{ __('roles.enter_cost_center_code') }}">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-12">
                                <div class="form-group">
                                    <label for="">{{ __('roles.cost_center_category') }} <span class="text-danger">
                                            *</span></label>
                                    <select name="cost_center_category_id" class="form-control js-select2-custom ">
                                        @foreach ($cost_center_categories as $cost_center_category_item)
                                            <option value="{{ $cost_center_category_item->id }}" @if($cost_center->cost_center_category_id == $cost_center_category_item->id ) selected @endif>
                                                {{ $cost_center_category_item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-12">
                                <div class="form-group">
                                    <label class="title-color" for="status">
                                        {{ __('general.status') }}
                                    </label>
                                    <div class="input-group">
                                        <input type="radio" name="status" class="mr-3 ml-3" value="active" 
                                            @if($cost_center->status == 'active') checked @endif>
                                        <label class="title-color" for="status">
                                            {{ __('general.active') }}
                                        </label>
                                    
                                        <input type="radio" name="status" class="mr-3 ml-3" value="inactive" 
                                            @if($cost_center->status == 'inactive') checked @endif>
                                        <label class="title-color" for="status">
                                            {{ __('general.inactive') }}
                                        </label>
                                    </div>
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
