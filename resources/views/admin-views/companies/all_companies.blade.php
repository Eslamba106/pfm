@extends('layouts.back-end.app')


@section('title')
    {{ ui_change('companies' , 'hierarchy') }}
@endsection
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('page_name')
    {{ ui_change('all_companies' , 'hierarchy')  }}
@endsection
@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                {{-- <img width="50" src="{{ asset('/assets/back-end/img/companies.jpg') }}" alt=""> --}}
                {{ ui_change('companies' , 'hierarchy')  }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.hierarchy.inline-menu')

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
                                            placeholder="{{ ui_change('search_by_name' , 'hierarchy')  }}"
                                            aria-label="Search by ID or name" value="{{ $search }}" required>
                                        <button type="submit"
                                            class="btn btn--primary input-group-text">{{ ui_change('search' , 'hierarchy')  }}</button>
                                    </div>
                                </form>
                               
                                <!-- End Search -->
                            </div>

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
                                        <th><input class="bulk_check_all" type="checkbox" /></th>
                                        <th>{{ ui_change('logo' , 'hierarchy') }} </th>
                                        <th>{{ ui_change('name' , 'hierarchy')  }}</th>
                                        <th>{{ ui_change('company_id' , 'hierarchy') }} </th>
                                        <th>{{ ui_change('country' , 'hierarchy')  }}</th>
                                        <th>{{ ui_change('Created_At' , 'hierarchy')  }}</th>
                                        <th>{{ ui_change('Actions' , 'hierarchy')  }}</th>
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
                                            <td><img width="60px" src="{{ asset(main_path() . $company->logo_image) }}"
                                                    alt=""></td>
                                            <td>{{ $company->name }}</td>
                                            <td>{{ $company->company_id }}</td>
                                            <td>{{ $company->countryName }}</td>
                                            <td>{{ \Carbon\Carbon::parse($company->created_at)->format('Y-m-d') }}</td>

                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a class="btn btn-outline--primary square-btn btn-sm mr-1"
                                                        title="{{ ui_change('view' , 'hierarchy')  }}"
                                                        href="{{ route('companies.show', $company->id) }}">
                                                        <img src="{{ asset('/assets/back-end/img/eye.svg') }}"
                                                            class="svg" alt="">
                                                    </a>

                                                    <a class="btn btn-outline-info btn-sm square-btn"
                                                        title="{{ ui_change('edit' , 'hierarchy')  }}"
                                                        href="{{ route('companies.edit', $company->id) }}">
                                                        <i class="tio-edit"></i>
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
                            <p class="mb-0">{{ ui_change('no_data_to_show' , 'hierarchy')  }}</p>
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
                        toastr.success("{{ ui_change('status_updated_successfully' , 'hierarchy')  }}");
                    } else {
                        toastr.error(
                            '{{ ui_change('status_updated_failed.' , 'hierarchy') }} {{ ui_change('Product_must_be_approved' , 'hierarchy')  }}'
                        );
                        location.reload();
                    }
                }
            });
        });
    </script>
@endpush
