@extends('layouts.back-end.app')
@section('title', __('collections.edit_group'))
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
                {{ __('collections.edit_group') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ __('collections.edit_group') }}
                    </div>
                    <div class="card-body" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route('groups.update', $group->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="row">
                                <div class="col-md-12 col-lg-4 col-xl-12">
                                    <div class="form-group">
                                        <label for="">{{ __('roles.name') }} <span class="text-danger">
                                                *</span></label>
                                        <input type="text" name="name" value="{{ $group->name }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-12">
                                    <div class="form-group">
                                        <label for="">{{ __('property_master.code') }} <span class="text-danger">
                                                *</span></label>
                                        <input type="text" name="code" value="{{ $group->code }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-12">
                                    <div class="form-group">
                                        <label for="">{{ __('collections.display_name') }} <span
                                                class="text-danger"> *</span></label>
                                        <input type="text" name="display_name" value="{{ $group->display_name }}"
                                            class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-12 col-lg-4 col-xl-12">
                                    <div class="form-group">
                                        <label for="">{{ __('collections.under_group') }} <span
                                                class="text-danger"> *</span></label>
                                        <select name="group_id" class="form-control js-select2-custom ">
                                            <option value="0" {{ 0 == $group->group_id ? 'selected' : '' }}>
                                                {{ __('collections.leave_as_parent') }}</option>
                                            @foreach ($main as $main_item)
                                                <option value="{{ $main_item->id }}"
                                                    {{ $main_item->id == $group->group_id ? 'selected' : '' }}>
                                                    {{ $main_item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-12">
                                    <div class="form-group">
                                        <label for="">{{ __('collections.nature') }} <span class="text-danger">
                                                *</span></label>
                                        <input type="text" name="nature" value="{{ $group->nature }}"
                                            class="form-control">
                                    </div>
                                </div>


                                <div class="col-md-12 col-lg-4 col-xl-12">
                                    <div class="form-group form-check">
                                        <input class="form-check-input" type="checkbox" name="tax_applicable" value="1"
                                            {{ $group->tax_applicable == 1 ? 'checked' : '' }}>
                                        <label class="form-check-label"
                                            for="tax_applicable">{{ __('collections.tax_applicable') }}</label>
                                    </div>
                                </div>
                                </div>

                                <div class="row mt-2 @if ($group->tax_applicable == 0) d-none @endif"
                                    id="tax_applicable_info">
                                    <div class="col-md-6 col-lg-4 col-xl-4">
                                        <div class="form-group">
                                            <label for="vat_applicable_from"
                                                class="title-color">{{ __('collections.applicable_from') }}</label>
                                            <input type="text" class="form-control" name="vat_applicable_from"
                                                id="vat_applicable_from"
                                                value="{{ isset($group->vat_applicable_from) ? (\Carbon\Carbon::createFromFormat('Y-m-d', $group->vat_applicable_from)->format('d/m/Y') )
                                                 : ( now()->format('d/m/Y') ) }}">
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
                                            <label for="tax_rate"
                                                class="title-color">{{ __('companies.tax_rate') }}</label>
                                            <input type="number" class="form-control" name="tax_rate"
                                                value="{{ $group->tax_rate }}"
                                                @if ($group->is_taxable != 1) disabled @endif>
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
                                            <input type="radio" name="main_status"
                                                {{ $group->status == 'active' ? 'checked' : '' }} value="active">
                                            <label for="name" class="title-color">{{ __('general.active') }}
                                            </label>
                                            <input type="radio" name="main_status"
                                                {{ $group->status == 'inactive' ? 'checked' : '' }} value="inactive"
                                                class="{{ $lang == 'ar' ? 'mr-3' : 'ml-3' }}">
                                            <label for="name" class="title-color">{{ __('general.inactive') }}
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-lg-4 col-xl-12">
                                        <label for="">{{ __('collections.enable_auto_code') }}</label>
                                        <div class="form-group">
                                            <input type="radio" name="status" value="yes"
                                                {{ $group->enable_auto_code == 1 ? 'checked' : '' }}>
                                            <label for="name" class="title-color">{{ __('general.yes') }}
                                            </label>
                                            <input type="radio" name="status" value="no"
                                                {{ $group->enable_auto_code == 0 ? 'checked' : '' }}
                                                class="{{ $lang == 'ar' ? 'mr-3' : 'ml-3' }}">
                                            <label for="name" class="title-color">{{ __('general.no') }}
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <div class="row  {{ $group->enable_auto_code == 1 ? '' : 'd-none' }} " id="prefix_group">
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
                                            <input type="text" value="{{ $group->result }}" readonly name="result"
                                                class="form-control">

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
        flatpickr("#vat_applicable_from", {
            dateFormat: "d/m/Y",
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
        $(document).ready(function() {
            $('input[name="tax_applicable"]').on('change', function() {
                var tax_applicable_info = $('#tax_applicable_info');

                if ($(this).is(':checked')) {
                    tax_applicable_info.removeClass('d-none');
                } else {
                    tax_applicable_info.addClass('d-none');
                }
            });
            $('input[name="name"]').on('keyup', function() {
            var name = $(this).val();
            $('input[name="display_name"]').val(name);
            
        });
        });
    </script>
    <script>
        $('select[name="is_taxable"]').on('change', function() {
            var is_taxable = $(this).val();
            var $tax_rate_input = $('input[name="tax_rate"]');

            if (is_taxable == '2' || is_taxable == '1') {
                $tax_rate_input.removeAttr('disabled').val('0');
            } else if (is_taxable == '0' || is_taxable == '3') {
                $tax_rate_input.attr('disabled', 'disabled').val('0');
            }
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
