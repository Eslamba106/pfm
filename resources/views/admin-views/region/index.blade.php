@extends('layouts.back-end.app')
@section('title', ui_change('regions' , 'hierarchy'))
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
            {{-- <img width="60" src="{{asset('/public/assets/back-end/img/regions.jpg')}}" alt=""> --}}
            {{ui_change('regions' , 'hierarchy')}}
        </h2>
    </div>
    <!-- End Page Title -->
    @include('admin-views.inline_menu.hierarchy.inline-menu')

    <!-- Content Row -->
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header">
                    {{ ui_change('add_new_region' , 'hierarchy')}}
                </div>
                <div class="card-body" style="text-align: {{ Session::get('locale') === "ar" ? 'right' : 'left'}};">
                    <form action="{{route('region.store')}}" method="post">
                        @csrf

                        <div class="form-group" >
                            <input type="hidden" id="id">
                            <label class="title-color" for="name">{{ ui_change('region_name' , 'hierarchy')}}<span class="text-danger"> *</span>  </label>
                            <input type="text" name="name" class="form-control"
                                   placeholder="{{ui_change('enter_region_name' , 'hierarchy')}}" >
                        </div>
                        <div class="form-group" >
                            <input type="hidden" id="id">
                            <label class="title-color" for="name">{{ ui_change('region_code' , 'hierarchy')}}<span class="text-danger"> *</span>  </label>
                            <input type="text" name="code" class="form-control"
                                   placeholder="{{ui_change('enter_region_code' , 'hierarchy')}}" >
                        </div>


                        <div class="d-flex flex-wrap gap-2 justify-content-end">
                            <button type="reset" class="btn btn-secondary">{{ui_change('reset' , 'hierarchy')}}</button>
                            <button type="submit" class="btn btn--primary">{{ui_change('submit' , 'hierarchy')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="px-3 py-4">
                    <div class="row align-items-center">
                            <div class="col-sm-4 col-md-6 col-lg-8 mb-2 mb-sm-0">
                                <h5 class="mb-0 d-flex align-items-center gap-2">{{ ui_change('region_list' , 'hierarchy')}}
                                    <span class="badge badge-soft-dark radius-50 fz-12"> </span>
                                </h5>
                            </div>
                            <div class="col-sm-8 col-md-6 col-lg-4">
                                <!-- Search -->
                                <form action="{{ url()->current() }}" method="GET">
                                    <div class="input-group input-group-custom input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-search"></i>
                                            </div>
                                        </div>
                                        <input id="datatableSearch_" type="search" name="search" class="form-control"
                                            placeholder="{{ ui_change('search_by_region_name' , 'hierarchy') }}" aria-label="Search" value="{{ $search }}" required>
                                        <button type="submit" class="btn btn--primary">{{ ui_change('search' , 'hierarchy')}}</button>
                                    </div>
                                </form>
                                <!-- End Search -->
                            </div>
                        </div>
                </div>
                <div style="text-align: {{Session::get('locale') === "ar" ? 'right' : 'left'}};">
                    <div class="table-responsive">
                        <table id="datatable"
                               class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                            <thead class="thead-light thead-50 text-capitalize">
                                <tr>
                                    <th>{{ ui_change('sl' , 'hierarchy')}}</th>
                                    <th class="text-center">{{ ui_change('region_name' , 'hierarchy') }} </th>
                                    <th class="text-center">{{ ui_change('region_code' , 'hierarchy')}} </th>
                                    <th class="text-center">{{ ui_change('actions' , 'hierarchy')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($regions as $key => $region)
                                <tr>
                                    <td>{{$regions->firstItem()+$key}}</td>
                                    <td class="text-center">{{ ($region->name)}}</td>
                                    <td class="text-center">{{ ($region->code)}}</td>
                                    <td>
                                       <div class="d-flex justify-content-center gap-2">
                                            <a class="btn btn-outline-info btn-sm square-btn"
                                                title="{{ ui_change('general.edit' , 'hierarchy')}}"
                                                href="{{ route('region.edit' , $region->id) }}">
                                                <i class="tio-edit"></i>
                                            </a>
                                            <a class="btn btn-outline-danger btn-sm delete square-btn"
                                                title="{{ ui_change('delete' , 'hierarchy')}}"
                                                id="{{ $region['id'] }}">
                                                <i class="tio-delete"></i>
                                            </a>
                                       </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="table-responsive mt-4">
                    <div class="d-flex justify-content-lg-end">
                        <!-- Pagination -->
                        {!! $regions->links() !!}
                    </div>
                </div>

                @if(count($regions)==0)
                    <div class="text-center p-4">
                        <img class="mb-3 w-160" src="{{asset('assets/back-end')}}/svg/illustrations/sorry.svg" alt="Image Description">
                        <p class="mb-0">{{ ui_change('general.no_data_to_show' , 'hierarchy')}}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')

    <script>
        $(document).on('click', '.delete', function () {
            var id = $(this).attr("id");
            Swal.fire({
                title: "{{ui_change('are_you_sure_delete_this' , 'hierarchy')}}",
                text: "{{ui_change('you_will_not_be_able_to_revert_this' , 'hierarchy')}}!",
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '{{ui_change('yes_delete_it' , 'hierarchy')}}!',
                cancelButtonText: '{{ ui_change("cancel" , 'hierarchy') }}',
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
                        url: "{{ route('region.delete') }}",
                        method: 'get',
                        data: {id: id},
                        success: function () {
                            toastr.success('{{ui_change('deleted_successfully' , 'hierarchy')}}');
                            location.reload();
                        }
                    });
                }
            })
        });



         // Call the dataTables jQuery plugin


    </script>
@endpush
