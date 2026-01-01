@extends('layouts.back-end.app')
@section('title', ui_change('countries' , 'hierarchy') )
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
                {{-- <img width="60" src="{{ asset('/public/assets/back-end/img/countries.jpg') }}" alt=""> --}}
                {{ ui_change('countries' , 'hierarchy')  }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.hierarchy.inline-menu')
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ ui_change('add_new_country' , 'hierarchy')  }}
                    </div>
                    <div class="card-body" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route('country.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="name" class="title-color">{{ ui_change('country' , 'hierarchy') }}<span
                                                class="text-danger"> *</span>
                                        </label>
                                        <select class="js-select2-custom form-control" name="country_id" id="country"
                                            required>
                                            <option value="">{{ ui_change('select' , 'hierarchy')  }}</option>
                                            @forelse ($countries as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="name"
                                            class="title-color">{{ ui_change('international_currency_code' , 'hierarchy') }}
                                        </label>
                                        <input type="text" name="international_currency_code" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="name" class="title-color">{{ ui_change('country_code' , 'hierarchy') }}
                                        </label>
                                        <input type="text" disabled name="country_code" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="currency_symbol"
                                            class="title-color">{{ ui_change('currency_symbol' , 'hierarchy') }}
                                        </label>
                                        <input type="text" name="currency_symbol" disabled class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="name" class="title-color">{{ ui_change('regions' , 'hierarchy')  }}
                                        </label>
                                        <select class="js-select2-custom form-control" name="region_id">
                                            @forelse ($regions as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="denomination_name"
                                            class="title-color">{{ ui_change('denomination_name' , 'hierarchy') }}
                                        </label>
                                        <input type="text" name="denomination_name" disabled class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="currency_name" class="title-color">{{ ui_change('currency_name' , 'hierarchy') }}
                                        </label>
                                        <input type="text" name="currency_name" disabled class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="currency_name"
                                            class="title-color">{{ ui_change('nationality_of_owner' , 'hierarchy') }}
                                        </label>
                                        <input type="text" name="nationality_of_owner" disabled class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="no_of_decimals" class="title-color">{{ ui_change('no_of_decimals' , 'hierarchy') }}
                                        </label>
                                        <input type="text" name="no_of_decimals" disabled class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2 justify-content-end">
                                <button type="reset" class="btn btn-secondary">{{ ui_change('reset' , 'hierarchy')  }}</button>
                                <button type="submit" class="btn btn--primary">{{ ui_change('submit' , 'hierarchy') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="row align-items-center">
                            <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                <h5 class="mb-0 d-flex align-items-center gap-2">{{ ui_change('country_list' , 'hierarchy') }}
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
                                            placeholder="{{ ui_change('search_by_country_name' , 'hierarchy') }}" aria-label="Search"
                                            value="{{ $search }}" required>
                                        <button type="submit"
                                            class="btn btn--primary">{{ ui_change('search' , 'hierarchy')  }}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                        </div>
                    </div>
                    <div style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                        <div class="table-responsive">
                            <table id="datatable"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th>{{ ui_change('sl' , 'hierarchy')  }}</th>
                                        <th class="text-center">{{ ui_change('country_code' , 'hierarchy') }} </th>
                                        <th class="text-center">{{ ui_change('region' , 'hierarchy')  }} </th>
                                        <th class="text-center">{{ ui_change('country_name' , 'hierarchy') }} </th>
                                        <th class="text-center">{{ ui_change('currency_name' , 'hierarchy') }} </th>
                                        <th class="text-center">{{ ui_change('actions' , 'hierarchy')  }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($country_master as $key => $item)
                                        <tr>
                                            <td>{{ $country_master->firstItem() + $key }}</td>
                                            <td class="text-center">{{ $item->country->code }}</td>
                                            <td class="text-center">{{ $item->region->name }}</td>
                                            <td class="text-center">{{ $item->country->name }}</td>
                                            <td class="text-center">{{ $item->currency_name }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a class="btn btn-outline-info btn-sm square-btn"
                                                        title="{{ ui_change('edit' , 'hierarchy') }}"
                                                        href="{{ route('country.edit', $item->id) }}">
                                                        <i class="tio-edit"></i>
                                                    </a>
                                                    <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                        title="{{ ui_change('delete' , 'hierarchy')  }}" id="{{ $item['id'] }}">
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
                            {!! $country_master->links() !!}
                        </div>
                    </div>

                    @if (count($country_master) == 0)
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
@endsection

@push('script')
    <script>
        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            Swal.fire({
                title: "{{ ui_change('are_you_sure_delete_this' , 'hierarchy')  }}",
                text: "{{ ui_change('you_will_not_be_able_to_revert_this' , 'hierarchy')  }}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ ui_change('yes_delete_it' , 'hierarchy')  }}!',
                cancelButtonText: '{{ ui_change('cancel' , 'hierarchy')  }}',
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
                        url: "{{ route('country.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success('{{ ui_change('deleted_successfully' , 'hierarchy') }}');
                            location.reload();
                        }
                    });
                }
            })
        });
        $(document).ready(function() {
            $('select[name="country_id"]').on('change', function() {
                var country_id = $(this).val();
                if (country_id) {
                    $.ajax({
                        url: "{{ URL::to('get_country') }}/" + country_id,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('input[name="international_currency_code"]').removeAttr(
                                'disabled');
                            $('input[name="international_currency_code"]').val(data
                                .international_currency_code);
                            $('input[name="country_code"]').removeAttr('disabled');
                            $('input[name="country_code"]').val(data.code);
                            $('input[name="currency_symbol"]').removeAttr('disabled');
                            $('input[name="currency_symbol"]').val(data.currency_symbol);
                            $('input[name="denomination_name"]').removeAttr('disabled');
                            $('input[name="denomination_name"]').val(data.denomination_name);
                            $('input[name="currency_name"]').removeAttr('disabled');
                            $('input[name="currency_name"]').val(data.currency_name);
                            $('input[name="nationality_of_owner"]').removeAttr('disabled');
                            $('input[name="nationality_of_owner"]').val(data
                                .nationality_of_owner);
                            $('input[name="no_of_decimals"]').removeAttr('disabled');
                            $('input[name="no_of_decimals"]').val(data.no_of_decimals);
                        },
                    });

                } else {
                    console.log('AJAX load did not work');
                }
            });

        });
        // function selectedfunction(){
        //     let country = document.getElementById('country');

        //     element.removeAttribute('disabled');
        // }

        // Call the dataTables jQuery plugin
    </script>
@endpush
