@extends('layouts.back-end.app')
@section('title', ui_change('create_Role', 'general_management'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('public/assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
        <div class="content container-fluid">
            <!-- Page Title -->
            <div class="mb-3">
                <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                    <img src="{{ asset('/public/assets/back-end/img/add-new-seller.png') }}" alt="">
                    {{ ui_change('employee_Role_Setup', 'general_management') }}
                </h2>
            </div>
        <!-- End Page Title -->

        <!-- Content Row -->
            <div class="card">
                <div class="card-body">
                <form id="submit-create-role" method="post" action="{{ route('role_admin.store') }}"
                    style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group mb-4">
                                <label for="name"
                                    class="title-color">{{ ui_change('role_name', 'general_management') }}</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    aria-describedby="emailHelp"
                                    placeholder="{{ ui_change('ex', 'general_management') }} : {{ ui_change('store', 'general_management') }}"
                                    required>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex gap-4 flex-wrap">
                        <label for="name"
                            class="title-color font-weight-bold mb-0">{{ ui_change('module_permission', 'general_management') }}
                        </label>
                        <div class="form-group d-flex gap-2">
                            <input type="checkbox" id="select_all" class="cursor-pointer">
                            <label class="title-color mb-0 cursor-pointer"
                                for="select_all">{{ ui_change('select_All', 'general_management') }}</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" name="modules[]" value="dashboard" class="module-permission"
                                    id="dashboard">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="dashboard">{{ ui_change('dashboard', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" name="modules[]" value="search_unit" class="module-permission"
                                    id="search_unit">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="search_unit">{{ ui_change('search_unit', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="hierarchy"
                                    id="hierarchy">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="hierarchy">{{ ui_change('hierarchy', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="accounts_master"
                                    id="accounts_master">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="accounts_master">{{ ui_change('accounts_master', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="transactions_master" id="transactions_master">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="transactions_master">{{ ui_change('transactions_master', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" name="modules[]" class="module-permission" value="property_master"
                                    id="property_master">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="property_master">{{ ui_change('property_master', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="property_config"
                                    id="property_config">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="property_config">{{ ui_change('property_config', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="property_transactions" id="property_transactions">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="property_transactions">{{ ui_change('property_transactions', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="property_reports" id="property_reports">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="property_reports">{{ ui_change('property_reports', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="collections"
                                    id="collections">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="collections">{{ ui_change('collections', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="facility_masters" id="facility_masters">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="facility_masters">{{ ui_change('facility_masters', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="facility_transactions" id="facility_transactions">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="facility_transactions">{{ ui_change('facility_transactions', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="facility_reports" id="facility_reports">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="facility_reports">{{ ui_change('facility_reports', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]"
                                    value="general_management" id="general_management">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="general_management">{{ ui_change('general_management', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="settings"
                                    id="settings">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="settings">{{ ui_change('settings', 'general_management') }}</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-lg-3">
                            <div class="form-group d-flex gap-2">
                                <input type="checkbox" class="module-permission" name="modules[]" value="import_excel"
                                    id="import_excel">
                                <label class="title-color mb-0"
                                    style="{{ Session::get('direction') === 'rtl' ? 'margin-right: 1.25rem;' : '' }};"
                                    for="import_excel">{{ ui_change('import_excel', 'general_management') }}</label>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit"
                            class="btn btn--primary">{{ ui_change('submit', 'general_management') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card mt-3">
            <div class="px-3 py-4">
                <div class="row justify-content-between align-items-center flex-grow-1">
                    <div class="col-md-4 col-lg-6 mb-2 mb-sm-0">
                        <h5 class="d-flex align-items-center gap-2">
                            {{ ui_change('employee_Roles', 'general_management') }}
                            <span class="badge badge-soft-dark radius-50 fz-12 ml-1">{{ count($rl) }}</span>
                        </h5>
                    </div>
                    <div class="col-md-8 col-lg-6 d-flex flex-wrap flex-sm-nowrap justify-content-sm-end gap-3">
                        <!-- Search -->
                        <form action="{{ url()->current() }}?search={{ $search }}" method="GET">
                            <div class="input-group input-group-merge input-group-custom">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="tio-search"></i>
                                    </div>
                                </div>
                                <input id="datatableSearch_" type="search" name="search" class="form-control"
                                    placeholder="{{ ui_change('search_role', 'general_management') }}"
                                    value="{{ $search }}">
                                <button type="submit"
                                    class="btn btn--primary">{{ ui_change('search', 'general_management') }}</button>
                            </div>
                        </form>
                        <!-- End Search -->
                        {{-- <div class="">
                            <button type="button" class="btn btn-outline--primary text-nowrap" data-toggle="dropdown">
                                <i class="tio-download-to"></i>
                                {{ ui_change('export', 'general_management') }}
                                <i class="tio-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('role_admin.export', ['search' => request('search')]) }}">
                                        <img width="14" src="{{ asset('/public/assets/back-end/img/excel.png') }}"
                                            alt="">
                                        {{ ui_change('excel', 'general_management') }}
                                    </a>
                                </li>
                            </ul>
                        </div> --}}
                    </div>
                </div>
            </div>
            <div class="pb-3">
                <div class="table-responsive">
                    <table class="table table-hover table-borderless table-thead-bordered table-align-middle card-table"
                        cellspacing="0"
                        style="text-align: {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }};">
                        <thead class="thead-light thead-50 text-capitalize table-nowrap">
                            <tr>
                                <th>{{ ui_change('SL', 'general_management') }}</th>
                                <th>{{ ui_change('role_name', 'general_management') }}</th>
                                <th>{{ ui_change('modules', 'general_management') }}</th>
                                <th>{{ ui_change('created_at', 'general_management') }}</th>
                                <th>{{ ui_change('status', 'general_management') }}</th>
                                <th class="text-center">{{ ui_change('action', 'general_management') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rl as $k => $r)
                                <tr>
                                    <td>{{ $k + 1 }}</td>
                                    <td>{{ $r['name'] }}</td>
                                    <td class="text-capitalize">
                                        @if ($r['module_access'] != null)
                                            @foreach ((array) json_decode($r['module_access']) as $m)
                                                @if ($m == 'report')
                                                    {{ ui_change('reports_and_analytics', 'general_management') }} <br>
                                                @elseif($m == 'user_section')
                                                    {{ ui_change('user_management', 'general_management') }} <br>
                                                @elseif($m == 'support_section')
                                                    {{ ui_change('Help_&_Support_Section', 'general_management') }} <br>
                                                @else
                                                    {{ ui_change(str_replace('_', ' ', $m), 'general_management') }} <br>
                                                @endif
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>{{ date('d-M-y', strtotime($r['created_at'])) }}</td>
                                    <td>
                                        <form action="{{ route('role_admin.employee-role-status') }}" method="post"
                                            id="employee_role_status{{ $r['id'] }}_form"
                                            class="employee_role_status_form">
                                            @csrf
                                            <input type="hidden" name="id" value="{{ $r['id'] }}">
                                            <label class="switcher">
                                                <input type="checkbox" class="switcher_input"
                                                    id="employee_role_status{{ $r['id'] }}" name="status"
                                                    value="1" {{ $r['status'] == 1 ? 'checked' : '' }}
                                                    onclick="toogleStatusModal(event,'employee_role_status{{ $r['id'] }}','employee-on.png','employee-off.png','{{ ui_change('Want_to_Turn_ON_Employee_Status.', 'general_management') }}','
                                             {{ ui_change('Want_to_Turn_OFF_Employee_Status', 'general_management') }}',`<p>{{ ui_change('when_the_status_is_enabled_employees_can_access_the_system_to_perform_their_responsibilities', 'general_management') }}</p>`,`<p>{{ ui_change('when_the_status_is_disabled_employees_cannot_access_the_system_to_perform_their_responsibilities', 'general_management') }}</p>`)">
                                                <span class="switcher_control"></span>
                                            </label>
                                        </form>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-2 justify-content-center">
                                            <a href="{{ route('role_admin.update', [$r['id']]) }}"
                                                class="btn btn-outline--primary btn-sm square-btn"
                                                title="{{ ui_change('edit', 'general_management') }}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <a href="#" class="btn btn-outline-danger btn-sm delete"
                                                title="{{ ui_change('delete', 'general_management') }}"
                                                id="{{ $r['id'] }}">
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
        </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset('public/assets/back-end') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset('public/assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            Swal.fire({
                title: "{{ ui_change('are_you_sure_delete_this_role', 'general_management') }}?",
                text: "{{ ui_change('you_will_not_be_able_to_revert_this', 'general_management') }}!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ ui_change('yes_delete_it', 'general_management') }}!",
                cancelButtonText: "{{ ui_change('cancel', 'general_management') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('role_admin.delete') }}",
                        method: 'POST',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success(
                                "{{ ui_change('role_deleted_successfully', 'general_management') }}"
                            );
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
    <script>
        $('#submit-create-role').on('submit', function(e) {

            var fields = $("input[name='modules[]']").serializeArray();
            if (fields.length === 0) {
                toastr.warning("{{ ui_change('select_minimum_one_selection_box', 'general_management') }}", {
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
        $('.employee_role_status_form').on('submit', function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    if (response.success == 1) {
                        toastr.success(response.message);
                    }
                }
            });
        });
    </script>

    <script>
        $("#select_all").on('change', function() {
            if ($("#select_all").is(":checked") === true) {
                console.log($("#select_all").is(":checked"));
                $(".module-permission").prop("checked", true);
            } else {
                $(".module-permission").removeAttr("checked");
            }
        });

        function checkbox_selection_check() {
            let nonEmptyCount = 0;
            $(".module-permission").each(function() {
                if ($(this).is(":checked") !== true) {
                    nonEmptyCount++;
                }
            });
            if (nonEmptyCount == 0) {
                $("#select_all").prop("checked", true);
            } else {
                $("#select_all").removeAttr("checked");
            }
        }

        $('.module-permission').click(function() {
            checkbox_selection_check();
        });
    </script>
@endpush
