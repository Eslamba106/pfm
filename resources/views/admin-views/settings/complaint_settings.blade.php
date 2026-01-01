@extends('layouts.back-end.app')
@php
    $currentUrl = url()->current();
    $segments = explode('/', $currentUrl);
    $end = end($segments);
@endphp
@section('title', __('general.settings'))

@push('css_or_js')
    <link href="{{ asset('assets/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/custom.css')}}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="{{asset('/assets/back-end/img/business-setup.png')}}" alt="">
                 {{ __('property_reports.complaint_settings') }}
            </h2>

        </div>
        <!-- End Page Title -->

        <!-- Inlile Menu -->
        @include('admin-views.settings.business-setup-inline-menu')



            <!-- Form -->
            <form class="product-form text-start" action="{{   route('complaint_settings.store')   }}" method="POST" enctype="multipart/form-data" id="product_form">
                @csrf
                @method('patch')

                <!-- general setup -->
                <div class="card mt-3 rest-part">
                    <div class="card-header">
                        <div class="d-flex gap-2">
                            <h4 class="mb-0">{{ __('property_reports.complaint_settings')  }}</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="token" class="title-color">{{ __('property_reports.prefix') }}</label>
                                    <input type="text" class="form-control" name="complaint_prefix"   value="{{  $complaint_prefix }}">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group">
                                    <label for="">{{ __('property_reports.complaint_suffix') }}</label>
                                    <input type="text" class="form-control"   name="complaint_suffix" value="{{   $complaint_suffix }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="token" class="title-color">{{ __('property_reports.complaint_width') }}</label>
                                    <input type="text" class="form-control" name="complaint_width" value="{{ $complaint_width }}">
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group">
                                    <label for="">{{ __('property_reports.complaint_start_number') }}</label>
                                    <input type="text" class="form-control" name="complaint_start_number" value="{{  $complaint_start_number }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group">
                                    <label for="">{{ __('property_reports.start_date') }}</label>
                                    <input type="text" class="form-control" id="complaint_start_date" name="complaint_date" value="{{  (isset($complaint_date)) ? \Carbon\Carbon::parse($complaint_date)->format('d-m-Y') : \Carbon\Carbon::now()->format('d-m-Y') }}" class="form-control">
                                </div>
                            </div>


                        </div>
                    </div>


                </div>


                <div class="row justify-content-end gap-3 mt-3 mx-1">
                    <button type="reset" class="btn btn-secondary px-5">{{ __('reset') }}</button>
                    <button type="submit" class="btn btn--primary px-5">{{ __('submit') }}</button>
                </div>
            </form>
@endsection
@push('script')
    <script>
        flatpickr("#complaint_start_date", {
            dateFormat: "d/m/Y",

        });


    </script>
@endpush
