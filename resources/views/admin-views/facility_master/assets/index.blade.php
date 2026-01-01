@extends('layouts.back-end.app')
@section('title', __('property_master.asset'))
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

                {{ __('property_master.asset') }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.facility_master.inline-menu')

        <!-- Content Row -->
        <div class="row">


            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
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
                                    <a href="{{ route('asset.create') }}" class="btn btn--primary">
                                        <i class="tio-add"></i>
                                        <span class="text">{{ __('property_master.add_new_asset') }}</span>
                                    </a>
                                {{-- @endcan --}}
                            </div>
                        </div>
                    </div>
                    <div style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                        <div class="table-responsive">
                            <table id="datatable"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th>{{ __('general.sl') }}</th>
                                        <th class="text-center">{{ __('login.name') }} </th>
                                        <th class="text-center">{{ __('property_master.code') }} </th>
                                        <th class="text-center">{{ __('property_master.asset_group') }} </th>
                                        <th class="text-center">{{ __('property_master.purchase_date') }} </th>
                                        <th class="text-center">{{ __('property_master.supplier_name') }} </th>
                                        <th class="text-center">{{ __('Location') }} </th>
                                        <th class="text-center">{{ __('general.status') }} </th>
                                        <th class="text-center">{{ __('general.actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($assets as $key => $item)
                                        <tr>
                                            <td>{{ $assets->firstItem() + $key }}</td>
                                            <td class="text-center">{{ $item->name }}</td>
                                            <td class="text-center">{{ $item->code }}</td>
                                            <td class="text-center">{{ $item->main_asset_group->name }}</td>
                                            <td class="text-center">{{ $item->purchase_date }}</td>
                                            <td class="text-center">{{ $item->main_supplier->name }}</td>
                                            @php
                                                $location = $unit_management->where('id' ,$item->unit_management_id )->first();
                                            @endphp
                                            <td class="text-center">
                                                @if (isset($location))
                                                     {{ $location->property_unit_management->code .
                                                '-' .
                                                $location->block_unit_management->block->code .
                                                '-' .
                                                $location->floor_unit_management->floor_management_main->name .
                                                '-' .
                                                $location->unit_management_main->name }}
                                                @else
                                                    {{ __('general.not_available') }}
                                                @endif
                                               </td>

                                            <td class="text-center">
                                                <form action="{{ route('asset.status-update') }}" method="post"
                                                    id="product_status{{ $item->id }}_form"
                                                    class="product_status_form">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                                    <label class="switcher mx-auto">
                                                        <input type="checkbox" class="switcher_input"
                                                            id="product_status{{ $item->id }}" name="status"
                                                            value="1"
                                                            {{ $item->status == 'active' ? 'checked' : '' }}
                                                            onclick="toogleStatusModal(event,'product_status{{ $item->id }}',
                                                    'product-status-on.png','product-status-off.png',
                                                    '{{ __('general.Want_to_Turn_ON') }} {{ $item->name }} ',
                                                    '{{ __('general.Want_to_Turn_OFF') }} {{ $item->name }} ',
                                                    `<p>{{ __('general.if_enabled_this_product_will_be_available') }}</p>`,
                                                    `<p>{{ __('general.if_disabled_this_product_will_be_hidden') }}</p>`)">
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('asset.schedule' ,$item->id ) }}"
                                                        class="btn btn-outline-warning btn-sm"
                                                        title="@lang('roles.schedules_list')">
                                                        <i class="fa fa-history"></i>
                                                    </a>
                                                    <a class="btn btn-outline-info btn-sm square-btn"
                                                        title="{{ __('general.edit') }}"
                                                        href="{{ route('asset.edit', $item->id) }}">
                                                        <i class="tio-edit"></i>
                                                    </a>
                                                    <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                        title="{{ __('general.delete') }}" id="{{ $item['id'] }}">
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
                            {!! $assets->links() !!}
                        </div>
                    </div>

                    @if (count($assets) == 0)
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
@endsection

@push('script')
    <script>
        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
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
                        url: "{{ route('amc_provider.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success('{{ __('country.deleted_successfully') }}');
                            location.reload();
                        }
                    });
                }
            })
        });
        flatpickr("#purchase_date", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
        });
    </script>
    <script>
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
                        url: "{{ route('asset.delete') }}",
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
