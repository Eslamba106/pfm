@extends('layouts.back-end.app')
@section('title')
    {{ __('users.create_user') }}
@endsection
@php
    $lang = session()->get('locale');
@endphp
@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                {{-- <img src="{{ asset(main_path() . 'back-end/img/inhouse-product-list.png') }}" alt=""> --}}
                {{ __('users.create_user') }}
            </h2>
        </div>


        <div class="mb-5"></div>
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <form id="signature-form" action="{{ route('user_management.store') }}" method="post"
                enctype="multipart/form-data">
                @csrf
                <!-- general setup -->
                <div class="card mt-3 rest-part">
                    <div class="card-header">
                        <div class="d-flex gap-2">

                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ __('users.name') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="phone_dail_code" class="title-color">{{ __('companies.dail_code') }} <span
                                        class="text-danger"> *</span></label>
                                    <select class="js-select2-custom form-control" name="phone_dail_code" required>
                                        <option selected>{{ __('general.select') }}</option>
                                        @foreach ($dail_code_main as $item_dail_code)
                                            <option value="{{ '+' . $item_dail_code->dial_code }}">
                                                {{ '+' . $item_dail_code->dial_code }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="phone" class="title-color">{{ __('users.phone') }} <span
                                            class="text-danger"> *</span></label>
                                    <input type="text" class="form-control" name="phone" required>
                                </div>
                            </div> 
 
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label class="title-color">{{ __('companies.user_name') }}<span class="text-danger">
                                            *</span></label>
                                    <input type="text" class="form-control" name="user_name" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <label class="title-color">{{ __('companies.password') }}<span class="text-danger">
                                        *</span></label>

                                <div class="form-group input-group input-group-merge">

                                    <input type="password" class="js-toggle-password form-control" name="password" required
                                        id="signupSrPassword" placeholder="{{ __('8+_characters_required') }}"
                                        aria-label="8+ characters required" required
                                        data-msg="Your password is invalid. Please try again."
                                        data-hs-toggle-password-options='{
                                                "target": "#changePassTarget",
                                                "defaultClass": "tio-hidden-outlined",
                                                "showClass": "tio-visible-outlined",
                                                "classChangeTarget": "#changePassIcon"
                                                }'>
                                    <div id="changePassTarget" class="input-group-append">
                                        <a class="input-group-text" href="javascript:">
                                            <i id="changePassIcon" class="tio-visible-outlined"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="role"
                                        class="title-color">{{ __('roles.role_name') }} <span class="text-danger"> *</span></label>
                                    <select class="js-select2-custom form-control" name="role_id" required>
                                        <option selected value="">{{ __('general.select') }}</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}">
                                                {{ $role->name }}
                                            </option>          
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="email" class="title-color">{{ __('users.email') }} </label>
                                    <input type="text" class="form-control" name="email">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-end gap-3 mt-3 mx-1">
                    <button type="reset" class="btn btn-secondary px-5">{{ __('general.reset') }}</button>
                    <button type="submit" class="btn btn--primary px-5">{{ __('general.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
@endsection
