@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
@endphp
@section('title', ui_change('units', 'property_master'))
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
                {{-- <img width="60" height="50" src="{{ asset('/assets/back-end/img/units.jpg') }}" alt=""> --}}
                {{ ui_change('units', 'property_master') }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.property_master.inline-menu')

        <div class="col-md-12">
            <div class="card">
                <div class="px-3 py-4">
                    <div class="row align-items-center">
                        <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                            <h5 class="mb-0 d-flex align-items-center gap-2">{{ ui_change('unit_list', 'property_master') }}
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
                                        placeholder="{{ ui_change('search_by_unit_name', 'property_master') }}"
                                        aria-label="Search" value="{{ $search }}" required>
                                    <button type="submit"
                                        class="btn btn--primary">{{ ui_change('general.search', 'property_master') }}</button>
                                </div>
                            </form>
                            <!-- End Search -->
                        </div>
                    </div>
                </div>
                <div class="position-relative px-3 py-4 m-2 ">
                    <a class="btn btn--primary position-absolute" style="top: 10px; right: 10px;"
                        href="{{ route('unit.create') }}">
                        {{ ui_change('add_new_unit', 'property_master') }}
                    </a>
                </div>
                <div style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                    <div class="table-responsive">
                        <table id="datatable"
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{ ui_change('sl', 'property_master') }} </th>
                                    <th class="text-center">{{ ui_change('unit_name', 'property_master') }} </th>
                                    <th class="text-center">{{ ui_change('unit_code', 'property_master') }} </th>
                                    {{-- <th class="text-center">{{ ui_change('no_of_u , 'property_master'nit') }} </th> --}}
                                    <th class="text-center">{{ ui_change('status', 'property_master') }}</th>
                                    <th class="text-center">{{ ui_change('actions', 'property_master') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($main as $key => $value)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        @if (isset($value->name))
                                            <td class="text-center">{{ $value->name }}</td>
                                        @else
                                            <td class="text-center text-red " style="color: red">
                                                {{ ui_change('not_available', 'property_master') }}</td>
                                        @endif
                                        @if (isset($value->code))
                                            <td class="text-center">{{ $value->code }} </td>
                                        @else
                                            <td class="text-center text-red " style="color: red">
                                                {{ ui_change('not_available', 'property_master') }}</td>
                                        @endif
                                        {{-- @if (isset($value->unit_no))
                                        <td class="text-center">{{ $value->unit_no }} </td>
                                    @else

                                        <td class="text-center text-red "  style="color: red">{{ ui_change('general.not_ava , 'property_master'ilable') }}</td>
                                    @endif --}}
                                        @if (isset($value->code))
                                            <td class="text-center">{{ $value->status }} </td>
                                        @else
                                            <td class="text-center text-red   " style="color: red">
                                                {{ ui_change('not_available', 'property_master') }}</td>
                                        @endif
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                <a class="btn btn-outline-info btn-sm square-btn"
                                                    title="{{ ui_change('edit', 'property_master') }}"
                                                    href="{{ route('unit.edit', $value->id) }}">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                @if (!$value->isUsed())
                                                    <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                        title="{{ ui_change('delete', 'property_master') }}"
                                                        id="{{ $value['id'] }}">
                                                        <i class="tio-delete"></i>
                                                    </a>
                                                @endif
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
                        <p class="mb-0">{{ ui_change('no_data_to_show', 'property_master') }}</p>
                    </div>
                @endif
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
                title: "{{ ui_change('are_you_sure_delete_this', 'property_master') }}",
                text: "{{ ui_change('you_will_not_be_able_to_revert_this', 'property_master') }}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ ui_change('yes_delete_it', 'property_master') }}!',
                cancelButtonText: '{{ ui_change('cancel', 'property_master') }}',
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
                        url: "{{ route('unit.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success(
                                '{{ ui_change('deleted_successfully', 'property_master') }}'
                                );
                            location.reload();
                        }
                    });
                }
            })
        });



        // Call the dataTables jQuery plugin
    </script>
@endpush
