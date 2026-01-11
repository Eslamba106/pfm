@extends('layouts.back-end.app')
@section('title', ui_change('supplier_list','facility_master') )
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
                {{-- <img width="60" src="{{ asset('/assets/back-end/img/seller.png') }}" alt=""> --}}
                {{ ui_change('supplier_list','facility_master')  }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.facility_master.inline-menu')

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ ui_change('add_new_supplier','facility_master')  }}
                    </div>
                    <div class="card-body" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route('supplier.store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="code" class="title-color">{{ ui_change('code','facility_master')  }} <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <input type="text" name="code" class="form-control">
                                    </div>
                                    @error('code')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="name" class="title-color">{{ ui_change('name','facility_master')  }} <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-2 col-lg-1 col-xl-1">
                                    <div class="form-group">
                                        <label for="dail_code_contact_no"
                                            class="title-color">{{ ui_change('dail_code','facility_master')  }}
                                        </label>
                                        <input type="text" name="dail_code_contact_no" class="form-control">
                                    </div>
                                    @error('dail_code_contact_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-lg-2 col-xl-2">
                                    <div class="form-group">
                                        <label for="contact_no" class="title-color">{{ ui_change('contact_no','facility_master')  }}
                                        </label>
                                        <input type="text" name="contact_no" class="form-control">
                                    </div>
                                    @error('contact_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-2 col-lg-1 col-xl-1">
                                    <div class="form-group">
                                        <label for="dail_code_whatsapp_no"
                                            class="title-color">{{ ui_change('dail_code','facility_master')  }}
                                        </label>
                                        <input type="text" name="dail_code_whatsapp_no" class="form-control">
                                    </div>
                                    @error('dail_code_whatsapp_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-4 col-lg-2 col-xl-2">
                                    <div class="form-group">
                                        <label for="whatsapp_no"
                                            class="title-color">{{ ui_change('whatsapp_no','facility_master') }}
                                        </label>
                                        <input type="text" name="whatsapp_no" class="form-control">
                                    </div>
                                    @error('whatsapp_no')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>



                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="address1" class="title-color">{{ ui_change('address1','facility_master')  }}
                                        </label>
                                        <textarea name="address1" class="form-control" cols="30" rows="2"></textarea>
                                    </div>
                                    @error('address1')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="address2" class="title-color">{{ ui_change('address2','facility_master')  }}
                                        </label>
                                        <textarea name="address2" class="form-control" cols="30" rows="2"></textarea>
                                    </div>
                                    @error('address2')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="city" class="title-color">{{ ui_change('city','facility_master') }}
                                        </label>
                                        <input type="text" name="city" class="form-control">
                                    </div>
                                    @error('city')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="state" class="title-color">{{ ui_change('state','facility_master')  }}
                                        </label>
                                        <input type="text" name="state" class="form-control">
                                    </div>
                                    @error('state')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="country" class="title-color">{{ ui_change('country','facility_master')  }}
                                        </label>
                                        <input type="text" name="country" class="form-control">
                                    </div>
                                    @error('country')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group"> {{-- property_management.contact_person --}}
                                        <label for="contact_person"
                                            class="title-color">{{ ui_change('contact_person','facility_master') }}
                                        </label>
                                        <input type="text" name="contact_person" class="form-control">
                                    </div>
                                    @error('contact_person')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-4 col-xl-3">
                                    <div class="form-group">
                                        <label for="name" class="title-color">{{ ui_change('taxability','facility_master') }} <span
                                                class="text-danger"> *</span>
                                        </label>
                                        <select class="js-select2-custom form-control" name="tax_registration" required>
                                            <option value="2" selected>{{ ui_change('no','facility_master') }}</option>
                                            <option value="1">{{ ui_change('yes','facility_master')  }}</option>

                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-4 col-xl-3 d-none tax_status_html ">
                                    <div class="form-group">
                                        <label for="name" class="title-color">{{ ui_change('VAT_no','facility_master')  }}
                                        </label>
                                        <input type="text" name="vat_no" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-2 justify-content-end">
                                <button type="reset" class="btn btn-secondary">{{ ui_change('reset','facility_master')  }}</button>
                                <button type="submit" class="btn btn--primary">{{ ui_change('submit','facility_master') }}</button>
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
                                <h5 class="mb-0 d-flex align-items-center gap-2">{{ ui_change('country_list','facility_master')  }}
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
                                            placeholder="{{ ui_change('search_by_country_name','facility_master')  }}" aria-label="Search"
                                            value="{{ $search }}">
                                        <button type="submit"
                                            class="btn btn--primary">{{ ui_change('search','facility_master')  }}</button>
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
                                        <th>{{ ui_change('sl','facility_master')  }}</th>
                                        <th class="text-center">{{ ui_change('country_code','facility_master')  }} </th>
                                        <th class="text-center">{{ ui_change('name','facility_master') }} </th>
                                        <th class="text-center">{{ ui_change('contact_no','facility_master')  }} </th>
                                        <th class="text-center">{{ ui_change('whatsapp_no','facility_master')  }} </th>
                                        <th class="text-center">{{ ui_change('city','facility_master')  }} </th>
                                        <th class="text-center">{{ ui_change('state','facility_master')  }} </th>
                                        <th class="text-center">{{ ui_change('country','facility_master')  }} </th>
                                        <th class="text-center">{{ ui_change('status','facility_master')  }} </th>
                                        <th class="text-center">{{ ui_change('actions','facility_master')  }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($suppliers as $key => $item)
                                        <tr>
                                            <td>{{ $suppliers->firstItem() + $key }}</td>
                                            <td class="text-center">{{ $item->code }}</td>
                                            <td class="text-center">{{ $item->name }}</td>
                                            <td class="text-center">
                                                {{ isset($item->dail_code_contact_no) ? '(' . $item->dail_code_contact_no . ')' . $item->contact_no : '' }}</td>
                                            <td class="text-center">
                                                {{ isset($item->dail_code_whatsapp_no) ? '(' . $item->dail_code_whatsapp_no . ')' . $item->whatsapp_no : '' }}</td>
                                            <td class="text-center">{{ $item->city }}</td>
                                            <td class="text-center">{{ $item->state }}</td>
                                            <td class="text-center">{{ $item->country }}</td>
                                            <td class="text-center">
                                                <form action="{{ route('supplier.status-update') }}" method="post"
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
                                                    '{{ ui_change('Want_to_Turn_ON','facility_master')  }} {{ $item->name }} ',
                                                    '{{ ui_change('Want_to_Turn_OFF','facility_master')  }} {{ $item->name }} ',
                                                    `<p>{{ ui_change('if_enabled_this_product_will_be_available','facility_master')   }}</p>`,
                                                    `<p>{{ ui_change('if_disabled_this_product_will_be_hidden','facility_master')   }}</p>`)">
                                                        <span class="switcher_control"></span>
                                                    </label>
                                                </form>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a class="btn btn-outline-info btn-sm square-btn"
                                                        title="{{ ui_change('edit','facility_master')  }}"
                                                        href="{{ route('supplier.edit', $item->id) }}">
                                                        <i class="tio-edit"></i>
                                                    </a>
                                                    <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                        title="{{ ui_change('delete','facility_master') }}" id="{{ $item['id'] }}">
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
                            {!! $suppliers->links() !!}
                        </div>
                    </div>

                    @if (count($suppliers) == 0)
                        <div class="text-center p-4">
                            <img class="mb-3 w-160" src="{{ asset('assets/back-end') }}/svg/illustrations/sorry.svg"
                                alt="Image Description">
                            <p class="mb-0">{{ ui_change('no_data_to_show','facility_master')  }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).ready(function() {
            $('select[name="tax_registration"]').on('change', function() {
                let status = $(this).val();
                if (status == 1) {
                    $(".tax_status_html").removeClass('d-none');
                } else {
                    $(".tax_status_html").addClass('d-none');
                }
            });
        });
    </script>
    <script>
        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            Swal.fire({
                title: "{{ ui_change('are_you_sure_delete_this','facility_master')  }}",
                text: "{{ ui_change('you_will_not_be_able_to_revert_this','facility_master')  }}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ ui_change('yes_delete_it','facility_master')  }}!',
                cancelButtonText: '{{ ui_change('cancel','facility_master')  }}',
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
                        url: "{{ route('supplier.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success('{{ ui_change('deleted_successfully','facility_master')  }}');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
