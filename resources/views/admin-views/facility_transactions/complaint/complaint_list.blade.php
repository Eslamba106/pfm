@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
    $firstDay = Carbon\Carbon::now()->startOfMonth()->format('d/m/Y');
    $lastDay = Carbon\Carbon::now()->endOfMonth()->format('d/m/Y');
@endphp
@section('title', __('facility_transactions.complaint_registration_list'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                {{-- <img src="{{ asset(main_path() . 'back-end/img/inhouse-subscription-list.png') }}" alt=""> --}}
                {{ __('facility_transactions.complaint_registration_list') }}
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $complaints->total() }}</span>
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.facility_transactions.inline-menu')



        @php
            $rent_mode_months = [
                1 => 'Daily',
                2 => 'Monthly',
                3 => 'Bi-Monthly',
                4 => 'Quarterly',
                5 => 'Half-Yearly',
                6 => 'Yearly',
            ];
        @endphp

        <div class="row mt-20">
            <div class="col-md-12">
                <div class="card ">
                    <div class="px-3 py-4 ">
                        <div class="row align-items-center  mb-5web">
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
                                <!-- End Search -->
                            </div>
                            <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">

                                {{-- @can('create_agent') --}}
                                @if(auth()->check())

                                <a href="{{ route('complaint_registration.create') }}" class="btn btn--primary">
                                    <i class="tio-add"></i>
                                    <span class="text">{{ __('roles.create_complaint') }}</span>
                                </a>
                                @endif
                                {{-- <button class="btn   btn-outline-primary " data-filter="" data-toggle="modal"
                                    data-target="#filter"><i class="fas fa-filter"></i></button>
                                <button class="btn   btn-outline-primary " data-update="" data-toggle="modal"
                                    data-target="#update"><i class="fas fa-edit"></i></button> --}}
                            </div>
                        </div>
                        <form action="{{ url()->current() }}" method="GET">

 

                            <div style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                                <div class="table-responsive">
                                    <table id="datatable"
                                        class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                        <thead class="thead-light thead-50 text-capitalize">
                                            <tr>
                                                <th><input id="bulk_check_all" class="bulk_check_all" type="checkbox" />
                                                    {{ __('general.sl') }}</th>
                                                <th class="text-center">Complaint No.</th>
                                                <th class="text-center">Tenant Name</th>
                                                <th class="text-center">Mobil Number</th>
                                                <th class="text-center">Unit Details</th>
                                                <th class="text-center">{{ __('roles.employee') }}</th>
                                                <th class="text-center">{{ __('roles.priority') }}</th>
                                                <th class="text-center">Schedule Date</th>
                                                <th class="text-center">Created At</th>
                                                <th class="text-center">Created At Time</th>
                                                <th class="text-center">{{ __('roles.status') }}</th>
                                                <th class="text-center">{{ __('roles.Actions') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody> {{-- created_at --}}
                                            @foreach ($complaints as $k => $complaint)
                                                <tr
                                                    @if (
                                                        $complaint->status == 'open' &&
                                                            \Carbon\Carbon::parse($complaint->created_at)->addHours($complaint->MainPriority->time) < \Carbon\Carbon::now()) style="background-color: #ff6666;" @endif>
                                                    <th scope="row"><input class="check_bulk_item" name="bulk_ids[]"
                                                            type="checkbox" value="{{ $complaint->id }}" />
                                                        {{ $complaints->firstItem() + $k }}</th>

                                                    <td class="text-center">
                                                        {{ $complaint->complaint_no ?? __('general.not_available') }}
                                                    </td>


                                                    <td class="text-center">

                                                        {{ $complaint->tenant->name ?? $complaint->tenant->group_company_name }}
                                                    </td>

                                                    <td class="text-center">
                                                        {{ $complaint->phone_number ?? __('general.not_available') }}
                                                    </td>


                                                    <td class="text-center">
                                                        {{ $complaint->unit_management->property_unit_management->name .
                                                            '-' .
                                                            $complaint->unit_management->block_unit_management->block->name .
                                                            '-' .
                                                            $complaint->unit_management->floor_unit_management->floor_management_main->name .
                                                            '-' .
                                                            $complaint->unit_management->unit_management_main->name }}
                                                    </td>



                                                    @php
                                                        $employee = null;
                                                        isset($complaint->employee_id)
                                                            ? ($employee = DB::select(
                                                                'select * from employees where id = ?',
                                                                [$complaint->employee_id],
                                                            ))
                                                            : null;
                                                    @endphp
                                                    <td class="text-center">
                                                        @if (isset($employee[0]))
                                                            {{ $employee[0]->name }}
                                                        @else
                                                            <a id="department_employee" class="btn   "
                                                                title="{{ __('general.show') }}"
                                                                data-department_employee="{{ $complaint->id }}"
                                                                data-target="#department_employee">
                                                                {{ $lang == 'ar' ? 'اختر الموظف' : 'select employee' }}
                                                            </a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ $complaint->MainPriority->time . ' H/s' }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{ $complaint->schedule_date ? \Carbon\Carbon::parse($complaint->schedule_date)->format('Y-m-d h:i A') : __('general.not_available') }}
                                                    </td>
                                                    <td class="text-center">{{ $complaint->created_at->format('Y-m-d') }}
                                                    </td>
                                                    <td class="text-center">{{ $complaint->created_at->format('h:i A') }}
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($complaint->status == 'open')
                                                            <span
                                                                class="@if ($complaint->notification_sent != 1) text-green @else text-red @endif ">{{ $complaint->status }}</span>
                                                        @endif
                                                        @if ($complaint->status == 'freezed')
                                                            <span class="text-gray">{{ $complaint->status }}</span>
                                                        @endif
                                                        @if ($complaint->status == 'closed')
                                                            <span class="text-primary">{{ $complaint->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="d-flex justify-content-center gap-2">
                                                            <a href="{{ route('complaint_registration.showComplaint', $complaint->id) }}"
                                                                class="btn btn-outline-info btn-sm"
                                                                title="@lang('Show')">
                                                                <i class="fa fa-eye"></i>
                                                            </a>
                                                            <a href="{{ route('complaint_registration.show_logs', $complaint->id) }}"
                                                                class="btn btn-outline-warning btn-sm"
                                                                title="@lang('Show')">
                                                                <i class="fa fa-history"></i>
                                                            </a>
                                                            @if(auth()->check())
                                                            <a href="{{ route('complaint_registration.editComplaint', $complaint->id) }}"
                                                                class="btn btn-outline-secondary btn-sm"
                                                                title="@lang('Edit')">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            @endif
                                                            @if(auth()->check())
                                                            <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                                title="{{ __('general.delete') }}"
                                                                id="{{ $complaint['id'] }}">
                                                                <i class="tio-delete"></i>
                                                            </a>
                                                              @endif 
                                                              <a id="attachment" class="btn btn-sm  btn-outline-primary square-btn " data-update="" data-toggle="modal"
                                                                data-target="#update"  data-id="{{ $complaint['id'] }}" ><i class="fas fa-file"></i></a>
                                                            
                                                        </div>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="table-responsive mt-4">
                                    <div class="px-4 d-flex justify-content-lg-end">
                                        <!-- Pagination -->
                                        {{ $complaints->links() }}
                                    </div>
                                </div>

                                @if (count($complaints) == 0)
                                    <div class="text-center p-4">
                                        <img class="mb-3 w-160"
                                            src="{{ asset(main_path() . 'back-end') }}/svg/illustrations/sorry.svg"
                                            alt="Image Description">
                                        <p class="mb-0">{{ __('general.no_data_to_show') }}</p>
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if(auth()->check())
                
            
            <div class="modal fade" id="department_employee_model" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{ $lang == 'ar' ? 'اسناد الي موظف' : 'Assign to Employee' }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('complaint_registration.assign_to_employee') }}" method="post">
                            @csrf
                            @method('patch')
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="row">
                                        <input type="hidden" name="complaint_id_to_assign">
                                        <div class="col-md-6 col-lg-12 col-xl-12">
                                            <div class="form-group">
                                                <label for=""
                                                    class="form-control-label">{{ __('roles.employee') }}
                                                    <span class="text-danger"> *</span> </label>
                                                <select class="js-select2-custom form-control" name="employee_id"
                                                    required> 
                                                </select>
                                                @error('employee_id')
                                                    <span class="text-red">
                                                        {{ $errors->first('employee_id') }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                           <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{ ui_change('schedule_date_for_employee' , 'facility_transaction') }} </label>
                                            <input type="text" class="form-control main_date" name="employee_date">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{ ui_change('schedule_time_for_employee' , 'facility_transaction') }} </label>
                                            <input type="time" class="form-control" name="employee_time">
                                        </div>
                                    </div>
                                     <div class="col-md-6 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{ ui_change('employee_remark' , 'facility_transaction') }} </label>
                                            <textarea type="time" class="form-control"  cols="30" rows="2"  name="employee_note"></textarea>
                                        </div>
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
            @endif
            <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">
                                {{ ui_change('add_attachment' , 'facility_transaction')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form action="{{ route('complaint_registration.assign_to_department') }}"  method="POST"  enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <div class="modal-body">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Department Select -->
                                        <input type="hidden" name="complaint_id"   >
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label for=""
                                                class="form-control-label">{{ ui_change('attachments' , 'facility_transaction')  }} <span
                                                    class="text-danger"> Jpg, png, jpeg, webp, pdf</span></label>
                                            <input type="file" class="form-control" name="attachment">
                                            @error('attachment')
                                                <span class="text-red">
                                                    {{ $errors->first('attachment') }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{ ui_change('attachment_date' , 'facility_transaction') }} </label>
                                            <input type="text" class="form-control main_date" name="attachment_date">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-xl-6">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{ ui_change('attachment_time' , 'facility_transaction') }} </label>
                                            <input type="time" class="form-control" name="attachment_time"  id="attachment_time">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12 col-xl-12">
                                        <div class="form-group">
                                            <label for="" class="form-control-label">{{ ui_change('attachment_remark' , 'facility_transaction') }} </label>
                                            <textarea  class="form-control"  cols="30" rows="2"  name="attachment_note"></textarea>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="col-md-4 d-flex align-items-end">
                                    <button value="update_department" name="bulk_action_btn" type="submit"
                                        class="btn btn--primary w-100">
                                        {{ ui_change('add' , 'facility_transaction') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
     flatpickr(".main_date", {
            dateFormat: "d/m/Y", 
            minDate: "today",
            defaultDate: 'today'
        });
</script>
<script>
    window.addEventListener('DOMContentLoaded', (event) => {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        document.getElementById('attachment_time').value = `${hours}:${minutes}`;
    });
</script>

<script>
    $(document).on('click', '#attachment', function () {
        var complaintId = $(this).data('id'); 
        $('input[name="complaint_id"]').val(complaintId); 
    });
</script>

    <script>
        $(document).on('click', '#department_employee', function(e) {
            e.preventDefault();
            var sect_id = $(this).data('department_employee');
            $('#department_employee_model').modal('show');
            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "GET",
                url: "{{ route('get_employees_departments_complaint', ':id') }}".replace(':id', sect_id),
                success: function(response) {
                    if (response.status == 404) {
                        $('#success_message').html("");
                        $('#success_message').addClass("alert alert-danger");
                        $('#success_message').text(response.message);
                        // $('#edit_name').val(response.get_service.name)
                    } else {
                        var employeeSelect = $('select[name="employee_id"]');
                        var complaint_id_to_assign = $('input[name="complaint_id_to_assign"]');
                        $.each(response.employees, function(index,
                            employee) {
                            employeeSelect.empty()
                            employeeSelect.append(
                                '<option value="' +
                                employee.id + '">' +
                                employee.name +
                                '</option>');
                        });

                        // complaint_id_to_assign.empty();complaint
                        complaint_id_to_assign.val(response.complaint.id);


                    }
                },
                // error: function(xhr, status, error) {
                //     console.error("Error: " + error);
                // }
            });

        });
    </script>
    <script>
        flatpickr("#invoice_date", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
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
                url: "{{ route('agreement.status-update') }}",
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
                        url: "{{ route('complaint_registration.deleteComplaint') }}",
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
        function filterUnits() {
            const buildingSelect = document.getElementById('report_building');
            const unitSelect = document.getElementById('report_unit_management');
            const selectedBuildingId = buildingSelect.value;

            if (selectedBuildingId != -1) {
                unitSelect.disabled = false;

                Array.from(unitSelect.options).forEach(option => {
                    if (option.value !== "-1") {
                        option.style.display = option.getAttribute('data-building') == selectedBuildingId ?
                            'block' : 'none';
                    }
                });
            } else {
                unitSelect.disabled = true;
                Array.from(unitSelect.options).forEach(option => {
                    option.style.display = 'block';
                });
            }
        }
    </script>
    <script>
        flatpickr("#end_date", {
            dateFormat: "d/m/Y",
        });
        flatpickr("#start_date", {
            dateFormat: "d/m/Y",
        });
    </script>
@endpush
