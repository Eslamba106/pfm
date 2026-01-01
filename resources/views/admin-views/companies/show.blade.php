@extends('layouts.back-end.app')
@php
    $lang = session()->get('locale');
@endphp

@section('title') 
    {{ ui_change('show_company' , 'hierarchy')  }}
@endsection
@push('css_or_js')
    <link href="{{ asset('assets/back-end/css/tags-input.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/select2/css/select2.min.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #dedede;
            border: 1px solid #dedede;
            border-radius: 2px;
            color: #222;
            display: flex;
            gap: 4px;
            align-items: center;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0">
                {{-- <img src="{{ asset('/assets/back-end/img/all-orders.png') }}" alt=""> --}}
                {{ ui_change('company_info' , 'hierarchy') }}
            </h2>
        </div>

        <!-- End Page Header -->

        <div class="row gx-2 gy-3" id="printableArea">
            <div class="col-lg-8 col-xl-9">
                <!-- Card -->
                <div class="card h-100">
                    <!-- Body -->
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-10 justify-content-between mb-4">
                            <div class="d-flex flex-column gap-10">
                                <h5
                                    class="mb-0 text-capitalize d-flex align-items-center gap-2 border-bottom pb-3 mb-4 pl-4">
                                    {{-- <img src="{{ asset('/assets/back-end/img/seller-information.png') }}" class="mb-1"
                                        alt=""> --}}
                                    {{ ui_change('general_info' , 'hierarchy')  }}
                                </h5>
                                <h4 class="text-capitalize">{{ ui_change('company_code' , 'hierarchy') }} #{{ $company->code }}</h4>
                                <div class="">
                                    <i class="tio-date-range"></i>
                                    {{ date('d M Y H:i:s', strtotime($company['created_at'])) }}
                                </div>
                            </div>
                            <div class="text-sm-right">

                                <div class="d-flex flex-column gap-2 mt-3">
                                     
                                   
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ ui_change('country' , 'hierarchy') }} :
                                    <strong>{{ $country_main->country->name ?? ui_change('not_available' , 'hierarchy')  }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ ui_change('country_code' , 'hierarchy') }} :
                                    <strong>{{ $country_main->country->code ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ ui_change('region' , 'hierarchy')  }} :
                                    <strong>{{ $country_main->region->name ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ ui_change('currency_name' , 'hierarchy')  }} :
                                    <strong>{{ $country_main->country->currency_name ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                            </div>


                        </div>
                        <div class="row mt-5">


                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ ui_change('currency_symbol' , 'hierarchy') }} :
                                    <strong>{{ $company->symbol ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ ui_change('currency_symbol' , 'hierarchy')  }} :
                                    <strong>{{ $company->currency_code ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ ui_change('denomination_name' , 'hierarchy') }} :
                                    <strong>{{ $company->denomination ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ ui_change('no_of_decimals' , 'hierarchy')  }} :
                                    <strong>{{ $company->decimals ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                            </div>

                        </div>
                        <div class="row mt-5">

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ ui_change('state' , 'hierarchy')  }} :
                                    <strong>{{ $company->state ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ ui_change('city' , 'hierarchy')  }} :
                                    <strong>{{ $company->city ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ ui_change('location' , 'hierarchy')  }} :
                                    <strong>{{ $company->location ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ ui_change('pin' , 'hierarchy') }} :
                                    <strong>{{ $company->pin ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                            </div>

                        </div>


                        <div class="row justify-content-md-end mb-3">
                            
                        </div>
                        <!-- End Row -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-4 col-xl-3">
                <!-- Card -->
                <div class="card">

                    <!-- Body -->
                    @if ($company)
                        <div class="card-body">
                            <h4 class="mb-4 d-flex align-items-center gap-2">
                                {{-- <img src="{{ asset('/assets/back-end/img/seller-information.png') }}" alt=""> --}}
                                {{ ui_change('company_info' , 'hierarchy') }}
                            </h4>

                            <div class="media flex-wrap gap-3">
                                <div class="">
                                    <img class="avatar rounded-circle avatar-70"
                                        onerror="this.src='{{ asset('assets/front-end/img/image-place-holder.png') }}'"
                                        src="{{ asset('assets/' . $company->logo_image) }}" alt="Image">
                                    {{-- {{ dd( asset($company->logo_image_url)) }} --}}
                                </div>
                                <div class="media-body d-flex flex-column gap-1">
                                    <span class="title-color hover-c1"><strong>{{ $company->name }}</strong></span>
                                    <span class="title-color hover-c1">{{ ui_change('company_code' , 'hierarchy')  }} :
                                        <strong>{{ $company->code }}</strong></span>
                                    <span class="title-color"> {{ ui_change('user_name' , 'hierarchy')  }} :
                                        <strong>{{ $company->user_name }}</strong>
                                    </span>
                                    <span class="title-color break-all"> {{ ui_change('phone' , 'hierarchy') }} :
                                        <strong>{{ '(+' . $company->phone_dail_code . ')' . $company->phone }}</strong></span>
                                    <span class="title-color break-all"> {{ ui_change('fax' , 'hierarchy') }} :
                                        <strong>{{ '(+' . $company->fax_dail_code . ')' . $company->fax }}</strong></span>
                                    <span class="title-color break-all">{{ ui_change('email' , 'hierarchy') }} :
                                        <strong>{{ $company->email }}</strong></span>
                                    <span class="title-color break-all">{{ ui_change('password' , 'hierarchy') }} :
                                        <strong>{{ $company->my_name }}</strong></span>
                                    <span class="title-color break-all">{{ ui_change('opening_time' , 'hierarchy') }} :
                                        <strong>{{ Carbon\Carbon::parse($company->opening_time)->format('h:i A') }}</strong></span>
                                    <span class="title-color break-all">{{ ui_change('closing_time' , 'hierarchy') }} :
                                        <strong>{{ Carbon\Carbon::parse($company->closing_time)->format('h:i A') }}</strong></span>
                                    <span class="title-color break-all">{{ ui_change('financial_year_start_ith' , 'hierarchy') }} :
                                        <strong>{{ Carbon\Carbon::parse($company->financial_year)->format('Y-m-d') }}</strong></span>
                                    <span class="title-color break-all">{{ ui_change('book_begining_with' , 'hierarchy') }} :
                                        <strong>{{ Carbon\Carbon::parse($company->book_begining)->format('Y-m-d') }}</strong></span>
                                    <span class="title-color break-all">{{ ui_change('address1' , 'hierarchy') }} :
                                        <strong>{{ $company->address1 ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                                    <span class="title-color break-all">{{ ui_change('address2' , 'hierarchy') }} :
                                        <strong>{{ $company->address2 ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                                    <span class="title-color break-all">{{ ui_change('address3' , 'hierarchy') }} :
                                        <strong>{{ $company->address3 ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card-body">
                            <div class="media align-items-center">
                                <span>{{ ui_change('user_not_found' , 'hierarchy')  }}</span>
                            </div>
                        </div>
                    @endif
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <div class="row gx-2 gy-3" id="printableArea">
            <div class="col-lg-8 col-xl-9">
                <!-- Card -->
                <div class="card h-100">
                    <!-- Body -->
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-10 justify-content-between mb-4">
                            <div class="d-flex flex-column gap-10">
                                <h5
                                    class="mb-0 text-capitalize d-flex align-items-center gap-2 border-bottom pb-3 mb-4 pl-4">
                                    <img src="{{ asset('/assets/back-end/img/seller-information.png') }}" class="mb-1"
                                        alt="">
                                    {{ ui_change('tax_info' , 'hierarchy')  }}
                                </h5>
                                <h4 class="text-capitalize">{{ ui_change('id' , 'hierarchy')  }} # {{ $company->id }}</h4>

                            </div>
                            <div class="text-sm-right">

                                <div class="d-flex flex-column gap-2 mt-3">

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">

                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <span class="title-color break-all"> {{ ui_change('vat_no' , 'hierarchy')}} :
                                    <strong>{{ $company->vat_no ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <span class="title-color break-all"> {{ ui_change('group_vat_no' , 'hierarchy')}} :
                                    <strong>{{ $company->group_vat_no ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <span class="title-color break-all"> {{ ui_change('tax_registration_date' , 'hierarchy')}} :
                                    <strong>{{ Carbon\Carbon::parse($company->tax_reg_date)->format('Y-m-d') ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <span class="title-color break-all"> {{ ui_change('tax_rate' , 'hierarchy')}} :
                                    <strong>{{ $company->tax_rate ?? ui_change('not_available' , 'hierarchy') }}</strong></span>
                            </div>

                        </div>



                        <div class="row justify-content-md-end mb-3">
                         
                        </div>
                        <!-- End Row -->
                    </div>
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>

            <div class="col-lg-4 col-xl-3">
                <!-- Card -->
                <div class="card">

                    <!-- Body -->
                    <!-- End Body -->
                </div>
                <!-- End Card -->
            </div>
        </div>
        <!-- End Row -->
    </div>
    
@endsection

@push('script_2')
    <script>
        $(document).on('change', '.payment_status', function() {
            var id = $(this).attr("data-id");
            var value = $(this).val();
            Swal.fire({
                title: '{{ ui_change('are_you_sure_change_this' , 'hierarchy')  }}?',
                text: "{{ ui_change('you_will_not_be_able_to_revert_this' , 'hierarchy')  }}!",
                showCancelButton: true,
                confirmButtonColor: '#377dff',
                cancelButtonColor: 'secondary',
                confirmButtonText: '{{ ui_change('yes_change_it' , 'hierarchy')  }}!',
                cancelButtonText: '{{ ui_change('cancel' , 'hierarchy') }}',
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "",
                        method: 'POST',
                        data: {
                            "id": id,
                            "payment_status": value
                        },
                        success: function(data) {
                            toastr.success('{{ ui_change('status_change_successfully' , 'hierarchy') }}');
                            location.reload();
                        }
                    });
                }
            })
        });

        function order_status(status) {
            @if ($company['order_status'] == 'delivered')
                Swal.fire({
                    title: '{{ ui_change('order_is_already_delivered_and_transaction_amount_has_been_disbursed_changing_status_can_be_the_reason_of_miscalculation' , 'hierarchy')  }}!',
                    text: "{{ ui_change('think_before_you_proceed' , 'hierarchy') }}.",
                    showCancelButton: true,
                    confirmButtonColor: '#377dff',
                    cancelButtonColor: 'secondary',
                    confirmButtonText: '{{ ui_change('yes_change_it' , 'hierarchy')  }}!',
                    cancelButtonText: '{{ ui_change('cancel' , 'hierarchy')  }}',
                }).then((result) => {
                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "",
                            method: 'POST',
                            data: {
                                "id": '{{ $company['id'] }}',
                                "order_status": status
                            },
                            success: function(data) {
                                if (data.success == 0) {
                                    toastr.success(
                                        '{{ ui_change('order_is_already_delivered_you_can_not_change_it' , 'hierarchy')  }} !!'
                                        );
                                    location.reload();
                                } else {
                                    toastr.success('{{ ui_change('status_change_successfully' , 'hierarchy') }}!');
                                    location.reload();
                                }

                            }
                        });
                    }
                })
            @else
                Swal.fire({
                    title: '{{ ui_change('are_you_sure_change_this' , 'hierarchy')  }}?',
                    text: "{{ ui_change('you_will_not_be_able_to_revert_this' , 'hierarchy') }}!",
                    showCancelButton: true,
                    confirmButtonColor: '#377dff',
                    cancelButtonColor: 'secondary',
                    confirmButtonText: '{{ ui_change('yes_change_it' , 'hierarchy')  }}!',
                    cancelButtonText: '{{ ui_change('cancel' , 'hierarchy') }}',
                }).then((result) => {
                    if (result.value) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                            }
                        });
                        $.ajax({
                            url: "",
                            method: 'POST',
                            data: {
                                "id": '{{ $company['id'] }}',
                                "order_status": status
                            },
                            success: function(data) {
                                if (data.success == 0) {
                                    toastr.success(
                                        '{{ ui_change('order_is_already_delivered_you_can_not_change_it' , 'hierarchy')  }} !!'
                                        );
                                    location.reload();
                                } else {
                                    toastr.success('{{ ui_change('status_change_successfully' , 'hierarchy') }}!');
                                    location.reload();
                                }

                            }
                        });
                    }
                })
            @endif
        }
    </script>

    <script>
        function addDeliveryMan(id) {
            $.ajax({
                type: "GET",
                url: '{{ url('/') }}/admin/orders/add-delivery-man/{{ $company['id'] }}/' + id,
                data: {
                    'order_id': '{{ $company['id'] }}',
                    'delivery_man_id': id
                },
                success: function(data) {
                    if (data.status == true) {
                        toastr.success('{{ ui_change('delivery_man_successfully_assigned_or_changed' , 'hierarchy') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    } else {
                        toastr.error('{{ ui_change('deliveryman_can_not_assign_or_change_in_that_status' , 'hierarchy') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                },
                error: function() {
                    toastr.error('{{ ui_change('add_valid_data' , 'hierarchy') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        }

        function last_location_view() {
            toastr.warning('{{ ui_change('only_available_when_order_is_out_for_delivery' , 'hierarchy')  }}!', {
                CloseButton: true,
                ProgressBar: true
            });
        }

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        function waiting_for_location() {
            toastr.warning('{{ ui_change('waiting_for_location' , 'hierarchy')  }}', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    </script>
@endpush
