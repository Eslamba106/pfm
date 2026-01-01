@extends('super_admin.layouts.app')
@php
    $lang = session()->get('locale');
@endphp

@section('title')
    {{ __('companies.companies') }}
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
                {{ __('companies.info') }}
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
                                    {{ __('general.general_info') }}
                                </h5>
                                <h4 class="text-capitalize">{{ __('companies.company_code') }} #{{ $company->code }}</h4>
                                <div class="">
                                    <i class="tio-date-range"></i>
                                    {{ date('d M Y H:i:s', strtotime($company['created_at'])) }}
                                </div>
                            </div>
                            <div class="text-sm-right">

                                <div class="d-flex flex-column gap-2 mt-3">
                                    <!-- Order status -->
                                    {{-- <div class="order-status d-flex justify-content-sm-end gap-10 text-capitalize">
                                        <span class="title-color">{{__('status')}}: </span>
                                        @if ($company['order_status'] == 'pending')
                                            <span class="badge badge-soft-info font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                                {{__(str_replace('_',' ',$company['order_status']))}}
                                            </span>
                                        @elseif($company['order_status']=='failed')
                                            <span class="badge badge-soft-danger font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                                {{__(str_replace('_',' ',$company['order_status']))}}
                                            </span>
                                        @elseif($company['order_status']=='processing' || $company['order_status']=='out_for_delivery')
                                            <span class="badge badge-soft-warning font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                                {{__(str_replace('_',' ',$company['order_status']))}}
                                            </span>
                                        @elseif($company['order_status']=='delivered' || $company['order_status']=='confirmed')
                                            <span class="badge badge-soft-success font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                                {{__(str_replace('_',' ',$company['order_status']))}}
                                            </span>
                                        @else
                                            <span class="badge badge-soft-danger font-weight-bold radius-50 d-flex align-items-center py-1 px-2">
                                                {{__(str_replace('_',' ',$company['order_status']))}}
                                            </span>
                                        @endif
                                    </div> --}}

                                    <!-- Payment Method -->
                                    {{-- <div class="payment-method d-flex justify-content-sm-end gap-10 text-capitalize">
                                        <span class="title-color">{{__('payment_Method')}} :</span>
                                        <strong>  {{__(str_replace('_',' ',$company['payment_method']))}}</strong>
                                    </div>
                                    @if (isset($company['transaction_ref']) && $company->payment_method != 'cash_on_delivery' && $company->payment_method != 'pay_by_wallet' && !isset($company->offline_payments))
                                        <!-- reference-code -->
                                        <div class="reference-code d-flex justify-content-sm-end gap-10 text-capitalize">
                                            <span class="title-color">{{__('reference_Code')}} :</span>
                                            <strong>{{__(str_replace('_',' ',$company['transaction_ref']))}} {{ $company->payment_method == 'offline_payment' ? '('.$company->payment_by.')':'' }}</strong>
                                        </div>
                                    @endif --}}
                                    <!-- Payment Status -->
                                    {{-- <div class="payment-status d-flex justify-content-sm-end gap-10">
                                        <span class="title-color">{{__('payment_Status')}}:</span>
                                        @if ($company['payment_status'] == 'paid')
                                            <span class="text-success font-weight-bold">
                                                {{__('paid')}}
                                            </span>
                                        @else
                                            <span class="text-danger font-weight-bold">
                                                {{__('unpaid')}}
                                            </span>
                                        @endif
                                    </div> --}}
                                    {{-- @if (\App\CPU\Helpers::get_business_settings('order_verification') && $company->order_type == 'default_type')
                                        <span class="ml-2 ml-sm-3">
                                            <b>
                                                {{__('order_verification_code')}} : {{$company['verification_code']}}
                                            </b>
                                        </span>
                                    @endif --}}
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('country.country') }} :
                                    <strong>{{ $country_main->country->name ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('country.country_code') }} :
                                    <strong>{{ $country_main->country->code ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('region.region') }} :
                                    <strong>{{ $country_main->region->name ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('country.currency_name') }} :
                                    <strong>{{ $country_main->country->currency_name ?? __('general.not_available') }}</strong></span>
                            </div>


                        </div>
                        <div class="row mt-5">


                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('country.currency_symbol') }} :
                                    <strong>{{ $company->symbol ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('country.currency_symbol') }} :
                                    <strong>{{ $company->currency_code ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('country.denomination_name') }} :
                                    <strong>{{ $company->denomination ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('country.no_of_decimals') }} :
                                    <strong>{{ $company->decimals ?? __('general.not_available') }}</strong></span>
                            </div>

                        </div>
                        <div class="row mt-5">

                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('companies.state') }} :
                                    <strong>{{ $company->state ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('companies.city') }} :
                                    <strong>{{ $company->city ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('companies.location') }} :
                                    <strong>{{ $company->location ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <span class="title-color break-all"> {{ __('companies.pin') }} :
                                    <strong>{{ $company->pin ?? __('general.not_available') }}</strong></span>
                            </div>

                        </div>


                        <div class="row justify-content-md-end mb-3">
                            {{-- <div class="col-md-9 col-lg-8">
                                <dl class="row text-sm-right">
                                    <dt class="col-5">{{__('item_price')}}</dt>
                                    <dd class="col-6 title-color">
                                        <strong> </strong>
                                    </dd>
                                    <dt class="col-5 text-capitalize">{{__('item_discount')}}</dt>
                                    <dd class="col-6 title-color">
                                        - <strong> </strong>
                                    </dd>
                                    <dt class="col-sm-5">{{__('extra_discount')}}</dt>
                                    <dd class="col-sm-6 title-color">
                                        <strong>-  </strong>
                                    </dd>
                                    <dt class="col-5 text-capitalize">{{__('sub_total')}}</dt>
                                    <dd class="col-6 title-color">
                                        <strong></strong>
                                    </dd>
                                    <dt class="col-sm-5">{{__('coupon_discount')}}</dt>
                                    <dd class="col-sm-6 title-color">
                                        <strong>- </strong>
                                    </dd>
                                    <dt class="col-5 text-uppercase">{{__('vat')}}/{{__('tax')}}</dt>
                                    <dd class="col-6 title-color">
                                        <strong> </strong>
                                    </dd>
                                    <dt class="col-sm-5">{{__('total')}}</dt>
                                    <dd class="col-sm-6 title-color">
                                        <strong>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($total+$shipping-$extra_discount-$coupon_discount))}}</strong>
                                    </dd>
                                </dl>
                                <!-- End Row -->
                            </div> --}}
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
                                {{ __('companies.info') }}
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
                                    <span class="title-color hover-c1">{{ __('companies.company_code') }} :
                                        <strong>{{ $company->code }}</strong></span>
                                    <span class="title-color"> {{ __('companies.user_name') }} :
                                        <strong>{{ $user->user_name }}</strong>
                                    </span>
                                    <span class="title-color break-all"> {{ __('general.phone') }} :
                                        <strong>{{ '(+' . $company->phone_dail_code . ')' . $company->phone }}</strong></span>
                                    <span class="title-color break-all"> {{ __('companies.fax') }} :
                                        <strong>{{ '(+' . $company->fax_dail_code . ')' . $company->fax }}</strong></span>
                                    <span class="title-color break-all">{{ __('companies.email') }} :
                                        <strong>{{ $company->email }}</strong></span>
                                    <span class="title-color break-all">{{ __('companies.password') }} :
                                        <strong>{{ $user->my_name }}</strong></span>
                                    <span class="title-color break-all">{{ __('companies.opening_time') }} :
                                        <strong>{{ Carbon\Carbon::parse($company->opening_time)->format('h:i A') }}</strong></span>
                                    <span class="title-color break-all">{{ __('companies.closing_time') }} :
                                        <strong>{{ Carbon\Carbon::parse($company->closing_time)->format('h:i A') }}</strong></span>
                                    <span class="title-color break-all">{{ __('companies.financial_year_start_ith') }} :
                                        <strong>{{ Carbon\Carbon::parse($company->financial_year)->format('Y-m-d') }}</strong></span>
                                    <span class="title-color break-all">{{ __('companies.book_begining_with') }} :
                                        <strong>{{ Carbon\Carbon::parse($company->book_begining)->format('Y-m-d') }}</strong></span>
                                    <span class="title-color break-all">{{ __('companies.address1') }} :
                                        <strong>{{ $company->address1 ?? __('general.not_available') }}</strong></span>
                                    <span class="title-color break-all">{{ __('companies.address2') }} :
                                        <strong>{{ $company->address2 ?? __('general.not_available') }}</strong></span>
                                    <span class="title-color break-all">{{ __('companies.address3') }} :
                                        <strong>{{ $company->address3 ?? __('general.not_available') }}</strong></span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card-body">
                            <div class="media align-items-center">
                                <span>{{ __('login.user_not_found') }}</span>
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
                                    {{ __('companies.tax_info') }}
                                </h5>
                                <h4 class="text-capitalize">{{ __('companies.id') }} # {{ $company->id }}</h4>

                            </div>
                            <div class="text-sm-right">

                                <div class="d-flex flex-column gap-2 mt-3">

                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">

                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <span class="title-color break-all"> {{ __('companies.vat_no') }} :
                                    <strong>{{ $company->vat_no ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <span class="title-color break-all"> {{ __('companies.group_vat_no') }} :
                                    <strong>{{ $company->group_vat_no ?? __('general.not_available') }}</strong></span>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <span class="title-color break-all"> {{ __('companies.tax_registration_date') }} :
                                    <strong>{{ Carbon\Carbon::parse($company->tax_reg_date)->format('Y-m-d') ?? __('general.not_available') }}</strong></span>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6">
                                <span class="title-color break-all"> {{ __('companies.tax_rate') }} :
                                    <strong>{{ $company->tax_rate ?? __('general.not_available') }}</strong></span>
                            </div>

                        </div>



                        <div class="row justify-content-md-end mb-3">
                            {{-- <div class="col-md-9 col-lg-8">
                                <dl class="row text-sm-right">
                                    <dt class="col-5">{{__('item_price')}}</dt>
                                    <dd class="col-6 title-color">
                                        <strong> </strong>
                                    </dd>
                                    <dt class="col-5 text-capitalize">{{__('item_discount')}}</dt>
                                    <dd class="col-6 title-color">
                                        - <strong> </strong>
                                    </dd>
                                    <dt class="col-sm-5">{{__('extra_discount')}}</dt>
                                    <dd class="col-sm-6 title-color">
                                        <strong>-  </strong>
                                    </dd>
                                    <dt class="col-5 text-capitalize">{{__('sub_total')}}</dt>
                                    <dd class="col-6 title-color">
                                        <strong></strong>
                                    </dd>
                                    <dt class="col-sm-5">{{__('coupon_discount')}}</dt>
                                    <dd class="col-sm-6 title-color">
                                        <strong>- </strong>
                                    </dd>
                                    <dt class="col-5 text-uppercase">{{__('vat')}}/{{__('tax')}}</dt>
                                    <dd class="col-6 title-color">
                                        <strong> </strong>
                                    </dd>
                                    <dt class="col-sm-5">{{__('total')}}</dt>
                                    <dd class="col-sm-6 title-color">
                                        <strong>{{\App\CPU\BackEndHelper::set_symbol(\App\CPU\BackEndHelper::usd_to_currency($total+$shipping-$extra_discount-$coupon_discount))}}</strong>
                                    </dd>
                                </dl>
                                <!-- End Row -->
                            </div> --}}
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
    <!--Show locations on map Modal -->
    {{-- <div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-labelledby="locationModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"
                        id="locationModalLabel">{{__('location_Data')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 modal_body_map">
                            <div class="location-map" id="location-map">
                                <div class="__h-400px w-100" id="location_map_canvas"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- End Modal -->
@endsection

@push('script_2')
    <script>
        $(document).on('change', '.payment_status', function() {
            var id = $(this).attr("data-id");
            var value = $(this).val();
            Swal.fire({
                title: '{{ __('are_you_sure_change_this') }}?',
                text: "{{ __('you_will_not_be_able_to_revert_this') }}!",
                showCancelButton: true,
                confirmButtonColor: '#377dff',
                cancelButtonColor: 'secondary',
                confirmButtonText: '{{ __('yes_change_it') }}!',
                cancelButtonText: '{{ __('cancel') }}',
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
                            toastr.success('{{ __('status_change_successfully') }}');
                            location.reload();
                        }
                    });
                }
            })
        });

        function order_status(status) {
            @if ($company['order_status'] == 'delivered')
                Swal.fire({
                    title: '{{ __('order_is_already_delivered_and_transaction_amount_has_been_disbursed_changing_status_can_be_the_reason_of_miscalculation') }}!',
                    text: "{{ __('think_before_you_proceed') }}.",
                    showCancelButton: true,
                    confirmButtonColor: '#377dff',
                    cancelButtonColor: 'secondary',
                    confirmButtonText: '{{ __('yes_change_it') }}!',
                    cancelButtonText: '{{ __('cancel') }}',
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
                                        '{{ __('order_is_already_delivered_you_can_not_change_it') }} !!'
                                        );
                                    location.reload();
                                } else {
                                    toastr.success('{{ __('status_change_successfully') }}!');
                                    location.reload();
                                }

                            }
                        });
                    }
                })
            @else
                Swal.fire({
                    title: '{{ __('are_you_sure_change_this') }}?',
                    text: "{{ __('you_will_not_be_able_to_revert_this') }}!",
                    showCancelButton: true,
                    confirmButtonColor: '#377dff',
                    cancelButtonColor: 'secondary',
                    confirmButtonText: '{{ __('yes_change_it') }}!',
                    cancelButtonText: '{{ __('cancel') }}',
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
                                        '{{ __('order_is_already_delivered_you_can_not_change_it') }} !!'
                                        );
                                    location.reload();
                                } else {
                                    toastr.success('{{ __('status_change_successfully') }}!');
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
                        toastr.success('{{ __('delivery_man_successfully_assigned_or_changed') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    } else {
                        toastr.error('{{ __('deliveryman_can_not_assign_or_change_in_that_status') }}', {
                            CloseButton: true,
                            ProgressBar: true
                        });
                    }
                },
                error: function() {
                    toastr.error('{{ __('add_valid_data') }}', {
                        CloseButton: true,
                        ProgressBar: true
                    });
                }
            });
        }

        function last_location_view() {
            toastr.warning('{{ __('only_available_when_order_is_out_for_delivery') }}!', {
                CloseButton: true,
                ProgressBar: true
            });
        }

        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })

        function waiting_for_location() {
            toastr.warning('{{ __('waiting_for_location') }}', {
                CloseButton: true,
                ProgressBar: true
            });
        }
    </script>
@endpush
