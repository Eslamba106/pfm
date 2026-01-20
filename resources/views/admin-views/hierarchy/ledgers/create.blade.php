@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
        $company = App\Models\Company::where('id' , auth()->user()->company_id )->first() ?? App\Models\User::first();
@endphp
@section('title', ui_change('create_ledger'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">
@endpush
@php
    $lang = Session::get('locale');
@endphp
@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                {{ ui_change('create_ledger') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ ui_change('create_ledger') }}
                    </div>
                    <div class="card-body" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route('ledgers.store' ) }}" method="post">
                            @csrf 
                            <div class="row">
                                <div class="col-md-12 col-lg-4 col-xl-6">
                                    <div class="form-group">
                                        <label for="">{{ ui_change('name') }}</label>
                                        <input type="text" name="name" required
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-6">
                                    <div class="form-group">
                                        <label for="">{{ ui_change('currency_name') }}</label>
                                        <select name="currency" class="form-control">
                                            @foreach ($countries as $country_item)
                                                <option  value="{{ $country_item->currency_name . '-' . $country_item->currency_symbol }}"
                                                    {{ ($company->currency == $country_item->currency_name  ) ? 'selected' : '' }}
                                                    >
                                                    {{ $country_item->currency_name . '-' . $country_item->currency_symbol }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-4 col-xl-6">
                                    <div class="form-group">
                                        <label for="">{{ ui_change('code') }}</label>
                                        <input type="text" name="code"   required
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-6">
                                    <div class="form-group">
                                        <label for="">{{ ui_change('address') }}</label>
                                        <textarea name="address" class="form-control" cols="2" rows="2"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-6">
                                    <div class="form-group">
                                        <label for="">{{ ui_change('under_group') }}</label>
                                        <select name="group_id" class="form-control js-select2-custom">
                                            @foreach ($groups as $groups_item)
                                                <option value="{{ $groups_item->id }}" >
                                                    {{ $groups_item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-6">
                                    <div class="form-group">
                                        <label for="">{{ ui_change('telephone') }}</label>
                                        <input type="text" name="phone" 
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-6">
                                    <div class="form-group">
                                        <label for="">{{ ui_change('contact_person') }}</label>
                                        <input type="text" name="contact_person"  
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-6">
                                    <div class="form-group">
                                        <label for="">{{ ui_change('email') }}</label>
                                        <input type="text" name="email"  
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-6">
                                    <div class="form-group">
                                        <label for="">{{ ui_change('select') }}</label>
                                        <select name="country_id" class="form-control js-select2-custom">
                                            <option value="0">{{ ui_change('country') }}</option>
                                            @foreach ($countries as $country_item)
                                                <option value="{{ $country_item->id }}" {{ ($company->country_master?->country?->id == $country_item->id  ) ? 'selected' : '' }} >
                                                    {{ $country_item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-3">

                                    <div class="form-group form-check">
                                        <input class="form-check-input" type="checkbox" name="is_cash" value="1" >
                                        <label class="form-check-label"
                                            for="is_cash">{{ ui_change('is_cash') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-3">

                                    <div class="form-group form-check">
                                        <input class="form-check-input" type="checkbox" name="is_discount" value="1" >
                                        <label class="form-check-label"
                                            for="is_discount">{{ ui_change('is_discount') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-3">

                                    <div class="form-group form-check">
                                        <input class="form-check-input" type="checkbox" name="project_general_ledger"
                                            value="1"  >
                                        <label class="form-check-label"
                                            for="project_general_ledger">{{ ui_change('project_general_ledger') }}</label>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-4 col-xl-3">
                                    <div class="form-group form-check">
                                        <input class="form-check-input" type="checkbox" name="maintain_bill_by_bill"  value="1">
                                        <label class="form-check-label"
                                            for="maintain_bill_by_bill">{{ ui_change('maintain_bill_by_bill') }}</label>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-4 col-xl-3">
                                    <div class="form-group form-check">
                                        <input class="form-check-input" type="checkbox" name="tax_applicable"
                                            value="1"  >
                                        <label class="form-check-label"
                                            for="tax_applicable">{{ ui_change('tax_applicable') }}</label>
                                    </div>
                                </div>

                                <div class="col-md-12 col-lg-4 col-xl-3">
                                    <div class="form-group form-check">
                                        <input class="form-check-input" type="checkbox" name="is_custom_vat"
                                            value="1"  >
                                        <label class="form-check-label"
                                            for="is_custom_vat">{{ ui_change('is_custom_vat') }}</label>
                                    </div>
                                </div>


                            </div>
                            <div class="row mt-2 "
                                id="tax_applicable_info">
                                <div class="col-md-6 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label for="vat_applicable_from"
                                            class="title-color">{{ ui_change('applicable_from') }}</label>
                                        <input type="text" class="form-control" name="vat_applicable_from"
                                            id="vat_applicable_from" 
                                            value="">
                                    </div>
                                    @error('vat_applicable_from')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-4">
                                    <div class="form-group">
                                        <label for="is_taxable" class="title-color">{{ ui_change('tax_type') }}
                                        </label>
                                        <select class="js-select2-custom form-control" name="is_taxable">
                                            <option value="0"  >
                                                {{ ui_change('zero_rated') }}</option>
                                            <option value="1"  >
                                                {{ ui_change('taxability') }}</option>
                                            <option value="2" >
                                                {{ ui_change('exempted') }}</option>
                                            <option value="3" >
                                                {{ ui_change('non_taxable') }}</option>


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
                                        <label for="tax_rate" class="title-color">{{ ui_change('tax_rate') }}</label>
                                        <input type="number" class="form-control" name="tax_rate"   
                                        >
                                    </div>
                                    @error('tax_rate')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
 

                            </div>
                            <div class="row mt-2 ">
                                <div class="col-md-12 col-lg-4 col-xl-12">
                                    <label for="">{{ ui_change('is_bank') }}</label>
                                    <div class="form-group">
                                        <input type="radio" name="bank_status" value="yes" >
                                        <label for="name" class="title-color">{{ ui_change('yes') }}</label>
                                        <input type="radio" name="bank_status" value="no"
                                            class="{{ $lang == 'ar' ? 'mr-3' : 'ml-3' }}" >
                                        <label for="name" class="title-color">{{ ui_change('no') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row  " id="bank_info">
                                <div class="col-md-12 col-lg-4 col-xl-6">
                                    <div class="form-group ">
                                        <label for="">{{ ui_change('bank_name') }}</label>
                                        <input type="text" name="bank_name"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-6">
                                    <div class="form-group ">
                                        <label for="">{{ ui_change('account_name') }}</label>
                                        <input type="text" value="{{ $company->name }}"
                                            name="account_name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-6">
                                    <div class="form-group ">
                                        <label for="">{{ ui_change('branch') }}</label>
                                        <input type="text"   name="branch"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-6">
                                    <div class="form-group ">
                                        <label for="">{{ ui_change('account_no') }}</label>
                                        <input type="text"   name="account_no"
                                            class="form-control">

                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-6">
                                    <div class="form-group ">
                                        <label for="">{{ ui_change('iban_no') }}</label>
                                        <input type="text"  name="iban_no"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-6">
                                    <div class="form-group ">
                                        <label for="">{{ ui_change('swift_code') }}</label>
                                        <input type="text"  name="swift_code"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>



                            <div class="d-flex flex-wrap gap-2 justify-content-end">
                                <button type="reset" class="btn btn-secondary">{{ ui_change('reset') }}</button>
                                <button type="submit" class="btn btn--primary">{{ ui_change('submit') }}</button>
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
        flatpickr("#vat_applicable_from", {
            dateFormat: "d/m/Y",
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
        $('select[name="group_id"]').on('change', function() {
            var group_id = $(this).val();
            
            if (group_id) {
                $.ajax({
                    url: "{{ route('get_group_by_id', ':id') }}".replace(':id', group_id),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        var tax_applicable_info = $('#tax_applicable_info');
                        var tax_rate_input = $('input[name="tax_rate"]');
                        var is_taxable = $('select[name="is_taxable"]');
                        var vat_applicable_from = $('input[name="vat_applicable_from"]'); 
                            if (data.group.tax_applicable == 1) {
                                $('input[name="tax_applicable"]').prop('checked', true);
                                tax_applicable_info.removeClass('d-none');
                                tax_rate_input.empty();
                                tax_rate_input.val(data.group.tax_rate);
                                 
                                if(data.group.tax_rate > 0){
                                    tax_rate_input.removeAttr('disabled')
                                }
                                is_taxable.val(data.group.is_taxable).change(); 
                                vat_applicable_from.empty();
                                vat_applicable_from.val(data.date);
                            } else {
                                $('input[name="tax_applicable"]').prop('checked', false);
                                tax_rate_input.empty();
                                tax_rate_input.attr('disabled', 'disabled').val('0');
                                tax_applicable_info.addClass('d-none');
                            } 
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            }

        });
    </script>
    <script>
        $('select[name="is_taxable"]').on('change', function() {
            var is_taxable = $(this).val();
            var $tax_rate_input = $('input[name="tax_rate"]');

            if (is_taxable == '2' || is_taxable == '1') {
                $tax_rate_input.removeAttr('disabled') ;
            } else if (is_taxable == '0' || is_taxable == '3') {
                $tax_rate_input.attr('disabled', 'disabled').val('0');
            }
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
                var prefix_ledger = $('#prefix_ledger');

                if (status == 'yes') {
                    prefix_ledger.removeClass('d-none');

                } else if (status == 'no') {
                    prefix_ledger.addClass('d-none');
                }
            });
        });
    </script>
@endpush
