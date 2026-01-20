@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
@endphp
@section('title', ui_change($route, 'room_reservation'))
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
                {{-- <img width="60" src="{{ asset('assets/back-end/img/' . $route . '.jpg') }}" alt=""> --}}
                {{ ui_change($route, 'room_reservation') }}
            </h2>
        </div>
        <!-- End Page Title -->
        @php
            $currentUrl = url()->current();
            $segments = explode('/', $currentUrl);
            $before_last = $segments[count($segments) - 2] ?? null;
            $facility_masters = ['room-block', 'room-floor', 'room-building', 'room-unit'];
        @endphp
        @if (in_array($before_last, $facility_masters))
            @include('admin-views.inline_menu.room_reservation.management.inline-menu')
        @else
            @include('admin-views.inline_menu.room_reservation.master.inline-menu')
        @endif

        <!-- Content Row -->
        <div class="row">


            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                <button type="button" data-add_new="" data-toggle="modal" data-target="#add_new"
                                    class="btn btn--primary createButton">
                                    <i class="tio-add"></i>
                                    <span class="text">{{ ui_change('add_new', 'property_transaction') }}</span>
                                </button>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <!-- Search -->
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-custom input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="{{ ui_change('search_by_' . $route . '_name', 'room_reservation') }}"
                                            aria-label="Search" value="{{ $search }}" required>
                                        <button type="submit"
                                            class="btn btn--primary">{{ ui_change('search', 'room_reservation') }}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                        </div>
                    </div>
                    <div style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                        <div class="table-responsive">
                            <table id="datatable"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th>{{ ui_change('sl', 'room_reservation') }}</th>
                                        <th class="text-center">{{ ui_change($route . '_name', 'room_reservation') }}
                                        </th>

                                        <th class="text-center">{{ ui_change($route . '_code', 'room_reservation') }}</th>
                                        @if ($route == 'room_block' || $route == 'room_floor')
                                            <th class="text-center">{{ ui_change('building', 'room_reservation') }}</th>
                                        @endif
                                        @if ($route == 'room_floor')
                                            <th class="text-center">{{ ui_change('Block', 'room_reservation') }}</th>
                                        @endif
                                        <th class="text-center">{{ ui_change('actions', 'room_reservation') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($main as $key => $value)
                                        <tr>
                                            <td>{{ $main->firstItem() + $key }}</td>
                                            <td class="text-center">{{ $value->name }}</td>

                                            <td class="text-center">{{ $value->code }} </td>
                                            @if ($route == 'room_block' || $route == 'room_floor')
                                                <td class="text-center">{{ $value->building?->name }} </td>
                                            @endif
                                            @if ($route == 'room_floor')
                                                <td class="text-center">{{ $value->block?->name }} </td>
                                            @endif

                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a id="edit_{{ $route }}_item"
                                                        class="btn btn-outline-info btn-sm square-btn"
                                                        title="{{ __('general.edit') }}" data-toggle="modal"
                                                        data-target="#edit_{{ $route }}"
                                                        data-{{ $route }}_id="{{ $value->id }}">
                                                        <i class="tio-edit"></i>
                                                    </a>


                                                    <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                        title="{{ ui_change('delete', 'room_reservation') }}"
                                                        id="{{ $value['id'] }}">
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

                    <div class="table-responsive mt-4">
                        <div class="d-flex justify-content-lg-end">
                            <!-- Pagination -->
                            {!! $main->links() !!}
                        </div>
                    </div>

                    @if (count($main) == 0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160" src="{{ asset('assets/back-end') }}/svg/illustrations/sorry.svg"
                                alt="Image Description">
                            <p class="mb-0">{{ ui_change('no_data_to_show', 'room_reservation') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>




    <div class="modal fade" id="edit_{{ $route }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ ui_change('edit_' . $route, 'room_reservation') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route($route . '.update') }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="modal-body">
                        <div class="row">
                            <input id="{{ $route }}_id" type="hidden" name="id" class="form-control">

                            <div class="col-md-12 col-lg-4 col-xl-12">
                                <div class="form-group ">
                                    <label for="">{{ ui_change('name') }}</label>
                                    <input id="edit_name" type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-12">
                                <div class="form-group ">
                                    <label for="">{{ ui_change('code') }}</label>
                                    <input id="edit_code" type="text" name="code" class="form-control">
                                </div>
                            </div>
                            @if ($route == 'room_block' || $route == 'room_floor')
                                <div class="col-md-12 col-lg-4 col-xl-12">
                                    <div class="form-group ">
                                        <label for="">{{ ui_change('building') }}</label>
                                        <select class="js-select2-custom form-control" id="edit_building_id"
                                            name="building_id" onchange="get_blocks_for_edit()" required>
                                            <option selected value="">{{ ui_change('select', 'property_master') }}
                                            </option>
                                            @foreach ($buildings as $building_item)
                                                <option value="{{ $building_item->id }}">
                                                    {{ $building_item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                            @if ($route == 'room_floor')
                                <div class="col-md-12 col-lg-4 col-xl-12">
                                    <div class="form-group ">
                                        <label for="">{{ ui_change('block') }}</label>
                                        <select class="js-select2-custom form-control" id="edit_block_id" name="block_id"
                                            required>
                                            <option value="">{{ ui_change('select', 'property_master') }} </option>
                                            @foreach ($blocks as $block_item)
                                                <option value="{{ $block_item->id }}">
                                                    {{ $block_item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ ui_change('cancel') }}</button>
                        <button type="submit" class="btn btn--primary">{{ ui_change('submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add_new" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        {{ ui_change('Generate_Invoice', 'property_report') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('booking_room.check_in_page') }}" id="checkin-form" method="get">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ ui_change('name', 'property_report') }}</label>
                                    <input type="text" class="form-control">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">{{ ui_change('ledger', 'property_report') }}</label>
                                    <select name="ledger_id" class="form-control">
                                        {{-- @foreach ($tenants as $tenants_item)
                                            <option value="{{ $tenants_item->id }}">
                                                {{ $tenants_item->name ?? $tenants_item->company_name }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">{{ ui_change('from', 'property_report') }}</label>
                                    <input type="number" name="from" class="form-control date">
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">{{ ui_change('period', 'property_report') }}</label>
                                    <select name="period_from" class="form-control">
                                        <option value="day">{{ ui_change('day', 'property_report') }}</option>
                                        <option value="week">{{ ui_change('week', 'property_report') }}</option>
                                        <option value="month">{{ ui_change('month', 'property_report') }}</option>
                                        <option value="year">{{ ui_change('year', 'property_report') }}</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">{{ ui_change('to', 'property_report') }}</label>
                                    <input type="number" name="to" class="form-control date">
                                </div>

                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">{{ ui_change('period', 'property_report') }}</label>
                                    <select name="period_from" class="form-control">
                                        <option value="day">{{ ui_change('day', 'property_report') }}</option>
                                        <option value="week">{{ ui_change('week', 'property_report') }}</option>
                                        <option value="month">{{ ui_change('month', 'property_report') }}</option>
                                        <option value="year">{{ ui_change('year', 'property_report') }}</option>
                                    </select>
                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ ui_change('Cancel', 'property_report') }}</button>
                        <button type="submit"
                            class="btn btn--primary">{{ ui_change('Generate', 'property_report') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            // var route_name = document.getElementById('route_name').value;
            Swal.fire({
                title: "{{ ui_change('are_you_sure_delete_this', 'room_reservation') }}",
                text: "{{ ui_change('you_will_not_be_able_to_revert_this', 'room_reservation') }}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ ui_change('yes_delete_it', 'room_reservation') }}!',
                cancelButtonText: '{{ ui_change('cancel', 'room_reservation') }}',
                type: 'warning',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route($route . '.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success(
                                '{{ ui_change('deleted_successfully', 'room_reservation') }}'
                            );
                            location.reload();
                        }
                    });
                }
            })
        });



        // Call the dataTables jQuery plugin
    </script>
    <script>
        $(document).on('click', '#edit_{{ $route }}_item', function(e) {
            e.preventDefault();

            var sect_id = $(this).data('{{ $route }}_id');

            $('#edit_{{ $route }}').modal('show');

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "GET",
                url: "{{ route($route . '.edit', ':id') }}".replace(':id', sect_id),
                success: function(response) {

                    if (response.status == 404) {

                        $('#success_message').html("");
                        $('#success_message').addClass("alert alert-danger");
                        $('#success_message').text(response.message);

                    } else {
                        $('#{{ $route }}_id').val(sect_id)

                        $('#edit_name').val(response.main_info.name);
                        $('#edit_code').val(response.main_info.code);
                        $('#edit_building_id').val(response.main_info.building_id).trigger('change');
                        $('#edit_building_id')
                            .val(response.main_info.building_id)
                            .trigger('change');

                        get_blocks_for_edit(response.main_info.block_id);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error: " + error);
                }
            });

        });
    </script>

    <script>
        function get_blocks() {
            let building_id = $('#building_id').val();

            if (!building_id) {
                $('#block_id').html('<option value="">Select</option>');
                return;
            }

            $.ajax({
                url: "{{ route('room_floor.get_blocks', ':id') }}".replace(':id', building_id),
                type: 'GET',
                success: function(response) {

                    $('#block_id').html('<option value="">Select Block</option>');

                    $.each(response.blocks, function(index, block) {
                        $('#block_id').append(
                            `<option value="${block.id}">${block.name}</option>`
                        );
                    });

                    $('#block_id').trigger('change');
                }
            });
        }

        function get_blocks_for_edit(selected_block_id = null) {

            let building_id = $('#edit_building_id').val();

            if (!building_id) {
                $('#edit_block_id').html('<option value="">Select</option>');
                return;
            }

            $.ajax({
                url: "{{ route('room_floor.get_blocks', ':id') }}".replace(':id', building_id),
                type: 'GET',
                success: function(response) {

                    $('#edit_block_id').html('<option value="">Select Block</option>');

                    $.each(response.blocks, function(index, block) {
                        $('#edit_block_id').append(
                            `<option value="${block.id}">${block.name}</option>`
                        );
                    });

                    if (selected_block_id) {
                        $('#edit_block_id').val(selected_block_id).trigger('change');
                    }
                }
            });
        }
    </script>
@endpush
