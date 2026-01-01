@extends('errors::minimal')

{{--@section('title', __('Not Found'))
@section('code', '404')--}}

@section('message')
    <style>
        .for-margin {
            margin: auto;

            margin-bottom: 10%;
        }

        .for-margin {

        }

        .page-not-found {
            margin-top: 30px;
            font-weight: 600;
            text-align: center;
        }
        .bg-light-blue{
            background-color: #1B7FED !important;
            border: none
        }
    </style>
    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-12">
                <img style="" src="{{asset(main_path()."back-end/img/404-logo.svg")}}" alt="">
                <h2 class="page-not-found">{{__('general.page_Not_found')}}</h2>

                <p style="text-align: center;">{{__('general.we_are_sorry')}}, {{__('general.the_page_you_requested_could_not_be_found')}} <br>
                    {{__('general.please_go_back_to_the_homepage')}}</p>
                <div style="text-align: center;">
                    <a class="btn btn--primary bg-light-blue" href="{{ route('main_dashboard') }}"> {{__('dashboard.dashboard')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
