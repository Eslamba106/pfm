@extends('layouts.back-end.app')

@section('title', ui_change('Complaint_history', 'facility_transaction'))
@php
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
                {{ ui_change('Complaint_history', 'facility_transaction') }}
                {{-- <span class="badge badge-soft-dark radius-50 fz-14 ml-1"> </span> --}}
            </h2>
        </div>
        <!-- End Page Title -->

        @if (count($comment_logs) != 0)


            <div class="row mt-20">
                <div class="col-md-12">


                    <div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h3 class="card-title m-0 ">
                                        {{ ui_change('Complaint_history', 'facility_transaction') . ' ' . $complaint->complaint_no }}
                                    </h3>
                                    <div>
                                        @if ($complaint->status == 'open')
                                            <button class="btn btn-primary" data-freezing_compalint="" data-toggle="modal"
                                                data-target="#freezing_compalint">Freezed</button>
                                            <button class="btn btn-secondary" data-closed_compalint="" data-toggle="modal"
                                                data-target="#closed_compalint">Closed</button>
                                        @endif
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    {{-- <table id="example2" class="table table-bordered table-hover">
                                        <thead>

                                            <tr>
                                                <td class="width30">{{ translate('Logs') }}</td>
                                                <td colspan="2">
                                                    @foreach ($comment_logs as $comment_logs_item)
                                                        @php
                                                             
                                                            $createdAt = Carbon\Carbon::parse($comment_logs_item->created_at);
                                                        @endphp
                                                        <div style="border-bottom: 1px solid #ccc; padding: 5px;">
                                                            <strong>Old:</strong>
                                                            {{ $comment_logs_item->old_comment ?? '#' }}<br>
                                                            <strong>New:</strong>
                                                            {{ $comment_logs_item->new_comment ?? '#' }}<br>
                                                            <strong>Date:</strong>
                                                            {{ $createdAt->format('Y-m-d') ?? '#' }}<br>
                                                            <strong>Time:</strong>
                                                            {{ $createdAt->format('H:i') ?? '#' }}<br>
                                                            <strong>{{ translate('auth') }} :</strong>
                                                            {{ $comment_logs_item->auther->name  }}<br>
                                                        </div>
                                                    @endforeach
                                                </td>
                                            </tr>
                                        </thead>
                                    </table> --}}
                                    <div style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                                        <div class="table-responsive">
                                            <table id="datatable"
                                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                                <thead class="thead-light thead-50 text-capitalize">
                                                    <tr>
                                                        <th><input id="bulk_check_all" class="bulk_check_all"
                                                                type="checkbox" />
                                                            {{ ui_change('sl', 'faciltiy_transaction') }}</th>
                                                        <th class="text-center">
                                                            {{ ui_change('date', 'faciltiy_transaction') }}</th>
                                                        <th class="text-center">
                                                            {{ ui_change('time', 'faciltiy_transaction') }}</th>
                                                        <th class="text-center">
                                                            {{ ui_change('activity', 'faciltiy_transaction') }}</th>
                                                        <th class="text-center">
                                                            {{ ui_change('attachment', 'faciltiy_transaction') }}</th>
                                                        <th class="text-center">
                                                            {{ ui_change('remarks', 'faciltiy_transaction') }}</th>
                                                        <th class="text-center">
                                                            {{ ui_change('user', 'faciltiy_transaction') }}</th>

                                                    </tr>
                                                </thead>
                                                <tbody> {{-- created_at --}}
                                                    @foreach ($comment_logs as $k => $comment_log_item)
                                                        <tr>
                                                            <th scope="row"><input class="check_bulk_item"
                                                                    name="bulk_ids[]" type="checkbox"
                                                                    value="{{ $comment_log_item->id }}" />
                                                                {{ $loop->index + 1 }}</th>

                                                            <td class="text-center">
                                                                {{ $comment_log_item->date ?? ui_change('not_available', 'facility_transaction') }}
                                                            </td>

                                                            <td class="text-center">
                                                                {{ $comment_log_item->time ?? ui_change('not_available', 'facility_transaction') }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ !is_null($comment_log_item->employee_id) ? $comment_log_item->activity . ' ' . $comment_log_item->employee->name : $comment_log_item->activity }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $comment_log_item->attachment ?? ui_change('not_available', 'facility_transaction') }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $comment_log_item->notes ?? ui_change('not_available', 'facility_transaction') }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $comment_log_item->user->name ?? ui_change('not_available', 'facility_transaction') }}
                                                            </td>


                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        {{-- <div class="table-responsive mt-4">
                                    <div class="px-4 d-flex justify-content-lg-end">
                                        <!-- Pagination -->
                                        {{ $comment_logs->links() }}
                                    </div>
                                </div> --}}

                                        @if (count($comment_logs) == 0)
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
                    </div>
                    <!-- modal Freezed Complaint -->
                    <div class="modal fade" id="freezing_compalint" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ ui_change('freezing_complaint', 'facility_transaction') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('complaint_registration.freezedComplaint', $complaint->id) }}"
                                    method="post">
                                    @csrf
                                    @method('patch')
                                    <div class="modal-body">
                                        <div class="form-group">

                                            <label
                                                for="">{{ ui_change('Select_Freezing_Reason', 'facility_transaction') }}</label>
                                            <select name="freezed_reason" class="form-control">
                                                @foreach ($freezing as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div> 
                                            <div class="form-group">
                                                <label for=""
                                                    class="form-control-label">{{ ui_change('date', 'facility_transaction') }}
                                                </label>
                                                <input type="text" class="form-control main_date" name="date">
                                            </div>
                                         
                                            <div class="form-group">
                                                <label for=""
                                                    class="form-control-label">{{ ui_change('time', 'facility_transaction') }}
                                                </label>
                                                <input type="time" class="form-control" name="time"
                                                    id="freezed_time">
                                            </div> 
                                        <div class="form-group">

                                            <label for="">{{ ui_change('notes', 'facility_transaction') }}</label>
                                            <textarea name="notes" id="" cols="30" rows="2" class="form-control"></textarea>
                                        </div>




                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ __('Cancel') }}</button>
                                        <button type="submit" class="btn btn--primary">{{ ui_change('save', 'facility_transaction') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal Freezed Complaint -->


                <!-- modal Closed Complaint -->
                <div class="modal fade" id="closed_compalint" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ ui_change('closed_complaint', 'facility_transaction') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route('complaint_registration.closedComplaint', $complaint->id) }}"
                                method="post">
                                @csrf
                                @method('patch')
                                <div class="modal-body">
                                    <div class="form-group">

                                        <label for="">{{ ui_change('closed_department', 'facility_transaction') }}</label>
                                        <select name="department" class="form-control">
                                            @foreach ($departments as $item)
                                                <option value="{{ $item->id }}"
                                                    @if ($item->id == $complaint->department) selected @endif>{{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                      <div class="form-group">
                                                <label for=""
                                                    class="form-control-label">{{ ui_change('date', 'facility_transaction') }}
                                                </label>
                                                <input type="text" class="form-control main_date" name="date">
                                            </div>
                                         
                                            <div class="form-group">
                                                <label for=""
                                                    class="form-control-label">{{ ui_change('time', 'facility_transaction') }}
                                                </label>
                                                <input type="time" class="form-control" name="time"
                                                    id="closed_time">
                                            </div> 
                                        <div class="form-group">

                                            <label for="">{{ ui_change('notes', 'facility_transaction') }}</label>
                                            <textarea name="notes" id="" cols="30" rows="2" class="form-control"></textarea>
                                        </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">{{ __('Cancel') }}</button>
                                    <button type="submit" class="btn btn--primary">{{ ui_change('save', 'facility_transaction') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal Closed Complaint -->

            @if (Session::has('success'))
                <script>
                    swal("Message", "{{ Session::get('success') }}", 'success', {
                        button: true,
                        button: "Ok",
                        timer: 3000,
                    })
                </script>
            @endif
    </div>
    </div>
    </div>
    @endif
    @if (count($comment_logs) == 0)
        <div class="text-center p-4">
            <img class="mb-3 w-160" src="{{ asset(main_path() . 'back-end') }}/svg/illustrations/sorry.svg"
                alt="Image Description">
            <p class="mb-0">{{ __('general.no_data_to_show') }}</p>
        </div>
    @endif
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
            document.getElementById('closed_time').value = `${hours}:${minutes}`;
        });
        window.addEventListener('DOMContentLoaded', (event) => {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            document.getElementById('freezed_time').value = `${hours}:${minutes}`;
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

        // $('.subscription_status_form').on('submit', function(event) {
        //     event.preventDefault();

        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        //         }
        //     });
        //     $.ajax({
        //         url: "{{ route('agreement.status-update') }}",
        //         method: 'POST',
        //         data: $(this).serialize(),
        //         success: function(data) {
        //             if (data.success == true) {
        //                 toastr.success('{{ __('general.updated_successfully') }}');
        //             } else if (data.success == false) {
        //                 toastr.error(
        //                     '{{ __('Status_updated_failed.') }} {{ __('Product_must_be_approved') }}'
        //                 );
        //                 setTimeout(function() {
        //                     location.reload();
        //                 }, 2000);
        //             }
        //         }
        //     });
        // });

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
                        url: "{{ route('agreement.delete') }}",
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
