@extends('layouts.back-end.app')
@section('title', ui_change('edit_floor' , 'property_master'))
@php
    $lang = Session::get('locale');
@endphp
@push('css_or_js')
    <link href="{{ asset('assets/back-end') }}/css/select2.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                {{ ui_change('edit_floor' , 'property_master') }}
            </h2>
        </div>
        @include('admin-views.inline_menu.property_master.inline-menu')
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body" style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">

                        <div class="row">
                            <div class="col-md-12 floor_form  multiple-form" id="multiple-form">
                                <form action="{{ route('floor.floor_single_edit', $main->id) }}" method="post">
                                    @method('PATCH')
                                    @csrf
                                    <div class="form-group">
                                        <label for="name" class="title-color">{{ ui_change('floor_name' , 'property_master') }}
                                        </label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ isset($main->name) ? $main->name : '' }}" required>
                                    </div>
                                    <div class="form-group" id="single-form-code">
                                        <label for="name" class="title-color">{{ ui_change('floor_code' , 'property_master') }}
                                        </label>
                                        <input type="text" name="code" class="form-control"
                                            value="{{ isset($main->code) ? $main->code : '' }}" required>
                                    </div>
                                    <div class="input-group">
                                        <input type="radio" name="status" class="mr-3 ml-3"
                                            {{ isset($main->status) && $main->status == 'active' ? 'checked' : '' }}
                                            {{ !isset($main->status) ? 'checked' : '' }} value="active">
                                        <label class="title-color" for="status">
                                            {{ ui_change('active' , 'property_master') }}
                                        </label>
                                        <input type="radio" name="status" class="mr-3 ml-3"
                                            {{ isset($main->status) && $main->status == 'inactive' ? 'checked' : '' }}
                                            value="inactive">
                                        <label class="title-color" for="status">
                                            {{ ui_change('inactive' , 'property_master') }}
                                        </label>

                                    </div>
                                    <div class="d-flex gap-3 justify-content-end">
                                        <button type="reset" id="reset"
                                            class="btn btn-secondary px-4">{{ ui_change('reset' , 'property_master') }}</button>
                                        <button type="submit"
                                            class="btn btn--primary px-4">{{ ui_change('submit' , 'property_master') }}</button>
                                    </div>
                                </form>
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
