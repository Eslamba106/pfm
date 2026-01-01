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
                            <div class="form-group">
                                <label class="title-color" for="name">{{ ui_change('name'   , 'property_master')  }}<span
                                        class="text-danger">*</span> </label>
                                <input type="text" name="name" class="form-control" value="{{ $main->name }}"
                                    placeholder="{{ ui_change('enter_' . $route . '_name', 'property_master')  }}">
                            </div>
                            @if ($code_status == 'yes')
                                <div class="form-group">
                                    <label class="title-color" for="code">
                                        {{ ui_change('code'   , 'property_master')   }}
                                    </label>
                                    <div class="input-group">
                                        <input type="text" name="code" class="form-control"
                                            value="{{ $main->code }}"
                                            placeholder="{{ ui_change('enter_' . $route . '_code'   , 'property_master')   }}">

                                    </div>
                                </div>
                            @endif
                            @if ($description == 'yes')
                                <div class="form-group">
                                    <label class="title-color" for="description">
                                        {{ ui_change('description'   , 'property_master')  }}
                                    </label>
                                    <div class="input-group">
                                        <textarea name="description" class="form-control" cols="30" rows="3">{{ $main->description }}</textarea>
                                    </div>
                                </div>
                            @endif
                            @if ($department == 'yes')
                            @php
                                $departments = App\Models\Department::get();
                            @endphp
                                <div class="form-group">
                                    <label class="title-color" for="description">
                                        {{ ui_change('all_departments'   , 'property_master') }}
                                    </label>
                                    <select class="js-select2-custom form-control" name="department_id" required>
                                        <option selected>{{ ui_change('select'   , 'property_master')  }}
                                        </option>
                                        @foreach ($departments as $department_item)
                                            <option value="{{ $department_item->id }}" {{ ($main->department_id == $department_item->id) ? 'selected' : '' }}>
                                                {{ $department_item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            @if ($complaint_type == 'yes')
                            @php
                                $complaint_categories = App\Models\ComplaintCategory::get();
                            @endphp
                                <div class="form-group">
                                    <label class="title-color" for="description">
                                        {{ ui_change('complaint_category'   , 'property_master')  }}
                                    </label>
                                    <select class="js-select2-custom form-control" name="complaint_category_id" required>
                                        <option selected>{{ ui_change('select'   , 'property_master') }}
                                        </option>
                                        @foreach ($complaint_categories as $complaint_category_item)
                                            <option value="{{ $complaint_category_item->id }}" {{ ($main->complaint_category_id == $complaint_category_item->id) ? 'selected' : '' }}>
                                                {{ $complaint_category_item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            @if ($route == 'unit_type')
                                @php
                                    $unit_descriptions = App\Models\UnitDescription::select('id' , 'name')->get();
                                @endphp
                                <div class="form-group">
                                    <label class="title-color" for="description">
                                        {{ ui_change('unit_descriptions'   , 'property_master')  }}
                                    </label>
                                    <select class="js-select2-custom form-control" name="unit_description_id" required>
                                        <option selected>{{ ui_change('select'   , 'property_master')  }}
                                        </option>
                                        @foreach ($unit_descriptions as $unit_description_item)
                                            <option value="{{ $unit_description_item->id }}" {{ ($main->unit_description_id == $unit_description_item->id) ? 'selected' : '' }}>
                                                {{ $unit_description_item->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            @if ($route == 'priority')
                            <div class="form-group">
                                <label class="title-color" for="time">
                                    {{ ui_change('time_frame'   , 'property_master')  }}
                                </label>
                                <div class="input-group">
                                    <input type="number" name="time" class="form-control"
                                        placeholder="{{ ui_change('enter_' . $route . 'time_frame'   , 'property_master') }}" value="{{ $main->time }}">

                                </div>
                            </div>
                            @endif
                            <div class="form-group">
                                <label class="title-color" for="status">
                                    {{ ui_change('status'   , 'property_master') }}
                                </label>
                                <div class="input-group">
                                    <input type="radio" name="status" class="mr-3 ml-3"
                                        @if ($main->status == 'active') checked @endif value="active">
                                    <label class="title-color" for="status">
                                        {{ ui_change('active'   , 'property_master') }}
                                    </label>
                                    <input type="radio" name="status" class="mr-3 ml-3"
                                        @if ($main->status == 'inactive') checked @endif value="inactive">
                                    <label class="title-color" for="status">
                                        {{ ui_change('inactive'   , 'property_master') }}
                                    </label>

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
