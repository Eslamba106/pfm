@extends('layouts.back-end.app')

@section('title', __('facility_transactions.complaint_registration_list'))
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
                {{ __('Show Complaint') }}
                {{-- <span class="badge badge-soft-dark radius-50 fz-14 ml-1"> </span> --}}
            </h2>
        </div>
        <!-- End Page Title -->


        <div class="row mt-20">
            <div class="col-md-12">


                <div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h3 class="card-title m-0 ">{{ __('Show Complaint') . ' ' . $complaint->complaint_no }}</h3>
                                <div>
                                    @if($complaint->status == 'open')
                                    <button class="btn btn-primary" data-freezing_compalint="" data-toggle="modal"
                                        data-target="#freezing_compalint">Freezed</button>
                                    <button class="btn btn-secondary" data-closed_compalint="" data-toggle="modal"
                                    data-target="#closed_compalint" >Closed</button>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <td class="width30">{{ __('Complaint No.') }}</td>
                                            <td>{{ $complaint->complaint_no ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('Tenant Name') }}</td>
                                            <td>{{ $complaint->tenant->name ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('Complainer Name') }}</td>
                                            <td>{{ $complaint->complainer_name ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('Mobil Number') }}</td>
                                            <td>{{ $complaint->phone_number ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('Property') }}</td>
                                            <td>{{ $complaint->property->name ?? '#' }}</td>
                                        </tr>{{ $complaint->unit_management->property_unit_management->name  .'-' . $complaint->unit_management->block_unit_management->block->name
                                        .'-'.$complaint->unit_management->floor_unit_management->floor_management_main->name .'-'.$complaint->unit_management->unit_management_main->name
                                            }}
                                        <tr>

                                            <td class="width30">{{ __('Blook') }}</td>
                                            <td>{{ $complaint->unit_management->block_unit_management->block->name ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('Floor') }}</td>
                                            <td>{{ $complaint->unit_management->floor_unit_management->floor_management_main->name ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('Unit') }}</td>
                                            <td>{{ $complaint->unit_management->unit_management_main->name ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('Complaint Category') }}</td>
                                            <td>{{ $complaint->complaintCategory->name ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('Complaint') }}</td>
                                            <td>{{ $complaint->ComplaintMain->name ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('Comment') }}</td>
                                            <td colspan="2">
                                                @foreach ($comment_logs as $comment_logs_item)
                                                    <div style="border-bottom: 1px solid #ccc; padding: 5px;">
                                                        <strong>Old:</strong> {{ $comment_logs_item->old_comment ?? '#' }}<br>
                                                        <strong>New:</strong> {{ $comment_logs_item->new_comment ?? '#' }}
                                                    </div>
                                                @endforeach
                                            </td>
                                        </tr>
                                        
                                        <tr>
                                            <td class="width30">{{ __('Department') }}</td>
                                            <td>{{ $complaint->MainDepartment->name ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('Priority') }}</td>
                                            <td>{{ $complaint->MainPriority->name ?? '#' }}</td>
                                        </tr>
                                        {{-- <tr>
                                            <td class="width30">{{ __('Time Frame') }}</td>
                                            <td>{{ ($complaint->MainPriority->time != null) ? $complaint->MainPriority->time. ' Hr/S' :'#' }}</td>
                                        </tr> --}}
                                        <tr>
                                            <td class="width30">{{ __('Status') }}</td>
                                            <td>{{ $complaint->status ?? '#' }}</td>
                                        </tr>
                                        @if(isset($complaint->freezed_reason))
                                            <tr>
                                                <td class="width30">{{ __('Freezing Reason') }}</td>
                                                <td>{{ App\Models\facility\Freezing::where('id',$complaint->freezed_reason)->first()->name ?? '#' }}</td>
                                            </tr>
                                        @endif
                                        @if(isset($complaint->freezing_notes))
                                            <tr>
                                                <td class="width30">{{ __('Freezing Notes') }}</td>
                                                <td>{{ $complaint->freezing_notes ?? '#' }}</td>
                                            </tr>
                                        @endif
                                        @if(isset($complaint->worker))
                                            <tr>
                                                <td class="width30">{{ __('The department that did the work') }}</td>
                                                <td>{{ App\Models\Department::where('id',$complaint->worker)->first()->name ?? '#' }}</td>
                                            </tr>
                                        @endif
                                        @if(isset($complaint->notes))
                                            <tr>
                                                <td class="width30">{{ __('Notes') }}</td>
                                                <td>{{ $complaint->notes ?? '#' }}</td>
                                            </tr>
                                        @endif
                                        @if(isset($complaint->attachment_type) && ($complaint->attachment_type == 'image'))
                                        {{-- {{ dd(asset('images/complaint/1741358235_1704694379.png')) }} --}}
                                            <tr>
                                                <td class="width30">{{ __('roles.attachments') }}</td>
                                                <td><img src="{{ asset($complaint->attachment) }}" alt=""></td>
                                            </tr>
                                        @endif
                                        @if(isset($complaint->attachment_type) && ($complaint->attachment_type == 'pdf'))
                                        {{-- {{ dd(asset('images/complaint/1741358235_1704694379.png')) }} --}}
                                            <tr>
                                                <td class="width30">{{ __('roles.attachments') }}</td>
                                                <td><a href="{{ route('complaint_registration.documents_view', $complaint->id) }}" class="btn btn-outline-info btn-sm"
                                                    title="@lang('general.show')" target="_blank"><i class="fa-solid fa-display"></i>
                                                </a></td>
                                            </tr>
                                        @endif
                                        <tr>
                                            <td class="width30">{{ __('Created At') }}</td>
                                            <td>{{ $complaint->created_at->format('Y-m-d') ?? '#' }}</td>
                                        </tr>
                                        <tr>
                                            <td class="width30">{{ __('Created At Time') }}</td>
                                            <td>{{ $complaint->created_at->format('h:i A') ?? '#' }}</td>
                                        </tr>



                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal Freezed Complaint -->
                <div class="modal fade" id="freezing_compalint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ __('Freezing Complaint') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <form action="{{ route('complaint_registration.freezedComplaint' , $complaint->id) }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <div class="modal-body">
                                        <div class="form-group">

                                            <label for="">{{ __('Select Freezing Reason') }}</label>
                                            <select name="freezed_reason" class="form-control">
                                                @foreach ($freezing as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">

                                            <label for="">{{ __('Notes') }}</label>
                                            <textarea name="notes" id="" cols="30" rows="2" class="form-control"></textarea>
                                        </div>




                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ __('Cancel') }}</button>
                                        <button type="submit" class="btn btn--primary">{{ __('Save') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- modal Freezed Complaint -->


                <!-- modal Closed Complaint -->
                <div class="modal fade" id="closed_compalint" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">{{ __('Closed Complaint') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <form action="{{ route('complaint_registration.closedComplaint' , $complaint->id) }}" method="post">
                                    @csrf
                                    @method('patch')
                                    <div class="modal-body">
                                        <div class="form-group">

                                            <label for="">{{ __('Closed Department') }}</label>
                                            <select name="department" class="form-control">
                                                @foreach ($departments as $item)
                                                    <option value="{{ $item->id }}" @if( $item->id == $complaint->department) selected @endif>{{ $item->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">

                                            <label for="">{{ __('Notes') }}</label>
                                            <textarea name="notes" id="" cols="30" rows="2" class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">{{ __('Cancel') }}</button>
                                        <button type="submit" class="btn btn--primary">{{ __('Save') }}</button>
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
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset(main_path() . 'back-end') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset(main_path() . 'back-end') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
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
