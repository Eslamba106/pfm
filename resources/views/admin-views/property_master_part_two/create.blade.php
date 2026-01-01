@extends('layouts.back-end.app')
@section('title', ui_change('add_new_floor' , 'property_master'))
@php
    $lang = Session::get('locale');
@endphp
@push('css_or_js')
    <link href="{{ asset('assets/back-end') }}/css/select2.min.css" rel="stylesheet" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                {{-- <img width="50" src="{{ asset('/assets/back-end/img/floors.png') }}" alt=""> --}}
                {{ ui_change('add_new_floor' , 'property_master') }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.property_master.inline-menu')

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body" style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                        {{-- <form action="" method="post" enctype="multipart/form-data">
                            @csrf --}}

                            <ul class="nav nav-tabs w-fit-content mb-4">
                                <li class="nav-item">
                                    <a class="nav-link type_link active" href="#"
                                        id="single-link">{{ ui_change('single' , 'property_master') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link type_link " href="#"
                                        id="multiple-link">{{ ui_change('multiple' , 'property_master') }}</a>
                                </li>
                            </ul>
                            <div class="row">

                                <div class="col-md-12 floor_form single-form" id="single-form">
                                    <form action="{{ route('floor.floor_single') }}" method="post">
                                        @csrf
                                        @include('includes.property_master.floor_single')
                                    </form>
                                </div>
                                <div class="col-md-12 floor_form d-none multiple-form" id="multiple-form">
                                    <form action="{{ route('floor.floor_multiple') }}" method="get">
                                        @csrf
                                        @include('includes.property_master.floor_multiple')
                                    </form>
                                </div>
                            </div>

                                {{-- <style>
                                    .custom-shadow-gray {
                                        box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
                                    }
                                </style>
                                <div class="container mt-3 bg-secondary  text-white custom-shadow-gray rounded">
                                    <div class="bg-success-subtle p-3 rounded">
                                        <span class="fw-bold">Floor No. Pre-fill With Zero :</span>
                                        <span class="text-danger">No</span>

                                        <span class="fw-bold ms-3">Digits :</span>
                                        <span class="text-danger">Not Available</span>

                                        <span class="fw-bold ms-3">Start Floor No. :</span>
                                        <span>2</span>

                                        <span class="fw-bold ms-3">End Floor No. :</span>
                                        <span>3</span>

                                        <span class="fw-bold ms-3">Floor Code Pre-fix :</span>
                                        <span class="text-danger">No</span>

                                        <span class="fw-bold ms-3">Status :</span>
                                        <span class="text-success">Active</span>
                                    </div>
                                </div> --}}
                                <style>
                                    /* إضافة ظل خفيف */
                                    .custom-shadow {
                                        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
                                    }
                                    /* تخصيص لون الخلفية */
                                    /* .bg-light-green {
                                        background-color: ;
                                    } */
                                </style>
                              {{-- <div class="container mt-3">
                                <div class="p-2 bg-primary text-white custom-shadow rounded">
                                    <div class="bg-success-subtle p-2 rounded">
                                        <span class="fw-bold">Floor No. Pre-fill With Zero :</span>
                                        <span class="text-danger">No</span>
                                        <span class="fw-bold ms-3">Digits :</span>
                                        <span class="text-danger">Not Available</span>
                                        <span class="fw-bold ms-3">Start Floor No. :</span>
                                        <span>2</span>
                                        <span class="fw-bold ms-3">End Floor No. :</span>
                                        <span>3</span>
                                        <span class="fw-bold ms-3">Floor Code Pre-fix :</span>
                                        <span class="text-danger">No</span>
                                        <span class="fw-bold ms-3">Status :</span>
                                        <span class="text-success">Active</span>
                                    </div>
                                </div>

                                <div class="p-3 bg-primary text-white custom-shadow rounded mt-4">
                                    <label class="fw-bold mb-2">Floor Names: <span class="text-danger">*</span></label>
                                    <div class="row g-2">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="2" placeholder="Enter Floor Name">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="3" placeholder="Enter Floor Name">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="4" placeholder="Enter Floor Name">
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        {{-- </form> --}}
                    </div>
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
            $(".floor_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            console.log(form_id)
            if (form_id === 'single-link') {
                $("#single-form").removeClass('d-none').addClass('active');
                $("#multiple-form").removeClass('active').addClass('d-none');
            } else if (form_id === 'multiple-link') {
                $("#multiple-form").removeClass('d-none').addClass('active');
                $("#single-form").removeClass('active').addClass('d-none');
            }

        });
        $(".prefix_link").click(function() {
            $(".prefix_input").addClass('d-none');
            if ($(this).attr('id') === "active") {
                $(".prefix_input").removeClass('d-none');
            }
        });
        $(".prefix_link_name").click(function() {
            $(".prefix_input_name").addClass('d-none');
            if ($(this).attr('id') === "active") {
                $(".prefix_input_name").removeClass('d-none');
            }
        });
        $(".fill_zero_link").click(function() {
            $(".fill_zero_link_input").addClass('d-none');
            if ($(this).attr('id') === "active") {
                $(".fill_zero_link_input").removeClass('d-none');
            }
        });

        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
    <script src="{{ asset('assets/back-end') }}/js/select2.min.js"></script>
    <script>
        $(".js-example-theme-single").select2({
            theme: "classic"
        });

        $(".js-example-responsive").select2({
            width: 'resolve'
        });
    </script>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#viewer').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#customFileUpload").change(function() {
            readURL(this);
        });


        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            Swal.fire({
                title: "{{ ui_change('are_you_sure?' , 'property_master') }}",
                text: "{{ ui_change('you_will_not_be_able_to_revert_this'  , 'property_master')}}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: '{{ ui_change('cancel'  , 'property_master')}}',
                confirmButtonText: '{{ ui_change('yes_delete_it'  , 'property_master')}}!'
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route('floor.delete') }}",
                        method: 'POST',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success('{{ ui_change('brand_deleted_successfully'  , 'property_master')}}');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
