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
                {{ ui_change($route, 'room_reservation') }}
            </h2>
        </div>

        @include('admin-views.inline_menu.room_reservation.management.inline-menu')


        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="px-3 py-4">


                        <div class="mb-3 d-flex align-items-center justify-content-between">
                            <h2 class="h1 mb-0 d-flex gap-2 align-items-center">

                                {{ ui_change('add_new_room', 'room_reservation') }}
                            </h2>
                            <button class="btn btn--primary mr-2" data-{{ $route }}="" data-toggle="modal"
                                data-target="#{{ $route }}">{{ ui_change('add_new_room', 'room_reservation') }}</button>
                        </div>

                    </div>

                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                <h5 class="mb-0 d-flex align-items-center gap-2">
                                    {{ ui_change($route . '_list', 'room_reservation') }}
                                    <span class="badge badge-soft-dark radius-50 fz-12"> </span>
                                </h5>
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




    <div class="modal fade" id="{{ $route }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ ui_change('add_new_room', 'room_reservation') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route($route . '.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-lg-4 col-xl-3">
                                <div class="form-group ">
                                    <label for="">{{ ui_change('name') }}</label>
                                    <input id="name" type="text" name="name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-3">
                                <div class="form-group ">
                                    <label for="">{{ ui_change('code') }}</label>
                                    <input id="code" type="text" name="code" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-3">
                                <div class="form-group ">
                                    <label for="">{{ ui_change('building') }}</label>
                                    <select class="js-select2-custom form-control" id="building_id" name="building_id"
                                        onchange="get_blocks()" required>
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

                            <div class="col-md-12 col-lg-4 col-xl-3">
                                <div class="form-group ">
                                    <label for="">{{ ui_change('block') }}</label>
                                    <select class="js-select2-custom form-control" id="block_id" name="block_id"
                                        onchange="get_floors()" required>
                                        <option value="">{{ ui_change('select', 'property_master') }} </option>
                                        @foreach ($blocks as $block_item)
                                            <option value="{{ $block_item->id }}">
                                                {{ $block_item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-3">
                                <div class="form-group ">
                                    <label for="">{{ ui_change('floor') }}</label>
                                    <select class="js-select2-custom form-control" id="floor_id" name="floor_id"
                                        required>
                                        <option value="">{{ ui_change('select', 'property_master') }} </option>
                                        @foreach ($floors as $floor_item)
                                            <option value="{{ $floor_item->id }}">
                                                {{ $floor_item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-3">
                                <div class="form-group ">
                                    <label for="">{{ ui_change('room_type', 'room_reservation') }}</label>
                                    <select class="js-select2-custom form-control" id="room_type" name="room_type"
                                        required>
                                        <option value="">{{ ui_change('select', 'property_master') }} </option>
                                        @foreach ($room_types as $room_type_item)
                                            <option value="{{ $room_type_item->id }}">
                                                {{ $room_type_item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 col-lg-4 col-xl-3">
                                <div class=" bg-white rounded shadow-sm  ">
                                    <h5 class="panel-title">{{ ui_change('room_options', 'room_reservation') }}</h5>
                                </div>
                                @foreach ($options as $key => $option_item)
                                    <div class="option-row mt-2">
                                        <p class="option-label mb-0">{{ $option_item->name }}</p>
                                        <div class="radio-group">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="{{ $option_item->id }}" value="yes">
                                                <label class="form-check-label"
                                                    for="breakfastYes">{{ ui_change('Yes') }}</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"
                                                    name="{{ $option_item->id }}" value="no" checked>
                                                <label class="form-check-label"
                                                    for="breakfastNo">{{ ui_change('No') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                @endforeach
                            </div>
                            <div class="col-md-12 col-lg-4 col-xl-3">
                                <div class="col-md-12">
                                    <div class="  bg-white rounded shadow-sm ">
                                        <h5 class="panel-title">{{ ui_change('room_facilities', 'room_reservation') }}
                                        </h5>
                                    </div>
                                    <div class="checkbox-list row">
                                        @foreach ($room_facilities as $room_facility_item)
                                            <div class="col-12 col-sm-12">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" id="fac1"
                                                        name="facilities[]">
                                                    <label class="form-check-label"
                                                        for="fac1">{{ $room_facility_item->name }}</label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
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
    <div class="modal fade" id="edit_{{ $route }}" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                $('#block_id').html('<option value="">{{ ui_change('Select', 'room_reservation') }}</option>');
                return;
            }

            $.ajax({
                url: "{{ route('room_floor.get_blocks', ':id') }}".replace(':id', building_id),
                type: 'GET',
                success: function(response) {

                    $('#block_id').html(
                        '<option value="">{{ ui_change('Select_Block', 'room_reservation') }}</option>');

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

    <script>
        function get_floors() {
            let building_id = $('#building_id').val();
            let block_id = $('#block_id').val();

            if (!building_id || !block_id) {
                $('#floor_id').html('<option value="">{{ ui_change('Select', 'room_reservation') }}</option>');
                return;
            }

            $.ajax({
                url: "{{ route('room_unit.get_floors', [':building_id', ':block_id']) }}".replace(':building_id',
                    building_id).replace(':block_id', block_id),
                type: 'GET',
                success: function(response) {

                    $('#floor_id').html(
                        '<option value="">{{ ui_change('select_floor', 'room_reservation') }}</option>');

                    $.each(response.floors, function(index, floor) {
                        $('#floor_id').append(
                            `<option value="${floor.id}">${floor.name}</option>`
                        );
                    });

                    $('#floor_id').trigger('change');
                }
            });
        }
    </script>
@endpush
