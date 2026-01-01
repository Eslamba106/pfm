@extends('layouts.back-end.app')
@php
    $lang = session()->get('locale');
@endphp
@section('title', __('property_master.edit_asset'))
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
                {{ __('property_master.edit_asset') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ __('property_master.edit_asset') }}
                    </div>
                    <div class="card-body" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route('asset.update', $asset->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="row">
                               
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="name" class="title-color">{{ __('login.name') }}<span
                                                class="text-danger"> *</span>
                                        </label>
                                        <input type="text" name="name" value="{{ $asset->name }}"
                                            class="form-control">
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="invoice_number" class="title-color">{{ __('property_master.invoice_number') }}
                                            <span class="text-danger"> *</span>
                                        </label>
                                        <input type="text" name="invoice_number" value="{{ $asset->invoice_number }}"
                                            class="form-control">
                                    </div>
                                    @error('invoice_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="code" class="title-color">{{ __('property_master.code') }}
                                            <span class="text-danger"> *</span>
                                        </label>
                                        <input type="text" name="code" value="{{ $asset->code }}"
                                            class="form-control">
                                    </div>
                                    @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="serial_number" class="title-color">{{ __('property_master.serial_number') }} 
                                        </label>
                                        <input type="text" name="serial_number" value="{{ $asset->serial_number }}"
                                            class="form-control">
                                    </div>
                                    @error('serial_number')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <label for="">
                                        {{ __('property_transactions.building') }}
                                    </label>
                                    <select name="report_building" id="report_building"
                                        class="form-control remv_focus" onchange="filterUnits()">
                                        <option value="-1" selected>{{ __('All Buildings') }}</option>
                                        @foreach ($all_building as $building_filter)
                                            <option value="{{ $building_filter->id }}" {{ ($building_filter->id == $asset->property_management_id ) ? 'selected' : '' }}>
                                                {{ $building_filter->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-12 col-lg-4 col-xl-3">
                                    <label for="">
                                        {{ __('property_master.unit') }}
                                    </label>
                                    <select name="report_unit_management" id="report_unit_management"
                                        class="form-control remv_focus"  >
                                        <option value="-1">{{ __('All Units') }}</option>
                                        @foreach ($unit_management as $unit_management_filter)
                                            <option value="{{ $unit_management_filter->id }}" {{ ($unit_management_filter->id == $asset->unit_management_id ) ? 'selected' : '' }}
                                                data-building="{{ $unit_management_filter->property_management_id }}">
                                                {{ $unit_management_filter->property_unit_management->code .
                                                    '-' .
                                                    $unit_management_filter->block_unit_management->block->code .
                                                    '-' .
                                                    $unit_management_filter->floor_unit_management->floor_management_main->name .
                                                    '-' .
                                                    $unit_management_filter->unit_management_main->name .
                                                    '-' .
                                                    ($unit_management_filter->unit_description->code ?? '') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3">
                                    <div class="form-group">
                                        <label for="asset_group" class="title-color">{{ __('roles.asset_group') }}<span
                                                class="text-danger"> *</span>
                                        </label>
                                        <select class="js-select2-custom form-control" name="asset_group_id">
                                            <option value="">{{ __('general.select') }}</option>

                                            @forelse ($asset_groups as $asset_group)
                                                <option value="{{ $asset_group->id }}" {{ ($asset_group->id == $asset->asset_group_id ) ? 'selected' : '' }}>{{ $asset_group->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    @error('asset_group')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-3 col-xl-3">
                                    <div class="form-group">
                                        <label for="purchase_date"
                                            class="title-color">{{ __('property_master.purchase_date') }} <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <input type="text" name="purchase_date"
                                            value="{{ (isset($asset->purchase_date)) ? \Carbon\Carbon::createFromFormat('Y-m-d', $asset->purchase_date)->format('d/m/Y') : '' }}"
                                            id="purchase_date_edit" class="form-control">
                                    </div>
                                    @error('purchase_date')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-3 col-xl-3">
                                    <div class="form-group">
                                        <label for="asset_group" class="title-color">{{ __('roles.supplier') }}<span
                                                class="text-danger"> *</span>
                                        </label>
                                        <select class="js-select2-custom form-control" name="supplier_id">
                                            <option value="">{{ __('general.select') }}</option>
                                            @forelse ($suppliers as $supplier)
                                                <option value="{{ $supplier->id }}" {{ ($supplier->id == $asset->supplier_id ) ? 'selected' : '' }}>{{ $supplier->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                    @error('supplier')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3 mt-5">
                                    <label for="name" class="title-color">{{ __('roles.status') }}
                                    </label>
                                    <div class="form-group">
                                        <input type="radio" name="status" value="active" {{ ( 'active' == $asset->status ) ? 'checked' : '' }} >
                                        <label for="name" class="title-color">{{ __('companies.active') }}
                                        </label>
                                        <input type="radio" name="status" value="inactive"
                                            class="{{ $lang == 'ar' ? 'mr-3' : 'ml-3' }}" {{ ( 'inactive' == $asset->status ) ? 'checked' : '' }}>
                                        <label for="name" class="title-color">{{ __('companies.inactive') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3 mt-5">
                                    <label for="name" class="title-color">{{ __('property_master.amc_info') }}
                                    </label>
                                    <div class="form-group">
                                        <input type="radio" name="amc" class="amc_status" value="yes" {{ ( 'yes' == $asset->amc ) ? 'checked' : '' }}>
                                        <label for="name" class="title-color">{{ __('general.yes') }}
                                        </label>
                                        <input type="radio" name="amc" class="amc_status" value="no"
                                            class="{{ $lang == 'ar' ? 'mr-3' : 'ml-3' }}"  {{ ( 'no' == $asset->amc ) ? 'checked' : '' }}>
                                        <label for="name" class="title-color">{{ __('general.no') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3 mt-5">
                                    <label for="name" class="title-color">{{ __('property_master.warranty_info') }}
                                    </label>
                                    <div class="form-group">
                                        <input type="radio" name="warranty_status" class="warranty" value="yes" {{ ( 'yes' == $asset->warranty_provider ) ? 'checked' : '' }} >
                                        <label for="name" class="title-color">{{ __('general.yes') }}
                                        </label>
                                        <input type="radio" name="warranty_status" class="warranty" value="no"
                                            class="{{ $lang == 'ar' ? 'mr-3' : 'ml-3' }}"  {{ ( 'no' == $asset->warranty_provider ) ? 'checked' : '' }} >
                                        <label for="name" class="title-color">{{ __('general.no') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 amc_status_html d-none">
                                    <div class="form-group">
                                        <label for="amc_ref" class="title-color">{{ __('property_master.amc_ref') }}
                                        </label>
                                        <input type="text" name="amc_ref" value="{{ $asset->amc_ref }}"
                                            class="form-control">
                                    </div>
                                    @error('amc_ref')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 amc_status_html  {{ ($asset->amc == 'no') ? 'd-none' : '' }} ">
                                    <div class="form-group">
                                        <label for="from" class="title-color">{{ __('property_master.from') }}
                                        </label>
                                        <input type="text" name="from"
                                            value="{{ (isset($asset->from)) ? \Carbon\Carbon::createFromFormat('Y-m-d', $asset->from)->format('d/m/Y') : '' }}"
                                            id="from_edit" class="form-control">
                                    </div>
                                    @error('from')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 amc_status_html {{ ($asset->amc == 'no') ? 'd-none' : '' }}">
                                    <div class="form-group">
                                        <label for="to" class="title-color">{{ __('property_master.to') }}
                                        </label>
                                        <input type="text" name="to"
                                            value="{{ (isset($asset->to)) ? \Carbon\Carbon::createFromFormat('Y-m-d', $asset->to)->format('d/m/Y') : '' }}"
                                            id="to_edit" class="form-control">
                                    </div>
                                    @error('to')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 amc_status_html {{ ($asset->amc == 'no') ? 'd-none' : '' }}">
                                    <div class="form-group">
                                        <label for="amc_amount"
                                            class="title-color">{{ __('property_master.amc_amount') }}
                                        </label>
                                        <input type="text" name="amc_amount" value="{{ $asset->amc_amount }}"
                                            class="form-control">
                                    </div>
                                    @error('amc_amount')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 amc_status_html {{ ($asset->amc == 'no') ? 'd-none' : '' }}">
                                    <div class="form-group">
                                        <label for="amc_provider"
                                            class="title-color">{{ __('property_master.amc_provider') }}
                                        </label>
                                        {{-- <input type="text" name="amc_provider" value="{{ $asset->amc_provider }}"
                                            class="form-control"> --}}
                                            <select class="js-select2-custom form-control" name="amc_provider">
                                                <option value="">{{ __('general.select') }}</option>
                                                @forelse ($amc as $amc_main)
                                                    <option value="{{ $amc_main->id }}" @selected($asset->amc_provider == $amc_main->id) >
                                                        {{ $amc_main->name }}</option>
                                                @empty
                                                @endforelse
                                            </select>
                                    </div>
                                    @error('amc_provider')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 amc_status_html {{ ($asset->amc == 'no') ? 'd-none' : '' }}">
                                    <div class="form-group">
                                        <label for="asset_group"
                                            class="title-color">{{ __('property_master.amc_maintenance_type') }}
                                        </label>
                                        <select class="js-select2-custom form-control" name="amc_maintenance_type">
                                            <option value="">{{ __('general.select') }}</option>
                                            @forelse ($maintenance_types as $amc_maintenance_type)
                                                <option value="{{ $amc_maintenance_type->id }}"  {{ ($amc_maintenance_type->id == $asset->amc_maintenance_type) ? 'selected' : ''  }}>
                                                    {{ $amc_maintenance_type->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                    @error('amc_maintenance_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 amc_status_html {{ ($asset->amc == 'no') ? 'd-none' : '' }}">
                                    <div class="form-group">
                                        <label for="amc_warranty_type"
                                            class="title-color">{{ __('property_master.amc_warranty_type') }}
                                        </label>
                                        <select class="js-select2-custom form-control" name="amc_warranty_type" disabled>
                                            <option value="">{{ __('general.select') }}</option>
                                            @forelse ($warranty_types as $amc_warranty_type)
                                                <option value="{{ $amc_warranty_type->id }}" {{ ($amc_warranty_type->id == $asset->amc_warranty_type) ? 'selected' : ''  }}>
                                                    {{ $amc_warranty_type->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                    @error('warranty_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-3 col-xl-3 warranty_html {{ ($asset->warranty_provider == 'yes') ? '' : 'd-none' }}">
                                    <div class="form-group">
                                        <label for="warranty_expiry"
                                            class="title-color">{{ __('property_master.warranty_expiry') }}
                                        </label>
                                        <input type="text" name="warranty_expiry"
                                            value="{{ (isset($asset->warranty_expiry)) ? \Carbon\Carbon::createFromFormat('Y-m-d', $asset->warranty_expiry)->format('d/m/Y') : '' }}"
                                            id="warranty_expiry_edit" class="form-control">
                                    </div>
                                    @error('warranty_expiry')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 warranty_html {{ ($asset->warranty_provider == 'yes') ? '' : 'd-none' }}">
                                    <div class="form-group">
                                        <label for="warranty_provider"
                                            class="title-color">{{ __('property_master.warranty_provider') }}
                                        </label>
                                        <input type="text" name="warranty_provider"
                                            value="{{ $asset->warranty_provider }}" class="form-control">
                                    </div>
                                    @error('warranty_provider')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 warranty_html {{ ($asset->warranty_provider == 'yes') ? '' : 'd-none' }}">
                                    <div class="form-group">
                                        <label for="asset_group"
                                            class="title-color">{{ __('property_master.maintenance_type') }}
                                        </label>
                                        <select class="js-select2-custom form-control" name="maintenance_type">
                                            <option value="">{{ __('general.select') }}</option>
                                            @forelse ($maintenance_types as $maintenance_type)
                                                <option value="{{ $maintenance_type->id }}"  {{ ($maintenance_type->id == $asset->maintenance_type) ? 'selected' : ''  }}>{{ $maintenance_type->name }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                    @error('maintenance_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-3 col-xl-3 warranty_html {{ ($asset->warranty_provider == 'yes') ? '' : 'd-none' }}">
                                    <div class="form-group">
                                        <label for="asset_group"
                                            class="title-color">{{ __('property_master.warranty_type') }}
                                        </label>
                                        <select class="js-select2-custom form-control" name="warranty_type" >
                                            <option value="">{{ __('general.select') }}</option>
                                            @forelse ($warranty_types as $warranty_type)
                                                <option value="{{ $warranty_type->id }}" {{ ($warranty_type->id == $asset->warranty_type) ? 'selected' : ''  }}>{{ $warranty_type->name }}
                                                </option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>

                                    @error('warranty_type')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
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
        flatpickr("#purchase_date_edit", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
        flatpickr("#warranty_expiry_edit", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
        flatpickr("#from_edit", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
        flatpickr("#to_edit", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
    </script>
      <script>
        function filterUnits() {
            const buildingSelect = document.getElementById('report_building');
            const unitSelect = document.getElementById('report_unit_management');
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
    <script>
        // function amc(){

        // }
        $(document).ready(function() {
            $(".amc_status").change(function() {
                let status = $(this).val();
                if (status === 'yes') {
                    $(".amc_status_html").removeClass('d-none');
                } else {
                    $(".amc_status_html").addClass('d-none');
                }
            });
            $(".warranty").change(function() {
                let status = $(this).val();
                if (status === 'yes') {
                    $(".warranty_html").removeClass('d-none');
                } else {
                    $(".warranty_html").addClass('d-none');
                }
            });
        });

        // });


        // $(".tenant_form").addClass('d-none');
        // $(this).addClass('active');

        // let form_id = this.id;
        // console.log(form_id)
        // if (form_id === 'personal-link') {
        //     $("#personal-form").removeClass('d-none').addClass('active');
        //     $("#company-form").removeClass('active').addClass('d-none');
        // } else if (form_id === 'company-link') {
        //     $("#company-form").removeClass('d-none').addClass('active');
        //     $("#personal-form").removeClass('active').addClass('d-none');
        // }

        // });
    </script>

@endpush
@push('script')
