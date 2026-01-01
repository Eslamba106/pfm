@extends('layouts.back-end.app')


@section('title')
    {{ __('users.users') }}
@endsection
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('page_name')
    {{ __('users.all_users') }}
@endsection
@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2"> 
                {{ __('users.users') }}
            </h2>
        </div>
        <!-- End Page Title -->

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
                                            placeholder="{{ __('general.search_by_name') }}"
                                            aria-label="Search by ID or name" value="{{ $search }}" required>
                                        <button type="submit"
                                            class="btn btn--primary input-group-text">{{ __('general.search') }}</button>
                                    </div>
                                </form>
                                
                                {{-- <form action="{{ url()->current() }}" method="GET">

                                    <div class="col-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="input-group mb-3 d-flex justify-content-end">
                                                    @can('change_users_status')
                                                        <div class="remv_control mr-2">
                                                            <select name="status" class="mr-3 mt-3 form-control ">
                                                                <option value="">{{ __('dashboard.set_status') }}
                                                                </option>
                                                                <option value="1">{{ __('dashboard.active') }}</option>
                                                                <option value="2">{{ __('dashboard.disactive') }}</option>
                                                            </select>
                                                        </div>
                                                    @endcan
                                                    @can('change_users_role')
                                                        <div class="remv_control mr-2">
                                                            <select name="role" class="mr-3 mt-3 form-control">
                                                                <option value="">{{ __('users.set_role') }}</option>
                                                                <option value="1">{{ __('users.user') }}</option>
                                                                <option value="2">{{ __('users.admin') }}</option>
                                                            </select>
                                                        </div>
                                                    @endcan
                                </form> --}}
                                <!-- End Search -->
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4"> </div>
                            <div class="col-sm-8 col-md-6 col-lg-4 text-end">
                                <a href="{{ route('user_management.create') }}" class="btn btn--primary mr-2"  >{{ __('users.create_user') }}</a></div>
                        </div>
                        <!-- End Row -->
                    </div>
                    <!-- End Data Table Top -->

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th><input class="bulk_check_all" type="checkbox" /> @lang('general.sl')</th> 
                                        <th>{{ __('roles.name') }}</th>
                                        <th>@lang('companies.user_name')</th>
                                        <th>{{ __('roles.role_name') }}</th>
                                        <th>{{ __('roles.Created_At') }}</th>
                                        <th>{{ __('roles.Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    @foreach ($users as $key => $user)
                                        <tr> 
                                            <td>
                                                <input class="check_bulk_item" name="bulk_ids[]" type="checkbox"
                                                    value="{{ $user->id }}" />
                                                {{ $users->firstItem() + $key }}
                                            </td> 
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->user_name }}</td>
                                            
                                            <td>{{ $user->role_name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d') }}</td>

                                            <td class="text-left">
                                                <div class="d-flex justify-content-center gap-2"> 
                                                    <a class="btn btn-outline-info btn-sm square-btn"
                                                        title="{{ __('general.edit') }}"
                                                        href="{{ route('user_management.edit', $user->id) }}">
                                                        <i class="tio-edit"></i>
                                                    </a>

                                                    <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                        title="{{ __('general.delete') }}" id="{{ $user->id }}">
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
                            {{ $users->links() }}
                        </div>
                    </div>
                    @if (count($users) == 0)
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
                        url: "{{ route('user_management.delete') }}",
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
