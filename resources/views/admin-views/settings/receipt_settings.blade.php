@extends('layouts.back-end.app')
@php
    $currentUrl = url()->current();
    $segments = explode('/', $currentUrl);
    $end = end($segments);
    $lang = Session::get('locale');

@endphp
@section('title', __('general.settings'))

@push('css_or_js')
    <link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/custom.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center gap-3 mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                {{ __('collections.receipt_settings') }}
            </h2>

        </div>
        <!-- End Page Title -->

        <!-- Inlile Menu -->
        @include('admin-views.settings.business-setup-inline-menu')

        {{-- <div class="content container-fluid"> --}}
        <!-- Page Title -->

        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <h2 class="h1 mb-0 d-flex gap-2 align-items-center">

                                {{ __('collections.receipt_settings') }}
                            </h2>
                            <button class="btn btn--primary mr-2" data-add_new_ledger="" data-toggle="modal"
                                data-target="#add_new_ledger">{{ __('collections.add_new_settings') }}</button>
                        </div>
                    </div>
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                <h5 class="mb-0 d-flex align-items-center gap-2">
                                    {{ __('collections.receipt_settings') }}
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
                                        <th class="text-center">{{ __('collections.applicable_from') }} </th>
                                        <th class="text-center">{{ __('collections.total_digit') }}</th>
                                        <th class="text-center">{{ __('collections.start_number') }}</th>
                                        <th class="text-center">{{ __('property_reports.prefix') }}</th>
                                        <th class="text-center">{{ __('collections.sufix') }}</th>
                                        <th class="text-center">{{ __('general.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($receipt_settings as $key => $value)
                                        <tr>
                                            <td>{{ $receipt_settings->firstItem() + $key }}</td>
                                            <td class="text-center">{{ $value->name }}</td>
                                            <td class="text-center">{{ $value->applicable_date }} </td>
                                            <td class="text-center">{{ $value->total_digit }} </td>
                                            <td class="text-center">{{ $value->starting_number }} </td>
                                            <td class="text-center">{{ $value->prefix }} </td>
                                            <td class="text-center">{{ $value->sufix }} </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a id="edit_receipt_settings_item" class="btn btn-outline-info btn-sm square-btn"
                                                        title="{{ __('general.edit') }}"
                                                        data-receipt_settings_id="{{ $value->id }}" data-target="#edit_receipt_settings">
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
                            {!! $receipt_settings->links() !!}
                        </div>
                    </div>

                    @if (count($receipt_settings) == 0)
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
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('collections.add_new_settings') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('receipt_settings.store') }}" method="post">
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
                                    <label for="">{{ __('roles.ledgers') }}</label>
                                    <select name="ledgers[]" class="js-select2-custom form-control" multiple="multiple">
                                        @foreach ($ledgers as $ledger_item)
                                            <option value="{{ $ledger_item->id }}">
                                                {{ $ledger_item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('property_reports.prefix') }}</label>
                                    <input type="text" name="prefix" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('collections.sufix') }}</label>
                                    <input type="text" name="sufix" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('collections.start_number') }}</label>
                                    <input type="number" name="start_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('collections.prefix_with_zero') }}</label>
                                    <select name="prefix_with_zero" class="form-control">
                                        <option value="yes">{{ __('general.yes') }}</option>
                                        <option value="no" selected>{{ __('general.no') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('collections.total_digit') }}</label>
                                    <input type="number" name="total_digit" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('general.result') }}</label>
                                    <input type="text" readonly name="result" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-6">
                                <div class="form-group">
                                    <label for="applicable_from"
                                        class="title-color">{{ __('collections.applicable_from') }}</label>
                                    <input type="text" class="form-control" name="applicable_date"
                                        id="create_applicable_from">
                                </div>
                                @error('applicable_from')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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




    <div class="modal fade" id="edit_receipt_settings" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('collections.edit_settings') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('receipt_settings.update' )}}" method="post">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group">
                                    <label for="">{{ __('roles.name') }}</label>
                                    <input id="edit_name" type="text" name="name" class="form-control">
                                    <input id="edit_receipt_settings_id" type="hidden" name="edit_receipt_settings_id" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group">
                                    <label for="">{{ __('roles.ledgers') }}</label>
                                    <select name="ledgers[]" class="js-select2-custom form-control" multiple="multiple">
                                        @foreach ($ledgers as $ledger_item)
                                            <option value="{{ $ledger_item->id }}">
                                                {{ $ledger_item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('property_reports.prefix') }}</label>
                                    <input id="edit_prefix"  type="text" name="prefix" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('collections.sufix') }}</label>
                                    <input id="edit_sufix" type="text" name="sufix" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('collections.start_number') }}</label>
                                    <input id="edit_start_number" type="number" name="start_number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('collections.prefix_with_zero') }}</label>
                                    <select name="prefix_with_zero" class="form-control">
                                        <option value="yes">{{ __('general.yes') }}</option>
                                        <option value="no" selected>{{ __('general.no') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('collections.total_digit') }}</label>
                                    <input type="number" id="edit_total_digit" name="total_digit" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-6">
                                <div class="form-group ">
                                    <label for="">{{ __('general.result') }}</label>
                                    <input type="text"  id="edit_result"  name="result" class="form-control">

                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-6">
                                <div class="form-group">
                                    <label for="applicable_from"
                                        class="title-color">{{ __('collections.applicable_from') }}</label>
                                    <input type="text" class="form-control" name="applicable_date"
                                        id="edit_applicable_from">
                                </div>
                                @error('applicable_from')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
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
       $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            Swal.fire({
                title: "{{ __('general.are_you_sure_delete_this') }}",
                text: "{{ __('general.you_will_not_be_able_to_revert_this') }}!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ __('general.yes_delete_it') }}!",
                cancelButtonText: "{{ __('general.cancel') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('receipt_settings.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success("{{ __('general.deleted_successfully') }}");
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
    <script>
        flatpickr("#edit_applicable_from", {
            dateFormat: "d/m/Y",
        });
        flatpickr("#create_applicable_from", {
            dateFormat: "d/m/Y",
        });
    </script>
    <script>
        $(document).on('click', '#edit_receipt_settings_item', function(e) {
            e.preventDefault();
            var sect_id = $(this).data('receipt_settings_id');
            $('#edit_receipt_settings').modal('show');
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "{{ route('receipt_settings.edit', ':id') }}".replace(':id', sect_id),
                success: function(response) {
                    if (response.status == 404) {
                        $('#success_message').html("");
                        $('#success_message').addClass("alert alert-danger");
                        $('#success_message').text(response.message);
                    } else {
                        let main_date = response.receipt_settings.applicable_date;
                        if (main_date) {
                            let formattedDate = moment(main_date, "YYYY-MM-DD").format("DD/MM/YYYY");
                            $('#edit_applicable_from').val(formattedDate)
                        }
                        $('#edit_receipt_settings_id').val(sect_id)
                        $('#edit_name').val(response.receipt_settings.name)
                        $('#edit_prefix').val(response.receipt_settings.prefix)
                        $('#edit_sufix').val(response.receipt_settings.sufix)
                        $('#edit_start_number').val(response.receipt_settings.starting_number)
                        $('#edit_total_digit').val(response.receipt_settings.total_digit)
                        $('#edit_result').val(response.receipt_settings.result)

                        // let selectedLedgers = response.main_ledgers.map(l => l.id);
                        // $('.js-select2-custom').val(selectedLedgers).trigger('change');
                        let selectedLedgers = response.main_ledgers.map(l => l.main_ledger_id);
                        $('.js-select2-custom').val(selectedLedgers).trigger('change');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('input[name="sufix"]').on('keyup', function() {
                let sufix = $(this).val();
                let prefix_with_zero = $('select[name="prefix_with_zero"]').val();
                let prefix = $('input[name="prefix"]').val();
                let total_digit = $('input[name="total_digit"]').val();
                let start_number = $('input[name="start_number"]').val();
                if (prefix_with_zero == 'yes') {
                    let paddedNumber = start_number.toString().padStart(total_digit, '0');

                    let result = $('input[name="result"]').val(prefix + paddedNumber + sufix);

                } else {
                    let paddedNumber = start_number.toString().padStart(0, '0');
                    let result = $('input[name="result"]').val(prefix + paddedNumber + sufix);
                }
            });
            $('input[name="prefix"]').on('keyup', function() {
                let prefix = $(this).val();
                let sufix = $('input[name="sufix"]').val();
                let prefix_with_zero = $('select[name="prefix_with_zero"]').val();
                let total_digit = $('input[name="total_digit"]').val();
                let start_number = $('input[name="start_number"]').val();
                if (prefix_with_zero == 'yes') {
                    let paddedNumber = start_number.toString().padStart(total_digit, '0');

                    let result = $('input[name="result"]').val(prefix + paddedNumber + sufix);

                } else {
                    let paddedNumber = start_number.toString().padStart(0, '0');
                    let result = $('input[name="result"]').val(prefix + paddedNumber + sufix);
                }
            });
            $('input[name="start_number"]').on('keyup', function() {
                let start_number = $(this).val();
                let prefix_with_zero = $('select[name="prefix_with_zero"]').val();
                let total_digit = $('input[name="total_digit"]').val();
                let prefix = $('input[name="prefix"]').val();
                let sufix = $('input[name="sufix"]').val();
                if (prefix_with_zero == 'yes') {
                    let paddedNumber = start_number.toString().padStart(total_digit, '0');

                    let result = $('input[name="result"]').val(prefix + paddedNumber + sufix);

                } else {
                    let paddedNumber = start_number.toString().padStart(0, '0');
                    let result = $('input[name="result"]').val(prefix + paddedNumber + sufix);
                }
            });
            $('input[name="total_digit"]').on('keyup', function() {
                let total_digit = $(this).val();
                let prefix_with_zero = $('select[name="prefix_with_zero"]').val();
                let start_number = $('input[name="start_number"]').val();
                let prefix = $('input[name="prefix"]').val();
                let sufix = $('input[name="sufix"]').val();
                if (prefix_with_zero == 'yes') {
                    let paddedNumber = start_number.toString().padStart(total_digit, '0');

                    let result = $('input[name="result"]').val(prefix + paddedNumber + sufix);

                } else {
                    let paddedNumber = start_number.toString().padStart(0, '0');
                    let result = $('input[name="result"]').val(prefix + paddedNumber + sufix);
                }
            });
            $('select[name="prefix_with_zero"]').on('change', function() {
                let prefix_with_zero = $(this).val();
                let total_digit = $('input[name="total_digit"]').val();
                let start_number = $('input[name="start_number"]').val();
                let prefix = $('input[name="prefix"]').val();
                let sufix = $('input[name="sufix"]').val();
                if (prefix_with_zero == 'yes') {
                    let paddedNumber = start_number.toString().padStart(total_digit, '0');

                    let result = $('input[name="result"]').val(prefix + paddedNumber + sufix);

                } else {
                    let paddedNumber = start_number.toString().padStart(0, '0');
                    let result = $('input[name="result"]').val(prefix + paddedNumber + sufix);
                }
            });


        });
    </script>
    <script>
        flatpickr("#applicable_from", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
    </script>
@endpush
