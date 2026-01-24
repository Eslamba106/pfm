@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
@endphp
@section('title',  ui_change($route , 'property_master') )
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('public/assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('public/assets/back-end/css/croppie.css') }}" rel="stylesheet">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 d-flex gap-2">
                {{-- <img width="60" src="{{ asset('/public/assets/back-end/img/' . $route . '.jpg') }}" alt=""> --}}
                {{  ui_change($route , 'property_master')  }}
            </h2>
        </div>
        <!-- End Page Title -->
        @php
        $currentUrl = url()->current();
        $segments = explode('/', $currentUrl);
        $last = end($segments);
        $facility_masters = ['department' , 'complaint_category','freezing' ,'main_complaint' ,'employee_type','priority' , 'asset_group', 'work_status']
    @endphp
    @if (in_array($last ,$facility_masters ))
    @include('admin-views.inline_menu.facility_master.inline-menu')

    @else
        
    @include('admin-views.inline_menu.property_master.inline-menu')
    @endif
        <!-- Content Row -->
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-header">
                        {{ ui_change('edit_' . $route , 'property_master')  }}
                    </div>
                    <div class="card-body" style="text-align: {{ $lang === 'ar' ? 'right' : 'left' }};">
                        <form action="{{ route($route . '.update', $main->id) }}" method="post">
                            @csrf
                            @method('patch')
                            
                           <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <input type="hidden" id="id">
                                        <label class="title-color"
                                            for="name">{{ ui_change('name', 'property_master') }}<span
                                                class="text-danger"> *</span> </label>
                                        <input type="text" name="name" class="form-control" value="{{ $main->name }}"
                                            placeholder="{{ ui_change('enter_' . $route . '_name', 'property_master') }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group"> 
                                        <label class="title-color"
                                            for="name">{{ ui_change('percentage', 'property_master') }} %<span
                                                class="text-danger"> *</span> </label>
                                        <input type="number" name="percentage" class="form-control" value="{{ $main->percentage }}"
                                            placeholder="{{ ui_change('enter_' . $route . '_percentage', 'property_master') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap gap-2 justify-content-end">
                                <button type="reset" class="btn btn-secondary">{{ ui_change('reset'   , 'property_master') }}</button>
                                <button type="submit" class="btn btn--primary">{{ ui_change('submit'   , 'property_master') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

@push('script')
    <script>
        $(document).on('click', '.delete', function() {
            var id = $(this).attr("id");
            // var route_name = document.getElementById('route_name').value;
            Swal.fire({
                title: "{{ ui_change('are_you_sure_delete_this'   , 'property_master')  }}",
                text: "{{ ui_change('you_will_not_be_able_to_revert_this'   , 'property_master')  }}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ ui_change('yes_delete_it'   , 'property_master')  }}!',
                cancelButtonText: '{{ ui_change('cancel'   , 'property_master')  }}',
                type: 'warning',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: "{{ route($route . '.delete') }}",
                        method: 'get',
                        data: {
                            id: id
                        },
                        success: function() {
                            toastr.success('{{  ui_change('deleted_successfully' , 'property_master') }}');
                            location.reload();
                        }
                    });
                }
            })
        });



        // Call the dataTables jQuery plugin
    </script>
@endpush
