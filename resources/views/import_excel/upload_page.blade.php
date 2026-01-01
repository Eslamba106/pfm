@extends('layouts.back-end.app')

@section('title', ui_change('import_'.$file))

@section('content')
<div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-4">
            <h2 class="h1 mb-1 text-capitalize d-flex gap-2"> 
                {{ui_change('Import')}}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.import.inline-menu')

        <!-- Content Row -->
        <div class="row" style="text-align: {{Session::get('direction') === "rtl" ? 'right' : 'left'}};">
            <div class="col-12">
                <div class="card card-body">
                    <h1 class="display-5">{{ui_change('instructions')}} : </h1>
                  {!! $instructions !!}
                </div>
            </div>
            <div class="col-md-12 mt-2">
                <form class="product-form" action="{{ route('preview_'.$file) }}" method="POST"
                      enctype="multipart/form-data">
                    @csrf
                    
                    <div class="card rest-part"> 
                        <div class="px-3 py-4 d-flex flex-wrap align-items-center gap-10 justify-content-center">
                            <h4 class="mb-0">{{ui_change("do_not_have_the_template")}} ?</h4>
                            <a href="{{asset('assets/template/'.$file.'.xlsx')}}" download=""
                               class="btn-link text-capitalize fz-16 font-weight-medium">{{ui_change('download_here')}}</a>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row justify-content-center">
                                    <div class="col-auto"> 
                                        <div class="uploadDnD">

                                                <div class="form-group inputDnD input_image input_image_edit" data-title="{{ui_change('drag_&_drop_file_or_browse_file')}}">
                                                <input type="file" name="file" accept=".xlsx, .xls" class="form-control-file text--primary font-weight-bold" id="inputFile"
                                                    onchange="readUrl(this)">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-10 align-items-center justify-content-end">
                                <button type="reset" class="btn btn-secondary px-4" onclick="resetImg();">{{ui_change('reset')}}</button>
                                <button type="submit" class="btn btn--primary px-4">{{ui_change('submit')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
<script>
    // File Upload
    "use strict";

    $('.upload-file__input').on('change', function() {
        $(this).siblings('.upload-file__img').find('img').attr({
            'src': '{{asset("/public/assets/back-end/img/excel.png")}}',
            'width': 80
        });
    });

    function resetImg() {
        $('.upload-file__img img').attr({
            'src': '{{asset("/public/assets/back-end/img/drag-upload-file.png")}}',
            'width': 'auto'
        });
    }

    function readUrl(input) {
        if (input.files && input.files[0]) {
            let reader = new FileReader();
            reader.onload = (e) => {
                let imgData = e.target.result;
                let imgName = input.files[0].name;
                input.closest('[data-title]').setAttribute("data-title", imgName);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endpush

