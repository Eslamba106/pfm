@extends('layouts.back-end.app')

@section('title', __('property_reports.leased_expired_details'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                {{ __('property_reports.leased_expired_details') }}
                {{-- <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $tenants->total() }}</span> --}}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.property_reports.inline-menu')

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
                                            placeholder="{{ __('general.search_by_name') }}" aria-label="Search orders"
                                            value="{{ request('search') }}">
                                        <input type="hidden" value="{{ request('status') }}" name="status">
                                        <button type="submit" class="btn btn--primary">{{ __('general.search') }}</button>
                                    </div>
                                </form>

                            </div>
                            <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">
                                <button type="button" data-target="#add_tenant" data-add_tenant="" data-toggle="modal"
                                    class="btn btn--primary btn-sm">
                                    <i class="fas fa-filter"></i>
                                </button>


                            </div>
                        </div>
                    </div>
                    <form action="" method="get">

                        <div class="table-responsive">
                            <table id="datatable"
                                style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th><input id="bulk_check_all" class="bulk_check_all" type="checkbox" />
                                            {{ __('general.sl') }}</th>
                                        <th class="text-center">{{ __('property_transactions.agreement_no') }}</th>
                                        <th class="text-center">{{ __('property_reports.tenant_name') }}</th>
                                        <th class="text-center">{{ __('property_master.unit') }}</th>
                                        <th class="text-center">{{ __('property_reports.lease_start_date') }}</th>
                                        <th class="text-center">{{ __('property_reports.lease_expaired_date') }}</th>
                                        {{-- <th class="text-center">{{ __('property_transactions.payment_mode') }}</th>
                                        <th class="text-center">{{ __('property_transactions.rent_amount') }}</th>
                                        <th class="text-center">{{ __('roles.status') }}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($agreements as $agreements_item) 
                                        <tr  >
                                            <th scope="row"><input class="check_bulk_item" name="bulk_ids[]" type="checkbox" value="{{ $agreements_item->id }}" />
                                                {{ $loop->index + 1 }}
                                            </th>
                                            <td class="text-center">
                                                {{ $agreements_item->agreement_no }}
                                            </td>
                                            <td class="text-center">
                                                {{ $agreements_item->tenant->name ?? $agreements_item->tenant->company_name }}
                                            </td>
                                            <td class="text-center">
                                                @foreach ($agreements_item->agreement_units as $unit)
                                                <li> {{ $unit->agreement_unit_main->property_unit_management->name ?? '' }} -
                                                    {{ $unit->agreement_unit_main->block_unit_management->block->name ?? '' }} -
                                                    {{ $unit->agreement_unit_main->floor_unit_management->floor_management_main->name ?? '' }} -
                                                    {{ $unit->agreement_unit_main->unit_management_main->name ?? '' }}
                                                </li>
                                                @endforeach
                                            </td>
                                            
                                            <td class="text-center">
                                                {{ $agreements_item->agreement_details->period_from }}
                                            </td>
                                            <td class="text-center">
                                                {{ $agreements_item->agreement_details->period_to }}
                                            </td>
                                            
                                            {{-- <td class="text-center">
                                                {{ $agreements_item->billing_month_year ?? __('general.not_available') }}
                                            </td>
                                            <td class="text-center">
                                                {{ $agreements_item->rent_mode ?? __('general.not_available') }}
                                            </td>
                                            <td class="text-center">
                                                {{ $agreements_item->rent_amount ?? __('general.not_available') }}
                                            </td>
                                            <td class="text-center">
                                                {{ __('property_reports.leased') }}
                                            </td> --}}
                                        </tr>
                                    
                                @endforeach
                                
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-4">
                            <div class="px-4 d-flex justify-content-lg-end">
                                <!-- Pagination -->
                                {{ $agreements->links() }}
                            </div>
                        </div>
                    </form>
                    @if (count($agreements) == 0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160" src="{{ asset(main_path() . 'back-end') }}/svg/illustrations/sorry.svg"
                                alt="Image Description">
                            <p class="mb-0">{{ __('general.no_data_to_show') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_tenant" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Filter') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">

                        <div class="col-md-12  ">
                            <form action="{{ url()->current() }}" method="get">
                                @csrf
                                {{-- <div class="col-md-12 col-lg-4 col-xl-4">
                                <label for="">
                                    {{ __('general.status') }}
                                </label>
                                <select name="status" class="form-control select2">
                                    
                                    <option value="-1">{{ __('All Status') }}</option>
                                    <option value="pending"       selected>{{ __('Pending') }}</option>
                                    <option value="completed">{{ __('Completed') }}</option>
                                    <option value="canceled">{{ __('Canceled') }}</option>
                                </select>
                            </div> --}}
                                <div class="row justify-content-end gap-3 mt-3 mx-1">
                                    <button type="submit"
                                        class="btn btn--primary px-5 saveTenant">{{ __('general.submit') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('script')
    @endpush
