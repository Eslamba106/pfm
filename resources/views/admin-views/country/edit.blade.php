@extends('layouts.back-end.app')
@section('title', ui_change('countries' , 'hierarchy'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{asset('assets/back-end/css/croppie.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Title -->
    <div class="mb-3">
        <h2 class="h1 mb-0 d-flex gap-2">
            {{-- <img width="60" src="{{asset('/assets/back-end/img/countries.jpg')}}" alt=""> --}}
            {{ui_change('edit_country' , 'hierarchy')}}
        </h2>
    </div>
    <!-- End Page Title -->

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    {{ ui_change('edit_country' , 'hierarchy')}}
                </div>
                <div class="card-body" style="text-align: {{ Session::get('locale') === "ar" ? 'right' : 'left'}};">
                    <form action="{{route('country.update' , $country->id)}}" method="post">
                        @csrf
                        @method('patch')
                        <div class="row">
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ ui_change('country' , 'hierarchy') }}<span class="text-danger"> *</span>
                                    </label>
                                    <select class="js-select2-custom form-control" name="country_id" id="country"
                                        required>
                                        <option value="0">{{ ui_change('select' , 'hierarchy') }}</option>
                                        @forelse ($countries as $item)
                                            <option value="{{ $item->id }}" {{( $item->id == $country->country_id) ? 'selected' : '' }}>{{ $item->name }}</option>
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
                                    <input type="text" name="international_currency_code" value="{{ $country->international_currency_code }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ ui_change('country_code' , 'hierarchy') }}
                                    </label>
                                    <input type="text"    name="country_code" value="{{ $country->country_code }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="currency_symbol"
                                        class="title-color">{{ ui_change('currency_symbol' , 'hierarchy') }}
                                    </label>
                                    <input type="text" name="currency_symbol"  value="{{ $country->currency_symbol }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="name" class="title-color">{{ ui_change('regions' , 'hierarchy') }}
                                    </label>
                                    <select class="js-select2-custom form-control" name="region_id" >
                                        @forelse ($regions as $item)
                                            <option value="{{ $item->id }}" {{( $item->id == $country->region_id) ? 'selected' : '' }}>{{ $item->name }}</option>
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
                                    <input type="text" name="denomination_name"  value="{{ $country->denomination_name }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="currency_name" class="title-color">{{ ui_change('currency_name' , 'hierarchy') }}
                                    </label>
                                    <input type="text" name="currency_name"  value="{{ $country->currency_name }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="currency_name"
                                        class="title-color">{{ ui_change('nationality_of_owner' , 'hierarchy') }}
                                    </label>
                                    <input type="text" name="nationality_of_owner"  value="{{ $country->nationality_of_owner }}" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-4 col-xl-3">
                                <div class="form-group">
                                    <label for="currency_name"
                                        class="title-color">{{ ui_change('no_of_decimals' , 'hierarchy') }}
                                    </label>
                                    <input type="text" name="no_of_decimals"  value="{{ $country->no_of_decimals }}" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="d-flex flex-wrap gap-2 justify-content-end">
                            <button type="reset" class="btn btn-secondary">{{ui_change('reset' , 'hierarchy')}}</button>
                            <button type="submit" class="btn btn--primary">{{ui_change('submit' , 'hierarchy')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>


@endsection
