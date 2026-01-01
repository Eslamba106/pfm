@extends('layouts.back-end.app')

@section('title', ui_change('edit_investor' , 'property_master') )
@php
    $lang = Session::get('locale');
@endphp
@push('css_or_js')
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f9f9f9;
        }
        input[type="text"] {
            width: 100%;
            padding: 5px;
            box-sizing: border-box;
        }
        .unit-label {
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                {{-- <img src="{{ asset(main_path() . 'back-end/img/inhouse-product-list.png') }}" alt=""> --}}
                {{ ui_change('edit_investor' , 'property_master') }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.investment.inline-menu')

        <!-- Form -->
        {{-- <form class="product-form text-start" action="{{ route('investor.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf --}}
            <!-- general setup -->
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        {{-- <img src="{{ asset(main_path() . 'back-end/img/shop-information.png') }}" class="mb-1"
                            alt=""> --}}
                        <h4 class="mb-0">{{ ui_change('edit_investor' , 'property_master') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs w-fit-content mb-4">
                        <li class="nav-item">
                            <a class="nav-link type_link @if ($investor->type == 'individual') active @endif " href="#"
                                id="personal-link">{{ ui_change('personal' , 'property_master')  }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link type_link @if ($investor->type == 'company') active @endif " href="#"
                                id="company-link">{{ ui_change('company' , 'property_master')  }}</a>
                        </li>
                    </ul>
                    <div class="col-md-12 investor_form personal-form @if ($investor->type == 'company') d-none @endif " id="personal-form">
                        <form action="{{ route('investor.update' , $investor->id) }}" method="post">
                            @csrf
                            @method('patch')
                            @include('admin-views.investments.investor.personal_form')
                            <div class="row justify-content-end gap-3 mt-3 mx-1">
                                <button type="reset" class="btn btn-secondary px-5">{{ ui_change('reset' , 'property_master')  }}</button>
                                <button type="submit" class="btn btn--primary px-5">{{ ui_change('submit' , 'property_master') }}</button>
                            </div>

                        </form>
                    </div>
                    <div class="col-md-12 investor_form @if ($investor->type == 'individual') d-none @endif company-form" id="company-form">
                        <form action="{{ route('investor.update' , $investor->id) }}" method="post">
                            @csrf
                            @method('patch')
                            @include('admin-views.investments.investor.company_form' )
                            <div class="row justify-content-end gap-3 mt-3 mx-1">
                                <button type="reset" class="btn btn-secondary px-5">{{ ui_change('reset' , 'property_master')  }}</button>
                                <button type="submit" class="btn btn--primary px-5">{{ ui_change('submit' , 'property_master')  }}</button>
                            </div>

                        </form>


                    </div>
                </div>
            </div>

 

    </div>
@endsection
@push('script')
<script>
    $(".type_link").click(function(e) {
        e.preventDefault();
        $(".type_link").removeClass('active');
        $(".investor_form").addClass('d-none');
        $(this).addClass('active');

        let form_id = this.id;
        console.log(form_id)
        if (form_id === 'personal-link') {
            $("#personal-form").removeClass('d-none').addClass('active');
            $("#company-form").removeClass('active').addClass('d-none');
        } else if (form_id === 'company-link') {
            $("#company-form").removeClass('d-none').addClass('active');
            $("#personal-form").removeClass('active').addClass('d-none');
        }

    }); 
    $(document).ready(function() {
        $('#dataTable').DataTable();
    });
</script>
@endpush
