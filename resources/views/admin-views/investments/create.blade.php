@extends('layouts.back-end.app')

@section('title', ui_change('create_investment', 'property_transaction'))
@php
    $lang = Session::get('locale');
@endphp
@push('css_or_js')
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                {{ ui_change('create_investment', 'property_transaction') }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.investment.inline-menu')


        <!-- Form -->
        <form id="productForm" class="product-form text-start" action="{{ route('investment.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <!-- general setup -->


            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        <h4 class="mb-0">{{ ui_change('general_info', 'property_transaction') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="">{{ ui_change('investment_no', 'property_transaction') }}<span
                                        class="starColor " style="font-size: 18px; "> *</span></label>
                                <input readonly type="text" name="investment_no" class="form-control"
                                    value="{{ investmentNo() }}">
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="">{{ ui_change('investment_date', 'property_transaction') }}<span
                                        class="starColor " style="font-size: 18px; "> *</span></label>
                                <input type="text" class="form-control" id="investment_date" name="investment_date"
                                    class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="period-from">{{ ui_change('period_from', 'property_transaction') }}<span
                                        class="starColor " style="font-size: 18px; "> *</span></label>
                                <div style="display: flex; gap: 10px;">
                                    <input type="text" name="period_from" id="period_from" class="form-control  "
                                        value="{{ Carbon\Carbon::now()->format('d/m/Y') }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="price"
                                    class="title-color">{{ ui_change('period_to', 'property_transaction') }}<span
                                        class="starColor " style="font-size: 18px; "> *</span></label>
                                <div style="display: flex; gap: 10px;">
                                    <input type="text" name="period_to" id="period_to" class="form-control mt-2  "
                                        value="{{ Carbon\Carbon::now()->subDay()->addYear()->format('d/m/Y') }}">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-lg-4 col-xl-6">
                            <div class="form-group">
                                <label for="name"
                                    class="title-color">{{ ui_change('investor_name', 'investment') }}<span
                                        class="text-danger" style="font-size: 18px; "> *</span><button type="button"
                                        data-target="#add_investor" data-add_investor="" data-toggle="modal"
                                        class="btn btn--primary btn-sm">
                                        <i class="fa fa-plus-square"></i>
                                    </button>
                                </label>
                                {{-- <input type="text" class="form-control" name="name" class="form-control"> --}}
                                <select class="js-select2-custom form-control" name="investor_type" required>
                                    <option selected value="">{{ ui_change('select', 'property_transaction') }} </option> 
                                    @foreach ($investors as $investor_item)
                                        
                                    <option value="{{ $investor_item->id }}">{{ $investor_item->name ?? $investor_item->company_name }}</option>
                                    @endforeach
                                </select>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

{{-- 
                        <div class="col-md-12 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="">{{ ui_change('investor_type', 'investment') }}<span
                                        class="starColor " style="font-size: 18px; "> *</span></label>
                                <select class="js-select2-custom form-control" name="investor_type" required>
                                    <option selected value="">{{ ui_change('select', 'property_transaction') }}
                                    </option>

                                    <option value="individual">{{ ui_change('individual', 'property_transaction') }}
                                    </option>
                                    <option value="company">{{ ui_change('company', 'property_transaction') }}</option>
                                </select>
                            </div>
                            @error('investor_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div> --}}
                        <div class="col-md-6 col-lg-4 col-xl-3">

                            <div class="form-group">
                                <label for="property_name">{{ ui_change('building_name', 'investment') }} <span
                                        class="starColor " style="font-size: 18px; "> *</span></label>

                                 <select class="js-select2-custom form-control" name="investor_type" required>
                                    <option selected value="">{{ ui_change('select', 'property_transaction') }} </option> 
                                    @foreach ($buildings as $building_item)
                                        
                                    <option value="{{ $building_item->id }}">{{ $building_item->name   }}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div> 
                       

                        <div class="col-md-12 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="">{{ ui_change('total_no_of_units', 'investment') }}
                                    <span class="text-danger" style="font-size: 18px; "> *</span></label>
                                <input type="number" id="total-no-units" required class="form-control"
                                    name="total_no_of_units">
                            </div>
                            @error('total_no_of_units')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>


                </div>

            </div>
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        <h4 class="mb-0">{{ ui_change('investor_details', 'investment') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-12 investor_form d-none company-form" id="company-form">

                            @include('admin-views.investments.investor.company_form')

                        </div>
                        <div class="col-md-12 investor_form d-none personal-form" id="personal-form">
                            @include('admin-views.investments.investor.personal_form')
                        </div>
                    </div>

                </div>

            </div>




            <div id="main-content"></div>
            <div class="row justify-content-end gap-3 mt-3 mx-1">
                <button type="reset"
                    class="btn btn-secondary px-5">{{ ui_change('reset', 'property_transaction') }}</button>
                <button type="submit" class="btn btn--primary px-5"
                    onclick="setFormAction('{{ route('investment.store') }}')">{{ ui_change('submit', 'property_transaction') }}</button>


            </div>
        </form>



    </div>



    <div class="modal fade" id="add_investor" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ ui_change('create_investor', 'property_transaction') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <ul class="nav nav-tabs w-fit-content mb-4">
                            <li class="nav-item">
                                <a class="nav-link type_link_create active" href="#"
                                    id="personal-link_create">{{ ui_change('personal', 'property_transaction') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link type_link_create " href="#"
                                    id="company-link_create">{{ ui_change('company', 'property_transaction') }}</a>
                            </li>
                        </ul>
                        <div class="col-md-12 investor_form_create personal-form_create" id="personal-form_create">
                            <form id="investorForm_personal" action="{{ route('investor.store_for_anything') }}"
                                method="post" class="investorForm">
                                @csrf
                                @method('post')
                                @include('admin-views.investments.investor.personal_form')
                                <div class="row justify-content-end gap-3 mt-3 mx-1">
                                    <button type="reset"
                                        class="btn btn-secondary px-5">{{ ui_change('reset', 'property_transaction') }}</button>
                                    <button type="submit" id="saveTenantPersonal"
                                        class="btn btn--primary px-5 saveTenant">{{ ui_change('submit', 'property_transaction') }}</button>
                                </div>

                            </form>
                        </div>
                        <div class="col-md-12 investor_form_create d-none company-form_create" id="company-form_create">
                            <form id="investorForm_company" action="{{ route('investor.store_for_anything') }}"
                                method="post" class="investorForm">
                                @csrf
                                @method('post')

                                @include('admin-views.investments.investor.company_form')
                                <div class="row justify-content-end gap-3 mt-3 mx-1">
                                    <button type="reset"
                                        class="btn btn-secondary px-5">{{ ui_change('reset', 'property_transaction') }}</button>
                                    <button type="submit" id="saveTenantCompany"
                                        class="btn btn--primary px-5 saveTenant">{{ ui_change('submit', 'property_transaction') }}</button>
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
        $(".type_link_create").click(function(e) {
            e.preventDefault();
            $(".type_link_create").removeClass('active');
            $(".investor_form_create").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            console.log(form_id)
            if (form_id === 'personal-link_create') {
                $("#personal-form_create").removeClass('d-none').addClass('active');
                $("#company-form_create").removeClass('active').addClass('d-none');
            } else if (form_id === 'company-link_create') {
                $("#company-form_create").removeClass('d-none').addClass('active');
                $("#personal-form_create").removeClass('active').addClass('d-none');
            }

        });
        flatpickr("#investment_date", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
            minDate: "today"
        });
        flatpickr("#period_to", {
            dateFormat: "d/m/Y",
            minDate: "today"
        });
        flatpickr("#period_from", {
            dateFormat: "d/m/Y",
            minDate: "today"
        });
    </script>
    <script>
        $(document).ready(function() {
            $('select[name="investor_type"]').on('change', function() {
                let value = $(this).val();
                $('#company-form').addClass('d-none');
                $('#personal-form').addClass('d-none');
                if (value === 'company') {
                    $('#company-form').removeClass('d-none');
                }

                if (value === 'individual') {
                    $('#personal-form').removeClass('d-none');
                }
            });
        });
    </script>

    <script>
        document.getElementById('total-no-units').addEventListener('input', function() {
            const totalUnits = parseInt(this.value) || 0;
            const container = document.getElementById('main-content');

            container.innerHTML = '';

            for (let i = 1; i <= totalUnits; i++) {
                const bladeContent = `
                        <div class="card mt-3 rest-part" id="main_content" style="background-color: #2b368f;color:white">
                <div class="card-header">
                    <div class="d-flex gap-2"> 
                        <h4 class="mb-0">{{ ui_change('unit_search_details', 'property_transaction') }}</h4>
                    </div>
                </div>
                <div class="card-body mt-3">

 
    <div class="form-row">
        
        <div class="col-md-6 col-lg-4 col-xl-3">

            <div class="form-group">
                <label for="block_name-${i}">{{ ui_change('block_name', 'property_transaction') }} <span class="starColor " style="font-size: 18px; "> *</span></label>
             
                <input type="text" required name="block_name-${i}"  class="form-control  " >
 
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">

            <div class="form-group">
                <label for="floor_name-${i}">{{ ui_change('floor_name', 'property_transaction') }} <span class="starColor " style="font-size: 18px; "> *</span></label>
             
                <input type="text" required name="floor_name-${i}"  class="form-control  " >
 
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">

            <div class="form-group">
                <label for="unit_name-${i}">{{ ui_change('unit_name', 'property_transaction') }} <span class="starColor " style="font-size: 18px; "> *</span></label>
             
                <input type="text" required name="unit_name-${i}"  class="form-control  " >
 
            </div>
        </div>

          <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="form-group">
                <label for="area-measurement">{{ ui_change('return_mode', 'property_transaction') }}</label>
                <select id="area-measurement" name="return_mode-${i}"
                    class="js-select2-custom form-control" required>
                    <option value="">{{ ui_change('select_rent_mode', 'property_transaction') }}</option>
                    <option value="1">{{ ui_change('daily', 'property_transaction') }}</option>
                    <option value="2">{{ ui_change('monthly', 'property_transaction') }}</option>
                    <option value="3">{{ ui_change('bi_monthly', 'property_transaction') }}</option>
                    <option value="4">{{ ui_change('quarterly', 'property_transaction') }}</option>
                    <option value="5">{{ ui_change('half_yearly', 'property_transaction') }}</option>
                    <option value="6">{{ ui_change('yearly', 'property_transaction') }}</option>
                </select>
            </div>
        </div> 
        
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="form-group">
                <label for="total-area">{{ ui_change('The_return', 'investment') }} <span class="starColor " style="font-size: 18px; "> *</span></label>
                <input type="number" required   name="return-${i}" class="form-control" required  
                    step="0.001" placeholder="0.000">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">

            <div class="form-group">
                <label for="unit-description">{{ ui_change('unit_description', 'property_transaction') }}</label>
                <select id="unit-description" name="unit_description_id-${i}"
                    class="js-select2-custom form-control"  >
                    <option value="0">{{ ui_change('any', 'property_transaction') }}</option>
                    @foreach ($unit_descriptions as $unit_description)
                        <option value="{{ $unit_description->id }}" >
                            {{ $unit_description->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="form-group">
                <label for="unit-type">{{ ui_change('unit_type', 'property_transaction') }}</label>
                <select id="unit-type" name="unit_type_id-${i}" class="js-select2-custom form-control"  >
                    <option value="0">{{ ui_change('any', 'property_transaction') }}</option>
                    @foreach ($unit_types as $unit_type)
                        <option value="{{ $unit_type->id }}">{{ $unit_type->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">

            <div class="form-group">
                <label for="unit-condition">{{ ui_change('unit_condition', 'property_transaction') }}</label>
                <select id="unit-condition" name="unit_condition_id-${i}"
                    class="js-select2-custom form-control"  >
                    <option value="">{{ ui_change('any', 'property_transaction') }}</option>
                    @foreach ($unit_conditions as $unit_condition)
                        <option value="{{ $unit_condition->id }}">{{ $unit_condition->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div> 
      

        
   
        </div>
        </div>
         
          
      
        `;

                container.innerHTML += bladeContent;
                flatpickr(".main_date_func", {
                    dateFormat: "d/m/Y",
                    minDate: "today"
                })
            }

        });
    </script>
@endpush
