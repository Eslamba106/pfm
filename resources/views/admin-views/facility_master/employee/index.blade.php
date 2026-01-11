@extends('layouts.back-end.app')

@section('title', ui_change('all_employee_item'))

@push('css_or_js')
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                <img src="{{ asset(main_path() . 'back-end/img/inhouse-employee_item-list.png') }}" alt="">
                {{ ui_change('all_employee') }}
                <span class="badge badge-soft-dark radius-50 fz-14 ml-1">{{ $main->total() }}</span>
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.facility_master.inline-menu')

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
                                            placeholder="{{ ui_change('search_by_name') }}" aria-label="Search orders"
                                            value="{{ request('search') }}">
                                        <input type="hidden" value="{{ request('status') }}" name="status">
                                        <button type="submit" class="btn btn--primary">{{ ui_change('search') }}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                            <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">


                                <a href="{{ route('employee.create') }}" class="btn btn--primary">
                                    <i class="tio-add"></i>
                                    <span class="text">{{ ui_change('create_employee') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="datatable" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                            class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{ ui_change('sl') }}</th>
                                    <th class="text-right">{{ ui_change('code') }}</th>
                                    <th class="text-right">{{ ui_change('name') }}</th>
                                    <th class="text-right">{{ ui_change('mobile') }}</th>
                                    <th class="text-right">{{ ui_change('office') }}</th>
                                    <th class="text-right">{{ ui_change('extension_no') }}</th>
                                    <th class="text-center">{{ ui_change('status') }}</th>
                                    <th class="text-center">{{ ui_change('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($main as $k => $employee_item)
                                    <tr>
                                        <th scope="row">{{ $main->firstItem() + $k }}</th>
                                        <td class="text-right">
                                            {{ $employee_item->code }}
                                        </td>
                                        <td>

                                            {{ \Illuminate\Support\Str::limit($employee_item->name, 20) }}

                                        </td>


                                        <td class="text-right">
                                            {{ "( " .$employee_item->mobile_dail_code ." ) " . $employee_item->mobile  }}
                                        </td>
                                        <td class="text-right">
                                            {{ "( " .$employee_item->office_dail_code ." ) " . $employee_item->office  }}
                                        </td>
                                        <td class="text-right">
                                            {{ $employee_item->extension_no}}
                                        </td>

                                        <td class="text-center">
                                            <form action="{{ route('employee.status-update') }}" method="post"
                                                id="employee_item_status{{ $employee_item->id }}_form"
                                                class="employee_item_status_form">
                                                @csrf
                                                <input type="hidden" name="id" value="{{ $employee_item->id }}">
                                                <label class="switcher mx-auto">
                                                    <input type="checkbox" class="switcher_input"
                                                        id="employee_item_status{{ $employee_item->id }}" name="status"
                                                        value="1"
                                                        {{ $employee_item->status == 'active' ? 'checked' : '' }}
                                                        onclick="toogleStatusModal(event,'employee_item_status{{ $employee_item->id }}',
                                                'employee_item-status-on.png','employee_item-status-off.png',
                                                '{{ ui_change('Want_to_Turn_ON') }} {{ $employee_item->name }} ',
                                                '{{ ui_change('Want_to_Turn_OFF') }} {{ $employee_item->name }} ',
                                                `<p>{{ ui_change('if_enabled_this_employee_item_will_be_available') }}</p>`,
                                                `<p>{{ ui_change('if_disabled_this_employee_item_will_be_hidden') }}</p>`)">
                                                    <span class="switcher_control"></span>
                                                </label>
                                            </form>
                                        </td>
                                        <td>
                                            <div class="d-flex justify-content-center gap-2">
                                                {{-- <a class="btn btn-outline-info btn-sm square-btn" title="{{ ui_change('barcode') }}"
                                            href="{{ route('employee_item.barcode', [$employee_item['id']]) }}">
                                            <i class="tio-barcode"></i>
                                        </a> --}}

                                                <a class="btn btn-outline--primary btn-sm square-btn"
                                                    title="{{ ui_change('edit') }}"
                                                    href="{{ route('employee.edit', [$employee_item->id]) }}">
                                                    <i class="tio-edit"></i>
                                                </a>
                                                <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                    title="{{ ui_change('delete') }}" id="{{ $employee_item->id }}">
                                                    <i class="tio-delete"></i>
                                                </a>
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
                            {{ $main->links() }}
                        </div>
                    </div>

                    @if (count($main) == 0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160" src="{{ asset(main_path() . 'back-end') }}/svg/illustrations/sorry.svg"
                                alt="Image Description">
                            <p class="mb-0">{{ ui_change('no_data_to_show') }}</p>
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

        $('.employee_item_status_form').on('submit', function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('employee.status-update') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    if (data.success == true) {
                        toastr.success('{{ ui_change('updated_successfully') }}');
                    } else if (data.success == false) {
                        toastr.error(
                            '{{ ui_change('Status_updated_failed.') }} {{ ui_change('Product_must_be_approved') }}'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });

        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            Swal.fire({
                title: "{{ ui_change('are_you_sure_delete_this') }}",
                text: "{{ ui_change('you_will_not_be_able_to_revert_this') }}!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ ui_change('yes_delete_it') }}!",
                cancelButtonText: "{{ ui_change('cancel') }}",
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('employee.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success("{{ ui_change('deleted_successfully') }}");
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
