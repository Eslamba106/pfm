@extends('layouts.back-end.app')

@section('title', ui_change('update_Currency'))

@push('css_or_js')

@endpush

@section('content')
    @php($currency_model=\App\CPU\Helpers::get_business_settings('currency_model'))
    <div class="content container-fluid">
        <!-- <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a
                        href="{{route('admin.dashboard')}}">{{ui_change('dashboard')}}</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">{{ui_change('currency')}}</li>
            </ol>
        </nav> -->
        <!-- Page Heading -->

        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex align-items-center gap-2">
                {{-- <img src="{{asset('/assets/back-end/img/coupon_setup.png')}}" alt=""> --}}
                {{ui_change('currency_update')}}
            </h2>
        </div>
        <!-- End Page Title -->

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="tio-money"></i>
                            {{ui_change('update_Currency')}}
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="{{route('admin.currency.update',[$data['id']])}}" method="post"
                              style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
                            @csrf
                            <div class="">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="title-color">{{ui_change('currency_Name')}} :</label>
                                        <input type="text" name="name"
                                               placeholder="{{ui_change('currency_Name')}}"
                                               class="form-control" id="name"
                                               value="{{$data->name}}">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label class="title-color">{{ui_change('currency_Symbol')}} :</label>
                                        <input type="text" name="symbol"
                                               placeholder="{{ui_change('currency_Symbol')}}"
                                               class="form-control" id="symbol"
                                               value="{{$data->symbol}}">
                                    </div>
                                </div>

                            </div>
                            <div class="">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label class="title-color">{{ui_change('currency_Code')}} :</label>
                                        <input type="text" name="code"
                                               placeholder="{{ui_change('currency_Code')}}"
                                               class="form-control" id="code"
                                               value="{{$data->code}}">
                                    </div>
                                    @if($currency_model=='multi_currency')
                                        <div class="col-md-6 mb-3">
                                            <label class="title-color">{{ui_change('exchange_Rate')}} :</label>
                                            <input type="number" min="0" max="1000000"
                                                   name="exchange_rate" step="0.00000001"
                                                   placeholder="{{ui_change('exchange_Rate')}}"
                                                   class="form-control" id="exchange_rate"
                                                   value="{{$data->exchange_rate}}">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="d-flex flex-wrap gap-10 justify-content-center">
                                <button type="submit" id="add" class="btn btn--primary">{{ui_change('update')}}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')

@endpush
