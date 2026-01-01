@extends('super_admin.layouts.app')


@section('title')
    {{ ui_change('companies') }}
@endsection
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('page_name')
    {{ ui_change('all_companies') }}
@endsection
@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                {{-- <img width="50" src="{{ asset('/assets/back-end/img/jpg') }}" alt=""> --}}
                {{ ui_change('companies') }}
            </h2>
        </div>
        <!-- End Page Title -->
        <form action="{{ url()->current() }}" method="get">
            <div class="row mt-20">
                <div class="col-md-12">
                    <div class="card">
                        <!-- Data Table Top -->
                        <div class="px-3 py-4">
                            <div class="row g-2 flex-grow-1">
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
                                                placeholder="{{ ui_change('search_by_name') }}"
                                                aria-label="Search by ID or name" value="{{ $search }}">
                                            <button type="submit"
                                                class="btn btn--primary input-group-text">{{ ui_change('search') }}</button>
                                        </div>
                                    </form>

                                    <!-- End Search -->
                                </div>
                                <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">
                                    <div class="d-flex flex-wrap gap-3 justify-content-lg-end ">
                                        <div class=" ">
                                            <label for="">{{ ui_change('company_status') }}</label>
                                            <select class="js-select2-custom form-control" name="request_status">
                                                <option selected value="">{{ ui_change('select') }}</option>
                                                <option value="approve">{{ ui_change('approve') }}</option>
                                                <option value="waiting_for_payment">{{ ui_change('waiting_for_payment') }}
                                                </option>
                                                <option value="pending">{{ ui_change('pending') }}</option>

                                            </select>
                                        </div>
                                        <button type="submit" name="bulk_action_btn" value="update_status"
                                            class="btn btn--primary btn-sm" style="margin-top: 26px;">
                                            {{ ui_change('update', 'property_transaction') }}
                                        </button>

                                    </div>
                                    <div>
                                        <button type="button" data-target="#filter" data-filter="" data-toggle="modal"
                                            class="btn btn--primary btn-sm" style="margin-top: 26px;">
                                            <i class="fas fa-filter"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- End Row -->

                        <!-- End Data Table Top -->

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                                    class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                    <thead class="thead-light thead-50 text-capitalize">
                                        <tr>
                                            <th><input class="bulk_check_all" type="checkbox" /></th>
                                            <th>{{ ui_change('company_id') }}</th>
                                            <th>{{ ui_change('name') }}</th>
                                            <th>{{ ui_change('user_name') }}</th>
                                            <th>{{ ui_change('country') }}</th>
                                            <th class="text-center">{{ ui_change('status') }}</th>
                                            <th>{{ ui_change('Created_At') }}</th>
                                            <th class="text-center">{{ ui_change('Actions') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($companies as $key => $company)
                                            <tr>

                                                <td>
                                                    <input class="check_bulk_item" name="bulk_ids[]" type="checkbox"
                                                        value="{{ $company->id }}" />
                                                    {{ $companies->firstItem() + $key }}
                                                </td>
                                                <td>{{ $company->company_id }}</td>
                                                <td>{{ $company->name }}</td>
                                                <td>{{ $users->where('company_id', $company->id)->first()->user_name ?? '' }}
                                                </td>
                                                <td>{{ $company->countryName }}</td>
                                                <td class="text-center">
                                                    @php
                                                        $statusClass = '';
                                                        if (isset($company->request_status)) {
                                                            if ($company->request_status == 'waiting_for_payment') {
                                                                $statusClass = 'bg-warning';
                                                            } elseif ($company->request_status == 'approve') {
                                                                $statusClass = 'bg-success';
                                                            } elseif ($company->request_status == 'pending') {
                                                                $statusClass = 'bg-white';
                                                            }
                                                        }
                                                    @endphp

                                                    <span class="{{ $statusClass }} p-2 border rounded-pill">
                                                        {{ isset($company->request_status) ? ui_change($company->request_status) : '' }}
                                                    </span>

                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($company->created_at)->format('Y-m-d') }}</td>

                                                <td>
                                                    <div class="d-flex justify-content-center gap-2">
                                                        <a class="btn btn-outline--primary square-btn btn-sm mr-1"
                                                            title="{{ __('general.view') }}"
                                                            href="{{ route('admin.companies.show', $company->id) }}">
                                                            <img src="{{ asset('/assets/back-end/img/eye.svg') }}"
                                                                class="svg" alt="">
                                                        </a>
                                                        <a class="btn btn-outline--primary square-btn btn-sm mr-1"
                                                            title="{{ __('roles.schedules_list') }}"
                                                            href="{{ route('admin.companies.schedules', $company->id) }}">
                                                            <i class="fa fa-history"></i>
                                                        </a>

                                                        <a class="btn btn-outline-info btn-sm square-btn"
                                                            title="{{ __('general.edit') }}"
                                                            href="{{ route('admin.companies.edit', $company->id) }}">
                                                            <i class="tio-edit"></i>
                                                        </a>
                                                        @if ($company->request_status == 'pending')
                                                            <a class="btn btn-outline-info btn-sm square-btn"
                                                                title="{{ ui_change('confirm') }}"
                                                                href="{{ route('admin.requests.confirm', $company->id) }}">
                                                                <i class="fa fa-check"></i>
                                                            </a>
                                                        @endif

                                                        <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                            title="{{ __('general.delete') }}" id="{{ $company->id }}">
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
                                {{ $companies->links() }}
                            </div>
                        </div>
                        @if (count($companies) == 0)
                            <div class="text-center p-4">
                                <img class="mb-3 w-160" src="{{ asset('assets/back-end') }}/svg/illustrations/sorry.svg"
                                    alt="Image Description">
                                <p class="mb-0">{{ __('general.no_data_to_show') }}</p>
                            </div>
                        @endif
                    </div>
                </div>
        </form>
    </div>




    @if (Session::has('success'))
        <script>
            swal("Message", "{{ Session::get('success') }}", 'success', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            swal("Message", "{{ Session::get('info') }}", 'info', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif

    <div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  " role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ ui_change('filter', 'property_transaction') }}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card-body">
                        <form action="{{ url()->current() }}" method="GET">
                            <div class="px-3 py-4">
                                <div class="row align-items-center">
                                    <div class="col-md-12 col-lg-12 col-xl-12">
                                        <label for="">
                                            {{ ui_change('status', 'property_transaction') }}
                                        </label>
                                        <select class="js-select2-custom form-control" name="request_status">
                                            <option selected value="-1">{{ ui_change('select') }}</option>
                                            <option value="approve">{{ ui_change('approve') }}</option>
                                            <option value="waiting_for_payment">{{ ui_change('waiting_for_payment') }}
                                            </option>
                                            <option value="pending">{{ ui_change('pending') }}</option>

                                        </select>
                                    </div>


                                </div>
                            </div>
                            <div class="d-flex gap-3 justify-content-end mt-4">
                                <button type="submit" class="btn btn--primary px-4 m-2" name="bulk_action_btn"
                                    value="filter"> {{ ui_change('filter', 'property_transaction') }}</button>
                            </div>
                        </form>
                    </div>
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
                        url: "{{ route('admin.companies.delete') }}",
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

        $('.brand_status_form').on('submit', function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "#",
                method: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    if (data.success == true) {
                        toastr.success("{{ __('status_updated_successfully') }}");
                    } else {
                        toastr.error(
                            '{{ __('status_updated_failed.') }} {{ __('Product_must_be_approved') }}'
                        );
                        location.reload();
                    }
                }
            });
        });
    </script>
@endpush
