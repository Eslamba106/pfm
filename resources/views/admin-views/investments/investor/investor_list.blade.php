@extends('layouts.back-end.app')

@section('title', ui_change('all_investors', 'property_master'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                <img src="{{ asset(main_path() . 'back-end/img/inhouse-subscription-list.png') }}" alt="">
                {{ ui_change('all_investors', 'investment') }}
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $investors->total() }}</span>
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.investment.inline-menu')


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
                                            placeholder="{{ ui_change('search_by_name', 'property_master') }}"
                                            aria-label="Search orders" value="{{ request('search') }}">
                                        <input type="hidden" value="{{ request('status') }}" name="status">
                                        <button type="submit"
                                            class="btn btn--primary">{{ ui_change('search', 'property_master') }}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                            <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">


                                <a href="{{ route('investor.create') }}" class="btn btn--primary">
                                    <i class="tio-add"></i>
                                    <span class="text">{{ ui_change('create_investor', 'property_master') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{ ui_change('sl', 'property_master') }}</th>
                                    <th class="text-center">{{ ui_change('name', 'property_master') }}</th>
                                    <th class="text-center">{{ ui_change('contact_person', 'property_master') }}</th>
                                    <th class="text-center">{{ ui_change('email', 'property_master') }}</th>
                                    <th class="text-center">{{ ui_change('whatsapp_no', 'property_master') }}</th>
                                    <th class="text-center">{{ ui_change('investor_type', 'property_master') }}</th>
                                    <th class="text-center">{{ ui_change('country', 'property_master') }}</th> 
                                    <th class="text-center">{{ ui_change('Actions', 'property_master') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($investors as $k => $investor_item)
                                    <tr>
                                        <th scope="row">{{ $investors->firstItem() + $k }}</th>

                                        <td class="text-center">
                                            {{ $investor_item->type == 'individual' ? $investor_item->name ?? ui_change('not_available', 'property_master') : $investor_item->company_name ?? ui_change('not_available', 'property_master') }}
                                        </td>
                                        <td class="text-center">
                                            {{ $investor_item->contact_person ?? ui_change('not_available', 'property_master') }}
                                        </td>
                                        <td class="text-center">
                                            {{ $investor_item->email1 ?? ui_change('not_available', 'property_master') }}
                                        </td>

                                        <td class="text-center">
                                            {{ $investor_item->whatsapp_no ?? ui_change('not_available', 'property_master') }}
                                        </td>

                                        <td class="text-center">
                                            {{ $investor_item->type ?? ui_change('not_available', 'property_master') }}
                                        </td>

                                        <td class="text-center">
                                            {{ $investor_item->country_master->country->name ?? ui_change('not_available', 'property_master') }}
                                        </td>

                                       
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                {{-- <a class="btn btn-outline-info btn-sm square-btn" title="{{ ui_change('all_investors' , 'property_master')('barcode') }}"
                                            href="{{ route('investor.barcode', [$subscription['id']]) }}">
                                            <i class="tio-barcode"></i>
                                        </a> --}}
                                                {{-- <a class="btn btn-outline-info btn-sm square-btn" title="View"
                                                    href="{{ route('investor.show', [$subscription->id]) }}">
                                                    <i class="tio-invisible"></i>
                                                </a> --}}
                                                {{-- @can('edit_investor') --}}
                                                <a class="btn btn-outline--primary btn-sm square-btn"
                                                    title="{{ ui_change('edit', 'property_master') }}"
                                                    href="{{ route('investor.edit', [$investor_item->id]) }}">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                {{-- @endcan
                                                @can('delete_investor') --}}
                                                <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                    title="{{ ui_change('delete', 'property_master') }}"
                                                    id="{{ $investor_item->id }}">
                                                    <i class="tio-delete"></i>
                                                </a>
                                                {{-- @endcan --}}

                                            </div>


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive mt-4">
                        <div class="px-4 d-flex justify-content-lg-end">
                            <!-- Pagination -->
                            {{ $investors->links() }}
                        </div>
                    </div>

                    @if (count($investors) == 0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160" src="{{ asset(main_path() . 'back-end') }}/svg/illustrations/sorry.svg"
                                alt="Image Description">
                            <p class="mb-0">{{ ui_change('no_data_to_show', 'property_master') }}</p>
                        </div>
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
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });

        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            Swal.fire({
                title: "{{ ui_change('are_you_sure_delete_this', 'property_master') }}",
                text: "{{ ui_change('you_will_not_be_able_to_revert_this', 'property_master') }}!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ ui_change('yes_delete_it', 'property_master') }}!",
                cancelButtonText: "{{ ui_change('cancel', 'property_master') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('investor.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success(
                                "{{ ui_change('deleted_successfully', 'property_master') }}"
                                );
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
