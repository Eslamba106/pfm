@extends('layouts.back-end.app')

@section('title', __('roles.all_receipts'))
@php
        // $company = App\Models\Company::where('id' , auth()->user()->company_id )->first() ?? App\Models\User::first();
            $company =(new App\Models\Company())->setConnection('tenant')->first() ;

    $lang = session()->get('locale');
@endphp
@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                {{-- <img src="{{ asset(main_path() . 'back-end/img/inhouse-subscription-list.png') }}" alt=""> --}}
                {{ __('roles.all_receipts') }}
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $receipts->total() }}</span>
            </h2>
        </div>
        <!-- End Page Title -->


        <div class="row mt-20">
            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-lg-4">
                                <!-- Search -->
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-custom input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="{{ __('general.receipt_search') }}" aria-label="Search orders"
                                            value="{{ request('search') }}">
                                        <input type="hidden" value="{{ request('status') }}" name="status">
                                        <button type="submit" class="btn btn--primary">{{ __('general.search') }}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                            <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">


                                {{-- @can('create_receipt') --}}
                                {{-- <button class="btn   btn-outline-primary " data-generate_invoice="" data-toggle="modal"
                                    data-target="#generate_invoice">Generate Invoice</button> --}}
                                <button data-target="#add_receipt" data-add_receipt="" data-toggle="modal"
                                    class="btn btn--primary">
                                    <i class="tio-add"></i>
                                    <span class="text">{{ __('roles.create_receipt') }}</span>
                                </button>
                                {{-- @endcan --}}
                            </div>
                        </div>
                    </div>
                    <form action="" method="get">
                        <div class="px-3 py-4">
                            <div class="row align-items-center">
                                {{-- <div class="col-md-12 col-lg-4 col-xl-3">
                                    <label for="">
                                        {{ __('property_transactions.booking_status') }}
                                    </label>
                                    <select name="booking_status" class="form-control select2">
                                        <option value="-1">{{ __('All Booking Status') }}</option>
                                        <option value="proposal">{{ __('property_transactions.proposal') }}</option>
                                        <option value="booking">{{ __('property_transactions.booking') }}</option>
                                        <option value="receipt">{{ __('property_transactions.receipt') }}</option>
                                    </select>
                                </div> --}}

                                <div class="col-md-12 col-lg-4 col-xl-3">
                                    <label for="">
                                        {{ __('property_master.from') }}
                                    </label>
                                    <input type="text" id="from_search_date" name="from" class="form-control ">

                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-3">
                                    <label for="">
                                        {{ __('property_master.to') }}
                                    </label>
                                    <input type="text" id="to_search_date" name="to" class="form-control ">

                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-3">
                                    <label for="">
                                        {{ __('collections.voucher_type') }}
                                    </label>
                                    <select class="js-select2-custom form-control" name="voucher_type">
                                        <option value="-1">
                                            {{ __('general.all') }}
                                        </option>
                                        @foreach ($receipt_settings as $receipt_settings_item)
                                            <option value="{{ $receipt_settings_item->id }}">
                                                {{ $receipt_settings_item->name }} </option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="d-flex gap-3 justify-content-end mt-4">
                                    <button type="submit" class="btn btn--primary px-4 m-2" name="bulk_action_btn"
                                        value="filter"> {{ __('general.filter') }}</button>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable"
                                style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th><input id="bulk_check_all" class="bulk_check_all" type="checkbox" />
                                            {{ __('general.sl') }}</th>
                                        <th class="text-center">{{ __('collections.receipt_no') }}</th>
                                        <th class="text-center">{{ __('collections.receipt_date') }}</th>
                                        <th class="text-center">{{ __('property_transactions.tenant') }}</th>
                                        <th class="text-center">{{ __('property_transactions.amount') }}</th>
                                        <th class="text-center">{{ __('country.currency_name') }}</th>
                                        <th class="text-center">{{ __('roles.Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($receipts as $k => $receipt_item)
                                        <tr>
                                            <th scope="row"><input class="check_bulk_item" name="bulk_ids[]"
                                                    type="checkbox" value="{{ $receipt_item->id }}" />
                                                {{ $receipts->firstItem() + $k }}</th>

                                            <td class="text-center">
                                                {{ $receipt_item->receipt_ref ?? __('general.not_available') }}
                                            </td>

                                            <td class="text-center">
                                                @php
                                                    $formatted_date = date(
                                                        'd-m-Y',
                                                        strtotime($receipt_item->receipt_date),
                                                    );
                                                @endphp
                                                {{ $formatted_date ?? __('general.not_available') }}
                                            </td>

                                            <td class="text-center">
                                                @php
                                                    $tenant = Illuminate\Support\Facades\DB::connection('tenant')->table('tenants')
                                                        ->where('id', $receipt_item->tenant_id)
                                                        ->first();
                                                @endphp
                                                {{ $tenant->type == 'individual' ? $tenant->name ?? __('general.not_available') : $tenant->company_name ?? __('general.not_available') }}
                                            </td>
                                            <td class="text-center">
                                                {{ $receipt_item->receipt_amount ?? __('general.not_available') }}
                                            </td>
                                            <td class="text-center">
                                                {{ $company->currency_code ?? __('general.not_available') }}
                                            </td>

                                            <td>
                                                <div class="d-flex justify-content-center gap-2">


                                                    <a class="btn btn-outline--primary btn-sm square-btn"
                                                        title="{{ __('general.edit') }}"
                                                        href="{{ route('receipts.edit', [$receipt_item->id]) }}">
                                                        <i class="tio-edit"></i>
                                                    </a>
                                                    <a class="btn btn-outline--primary btn-sm square-btn"
                                                        title="{{ __('general.print') }}"
                                                        href="{{ route('receipts.print_receipt', [$receipt_item->id]) }}">
                                                        <i class="fa fa-print"></i>
                                                    </a>

                                                    {{-- @endcan
                                                @can('delete_receipt') --}}
                                                    <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                        title="{{ __('general.delete') }}" id="{{ $receipt_item->id }}">
                                                        <i class="tio-delete"></i>
                                                    </a>
                                                    {{-- @endcan --}}

                                                </div>


                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <div class="table-responsive mt-4">
                        <div class="px-4 d-flex justify-content-lg-end">
                            <!-- Pagination -->
                            {{ $receipts->links() }}
                        </div>
                    </div>

                    @if (count($receipts) == 0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160"
                                src="{{ asset(main_path() . 'back-end') }}/svg/illustrations/sorry.svg"
                                alt="Image Description">
                            <p class="mb-0">{{ __('general.no_data_to_show') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_receipt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('roles.create_receipt') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('receipts.create') }}" method="get">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">

                            <div class="form-group">
                                <label for="">{{ __('property_transactions.tenants') }}</label>
                                <select name="tenant_id" class="form-control" required>
                                    @foreach ($tenants as $tenant_item)
                                        <option value="{{ $tenant_item->id }}">
                                            {{ $tenant_item->name ?? $tenant_item->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('general.cancel') }}</button>
                            <button type="submit" class="btn btn--primary">{{ __('roles.create_receipt') }}</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset(main_path() . 'back-end') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset(main_path() . 'back-end') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script>
        flatpickr("#from_search_date", {
            dateFormat: "d/m/Y",
        });
        flatpickr("#to_search_date", {
            dateFormat: "d/m/Y",

        });
    </script>
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $('.subscription_status_form').on('submit', function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('receipts.status-update') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    if (data.success == true) {
                        toastr.success('{{ __('general.updated_successfully') }}');
                    } else if (data.success == false) {
                        toastr.error(
                            '{{ __('Status_updated_failed.') }} {{ __('Product_must_be_approved') }}'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });

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
                        url: "{{ route('receipts.delete') }}",
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
@endpush
