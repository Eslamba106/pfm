@extends('layouts.back-end.app')

@section('title', ui_change('all_investments', 'property_transaction'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                <img src="{{ asset(main_path() . 'back-end/img/inhouse-subscription-list.png') }}" alt="">
                {{ ui_change('all_investments', 'property_transaction') }}
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $investments->total() }}</span>
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.investment.inline-menu')

        {{-- <form action="{{ url()->current() }}" method="GET"> --}}
        <form action="" method="get">
            @csrf
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
                                                placeholder="{{ ui_change('investment_search', 'property_transaction') }}"
                                                aria-label="Search orders" value="{{ request('search') }}">
                                            <input type="hidden" value="{{ request('status') }}" name="status">
                                            <button type="submit"
                                                class="btn btn--primary">{{ ui_change('search', 'property_transaction') }}</button>
                                        </div>
                                    </form>
                                    <!-- End Search -->
                                </div>
                                <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">
 
                                    <a href="{{ route('investment.create') }}" class="btn btn--primary">
                                        <i class="tio-add"></i>
                                        <span
                                            class="text">{{ ui_change('create_investment', 'property_transaction') }}</span>
                                    </a>
                                    {{-- <button type="button" data-target="#filter" data-filter="" data-toggle="modal"
                                        class="btn btn--primary btn-sm">
                                        <i class="fas fa-filter"></i>
                                    </button> --}}
                                  
                                </div>
                            </div>
                        </div>

                        <div class="px-3 py-4">

                        </div>
                        <div class="table-responsive">
                            <table id="datatable"
                                style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th><input id="bulk_check_all" class="bulk_check_all" type="checkbox" />
                                            {{ ui_change('sl', 'property_transaction') }}</th>
                                        <th class="text-center">
                                            {{ ui_change('investment_no', 'property_transaction') }}</th>
                                        <th class="text-center">
                                            {{ ui_change('investment_date', 'property_transaction') }}</th>

                                        <th class="text-center">{{ ui_change('start_Date', 'property_transaction') }}</th>
                                        <th class="text-center">{{ ui_change('end_Date', 'property_transaction') }}</th>
                                        <th class="text-center">{{ ui_change('investor_name', 'investment') }}</th>
                                        <th class="text-center">{{ ui_change('building_name', 'investment') }}</th> 
                                        <th class="text-center">{{ ui_change('Actions', 'property_transaction') }} </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($investments as $k => $investment_item)
                                        @php
                                            $formatted_date = date(
                                                'd-m-Y',
                                                strtotime($investment_item->investment_date),
                                            );
                                            $from = date('d-m-Y', strtotime($investment_item->period_from));
                                            $to = date('d-m-Y', strtotime($investment_item->period_to));
                                        @endphp
                                        <tr>
                                            <th scope="row"><input class="check_bulk_item" name="bulk_ids[]"
                                                    type="checkbox" value="{{ $investment_item->id }}" />
                                                {{ $investments->firstItem() + $k }}</th>

                                            <td class="text-center">
                                                {{ $investment_item->investment_no ?? ui_change('not_available', 'property_transaction') }}
                                            </td>

                                            <td class="text-center">

                                                {{ $formatted_date ?? ui_change('not_available', 'property_transaction') }}
                                            </td>
                                            <td class="text-center">

                                                {{ $from ?? ui_change('not_available', 'property_transaction') }}
                                            </td>
                                            <td class="text-center">

                                                {{ $to ?? ui_change('not_available', 'property_transaction') }}
                                            </td>

                                            <td class="text-center">
                                                {{ $investment_item->name ?? ui_change('not_available', 'property_transaction') }}
                                            </td>
                                            <td class="text-center">
                                                {{ $investment_item->property?->name ?? ui_change('not_available', 'property_transaction') }}
                                            </td>

                                              <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    
                                                    {{-- <a class="btn btn-outline--primary btn-sm square-btn"
                                                        title="{{ ui_change('edit'  , 'property_transaction')}}"
                                                        href="{{ route('investment.edit', [$investment_item->id]) }}">
                                                        <i class="tio-edit"></i>
                                                    </a>   --}}
                                                        <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                            title="{{ ui_change('delete' , 'property_transaction') }}"
                                                            id="{{ $investment_item->id }}">
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
                </div>
            </div>
        </form>
        <div class="table-responsive mt-4">
            <div class="px-4 d-flex justify-content-lg-end">
                <!-- Pagination -->
                {{ $investments->links() }}
            </div>
        </div>

        @if (count($investments) == 0)
            <div class="text-center p-4">
                <img class="mb-3 w-160" src="{{ asset(main_path() . 'back-end') }}/svg/illustrations/sorry.svg"
                    alt="Image Description">
                <p class="mb-0">{{ ui_change('no_data_to_show', 'property_transaction') }}</p>
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
        flatpickr("#from_search_date", {
            dateFormat: "d/m/Y",
        });
        flatpickr("#to_search_date", {
            dateFormat: "d/m/Y",

        });
    </script>
    <script>
        // Call the dataTables jQuery plugin
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });


        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            Swal.fire({
                title: "{{ ui_change('are_you_sure_delete_this', 'property_transaction') }}",
                text: "{{ ui_change('you_will_not_be_able_to_revert_this', 'property_transaction') }}!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ ui_change('yes_delete_it', 'property_transaction') }}!",
                cancelButtonText: "{{ ui_change('cancel', 'property_transaction') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('investment.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success(
                                "{{ ui_change('deleted_successfully', 'property_transaction') }}"
                            );
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
