@extends('layouts.back-end.app')

@section('title', ui_change('create_employee', 'facility_master'))
@php
    $lang = session()->get('locale');
@endphp
@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                <img src="{{ asset(main_path() . 'back-end/img/inhouse-product-list.png') }}" alt="">
                {{ ui_change('create_employee', 'facility_master') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Form -->
        <form class="product-form text-start" action="{{ route('employee.update', $employee->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('patch')
            <!-- general setup -->
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        <img src="{{ asset(main_path() . 'back-end/img/shop-information.png') }}" class="mb-1"
                            alt="">
                        <h4 class="mb-0">{{ ui_change('create_employee', 'facility_master') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-lg-4 col-xl-6">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ ui_change('name', 'facility_master') }}</label>
                                <input type="text" class="form-control" name="name" value="{{ $employee->name }}">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-6">
                            <div class="form-group">
                                <label for="price"
                                    class="title-color">{{ ui_change('code', 'facility_master')  }}</label>
                                <input type="text" class="form-control" name="code" value="{{ $employee->code }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-6">
                            <div class="form-group">
                                <label for="email"
                                    class="title-color">{{ ui_change('email', 'facility_master') }}</label>
                                <input type="text" class="form-control" name="email" value="{{ $employee->email }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-6">
                            <div class="form-group">
                                <label for="username"
                                    class="title-color">{{ ui_change('username', 'facility_master') }}</label>
                                <input type="text" class="form-control" name="username" value="{{ $employee->username }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-6">
                            <div class="form-group">
                                <label for="password"
                                    class="title-color">{{ ui_change('password', 'facility_master') }}</label>
                                <input type="text" class="form-control" name="password" value="{{ $employee->myname }}">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-1">
                            <div class="form-group">
                                <label for="price"
                                    class="title-color">{{ ui_change('dail_code', 'facility_master') }}</label>
                                <input type="text" class="form-control" name="mobile_dail_code"
                                    value="{{ $employee->mobile_dail_code }}">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-5">
                            <div class="form-group">
                                <label for="price"
                                    class="title-color">{{ ui_change('mobile', 'facility_master') }}</label>
                                <input type="text" class="form-control" name="mobile" value="{{ $employee->mobile }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-1">
                            <div class="form-group">
                                <label for="price"
                                    class="title-color">{{ ui_change('dail_code', 'facility_master') }}</label>
                                <input type="text" class="form-control" name="whatsapp_dail_code"
                                    value="{{ $employee->whatsapp_dail_code }}">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-5">
                            <div class="form-group">
                                <label for="price"
                                    class="title-color">{{ ui_change('whatsapp', 'facility_master') }}</label>
                                <input type="text" class="form-control" name="whatsapp"
                                    value="{{ $employee->whatsapp }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-1">
                            <div class="form-group">
                                <label for="price"
                                    class="title-color">{{ ui_change('dail_code', 'facility_master') }}</label>
                                <input type="text" class="form-control" name="office_dail_code"
                                    value="{{ $employee->office_dail_code }}">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-5">
                            <div class="form-group">
                                <label for="price"
                                    class="title-color">{{ ui_change('office', 'facility_master') }}</label>
                                <input type="text" class="form-control" name="office"
                                    value="{{ $employee->office }}">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-6">
                            <div class="form-group">
                                <label for="price"
                                    class="title-color">{{ ui_change('extension_no', 'facility_master') }}</label>
                                <input type="text" class="form-control" name="extension_no"
                                    value="{{ $employee->extension_no }}">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-6">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ ui_change('departments', 'facility_master') }}
                                </label>
                                <select class="js-select2-custom form-control" name="department_id">

                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ $employee->department_id == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-6">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ ui_change('employee_types', 'facility_master') }}
                                </label>
                                <select class="js-select2-custom form-control" name="employee_type_id">

                                    @foreach ($employee_types as $employee_type)
                                        <option value="{{ $employee_type->id }}"
                                            {{ $employee->employee_type_id == $employee_type->id ? 'selected' : '' }}>
                                            {{ $employee_type->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3 mt-5">
                            <div class="form-group">
                                <input type="radio" name="status" value="active"
                                    {{ $employee->status == 'active' ? 'checked' : '' }}>
                                <label for="name" class="title-color">{{ ui_change('active', 'facility_master') }}
                                </label>
                                <input type="radio" name="status" value="inactive"
                                    class="{{ $lang == 'ar' ? 'mr-3' : 'ml-3' }}"
                                    {{ $employee->status == 'inactive' ? 'checked' : '' }}>
                                <label for="name" class="title-color">{{ ui_change('inactive', 'facility_master') }}
                                </label>
                            </div>
                        </div>

                    </div>

                </div>


            </div>

            <div class="row justify-content-end gap-3 mt-3 mx-1">
                <button type="reset"
                    class="btn btn-secondary px-5">{{ ui_change('reset', 'facility_master') }}</button>
                <button type="submit"
                    class="btn btn--primary px-5">{{ ui_change('submit', 'facility_master') }}</button>
            </div>
        </form>



    </div>
@endsection
@push('script')
@endpush
