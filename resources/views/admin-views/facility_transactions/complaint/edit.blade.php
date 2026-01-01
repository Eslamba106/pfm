@extends('layouts.back-end.app')


@section('title')
    {{ __('roles.edit_complaint') }}
@endsection
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/back-end') }}/css/select2.min.css" rel="stylesheet" />
@endpush

@section('page_name')
    {{ __('roles.edit_complaint') }}
@endsection
@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                {{ __('roles.edit_complaint') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                        {{-- <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
                            @csrf --}}

                        <form action="{{ route('complaint_registration.updateComplaint' , $complaint->id) }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{ __('roles.all_tenants') }}
                                                <span class="text-danger"> *</span> </label>
                                            <select class="form-control" name="tenant_id" id="">
                                                <option selected>{{ __('general.select') }}</option>
                                                @foreach ($tenants as $tenant)
                                                    <option value="{{ $tenant->id }}" {{ ($complaint->tenant_id == $tenant->id) ? 'selected' : '' }} >{{ $tenant->name ?? $tenant->group_company_name }}</option>
                                                @endforeach
                                            </select>
                                            @error('tenant_id')
                                                <span class="text-red">
                                                    {{ $errors->first('tenant_id') }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="form-group">
                                            <label for=""
                                                class="form-control-label">{{ __('facility_transactions.complainer_name') }} </label>
                                            <input type="text" class="form-control" name="complainer_name" value="{{ $complaint->complainer_name }}">
                                            @error('complainer_name')
                                                <span class="text-red">
                                                    {{ $errors->first('complainer_name') }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{ __('general.phone') }} </label>
                                            <input type="text" class="form-control" name="phone_number" value="{{ $complaint->phone_number }}">
                                            @error('phone_number')
                                                <span class="text-red">
                                                    {{ $errors->first('phone_number') }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{ __('companies.email') }}</label>
                                            <input type="text" class="form-control" name="email" value="{{ $complaint->email }}">
                                            @error('email')
                                                <span class="text-red">
                                                    {{ $errors->first('email') }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 col-lg-4 col-xl-6">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{ __('property_master.units') }} <span class="text-danger"> *</span> </label>
                                            <select class="form-control" name="unit_id" disabled>
                                                <option value="{{ $main_unit->id }}"  >
                                            {{ $main_unit->property_unit_management->name  .'-' . $main_unit->block_unit_management->block->name
                                                .'-'.$main_unit->floor_unit_management->floor_management_main->name .'-'.$main_unit->unit_management_main->name
                                                    }}
                                                </option>
                                            </select>
                                            @error('unit_id')
                                                <span class="text-red">
                                                    {{ $errors->first('unit_id') }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="form-group">
                                            <label for=""
                                                class="form-control-label">{{ __('facility_transactions.complaint_category') }} <span class="text-danger"> *</span> </label>
                                            <select class="form-control" name="complaint_category" id="">
                                                <option value="" selected>{{ __('general.select') }}</option>
                                                @foreach ($complaint_categories as $complaint_category)
                                                    <option value="{{ $complaint_category->id }}" {{ ($complaint->complaint_category == $complaint_category->id) ? 'selected' : '' }}>
                                                        {{ $complaint_category->name }}
                                                    </option>
                                                @endforeach
                                            </select> @error('complaint_category')
                                                <span class="text-red">
                                                    {{ $errors->first('complaint_category') }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{ __('property_master.main_complaint') }} <span class="text-danger"> *</span></label>
                                            <select class="form-control" name="complaint" id="">
                                                <option value="" selected>{{ __('general.select') }}</option>
                                                @foreach ($sub_complaints as $sub_complaint)
                                                    <option value="{{ $sub_complaint->id }}" {{ ($complaint->complaint  == $sub_complaint->id) ? 'selected' : '' }}>{{ $sub_complaint->name }}
                                                    </option>
                                                @endforeach
                                            </select> @error('complaint')
                                                <span class="text-red">
                                                    {{ $errors->first('complaint') }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-12">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{ __('facility_transactions.complaint_comment') }}
                                            </label>
                                            <textarea class="form-control" name="complaint_comment" id="" cols="30" rows="2">{{ $complaint->complaint_comment }}</textarea>
                                            @error('complaint_comment')
                                                <span class="text-red">
                                                    {{ $errors->first('complaint_comment') }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row">

                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{ __('roles.departments') }} <span class="text-danger"> *</span></label>
                                            <select class="form-control" name="department">
                                                <option value="" selected>{{ __('general.select') }}</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}" {{ ($complaint->department == $department->id) ? 'selected' : '' }}>{{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select> @error('department')
                                                <span class="text-red">
                                                    {{ $errors->first('department') }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="form-group">
                                            <label for="name" class="title-color">{{ __('roles.employee_type') }}  </label>
                                            <select class="js-select2-custom form-control" name="employee_type" >
                                                <option value="" selected>{{ __('collections.not_applicable') }}</option>
                                                <option value="employee" >{{ __('roles.employee') }}</option>
                                                <option value="amc_provider">{{ __('roles.amc_provider') }}</option>
    
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3 employee_select d-none"   >
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{ __('roles.employee') }}
                                            </label>
                                            <select class="form-control" name="employee_id">
                                                <option value="" selected>{{ __('general.select') }}</option>
                                            </select> 
                                            @error('employee_id')
                                                <span class="text-red">
                                                    {{ $errors->first('employee_id') }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3 amc_select d-none">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{ __('roles.amc_provider') }}
                                            </label>
                                            <select class="form-control" name="employee_id_amc" >
                                                <option value="" selected>{{ __('general.select') }}</option>
                                                @foreach ($amc_provider as $item_amc_provider)
                                                <option value="{{ $item_amc_provider->id }}">{{ $item_amc_provider->name }}</option>
                                                @endforeach
                                            </select> 
                                            @error('employee_id_amc')
                                                <span class="text-red">
                                                    {{ $errors->first('employee_id_amc') }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 col-xl-3">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{ __('roles.priority') }} <span class="text-danger"> *</span></label>
                                            <select class="form-control" name="priority">
                                                <option selected>{{ __('general.select') }}</option>
                                                @foreach ($priorities as $priority)
                                                    <option value="{{ $priority->id }}" {{ ($complaint->priority == $priority->id) ? 'selected' : '' }}>{{ $priority->name }}
                                                    </option>
                                                @endforeach
                                            </select> @error('priority')
                                                <span class="text-red">
                                                    {{ $errors->first('priority') }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                            </div>




                            <div class="d-flex gap-3 justify-content-end">
                                <button type="submit" class="btn btn--primary px-4"><i
                                        class="fa fa-plus-square"></i> {{ __('general.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="mt-5"></div>



    @if (Session::has('success'))
        <script>
            swal("Message", "{{ Session::get('success') }}", 'success', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            swal("Message", "{{ Session::get('info') }}", 'info', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
@endsection
@push('script')
<script>
    $(document).ready(function() {
        $('select[name="employee_type"]').on('change', function() {
            let status = $(this).val();
            if (status == 'employee') {
                $(".employee_select").removeClass('d-none');
                $(".amc_select").addClass('d-none');
            } else {
                $(".employee_select").addClass('d-none');
                $(".amc_select").removeClass('d-none');
            }
        });
    });
</script>
    <script>
        $(document).ready(function() {
            $('select[name="complaint_category"]').on('change', function() {
                var tenantId = $(this).val();
                if (tenantId) {
                    $.ajax({
                        url: "{{ URL::to('get_sub_complaint_departments') }}/" + tenantId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="department"]').empty();
                            $('select[name="department"]').prop('disabled', tenantId ? false :
                                true);
                            // $.each(data, function(key, value) {
                            $('select[name="department"]').append('<option value="' +
                                data.id + '">' + data.name + '</option>');
                            // });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('select[name="complaint_category"]').on('change', function() {
                var tenantId = $(this).val();
                if (tenantId) {
                    $.ajax({
                        url: "{{ URL::to('get_sub_complaint_categories') }}/" + tenantId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="complaint"]').empty();
                            $('select[name="complaint"]').prop('disabled', tenantId ? false :
                                true);
                            $.each(data, function(key, value) {
                                $('select[name="complaint"]').append('<option value="' +
                                    value.id + '">' + value.name + '</option>');
                            });
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            $('select[name="tenant_id"]').on('change', function() {
                var tenantId = $(this).val();
                if (tenantId) {
                    $.ajax({
                        url: "{{ URL::to('get_units') }}/" + tenantId,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            var unitSelect = $('select[name="unit_id"]');
                            unitSelect.empty();
                            unitSelect.prop('disabled', false);


                            $.each(data, function(key, value) {
                                var propertyName = value.property_unit_management
                                    ?.name || 'N/A';
                                var blockName = value.block_unit_management?.block
                                    ?.name || 'N/A';
                                var floorName = value.floor_unit_management
                                    ?.floor_management_main?.name || 'N/A';
                                var unitName = value.unit_management_main?.name ||
                                'N/A';

                                unitSelect.append('<option value="' + value.id + '">' +
                                    propertyName + '-' +
                                    blockName + '-' +
                                    floorName + '-' +
                                    unitName +
                                    '</option>');
                            });

                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });
    </script>
@endpush
