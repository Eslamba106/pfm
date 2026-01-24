@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
@endphp
@section('title', ui_change($route, 'property_master'))
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
                {{ ui_change($route == 'live_with' ? 'tenant_status' : $route, 'property_master') }}
            </h2>
        </div>
        <!-- End Page Title -->
        @php
            $currentUrl = url()->current();
            $segments = explode('/', $currentUrl);
            $last = end($segments);
            $facility_masters = [
                'department',
                'complaint_category',
                'freezing',
                'main_complaint',
                'employee_type',
                'priority',
                'asset_group',
                'work_status',
            ];
        @endphp
        @if (in_array($last, $facility_masters))
            @include('admin-views.inline_menu.facility_master.inline-menu')
        @else
            @include('admin-views.inline_menu.property_master.inline-menu')
        @endif

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ ui_change('add_new_' . ($route == 'live_with' ? 'tenant_status' : $route), 'property_master') }}
                    </div>
                    <div class="card-body" style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route($route . '.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="hidden" id="id">
                                        <label class="title-color"
                                            for="name">{{ ui_change('name', 'property_master') }}<span
                                                class="text-danger"> *</span> </label>
                                        <input type="text" name="name" class="form-control"
                                            placeholder="{{ ui_change('enter_' . $route . '_name', 'property_master') }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group"> 
                                        <label class="title-color"
                                            for="name">{{ ui_change('percentage', 'property_master') }} %<span
                                                class="text-danger"> *</span> </label>
                                        <input type="number" name="percentage" class="form-control"
                                            placeholder="{{ ui_change('enter_' . $route . '_percentage', 'property_master') }}">
                                    </div>
                                </div>
                            </div>





                            <div class="d-flex flex-wrap gap-2 justify-content-end">
                                <button type="reset"
                                    class="btn btn-secondary">{{ ui_change('reset', 'property_master') }}</button>
                                <button type="submit"
                                    class="btn btn--primary">{{ ui_change('submit', 'property_master') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                <h5 class="mb-0 d-flex align-items-center gap-2">
                                    {{ ui_change($route . '_list', 'property_master') }}
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
                                            placeholder="{{ ui_change('search_by_' . ($route == 'live_with' ? 'tenant_status' : $route) . '_name', 'property_master') }}"
                                            aria-label="Search" value="{{ $search }}" required>
                                        <button type="submit"
                                            class="btn btn--primary">{{ ui_change('search', 'property_master') }}</button>
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
                                        <th>{{ ui_change('sl', 'property_master') }}</th>
                                        <th class="text-left">
                                            {{ ui_change($route . '_name', 'property_master') }}
                                        </th>
                                        <th class="text-left">{{ ui_change('percentage', 'property_master') }}</th>
                                        <th class="text-center">{{ ui_change('actions', 'property_master') }}</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($main as $key => $value)
                                        <tr>
                                            <td>{{ $main->firstItem() + $key }}</td>
                                            <td class="text-left">{{ $value->name }}</td>
                                            <td class="text-left">{{ $value->percentage }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a class="btn btn-outline-info btn-sm square-btn"
                                                        title="{{ ui_change('edit', 'property_master') }}"
                                                        href="{{ route($route . '.edit', $value->id) }}">
                                                        <i class="tio-edit"></i>
                                                    </a>
                                                    <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                        title="{{ ui_change('delete', 'property_master') }}"
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
                            <p class="mb-0">{{ ui_change('no_data_to_show', 'property_master') }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    {{-- <input type="hidden" id="route_name" name="route_name" value="{{ $route }}" > --}}
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
                        url: "{{ route($route . '.delete') }}",
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
    <script>
        $('.product_status_form').on('submit', function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route($route . '.status-update') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    if (data.success == true) {
                        toastr.success('{{ ui_change('updated_successfully', 'property_master') }}');
                    } else if (data.success == false) {
                        toastr.error(
                            '{{ ui_change('Status_updated_failed.', 'property_master') }} {{ ui_change('Product_must_be_approved', 'property_master') }}'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
    </script>
@endpush
