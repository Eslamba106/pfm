@extends('layouts.back-end.app')

@section('title', __('roles.rent_price_list'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                {{ __('roles.rent_price_list') }}
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $rent_price_list->total() }}</span>
            </h2>
        </div>
        @include('admin-views.inline_menu.property_config.inline-menu')
        <div class="row mt-20">
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
                                <a href="{{ route('rent_price.create') }}" class="btn btn--primary">
                                    <i class="tio-add"></i>
                                    <span class="text">{{ __('roles.create_rent') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <form action="" method="get">
                        <div class="px-3 py-4">
                            <div class="row align-items-center">
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="datatable"
                                style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th><input id="bulk_check_all" class="bulk_check_all" type="checkbox" />
                                            {{ __('general.sl') }}</th>
                                        <th class="text-center">{{ __('property_master.unit') }}</th>
                                        <th class="text-center">{{ __('property_transactions.rent_amount') }}</th>
                                        <th class="text-center">{{ __('collections.applicable_from') }}</th>
                                        <th class="text-center">{{ __('roles.Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rent_price_list as $k => $rent_price_list_item)
                                        <tr>
                                            <th scope="row"><input class="check_bulk_item" name="bulk_ids[]"
                                                    type="checkbox" value="{{ $rent_price_list_item->id }}" />
                                                {{ $rent_price_list->firstItem() + $k }}
                                            </th>

                                            <td class="text-center">
                                                {{ optional($rent_price_list_item->unit_management->property_unit_management)->name .
                                                    '-' .
                                                    optional($rent_price_list_item->unit_management->block_unit_management)->block->name .
                                                    '-' .
                                                    optional($rent_price_list_item->unit_management->floor_unit_management)->floor_management_main->name .
                                                    '-' .
                                                    optional($rent_price_list_item->unit_management)->unit_management_main->name ??
                                                    __('general.not_available') }}
                                            </td>
                                            <td class="text-center">
                                                {{ number_format($rent_price_list_item->rent_amount, 3) ?? __('general.not_available') }}
                                            </td>
                                            <td class="text-center">
                                                {{ optional($rent_price_list_item)->applicable_date ?? __('general.not_available') }}
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">

                                                    <a class="btn btn-outline--primary btn-sm square-btn"
                                                        title="{{ __('edit') }}"
                                                        href="{{ route('rent_price.edit', [$rent_price_list_item->id]) }}">
                                                        <i class="tio-edit"></i>
                                                    </a>
                                                    <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                        title="{{ __('general.delete') }}" id="{{ $rent_price_list_item->id }}">
                                                        <i class="tio-delete"></i>
                                                    </a>
                                                </div>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                    <div class="table-responsive mt-4">
                        <div class="px-4 d-flex justify-content-lg-end">
                            <!-- Pagination -->
                            {{ $rent_price_list->links() }}
                        </div>
                    </div>

                    @if (count($rent_price_list) == 0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160" src="{{ asset(main_path() . 'back-end') }}/svg/illustrations/sorry.svg"
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
    $(document).on('click', '.delete', function () {
        var id = $(this).attr("id");
        // var route_name = document.getElementById('route_name').value;
        Swal.fire({
            title: "{{__('general.are_you_sure_delete_this')}}",
            text: "{{__('general.you_will_not_be_able_to_revert_this')}}!",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '{{__('general.yes_delete_it')}}!',
            cancelButtonText: '{{ __("general.cancel") }}',
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
                    url: "{{ route('rent_price.delete') }}",
                    method: 'get',
                    data: {id: id},
                    success: function () {
                        toastr.success('{{__('department.deleted_successfully')}}');
                        location.reload();
                    }
                });
            }
        })
    }); 
</script>
@endpush
