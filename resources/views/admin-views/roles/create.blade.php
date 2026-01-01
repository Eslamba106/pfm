@extends('layouts.back-end.app')


@section('title')
    {{ __('roles.roles') }}
@endsection
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('assets/back-end') }}/css/select2.min.css" rel="stylesheet" />
@endpush

@section('page_name')
    {{ __('roles.all_roles') }}
@endsection
@section('content')


    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="d-flex flex-wrap gap-2 align-items-center mb-3">
            <h2 class="h1 mb-0 d-flex align-items-center gap-2">
                <img width="20" src="{{ asset('/assets/back-end/img/brand.png') }}" alt="">
                {{ __('roles.create_role') }}
            </h2>
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-body" style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route('roles.store') }}" method="post" enctype="multipart/form-data">
                            @csrf


                            {{-- <section class="section"> --}}

                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-6">

                                    @if (empty($role))
                                        <div class="form-group @error('name') is-invalid @enderror">
                                            <label>{{ trans('roles.name') }}</label>
                                            <input type="text" name="name" class="form-control"
                                                value="{{ !empty($role) ? $role->name : old('name') }}" placeholder="" />
                                        </div>

                                        @error('name')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    @endif

                                    <div class="form-group @error('caption') is-invalid @enderror">
                                        <label>{{ trans('roles.Caption') }}</label>
                                        <input type="text" name="caption" class="form-control"
                                            value="{{ !empty($role) ? $role->caption : old('caption') }}" placeholder="" />

                                        @error('caption')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>



                                </div>
                            </div>


                            <div class="form-group" id="sections">
                                <div class="mt-3"></div>
                                <div class="row">
                                    @foreach ($sections as $section)
                                        <div
                                            class="section-card is_{{ $section->type }} col-12 col-md-6 col-lg-4 {{ (!empty($role) and $role->is_admin and $section->type == 'panel') ? 'd-none' : '' }} {{ (!empty($role) and !$role->is_admin and $section->type == 'admin') ? 'd-none' : '' }} {{ (empty($role) and $section->type == 'admin') ? 'd-none' : '' }}">
                                            <div class="card card-primary section-box">
                                                <div class="card-header">
                                                    <input type="checkbox" name="permissions[]"
                                                        id="permissions_{{ $section->id }}" value="{{ $section->id }}"
                                                        {{ isset($permissions[$section->id]) ? 'checked' : '' }}
                                                        class="form-check-input mt-0 section-parent">
                                                    <label
                                                        class="form-check-label font-16 font-weight-bold cursor-pointer {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                                        for="permissions_{{ $section->id }}">
                                                        {{ __('roles.' . $section->caption) }}
                                                    </label>
                                                </div>

                                                @if (!empty($section->children))
                                                    <div class="card-body ">

                                                        @foreach ($section->children as $key => $child)
                                                            <div class="form-check mt-1">
                                                                <input type="checkbox" name="permissions[]"
                                                                    id="permissions_{{ $child->id }}"
                                                                    value="{{ $child->id }}"
                                                                    {{ isset($permissions[$child->id]) ? 'checked' : '' }}
                                                                    class="form-check-input section-child">
                                                                <label
                                                                    class="form-check-label cursor-pointer mt-0 {{ session()->get('locale') == 'en' ? '' : 'mr-4' }}"
                                                                    for="permissions_{{ $child->id }}">
                                                                    {{ __('roles.' . $child->caption) }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                {{-- @endcan --}}
                            </div>

                            @php
                                $lang = Session::get('locale');
                                $default_lang = 'ar';
                            @endphp


                            <div class="d-flex gap-3 justify-content-end">
                                <button type="submit" class="btn btn--primary px-4">{{ __('general.save') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="mt-5"></div>



    @if (Session::has('success'))
        <script>
            swal("Message", "{{ Session::get('success') }}", 'success', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
    @if (Session::has('info'))
        <script>
            swal("Message", "{{ Session::get('info') }}", 'info', {
                button: true,
                button: "Ok",
                timer: 3000,
            })
        </script>
    @endif
@endsection
@push('script')
    <script src="{{ asset('js/roles.min.js') }}"></script>

    <script>
        $(".lang_link").click(function(e) {
            e.preventDefault();
            $(".lang_link").removeClass('active');
            $(".lang_form").addClass('d-none');
            $(this).addClass('active');

            let form_id = this.id;
            let lang = form_id.split("-")[0];

            $("#" + lang + "-form").removeClass('d-none');
            if (lang == '{{ $default_lang }}') {
                $(".from_part_2").removeClass('d-none');
            } else {
                $(".from_part_2").addClass('d-none');
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
                title: '{{ __('are_you_sure?') }}',
                text: "{{ __('you_will_not_be_able_to_revert_this') }}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: '{{ __('cancel') }}',
                confirmButtonText: '{{ __('yes_delete_it') }}!'
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
                            id: id
                        },
                        success: function() {
                            toastr.success('{{ __('general.deleted_successfully') }}');
                            location.reload();
                        }
                    });
                }
            })
        });
    </script>
@endpush
