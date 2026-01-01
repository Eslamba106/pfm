@extends('layouts.back-end.app')
@section('title', ui_change('regions' , 'hierarchy') )
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{asset('public/assets/back-end')}}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{asset('public/assets/back-end/css/croppie.css')}}" rel="stylesheet">
@endpush

@section('content')
<div class="content container-fluid">
    <!-- Page Title -->
    <div class="mb-3">
        <h2 class="h1 mb-0 d-flex gap-2">
            <img width="60" src="{{asset('/public/assets/back-end/img/regions.jpg')}}" alt="">
            {{ui_change('edit_region' , 'hierarchy') }}
        </h2>
    </div>
    <!-- End Page Title -->

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    {{ ui_change('edit_region' , 'hierarchy') }}
                </div> 
                <div class="card-body" style="text-align: {{ Session::get('locale') === "ar" ? 'right' : 'left'}};">
                    <form action="{{route('region.update' , $region->id)}}" method="post">
                        @csrf
                        @method('patch')
                        <div class="form-group" >
                            <input type="hidden" id="id">
                            <label class="title-color" for="name">{{ ui_change('region_name' , 'hierarchy') }}<span class="text-danger">*</span>  </label>
                            <input type="text" name="name" class="form-control" value="{{ $region->name }}"  
                                   placeholder="{{ui_change('enter_region_name' , 'hierarchy') }}" >
                        </div>
                        <div class="form-group" >
                            <input type="hidden" id="id">
                            <label class="title-color" for="name">{{ ui_change('region_code' , 'hierarchy') }}<span class="text-danger">*</span>  </label>
                            <input type="text" name="code" class="form-control" value="{{ $region->code }}" 
                                   placeholder="{{ui_change('enter_region_code' , 'hierarchy') }}" >
                        </div>


                        <div class="d-flex flex-wrap gap-2 justify-content-end">
                            <button type="reset" class="btn btn-secondary">{{ui_change('reset' , 'hierarchy') }}</button>
                            <button type="submit" class="btn btn--primary">{{ui_change('submit' , 'hierarchy') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>



    </div>

    
@endsection