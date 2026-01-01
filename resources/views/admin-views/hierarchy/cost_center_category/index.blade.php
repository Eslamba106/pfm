@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
@endphp
@section('title', __('roles.cost_center_category_list'))
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
                {{-- <img width="60" src="{{ asset('assets/back-end/img/' . 'cost_center_category.jpg') }}" alt=""> --}}
                {{ __('roles.cost_center_category_list') }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.accounts_master.inline-menu')

        <!-- Content Row -->
        <div class="row">
            @can('create_cost_center_category') 
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ __('roles.add_new_cost_center_category') }}
                    </div>
                    <div class="card-body" style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route('cost_center_category.store') }}" method="post">
                            @csrf

                            <div class="form-group">
                                <input type="hidden" id="id">
                                <label class="title-color" for="name">{{ __('property_master.name') }}<span
                                        class="text-danger"> *</span> </label>
                                <input type="text" name="name" class="form-control"
                                    placeholder="{{ __('roles.enter_cost_center_category_name') }}">
                            </div> 
                                <div class="form-group">
                                    <label class="title-color" for="code">
                                        {{ __('property_master.code') }} 

                                    </label>
                                    <div class="input-group">
                                        <input type="text" name="code" class="form-control"
                                            placeholder="{{ __('roles.enter_cost_center_category_code') }}">

                                    </div>
                                </div>
                            
                            <div class="form-group">
                                <label class="title-color" for="status">
                                    {{ __('general.status') }}
                                </label>
                                <div class="input-group">
                                    <input type="radio" name="status" class="mr-3 ml-3" checked value="active">
                                    <label class="title-color" for="status">
                                        {{ __('general.active') }}
                                    </label>
                                    <input type="radio" name="status" class="mr-3 ml-3" value="inactive">
                                    <label class="title-color" for="status">
                                        {{ __('general.inactive') }}
                                    </label>

                                </div>
                            </div>



                            <div class="d-flex flex-wrap gap-2 justify-content-end">
                                <button type="reset" class="btn btn-secondary">{{ __('general.reset') }}</button>
                                <button type="submit" class="btn btn--primary">{{ __('general.submit') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @endcan
            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                <h5 class="mb-0 d-flex align-items-center gap-2">
                                    {{ __('roles.cost_center_category_list') }}
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
                                            placeholder="{{ __('roles.search_by_cost_center_category_name') }}"
                                            aria-label="Search" value="{{ $search }}" required>
                                        <button type="submit"
                                            class="btn btn--primary">{{ __('general.search') }}</button>
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
                                        <th>{{ __('general.sl') }}</th>
                                        <th class="text-center">{{ __('roles.cost_center_category_name') }} </th> 
                                        <th class="text-center">{{ __('roles.cost_center_category_code') }} </th> 
                                        <th class="text-center">{{ __('general.status') }}</th>
                                        <th class="text-center">{{ __('general.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($main as $key => $value)
                                        <tr>
                                            <td>{{ $main->firstItem() + $key }}</td>
                                            <td class="text-center">{{ $value->name }}</td>
                                             
                                            <td class="text-center">{{ $value->code ?? __('general.not_available') }} </td>
                                             

                                   
                                            <td class="text-center">
                                                <form action="{{ route('cost_center_category.status-update') }}" method="post"
                                                    id="product_status{{ $value->id }}_form"
                                                    class="product_status_form">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $value->id }}">
                                                    <label class="switcher mx-auto">
                                                        <input type="checkbox" class="switcher_input"
                                                            id="product_status{{ $value->id }}" name="status"
                                                            value="1"
                                                            {{ $value->status == 'active' ? 'checked' : '' }}
                                                            onclick="toogleStatusModal(event,'product_status{{ $value->id }}',
                                                    'product-status-on.png','product-status-off.png',
                                                    '{{ __('general.Want_to_Turn_ON') }} {{ $value->name }} ',
                                                    '{{ __('general.Want_to_Turn_OFF') }} {{ $value->name }} ',
                                                    `<p>{{ __('general.if_enabled_this_product_will_be_available') }}</p>`,
                                                    `<p>{{ __('general.if_disabled_this_product_will_be_hidden') }}</p>`)">
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a class="btn btn-outline-info btn-sm square-btn"
                                                        title="{{ __('general.edit') }}"
                                                        href="{{ route('cost_center_category.edit', $value->id) }}">
                                                        <i class="tio-edit"></i>
                                                    </a>
                                                    <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                        title="{{ __('general.delete') }}" id="{{ $value['id'] }}">
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
                            <p class="mb-0">{{ __('general.no_data_to_show') }}</p>
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
                title: "{{ __('general.are_you_sure_delete_this') }}",
                text: "{{ __('general.you_will_not_be_able_to_revert_this') }}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ __('general.yes_delete_it') }}!',
                cancelButtonText: '{{ __('general.cancel') }}',
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
                        url: "{{ route('cost_center_category.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success('{{ __('department.deleted_successfully') }}');
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
                url: "{{ route('cost_center_category.status-update') }}",
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
    </script>
@endpush
