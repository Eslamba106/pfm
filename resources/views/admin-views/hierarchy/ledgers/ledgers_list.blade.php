@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
        $company = App\Models\Company::where('id' , auth()->user()->company_id )->first() ?? App\Models\User::first();
@endphp
@section('title', __('collections.ledgers'))
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

                {{ __('collections.ledgers') }}
            </h2>
            <button class="btn btn--primary mr-2" data-add_new_ledger="" data-toggle="modal"
                data-target="#add_new_ledger">{{ __('collections.add_new_ledger') }}</button>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.accounts_master.inline-menu')

        <!-- Content Row -->
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                <h5 class="mb-0 d-flex align-items-center gap-2">
                                    {{ __('collections.ledgers_list') }}
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
                                            placeholder="{{ __('collections.search_by_ledger_name') }}" aria-label="Search"
                                            value="{{ $search }}" required>
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
                                        <th class="text-center">{{ __('property_master.name') }} </th>
                                        <th class="text-center">{{ __('property_master.code') }} </th>
                                        <th class="text-center">{{ __('collections.under_group') }} </th>
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
                                            <td class="text-center">{{ $value->group->name }} </td>
                                            <td class="text-center">{{ __('general.' . $value->status) }} </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a class="btn btn-outline-info btn-sm square-btn"
                                                        title="{{ __('general.edit') }}"
                                                        href="{{ route('ledgers.edit', $value->id) }}">
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
                            <img class="mb-3 w-160" src="{{ asset('assets/back-end') }}/svg/illustrations/sorry.svg"
                                alt="Image Description">
                            <p class="mb-0">{{ __('general.no_data_to_show') }}</p>
                        </div>
                    @endif
                </div>
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
                                    <input type="text" name="name" class="form-control" required>
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
                                    <input type="text" name="code" class="form-control" required>
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
                                        @foreach ($groups as $groups_item)
                                            <option value="{{ $groups_item->id }}">{{ $groups_item->name }}</option>
                                        @endforeach
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
                                    <input class="form-check-input" type="checkbox" name="tax_applicable"
                                        value="1">
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
                        <div class="row mt-2 d-none" id="tax_applicable_info">
                            <div class="col-md-6 col-lg-4 col-xl-4">
                                <div class="form-group">
                                    <label for="vat_applicable_from"
                                        class="title-color">{{ __('collections.applicable_from') }}</label>
                                    <input type="text" class="form-control" name="vat_applicable_from"
                                        id="vat_applicable_from">
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
                                        <option value="0" selected>{{ __('companies.zero_rated') }}</option>
                                        <option value="1">{{ __('collections.taxability') }}</option>
                                        <option value="2">{{ __('companies.exempted') }}</option>
                                        <option value="3">{{ __('companies.non_taxable') }}</option>


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
                                    <input type="number" class="form-control" name="tax_rate" disabled>
                                </div>
                                @error('tax_rate')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                         
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
@endsection

@push('script')
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
                $tax_rate_input.removeAttr('disabled');
            } else if (is_taxable == '0' || is_taxable == '3') {
                $tax_rate_input.attr('disabled', 'disabled').val('0');
            }
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
        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            // var route_name = document.getElementById('route_name').value;
            Swal.fire({
                title: "{{ __('general.are_you_sure_delete_this') }}",
                text: "{{ __('general.you_will_not_be_able_to_revert_this') }}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __('general.yes_delete_it') }}!',
                cancelButtonText: '{{ __('general.cancel') }}',
                type: 'warning',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('ledgers.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success('{{ __('department.deleted_successfully') }}');
                            location.reload();
                        }
                    });
                }
            })
        });



        // Call the dataTables jQuery plugin
    </script>
    <script>
        flatpickr("#vat_applicable_from", {
            dateFormat: "d/m/Y",
             
        });
    </script>
@endpush
