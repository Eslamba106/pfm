@extends('layouts.back-end.app')

@section('title', __('property_reports.tenant_contact_details'))
@php
    $lang = session()->get('locale');
     $firstDay = Carbon\Carbon::now()->startOfMonth()->format('d/m/Y');
    $lastDay = Carbon\Carbon::now()->endOfMonth()->format('d/m/Y');
@endphp
@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                {{ __('property_reports.tenant_contact_details') }}
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
                                <button type="button" data-target="#filter_tenant_report" data-filter_tenant_report="" data-toggle="modal"
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
                                        <th class="text-center">{{ __('property_reports.tenant_name') }}</th>
                                        <th class="text-center">{{ __('property_master.unit') }}</th>
                                        <th class="text-center">{{ __('property_transactions.contact_person') }}</th>
                                        <th class="text-center">{{ __('roles.email') }}</th>
                                        <th class="text-center">{{ __('general.mobile') }}</th>
                                        <th class="text-center">{{ __('property_transactions.whatsapp_no') }}</th>
                                        <th class="text-center">{{ __('country.country') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tenants as $k => $tenant_item)
                                        <tr>
                                            <th scope="row"><input class="check_bulk_item" name="bulk_ids[]"
                                                    type="checkbox" value="{{ $tenant_item->id }}" />
                                                {{ $loop->index + 1 }}</th>

                                            <td class="text-center">
                                                {{ $tenant_item->name ?? $tenant_item->company_name }}
                                            </td>

                                            <td class="text-center">
                                                @foreach ($tenant_item->schedules->unique('unit_id') as $schedule)
                                                    <li> {{ $schedule->main_unit->property_unit_management->name .
                                                        '-' .
                                                        $schedule->main_unit->block_unit_management->block->name .
                                                        '-' .
                                                        $schedule->main_unit->floor_unit_management->floor_management_main->name .
                                                        '-' .
                                                        $schedule->main_unit->unit_management_main->name ??
                                                        '-' }}
                                                    </li>
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                {{ $tenant_item->contact_person ?? __('general.not_available') }}
                                            </td>
                                            <td class="text-center">
                                                {{ $tenant_item->email1 ?? __('general.not_available') }}
                                            </td>

                                            <td class="text-center">
                                                {{ $tenant_item->whatsapp_no ?? __('general.not_available') }}
                                            </td>
                                            <td class="text-center">
                                                {{ $tenant_item->contact_no ?? __('general.not_available') }}
                                            </td>
                                            <td class="text-center">
                                                {{ $tenant_item->country_master->country->name ?? __('general.not_available') }}
                                            </td>




                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="table-responsive mt-4">
                            <div class="px-4 d-flex justify-content-lg-end">
                                <!-- Pagination -->
                                {{-- {{ $tenants->links() }} --}}
                            </div>
                        </div>
                    </form>
                    @if (count($tenants) == 0)
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
     <div class="modal fade" id="filter_tenant_report" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                <div class="row align-items-center">
                                    {{-- <div class="col-md-12 col-lg-4 col-xl-4">


                                        <input class="form-control float-right {{ $lang == 'ar' ? 'mr-2' : 'ml-2' }}"
                                            type="text" id="start_date" name="start_date" value="{{ $firstDay }}">
                                    </div>
                                    <div class="col-md-12 col-lg-4 col-xl-4">
                                        <input class="form-control float-right {{ $lang == 'ar' ? 'mr-2' : 'ml-2' }}"
                                            type="text" id="end_date" name="end_date" value="{{ $lastDay }}">

                                    </div> --}}

                                    <div class="col-md-12 col-lg-4 col-xl-4">
                                        <select name="filter_tenant" class="form-control remv_focus">
                                            <option value="-1">{{ __('All Tenants') }}</option>
                                            @foreach ($tenants as $tenant_filter)
                                                <option value="{{ $tenant_filter->id }}">
                                                    {{ $tenant_filter->name ?? $tenant_filter->company_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                {{-- </div>
                                <div class="row align-items-center mt-1"> --}}
                                    <div class="col-md-12 col-lg-4 col-xl-4">
                                        <select name="filter_building" id="filter_building"
                                            class="form-control remv_focus" onchange="filterUnits()">
                                            <option value="-1" selected>{{ __('All Buildings') }}</option>
                                            @foreach ($all_building as $building_filter)
                                                <option value="{{ $building_filter->id }}">{{ $building_filter->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-12 col-lg-4 col-xl-4">
                                        <select name="filter_unit_management" id="filter_unit_management"
                                            class="form-control remv_focus" disabled>
                                            <option value="-1">{{ __('All Units') }}</option>
                                            @foreach ($unit_management as $unit_management_filter)
                                                <option value="{{ $unit_management_filter->id }}"
                                                    data-building="{{ $unit_management_filter->property_management_id }}">
                                                    {{ $unit_management_filter->property_unit_management->name .
                                                        '-' .
                                                        $unit_management_filter->block_unit_management->block->name .
                                                        '-' .
                                                        $unit_management_filter->floor_unit_management->floor_management_main->name .
                                                        '-' .
                                                        $unit_management_filter->unit_management_main->name .
                                                        '-' .
                                                        ($unit_management_filter->unit_description->name ?? '') }}

                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    {{-- <div class="col-md-12 col-lg-4 col-xl-3">
                                        <button type="submit" class="btn btn--primary px-4 m-2" name="bulk_action_btn"
                                            value="filter"> {{ __('general.filter') }}</button>
                                    </div> --}}
                                </div>

                                <div class="row justify-content-end gap-3 mt-3 mx-1">
                                    <button type="submit" class="btn btn--primary px-5 saveTenant"
                                        name="bulk_action_btn" value="filter">{{ __('general.filter') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
            flatpickr("#start_date", {
            dateFormat: "d/m/Y", 
        });
            flatpickr("#end_date", {
            dateFormat: "d/m/Y", 
        });

        function filterUnits() {
            const buildingSelect = document.getElementById('filter_building');
            const unitSelect = document.getElementById('filter_unit_management');
            const selectedBuildingId = buildingSelect.value;

            if (selectedBuildingId !== "-1") {
                unitSelect.disabled = false;

                unitSelect.querySelectorAll("option").forEach(option => {
                    option.hidden = option.value !== "-1" && option.getAttribute('data-building') !==
                        selectedBuildingId;
                });

            } else {
                unitSelect.disabled = true;
                unitSelect.querySelectorAll("option").forEach(option => {
                    option.hidden = false;
                });
            }
        }
</script>
@endpush
