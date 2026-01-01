@extends('layouts.back-end.app')
@section('title', ui_change('edit_Role' , 'general_management'))
@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                <img src="{{asset('/public/assets/back-end/img/add-new-seller.png')}}" alt="">
                {{ui_change('role_Update' , 'general_management')}}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="card">
            <div class="card-body">
                <form id="submit-create-role" action="{{route('role_admin.master_update',[$role['id']])}}" method="post"
                      style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="name" class="title-color">{{ui_change('role_name' , 'general_management')}}</label>
                                <input type="text" name="name" value="{{$role['name']}}" class="form-control" id="name"
                                       aria-describedby="emailHelp"
                                       placeholder="{{ui_change('ex' , 'general_management')}} : {{ui_change('store' , 'general_management')}}">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-4 flex-wrap">
                        <label for="module" class="title-color mb-0">{{ui_change('module_permission' , 'general_management')}}
                            : </label>
                        <div class="form-group d-flex gap-2">
                            <input type="checkbox" id="select_all" class="cursor-pointer">
                            <label class="title-color mb-0  cursor-pointer"
                                   for="select_all">{{ui_change('select_All' , 'general_management')}}</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3 col-sm-6">
                            <div class="form-group form-check">
                                <input type="checkbox" name="modules[]" value="dashboard"
                                       class="form-check-input module-permission"
                                       id="dashboard" {{in_array('dashboard',(array)json_decode($role['module_access']))?'checked':''}}>
                                <label class="form-check-label"
                                       style="{{Session::get('direction') === "rtl" ? 'margin-right: 1.25rem;' : ''}};"
                                       for="dashboard">{{ui_change('dashboard' , 'general_management')}}</label>
                            </div>
                        </div>
                               <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" name="modules[]" value="search_unit" class="module-permission"
                                    id="search_unit" {{in_array('search_unit',(array)json_decode($role['module_access']))?'checked':''}}>
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="search_unit">{{ ui_change('search_unit', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="hierarchy"
                                    id="hierarchy" {{in_array('hierarchy',(array)json_decode($role['module_access']))?'checked':''}}>
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="hierarchy">{{ ui_change('hierarchy', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="accounts_master"
                                    id="accounts_master" {{in_array('accounts_master',(array)json_decode($role['module_access']))?'checked':''}}>
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="accounts_master">{{ ui_change('accounts_master', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="transactions_master" id="transactions_master" {{in_array('transactions_master',(array)json_decode($role['module_access']))?'checked':''}}>
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="transactions_master">{{ ui_change('transactions_master', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" name="modules[]" class="module-permission" value="property_master"
                                    id="property_master" {{in_array('property_master',(array)json_decode($role['module_access']))?'checked':''}}>
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="property_master">{{ ui_change('property_master', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="property_config"
                                    id="property_config" {{in_array('property_config',(array)json_decode($role['module_access']))?'checked':''}}>
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="property_config">{{ ui_change('property_config', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="property_transactions" id="property_transactions" {{in_array('property_transactions',(array)json_decode($role['module_access']))?'checked':''}}>
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="property_transactions">{{ ui_change('property_transactions', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="property_reports" id="property_reports"  {{in_array('property_reports',(array)json_decode($role['module_access']))?'checked':''}}>
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="property_reports">{{ ui_change('property_reports', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="collections"
                                    id="collections" {{in_array('collections',(array)json_decode($role['module_access']))?'checked':''}}>
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="collections">{{ ui_change('collections', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="facility_masters" id="facility_masters" {{in_array('facility_masters',(array)json_decode($role['module_access']))?'checked':''}}>
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="facility_masters">{{ ui_change('facility_masters', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="facility_transactions" id="facility_transactions" {{in_array('facility_transactions',(array)json_decode($role['module_access']))?'checked':''}}>
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="facility_transactions">{{ ui_change('facility_transactions', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="facility_reports" id="facility_reports" {{in_array('facility_reports',(array)json_decode($role['module_access']))?'checked':''}}>
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="facility_reports">{{ ui_change('facility_reports', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="general_management" id="general_management" {{in_array('general_management',(array)json_decode($role['module_access']))?'checked':''}}>
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="general_management">{{ ui_change('general_management', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="settings"
                                    id="settings" {{in_array('settings',(array)json_decode($role['module_access']))?'checked':''}}>
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="settings">{{ ui_change('settings', 'general_management') }}</label>
                            </div>
                        </div>
                     
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <button type="reset" class="btn btn-secondary">{{ui_change('reset' , 'general_management')}}</button>
                        <button type="submit" class="btn btn--primary">{{ui_change('update' , 'general_management')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>

        $('#submit-create-role').on('submit', function (e) {

            var fields = $("input[name='modules[]']").serializeArray();
            if (fields.length === 0) {
                toastr.warning("{{ ui_change('select_minimum_one_selection_box' , 'general_management') }}", {
                    CloseButton: true,
                    ProgressBar: true
                });
                return false;
            } else {
                $('#submit-create-role').submit();
            }
        });
    </script>

    <script>
        $("#select_all").on('change', function () {
            if ($("#select_all").is(":checked") === true) {
                console.log($("#select_all").is(":checked"));
                $(".module-permission").prop("checked", true);
            } else {
                $(".module-permission").removeAttr("checked");
            }
        });

        $(document).ready(function(){
            checkbox_selection_check();
        })

        function checkbox_selection_check() {
            let nonEmptyCount = 0;
            $(".module-permission").each(function() {
                if ($(this).is(":checked") !== true) {
                    nonEmptyCount++;
                }
            });
            if (nonEmptyCount == 0) {
                $("#select_all").prop("checked", true);
            }else{
                $("#select_all").removeAttr("checked");
            }
        }

        $('.module-permission').click(function(){
            checkbox_selection_check();
        });
    </script>
@endpush
