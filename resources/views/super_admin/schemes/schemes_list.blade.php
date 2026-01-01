@extends('super_admin.layouts.app')


@section('title')
    {{ ui_change('schemes') }}
@endsection
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('page_name')
    {{ ui_change('all_schemes') }}
@endsection
@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                {{ ui_change('schemes') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <div class="row mt-20">
            <div class="col-md-12">
                <div class="card">
                    <!-- Data Table Top -->
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
                                            placeholder="{{ ui_change('search_by_name', 'property_transaction') }}"
                                            aria-label="Search orders" value="{{ request('search') }}">
                                        <input type="hidden" value="{{ request('status') }}" name="status">
                                        <button type="submit"
                                            class="btn btn--primary">{{ ui_change('search', 'property_transaction') }}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                            <div class="col-lg-8 mt-3 mt-lg-0 d-flex flex-wrap gap-3 justify-content-lg-end">

                                {{-- @can('create_schema') --}}
                                <a href="{{ route('admin.schema.create') }}" class="btn btn--primary">
                                    <i class="tio-add"></i>
                                    <span class="text">{{ ui_change('create_schema', 'property_transaction') }}</span>
                                </a>
                                {{-- <button type="button" data-target="#filter" data-filter="" data-toggle="modal"
                                    class="btn btn--primary btn-sm">
                                    <i class="fas fa-filter"></i>
                                </button> --}}
                                {{-- @endcan --}}
                            </div>
                        </div>
                    </div>
                    <!-- End Data Table Top -->

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th><input class="bulk_check_all" type="checkbox" /></th>
                                        <th>{{ ui_change('name') }}</th>
                                        <th>{{ ui_change('applicable_Date') }}</th>
                                        <th>{{ ui_change('end_Date') }}</th>
                                        <th>{{ ui_change('user_charge') }}</th>
                                        <th>{{ ui_change('user_count') }}</th>
                                        <th>{{ ui_change('unit_charge') }}</th>
                                        <th>{{ ui_change('unit_count') }}</th>
                                        <th>{{ ui_change('building_charge') }}</th>
                                        <th>{{ ui_change('building_count') }}</th>
                                        <th>{{ ui_change('branch_charge') }}</th>
                                        <th>{{ ui_change('branch_count') }}</th>
                                        <th>{{ ui_change('setup_cost') }}</th>
                                        <th>{{ ui_change('display') }}</th>
                                        <th>{{ ui_change('status') }}</th>
                                        <th class="text-center">{{ ui_change('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($schemes as $key => $schema)
                                        <tr>

                                            <td>
                                                <input class="check_bulk_item" name="bulk_ids[]" type="checkbox"
                                                    value="{{ $schema->id }}" />
                                                {{ $schemes->firstItem() + $key }}
                                            </td>
                                            <td>{{ $schema->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($schema->applicable_date)->format('Y-m-d') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($schema->end_date)->format('Y-m-d') }}</td>
                                            <td>{{ $schema->user_charge }}</td>
                                            <td>{{ $schema->user_count_from . ' ' . ui_change('to') . ' ' . $schema->user_count_to }}
                                            </td>
                                            <td>{{ $schema->unit_charge }}</td>
                                            <td>{{ $schema->unit_count_from . ' ' . ui_change('to') . ' ' . $schema->unit_count_to }}
                                            </td>
                                            <td>{{ $schema->building_charge }}</td>
                                            <td>{{ $schema->building_count_from . ' ' . ui_change('to') . ' ' . $schema->building_count_to }}
                                            </td>
                                            <td>{{ $schema->branch_charge }}</td>
                                            <td>{{ $schema->branch_count_from . ' ' . ui_change('to') . ' ' . $schema->branch_count_to }}
                                            </td>
                                            <td>{{ $schema->setup_cost }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('admin.schema.display-update') }}" method="post"
                                                    id="schema_display{{ $schema->id }}_form"
                                                    class="product_display_form">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $schema->id }}">
                                                    <label class="switcher mx-auto">
                                                        <input type="checkbox" class="switcher_input"
                                                            id="schema_display{{ $schema->id }}" name="display"
                                                            value="1"
                                                            {{ $schema->display == 'active' ? 'checked' : '' }}
                                                            onclick="toogleStatusModal(event,'schema_display{{ $schema->id }}',
                                                    'schema-status-on.png','schema-status-off.png',
                                                    '{{ ui_change('Want_to_Turn_ON', 'property_master') }} {{ $schema->name }} ',
                                                    '{{ ui_change('Want_to_Turn_OFF', 'property_master') }} {{ $schema->name }} ',
                                                    `<p>{{ ui_change('if_enabled_this_schema_will_be_available', 'property_master') }}</p>`,
                                                    `<p>{{ ui_change('if_disabled_this_schema_will_be_hidden', 'property_master') }}</p>`)">
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </form>
                                            </td>
                                            <td class="text-center">
                                                <form action="{{ route('admin.schema.status-update') }}" method="post"
                                                    id="schema_status{{ $schema->id }}_form" class="product_status_form">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $schema->id }}">
                                                    <label class="switcher mx-auto">
                                                        <input type="checkbox" class="switcher_input"
                                                            id="schema_status{{ $schema->id }}" name="status"
                                                            value="1"
                                                            {{ $schema->status == 'active' ? 'checked' : '' }}
                                                            onclick="toogleStatusModal(event,'schema_status{{ $schema->id }}',
                                                    'schema-status-on.png','schema-status-off.png',
                                                    '{{ ui_change('Want_to_Turn_ON', 'property_master') }} {{ $schema->name }} ',
                                                    '{{ ui_change('Want_to_Turn_OFF', 'property_master') }} {{ $schema->name }} ',
                                                    `<p>{{ ui_change('if_enabled_this_schema_will_be_available', 'property_master') }}</p>`,
                                                    `<p>{{ ui_change('if_disabled_this_schema_will_be_hidden', 'property_master') }}</p>`)">
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                         <a class="btn btn-outline-info btn-sm square-btn"
                                                        title="{{ ui_change('edit') }}"
                                                        href="{{ route('admin.schema.edit', $schema->id) }}">
                                                        <i class="tio-edit"></i>
                                                    </a>
                                                    {{-- <a class="btn btn-outline--primary square-btn btn-sm mr-1"
                                                        title="{{ __('general.view') }}"
                                                        href="{{ route('admin.schemes.show', $schema->id) }}">
                                                        <img src="{{ asset('/assets/back-end/img/eye.svg') }}"
                                                            class="svg" alt="">
                                                    </a>
                                                    <a class="btn btn-outline--primary square-btn btn-sm mr-1"
                                                        title="{{ __('roles.schedules_list') }}"
                                                        href="{{ route('admin.schemes.schedules', $schema->id) }}">
                                                        <i class="fa fa-history"></i>
                                                    </a>

                                                    <a class="btn btn-outline-info btn-sm square-btn"
                                                        title="{{ __('general.edit') }}"
                                                        href="{{ route('admin.schemes.edit', $schema->id) }}">
                                                        <i class="tio-edit"></i>
                                                    </a>
                                                    @if ($schema->code == 'request')
                                                    <a class="btn btn-outline-info btn-sm square-btn"
                                                        title="{{ ui_change('confirm') }}"
                                                        href="{{ route('admin.requests.confirm', $schema->id) }}">
                                                        <i class="fa fa-check"></i>
                                                    </a>
                                                    @endif

                                                    <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                        title="{{ __('general.delete') }}" id="{{ $schema->id }}">
                                                        <i class="tio-delete"></i>
                                                    </a> --}}
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
                            {{ $schemes->links() }}
                        </div>
                    </div>
                    @if (count($schemes) == 0)
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
                        url: "{{ route('admin.schema.delete') }}",
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
                        toastr.success("{{ ui_change('status_updated_successfully') }}");
                    } else {
                        toastr.error(
                            '{{ ui_change('status_updated_failed.') }} {{ ui_change('Product_must_be_approved') }}'
                        );
                        location.reload();
                    }
                }
            });
        });
    </script>

    <script>
        $('.schema_status_form').on('submit', function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.schema.status-update') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    if (data.success == true) {
                        toastr.success('{{ ui_change('updated_successfully', 'property_master') }}');
                    } else if (data.success == false) {
                        toastr.error(
                            '{{ ui_change('Status_updated_failed.', 'property_master') }} {{ ui_change('schema_must_be_approved', 'property_master') }}'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    }
                }
            });
        });
        $('.schema_display_form').on('submit', function(event) {
            event.preventDefault();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{ route('admin.schema.display-update') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(data) {
                    if (data.success == true) {
                        toastr.success('{{ ui_change('updated_successfully', 'property_master') }}');
                    } else if (data.success == false) {
                        toastr.error(
                            '{{ ui_change('Status_updated_failed.', 'property_master') }} {{ ui_change('schema_must_be_approved', 'property_master') }}'
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
