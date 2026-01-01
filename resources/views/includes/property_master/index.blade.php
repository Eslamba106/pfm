@extends('layouts.back-end.app')
@section('title', __('property_master.add_new_floor'))
@php
    $lang = Session::get('locale');
@endphp
@push('css_or_js')
    <link href="{{ asset('public/assets/back-end') }}/css/select2.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    {{ __('property_master.add_new_floor') }}
                </div>
                <div class="card-body" style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                    <form action="{{ route($route . '.store') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <input type="hidden" id="id">
                            <label class="title-color" for="name">{{ __('property_master.name') }}<span
                                    class="text-danger">*</span> </label>
                            <input type="text" name="name" class="form-control"
                                placeholder="{{ __('property_master.enter_floor_name') }}">
                        </div>
                        <div class="form-group">
                            <label class="title-color" for="code">
                                {{ __('property_master.code') }}
                            </label>
                            <div class="input-group">
                                <input type="text" name="code" class="form-control"
                                    placeholder="{{ __('property_master.enter_floor_code') }}">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="title-color" for="status">
                                {{ __('general.status') }}
                            </label>
                            <div class="input-group">
                                <input type="radio" name="status" class="mr-3 ml-3" checked value="active">
                                <label class="title-color" for="status">
                                    {{ __('general.active') }}
                                </label>
                                <input type="radio" name="status" class="mr-3 ml-3" value="inactive">
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

        <div class="col-md-12">
            <div class="card">
                <div class="px-3 py-4">
                    <div class="row align-items-center">
                        <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                            <h5 class="mb-0 d-flex align-items-center gap-2">{{ __('property_master.floor_list') }}
                                <span class="badge badge-soft-dark radius-50 fz-12"> </span>
                            </h5>
                        </div>
                        <div class="col-sm-8 col-md-6 col-lg-4">
                            <!-- Search -->
                            <form action="{{ url()->current() }}" method="GET">
                                <div class="input-group input-group-custom input-group-merge">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="tio-search"></i>
                                        </div>
                                    </div>
                                    <input id="datatableSearch_" type="search" name="search" class="form-control"
                                        placeholder="{{ __('property_master.search_by_floor_name') }}"
                                        aria-label="Search" value="{{ $search }}" required>
                                    <button type="submit" class="btn btn--primary">{{ __('general.search') }}</button>
                                </div>
                            </form>
                            <!-- End Search -->
                        </div>
                    </div>
                </div>
                <div style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                    <div class="table-responsive">
                        <table id="datatable"
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{ __('general.sl') }}</th>
                                    <th class="text-center">{{ __('property_master.floor_name') }} </th>
                                    <th class="text-center">{{ __('property_master.floor_code') }} </th>
                                    <th class="text-center">{{ __('general.status') }}</th>
                                    <th class="text-center">{{ __('general.actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($main as $key => $value)
                                    <tr>
                                        <td>{{ $main->firstItem() + $key }}</td>
                                        <td class="text-center">{{ $value->name }}</td>
                                        <td class="text-center">{{ $value->code }} </td>
                                        <td class="text-center">{{ $value->status }} </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline-info btn-sm square-btn"
                                                    title="{{ __('general.edit') }}"
                                                    href="{{ route($route . '.edit', $value->id) }}">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                    title="{{ __('general.delete') }}" id="{{ $value['id'] }}">
                                                    <i class="tio-delete"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="table-responsive mt-4">
                    <div class="d-flex justify-content-lg-end">
                        <!-- Pagination -->
                        {!! $main->links() !!}
                    </div>
                </div>

                @if (count($main) == 0)
                    <div class="text-center p-4">
                        <img class="mb-3 w-160" src="{{ asset('public/assets/back-end') }}/svg/illustrations/sorry.svg"
                            alt="Image Description">
                        <p class="mb-0">{{ __('general.no_data_to_show') }}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
