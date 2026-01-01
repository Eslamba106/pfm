@extends('layouts.back-end.app')
@section('title', __('property_master.edit_amc_provider'))
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
                {{-- <img width="60" src="{{ asset('/assets/back-end/img/countries.jpg') }}" alt=""> --}}
                {{ __('property_master.edit_amc_provider') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ __('property_master.edit_amc_provider') }}
                    </div>
                    <div class="card-body" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route('amc_provider.update', $amc_provider->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="code" class="title-color">{{ __('property_master.code') }}
                                        </label>
                                        <input type="text" name="code" class="form-control"
                                            value="{{ $amc_provider->code }}" required>
                                    </div>
                                    @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="name" class="title-color">{{ __('login.name') }}
                                        </label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ $amc_provider->name }}" required>
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-2 col-lg-1 col-xl-1">
                                    <div class="form-group">
                                        <label for="dail_code_contact_no"
                                            class="title-color">{{ __('companies.dail_code') }}
                                        </label>
                                        <input type="text" name="dail_code_contact_no"
                                            value="{{ $amc_provider->dail_code_contact_no }}" class="form-control"
                                             >
                                    </div>
                                    @error('dail_code_contact_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-lg-2 col-xl-2">
                                    <div class="form-group">
                                        <label for="contact_no" class="title-color">{{ __('property_master.contact_no') }}
                                        </label>
                                        <input type="text" name="contact_no" value="{{ $amc_provider->contact_no }}"
                                            class="form-control"  >
                                    </div>
                                    @error('contact_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-2 col-lg-1 col-xl-1">
                                    <div class="form-group">
                                        <label for="dail_code_whatsapp_no"
                                            class="title-color">{{ __('companies.dail_code') }}
                                        </label>
                                        <input type="text" name="dail_code_whatsapp_no"
                                            value="{{ $amc_provider->dail_code_whatsapp_no }}" class="form-control"
                                             >
                                    </div>
                                    @error('dail_code_whatsapp_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-lg-2 col-xl-2">
                                    <div class="form-group">
                                        <label for="whatsapp_no"
                                            class="title-color">{{ __('property_master.whatsapp_no') }}
                                        </label>
                                        <input type="text" name="whatsapp_no" value="{{ $amc_provider->whatsapp_no }}"
                                            class="form-control"  >
                                    </div>
                                    @error('whatsapp_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>



                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="address1" class="title-color">{{ __('companies.address1') }}
                                        </label>
                                        <textarea name="address1" class="form-control" cols="30" rows="2">{{ $amc_provider->address1 }}</textarea>
                                    </div>
                                    @error('address1')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="address2" class="title-color">{{ __('companies.address2') }}
                                        </label>
                                        <textarea name="address2" class="form-control" cols="30" rows="2">{{ $amc_provider->address1 }}</textarea>
                                    </div>
                                    @error('address2')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="city" class="title-color">{{ __('companies.city') }}
                                        </label>
                                        <input type="text" name="city" value="{{ $amc_provider->city }}"
                                            class="form-control"  >
                                    </div>
                                    @error('city')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="state" class="title-color">{{ __('companies.state') }}
                                        </label>
                                        <input type="text" name="state" value="{{ $amc_provider->state }}"
                                            class="form-control"  >
                                    </div>
                                    @error('state')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="country" class="title-color">{{ __('companies.country') }}
                                        </label>
                                        <input type="text" name="country" value="{{ $amc_provider->country }}"
                                            class="form-control"  >
                                    </div>
                                    @error('country')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group"> {{-- property_management.contact_person --}}
                                        <label for="contact_person"
                                            class="title-color">{{ __('property_management.contact_person') }}
                                        </label>
                                        <input type="text" name="contact_person"
                                            value="{{ $amc_provider->contact_person }}" class="form-control"  >
                                    </div>
                                    @error('contact_person')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="name" class="title-color">{{ __('companies.taxability') }} <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <select class="js-select2-custom form-control" name="tax_registration" required>
                                            <option value="2"
                                                {{ 2 == $amc_provider->tax_registration ? 'selected' : '' }}>
                                                {{ __('general.no') }}</option>
                                            <option value="1"
                                                {{ 1 == $amc_provider->tax_registration ? 'selected' : '' }}>
                                                {{ __('general.yes') }}</option>

                                        </select>
                                    </div>
                                </div>

                                <div
                                    class="col-md-6 col-lg-4 col-xl-3  {{ 1 == $amc_provider->tax_registration ? '' : 'd-none' }}  tax_status_html ">
                                    <div class="form-group">
                                        <label for="name" class="title-color">{{ __('companies.vat_no') }}
                                        </label>
                                        <input type="text" name="vat_no" class="form-control"
                                            value="{{ $amc_provider->vat_no }}">
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

@push('script')
    <script>
        $(document).ready(function() {
            $('select[name="tax_registration"]').on('change', function() {
                let status = $(this).val();
                if (status == 1) {
                    $(".tax_status_html").removeClass('d-none');
                } else {
                    $(".tax_status_html").addClass('d-none');
                }
            });
        });
    </script>
@endpush
