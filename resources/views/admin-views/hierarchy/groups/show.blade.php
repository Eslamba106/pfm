@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
        $company = App\Models\Company::where('id' , auth()->user()->company_id )->first() ?? App\Models\User::first();

@endphp
@section('title', __('collections.groups'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <h2 class="h1 mb-0 d-flex gap-2 align-items-center">
                {{ __('collections.groups') }}
            </h2>

        </div>

        <div class="row mt-20">
            <div class="col-md-12">
                <div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title m-0 ">{{ __('collections.show_group') . ' ' . $group->name }}</h3>
                                <div>
                                    <a class="btn btn--primary"
                                        href="{{ route('groups.edit', ['id' => $group['id']]) }}">{{ __('collections.edit_group') }}</a>
                                    <button class="btn btn--primary mr-2" data-add_new_ledger="" data-toggle="modal"
                                        data-target="#add_new_ledger">{{ __('collections.add_new_ledger') }}</button>
                                    <button class="btn btn--primary mr-2" data-add_new_group="" data-toggle="modal"
                                        data-target="#add_new_group">{{ __('collections.add_new_group') }}</button>
                                </div>
                            </div>

                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td class="width30">{{ __('roles.name') }}</td>
                                            <td>{{ $group->name ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('property_master.code') }}</td>
                                            <td>{{ $group->code ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('collections.display_name') }}</td>
                                            <td>{{ $group->display_name ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('collections.nature') }}</td>
                                            <td>{{ $group->nature ?? '#' }}</td>
                                        </tr>
                                        @if (isset($sub_groups))

                                            @if ($sub_groups->isNotEmpty())
                                                <tr>
                                                    <td class="width30">{{ __('collections.sub_groups') }}</td>
                                                    <td>
                                                        @foreach ($sub_groups as $sub_group_item)
                                                            <a
                                                                href="{{ route('groups.show', ['id' => $sub_group_item['id']]) }}">{{ $sub_group_item->name ?? '#' }}</a>
                                                            ,
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif


                                        <tr>
                                            <td class="width30">{{ __('property_reports.prefix') }}</td>
                                            <td>{{ $group->result ?? '#' }}</td>
                                        </tr>
                                        @if (isset($parent_group))
                                            <tr>
                                                <td class="width30">{{ __('collections.parent_group') }}</td>
                                                <td><a
                                                        href="{{ route('groups.show', ['id' => $parent_group['id']]) }}">{{ $parent_group->name ?? '#' }}</a>
                                                </td>
                                            </tr>
                                        @endif



                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                @if (Session::has('success'))
                    <script>
                        swal("Message", "{{ Session::get('success') }}", 'success', {
                            button: true,
                            button: "Ok",
                            timer: 3000,
                        })
                    </script>
                @endif
            </div>
        </div>
    </div>


    <div class="modal fade " id="add_new_ledger" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('collections.add_new_ledger') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('ledgers.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group">
                                    <label for="">{{ __('roles.name') }}</label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group">
                                    <label for="">{{ __('country.currency_name') }}</label>
                                    <select name="currency" class="form-control">
                                        @foreach ($countries as $country_item)
                                            <option
                                                {{ $country_item->currency_name == 'Bahraini dinar' ? 'selected' : '' }}
                                                value="{{ $country_item->currency_name . '-' . $country_item->currency_symbol }}">
                                                {{ $country_item->currency_name . '-' . $country_item->currency_symbol }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group">
                                    <label for="">{{ __('property_master.code') }}</label>
                                    <input type="text" name="code" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group">
                                    <label for="">{{ __('collections.address') }}</label>
                                    {{-- <input type="text" name="code" class="form-control"> --}}
                                    <textarea name="address" class="form-control" cols="2" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group">
                                    <label for="">{{ __('collections.under_group') }}</label>
                                    <select name="group_id" class="form-control js-select2-custom">
                                        {{-- @foreach ($groups as $groups_item) --}}
                                        <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        {{-- @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group">
                                    <label for="">{{ __('property_management.telephone') }}</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group">
                                    <label for="">{{ __('property_management.contact_person') }}</label>
                                    <input type="text" name="contact_person" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group">
                                    <label for="">{{ __('roles.email') }}</label>
                                    <input type="text" name="email" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group">
                                    <label for="">{{ __('general.select') }}</label>
                                    <select name="country_id" class="form-control js-select2-custom">
                                        <option value="0">{{ __('country.country') }}</option>
                                        @foreach ($countries as $country_item)
                                            <option value="{{ $country_item->id }}"
                                                {{ $country_item->currency_name == 'Bahraini dinar' ? 'selected' : '' }}>
                                                {{ $country_item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-3">

                                <div class="form-group form-check">
                                    <input class="form-check-input" type="checkbox" name="is_cash" value="1">
                                    <label class="form-check-label"
                                        for="is_cash">{{ __('collections.is_cash') }}</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-3">

                                <div class="form-group form-check">
                                    <input class="form-check-input" type="checkbox" name="is_discount" value="1">
                                    <label class="form-check-label"
                                        for="is_discount">{{ __('collections.is_discount') }}</label>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-3">

                                <div class="form-group form-check">
                                    <input class="form-check-input" type="checkbox" name="project_general_ledger"
                                        value="1">
                                    <label class="form-check-label"
                                        for="project_general_ledger">{{ __('collections.project_general_ledger') }}</label>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4 col-xl-3">
                                <div class="form-group form-check">
                                    <input class="form-check-input" type="checkbox" name="maintain_bill_by_bill"
                                        value="1">
                                    <label class="form-check-label"
                                        for="maintain_bill_by_bill">{{ __('collections.maintain_bill_by_bill') }}</label>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4 col-xl-3">
                                <div class="form-group form-check">
                                    <input class="form-check-input" {{ $group->tax_applicable == 1 ? 'checked' : '' }}
                                        type="checkbox" name="tax_applicable" value="1">
                                    <label class="form-check-label"
                                        for="tax_applicable">{{ __('collections.tax_applicable') }}</label>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4 col-xl-3">
                                <div class="form-group form-check">
                                    <input class="form-check-input" type="checkbox" name="is_custom_vat" value="1">
                                    <label class="form-check-label"
                                        for="is_custom_vat">{{ __('collections.is_custom_vat') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2 {{ $group->tax_applicable == 1 ? '' : 'd-none' }}" id="tax_applicable_info">
                            <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="vat_applicable_from"
                                        class="title-color">{{ __('collections.applicable_from') }}</label>
                                    <input type="text" class="form-control" name="vat_applicable_from"
                                        id="vat_applicable_from"
                                        value="{{ isset($group->vat_applicable_from) ? \Carbon\Carbon::createFromFormat('Y-m-d', $group->vat_applicable_from)->format('d/m/Y') : '' }}">
                                </div>
                                @error('vat_applicable_from')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="is_taxable" class="title-color">{{ __('collections.tax_type') }}
                                    </label>
                                    <select class="js-select2-custom form-control" name="is_taxable">
                                        <option value="0" {{ $group->is_taxable == 0 ? 'selected' : '' }}>
                                            {{ __('companies.zero_rated') }}</option>
                                        <option value="1" {{ $group->is_taxable == 1 ? 'selected' : '' }}>
                                            {{ __('collections.taxability') }}</option>
                                        <option value="2" {{ $group->is_taxable == 2 ? 'selected' : '' }}>
                                            {{ __('companies.exempted') }}</option>
                                        <option value="3" {{ $group->is_taxable == 3 ? 'selected' : '' }}>
                                            {{ __('companies.non_taxable') }}</option>


                                    </select>
                                </div>
                                @error('is_taxable')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="tax_rate" class="title-color">{{ __('companies.tax_rate') }}</label>
                                    <input type="number" class="form-control" name="tax_rate"
                                        value="{{ $group->tax_rate }}" @if ($group->tax_rate == 0) disabled @endif>
                                </div>
                                @error('tax_rate')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="row mt-2  "> --}}
                        <div class="col-md-12 col-lg-4 col-xl-12">
                            <label for="">{{ __('collections.is_bank') }}</label>
                            <div class="form-group">
                                <input type="radio" name="bank_status" value="yes">
                                <label for="name" class="title-color">{{ __('general.yes') }}
                                </label>
                                <input type="radio" name="bank_status" value="no"
                                    class="{{ $lang == 'ar' ? 'mr-3' : 'ml-3' }}" checked>
                                <label for="name" class="title-color">{{ __('general.no') }}
                                </label>
                            </div>
                        </div>

                        <div class="row d-none" id="bank_info">
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('collections.bank_name') }}</label>
                                    <input type="text" name="bank_name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('collections.account_name') }}</label>
                                    <input type="text" name="account_name" value="{{ $company->name }}"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('collections.branch') }}</label>
                                    <input type="text" name="branch" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('collections.account_no') }}</label>
                                    <input type="text" name="account_no" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('collections.iban_no') }}</label>
                                    <input type="text" name="iban_no" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="swift_code">{{ __('collections.swift_code') }}</label>
                                    <input type="text" name="swift_code" class="form-control">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('general.cancel') }}</button>
                        <button type="submit" class="btn btn--primary">{{ __('general.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade " id="add_new_group" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('collections.add_new_group') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('groups.store') }}" method="post">
                    @csrf
                    <div class="modal-body" style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                        <div class="row">
                            <div class="col-md-12 col-lg-4 col-xl-12">
                                <div class="form-group">
                                    <label for="">{{ __('roles.name') }} <span class="text-danger">
                                            *</span></label>
                                    <input type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-12">
                                <div class="form-group">
                                    <label for="">{{ __('property_master.code') }} <span class="text-danger">
                                            *</span></label>
                                    <input type="text" name="code" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-12">
                                <div class="form-group">
                                    <label for="">{{ __('collections.display_name') }} <span class="text-danger">
                                            *</span></label>
                                    <input type="text" name="display_name" class="form-control">
                                </div>
                            </div>


                            <div class="col-md-12 col-lg-4 col-xl-12">
                                <div class="form-group">
                                    <label for="">{{ __('collections.under_group') }} <span class="text-danger">
                                            *</span></label>
                                    <select name="group_id" class="form-control js-select2-custom ">

                                        <option value="{{ $group->id }}">{{ $group->name }}
                                        </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-12">
                                <div class="form-group">
                                    <label for="">{{ __('collections.nature') }} <span class="text-danger">
                                            *</span></label>
                                    <input type="text" name="nature" class="form-control">
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4 col-xl-12">
                                <div class="form-group form-check">
                                    <input class="form-check-input" @if ($group->tax_applicable == 1) checked @endif
                                        type="checkbox" name="tax_applicable" value="1">
                                    <label class="form-check-label"
                                        for="tax_applicable">{{ __('collections.tax_applicable') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-2  @if ($group->tax_applicable == 0) d-none @endif "
                            id="tax_applicable_info_group">
                            <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="vat_applicable_from"
                                        class="title-color">{{ __('collections.applicable_from') }}</label>
                                    <input type="text" class="form-control" name="vat_applicable_from"
                                        id="vat_applicable_from"
                                        value="{{ isset($group->vat_applicable_from) ? \Carbon\Carbon::createFromFormat('Y-m-d', $group->vat_applicable_from)->format('d/m/Y') : '' }}">
                                </div>
                                @error('vat_applicable_from')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="is_taxable" class="title-color">{{ __('collections.tax_type') }}
                                    </label>
                                    <select class="js-select2-custom form-control" name="is_taxable">
                                        <option value="0" {{ $group->is_taxable == 0 ? 'selected' : '' }}>
                                            {{ __('companies.zero_rated') }}</option>
                                        <option value="1" {{ $group->is_taxable == 1 ? 'selected' : '' }}>
                                            {{ __('collections.taxability') }}</option>
                                        <option value="2" {{ $group->is_taxable == 2 ? 'selected' : '' }}>
                                            {{ __('companies.exempted') }}</option>
                                        <option value="3" {{ $group->is_taxable == 3 ? 'selected' : '' }}>
                                            {{ __('companies.non_taxable') }}</option>
                                    </select>
                                </div>
                                @error('is_taxable')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="tax_rate" class="title-color">{{ __('companies.tax_rate') }}</label>
                                    <input type="number" class="form-control" name="tax_rate"
                                        value="{{ $group->tax_rate }}" @if ($group->tax_rate == 0) disabled @endif>
                                </div>
                                @error('tax_rate')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-md-12 col-lg-4 col-xl-12">
                                <label for="">{{ __('roles.status') }}</label>
                                <div class="form-group">
                                    <input type="radio" name="main_status" checked value="active">
                                    <label for="name" class="title-color">{{ __('general.active') }}
                                    </label>
                                    <input type="radio" name="main_status" value="inactive"
                                        class="{{ $lang == 'ar' ? 'mr-3' : 'ml-3' }}">
                                    <label for="name" class="title-color">{{ __('general.inactive') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-12">
                                <label for="">{{ __('collections.enable_auto_code') }}</label>
                                <div class="form-group">
                                    <input type="radio" name="status" value="yes">
                                    <label for="name" class="title-color">{{ __('general.yes') }}
                                    </label>
                                    <input type="radio" name="status" value="no"
                                        class="{{ $lang == 'ar' ? 'mr-3' : 'ml-3' }}" checked>
                                    <label for="name" class="title-color">{{ __('general.no') }}
                                    </label>
                                </div>
                            </div>

                        </div>
                        <div class="row d-none" id="prefix_group">
                            <div class="col-md-12 col-lg-4 col-xl-4">
                                <div class="form-group ">
                                    <label for="">{{ __('property_reports.prefix') }}</label>
                                    <input type="text" name="prefix" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-4">
                                <div class="form-group ">
                                    <label for="">{{ __('collections.start_number') }}</label>
                                    <input type="number" name="start_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-4">
                                <div class="form-group ">
                                    <label for="">{{ __('collections.prefix_with_zero') }}</label>
                                    {{-- <input type="text" name="prefix_with_zero" class="form-control"> --}}
                                    <select name="prefix_with_zero" class="form-control">
                                        <option value="yes">{{ __('general.yes') }}</option>
                                        <option value="no" selected>{{ __('general.no') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-4">
                                <div class="form-group ">
                                    <label for="">{{ __('collections.total_digit') }}</label>
                                    <input type="number" name="total_digit" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-4">
                                <div class="form-group ">
                                    <label for="">{{ __('general.result') }}</label>
                                    <input type="text" readonly name="result" class="form-control">

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ __('general.cancel') }}</button>
                        <button type="submit" class="btn btn--primary">{{ __('general.submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        flatpickr("#vat_applicable_from", {
            dateFormat: "d/m/Y",
        });
    </script>
    <script>
        $(document).ready(function() {
            $('input[name="tax_applicable"]').on('change', function() {
                var tax_applicable_info = $('#tax_applicable_info');

                if ($(this).is(':checked')) {
                    tax_applicable_info.removeClass('d-none');
                } else {
                    tax_applicable_info.addClass('d-none');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            $('input[name="bank_status"]').on('change', function() {
                var bank_status = $(this).val();
                var bank_info = $('#bank_info');

                if (bank_status == 'yes') {
                    bank_info.removeClass('d-none');

                } else if (bank_status == 'no') {
                    bank_info.addClass('d-none');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('input[name="tax_applicable"]').on('change', function() {
                var tax_applicable_info = $('#tax_applicable_info_group');

                if ($(this).is(':checked')) {
                    tax_applicable_info.removeClass('d-none');
                } else {
                    tax_applicable_info.addClass('d-none');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('input[name="prefix"]').on('keyup', function() {
                let prefix = $(this).val();
                let prefix_with_zero = $('select[name="prefix_with_zero"]').val();
                let total_digit = $('input[name="total_digit"]').val();
                let start_number = $('input[name="start_number"]').val();
                if (prefix_with_zero == 'yes') {
                    let paddedNumber = start_number.toString().padStart(total_digit, '0');

                    let result = $('input[name="result"]').val(prefix + paddedNumber);

                } else {
                    let paddedNumber = start_number.toString().padStart(0, '0');
                    let result = $('input[name="result"]').val(prefix + paddedNumber);
                }
            });
            $('input[name="start_number"]').on('keyup', function() {
                let start_number = $(this).val();
                let prefix_with_zero = $('select[name="prefix_with_zero"]').val();
                let total_digit = $('input[name="total_digit"]').val();
                let prefix = $('input[name="prefix"]').val();
                if (prefix_with_zero == 'yes') {
                    let paddedNumber = start_number.toString().padStart(total_digit, '0');

                    let result = $('input[name="result"]').val(prefix + paddedNumber);

                } else {
                    let paddedNumber = start_number.toString().padStart(0, '0');
                    let result = $('input[name="result"]').val(prefix + paddedNumber);
                }
            });
            $('input[name="total_digit"]').on('keyup', function() {
                let total_digit = $(this).val();
                let prefix_with_zero = $('select[name="prefix_with_zero"]').val();
                let start_number = $('input[name="start_number"]').val();
                let prefix = $('input[name="prefix"]').val();
                if (prefix_with_zero == 'yes') {
                    let paddedNumber = start_number.toString().padStart(total_digit, '0');

                    let result = $('input[name="result"]').val(prefix + paddedNumber);

                } else {
                    let paddedNumber = start_number.toString().padStart(0, '0');
                    let result = $('input[name="result"]').val(prefix + paddedNumber);
                }
            });
            $('select[name="prefix_with_zero"]').on('change', function() {
                let prefix_with_zero = $(this).val();
                let total_digit = $('input[name="total_digit"]').val();
                let start_number = $('input[name="start_number"]').val();
                let prefix = $('input[name="prefix"]').val();
                if (prefix_with_zero == 'yes') {
                    let paddedNumber = start_number.toString().padStart(total_digit, '0');

                    let result = $('input[name="result"]').val(prefix + paddedNumber);

                } else {
                    let paddedNumber = start_number.toString().padStart(0, '0');
                    let result = $('input[name="result"]').val(prefix + paddedNumber);
                }
            });

            $('input[name="status"]').on('change', function() {
                var status = $(this).val();
                var prefix_group = $('#prefix_group');

                if (status == 'yes') {
                    prefix_group.removeClass('d-none');

                } else if (status == 'no') {
                    prefix_group.addClass('d-none');
                }
            });
        });
    </script>
@endpush
