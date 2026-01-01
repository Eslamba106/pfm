@extends('layouts.back-end.app')

@section('title', ui_change('search_unit' ,'search_unit'))
 
@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        table {
            /* width: 100%; */
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            /* background-color: #f9f9f9; */
            background-color: #efa520;
            color: white;
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


        /* enquiry search details */


        .form-container {
            background-color: #efa520;
            /* background-color: var(--secondary); #2b368f */
            padding: 20px;
            border-radius: 10px;
            /* max-width: 1200px; */
            margin: auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            flex: 1;
            min-width: 200px;
            display: flex;
            flex-direction: column;
        }

        .form-group label {

            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-group textarea {
            resize: none;
        }

        .form-group input[type="date"] {
            padding-right: 30px;
        }

        .trash-icon {
            display: flex;
            justify-content: flex-end;
            margin-top: -10px;
        }

        .trash-icon button {
            background-color: #d9534f;
            border: none;
            color: white;
            padding: 10px 15px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 16px;
        }

        .trash-icon button:hover {
            background-color: #c9302c;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header pb-0 mb-0 border-0">
            <div class="flex-between align-items-center">
                <div>
                    <h1 class="page-header-title"
                        style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                        {{ ui_change('dashboard' , 'search_unit') }}</h1>
                    <p>{{ ui_change('welcome_message' , 'search_unit') }}.</p>
                </div>
            </div>
        </div>
        <!-- End Page Header -->

        <!-- Business Analytics -->
        <div class="card mb-2 remove-card-shadow">
            <div class="card-body">
                <div class="row flex-between align-items-center g-2 mb-3">


                </div>
                <form action="{{ route('general_search_units_in_dashboard') }}" method="get">
                    <div class="row g-2" id="order_stats">
                        <div class="form-container mt-3  ">
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="building">{{ ui_change('Building' , 'search_unit') }}</label>
                                    <select id="building" name="property_id" class="js-select2-custom form-control">
                                        <option value="">{{ ui_change('Select_building' , 'search_unit') }}</option>
                                        @foreach ($buildings as $building)
                                            <option value="{{ $building->id }}">{{ $building->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="unit-description">{{ ui_change('Unit_Description' , 'search_unit') }}</label>
                                    <select id="unit-description" name="unit_description_id"
                                        class="js-select2-custom form-control">
                                        <option value="">{{ ui_change('Any' , 'search_unit') }}</option>
                                        @foreach ($unit_descriptions as $unit_description)
                                            <option value="{{ $unit_description->id }}">
                                                {{ $unit_description->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="unit-type">{{ ui_change('Unit_Type' , 'search_unit') }}</label>
                                    <select id="unit-type" name="unit_type_id" class="js-select2-custom form-control">
                                        <option value="-1">{{ ui_change('Any' , 'search_unit') }}</option>
                                        @foreach ($unit_types as $unit_type)
                                            <option value="{{ $unit_type->id }}">{{ $unit_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="unit-condition">{{ ui_change('Unit_Condition' , 'search_unit') }}</label>
                                    <select id="unit-condition" name="unit_condition_id"
                                        class="js-select2-custom form-control">
                                        <option value="">{{ ui_change('Any' , 'search_unit') }}</option>
                                        @foreach ($unit_conditions as $unit_condition)
                                            <option value="{{ $unit_condition->id }}">{{ $unit_condition->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="preferred-view">{{ ui_change('Preferred_View' , 'search_unit') }}</label>
                                    <select id="preferred-view" name="view_id" class="js-select2-custom form-control">
                                        <option value="">{{ ui_change('Any' , 'search_unit') }}</option>
                                        @foreach ($views as $view)
                                            <option value="{{ $view->id }}">{{ $view->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row justify-content-end gap-3 mt-3 mx-1">
                        <button type="submit" class="btn btn-warning px-5"><i
                                class="fa fa-search"></i>{{ ui_change('search' , 'search_unit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
 
        
    <script>
        
        $('select[name=property_id]').on('change', function() {
            var property_id = $(this).val();
            if (property_id) {
                $.ajax({
                    url: "{{ route('dashboard.get_unit_details', ':id') }}".replace(':id', property_id),
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            $('select[name="unit_description_id"]').empty();
                            $('select[name="unit_type_id"]').empty();
                            $('select[name="unit_condition_id"]').empty();
                            $('select[name="view_id"]').empty();
                            $('select[name="unit_condition_id"]').append(
                                `<option value="">Any</option>`
                            );
                        $('select[name="view_id"]').append(
                                `<option value="">Any</option>`
                            );
                        $('select[name="unit_type_id"]').append(
                                `<option value="">Any</option>`
                            );
                        $('select[name="unit_description_id"]').append(
                                `<option value="">Any</option>`
                            );
                            data.unit_conditions.forEach(function(unit_condition) {
                                $('select[name="unit_condition_id"]').append(
                                    `<option value="${unit_condition.id}">${unit_condition.name}</option>`
                                );
                            });
                            data.unit_view.forEach(function(view) {
                                $('select[name="view_id"]').append(
                                    `<option value="${view.id}">${view.name}</option>`
                                );
                            });
                            data.unit_types.forEach(function(unit_type) {
                                $('select[name="unit_type_id"]').append(
                                    `<option value="${unit_type.id}">${unit_type.name}</option>`
                                );
                            });
                            data.unit_descriptions.forEach(function(desc) {
                                $('select[name="unit_description_id"]').append(
                                    `<option value="${desc.id}">${desc.name}</option>`
                                );
                            });
                           

                        } else {}
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error , status);
                    }
                });
            }
        })
        $('select[name=unit_description_id]').on('change', function() {
            var property_id= $('select[name=property_id]').val();
            var unit_description_id = $(this).val();

            if (property_id) {
                $.ajax({
                    url: "{{ route('dashboard.get_unit_details', ':id') }}".replace(':id', property_id),
                    type: "GET",
                    data:   {
                        'unit_description_id': unit_description_id
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            // $('select[name="unit_description_id"]').empty();
                            $('select[name="unit_type_id"]').empty();
                            $('select[name="unit_condition_id"]').empty();
                            $('select[name="view_id"]').empty();
                            $('select[name="unit_condition_id"]').append(
                                `<option value="">Any</option>`
                            );
                        $('select[name="view_id"]').append(
                                `<option value="">Any</option>`
                            );
                        $('select[name="unit_type_id"]').append(
                                `<option value="">Any</option>`
                            );
                        // $('select[name="unit_description_id"]').append(
                        //         `<option value="">Any</option>`
                        //     );
                        data.unit_types.forEach(function(unit_type) {
                                $('select[name="unit_type_id"]').append(
                                    `<option value="${unit_type.id}">${unit_type.name}</option>`
                                );
                            });
                            data.unit_conditions.forEach(function(unit_condition) {
                                $('select[name="unit_condition_id"]').append(
                                    `<option value="${unit_condition.id}">${unit_condition.name}</option>`
                                );
                            });
                            data.unit_view.forEach(function(view) {
                                $('select[name="view_id"]').append(
                                    `<option value="${view.id}">${view.name}</option>`
                                );
                            });
                           
                            // data.unit_descriptions.forEach(function(desc) {
                            //     $('select[name="unit_description_id"]').append(
                            //         `<option value="${desc.id}">${desc.name}</option>`
                            //     );
                            // });
                           

                        } else {}
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            }
        })
        $('select[name=unit_type_id]').on('change', function() {
            var property_id= $('select[name=property_id]').val();
            var unit_type_id = $(this).val();
            var unit_description_id= $('select[name=unit_description_id]').val();

            if (property_id) {
                $.ajax({
                    url: "{{ route('dashboard.get_unit_details', ':id') }}".replace(':id', property_id),
                    type: "GET",
                    data:   {
                        'unit_description_id': unit_description_id,
                        'unit_type_id': unit_type_id,

                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            // $('select[name="unit_description_id"]').empty();
                            // $('select[name="unit_type_id"]').empty();
                            $('select[name="unit_condition_id"]').empty();
                            $('select[name="view_id"]').empty();
                            $('select[name="unit_condition_id"]').append(
                                `<option value="">Any</option>`
                            );
                        $('select[name="view_id"]').append(
                                `<option value="">Any</option>`
                            );
                        $('select[name="unit_type_id"]').append(
                                `<option value="">Any</option>`
                            );
                        $('select[name="unit_description_id"]').append(
                                `<option value="">Any</option>`
                            );
                            data.unit_conditions.forEach(function(unit_condition) {
                                $('select[name="unit_condition_id"]').append(
                                    `<option value="${unit_condition.id}">${unit_condition.name}</option>`
                                );
                            });
                            data.unit_view.forEach(function(view) {
                                $('select[name="view_id"]').append(
                                    `<option value="${view.id}">${view.name}</option>`
                                );
                            });
                            // data.unit_types.forEach(function(unit_type) {
                            //     $('select[name="unit_type_id"]').append(
                            //         `<option value="${unit_type.id}">${unit_type.name}</option>`
                            //     );
                            // });
                            // data.unit_descriptions.forEach(function(desc) {
                            //     $('select[name="unit_description_id"]').append(
                            //         `<option value="${desc.id}">${desc.name}</option>`
                            //     );
                            // });
                           

                        } else {}
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            }
        })
        $('select[name=unit_condition_id]').on('change', function() {
            var property_id= $('select[name=property_id]').val();
            var unit_type_id= $('select[name=unit_type_id]').val();
            var unit_description_id= $('select[name=unit_description_id]').val();
            var unit_condition_id = $(this).val();

            if (property_id) {
                $.ajax({
                    url: "{{ route('dashboard.get_unit_details', ':id') }}".replace(':id', property_id),
                    type: "GET",
                    data:   {
                        'unit_condition_id': unit_condition_id,
                        'unit_description_id': unit_description_id,
                        'unit_type_id': unit_type_id,
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data) {
                            // $('select[name="unit_description_id"]').empty();
                            // $('select[name="unit_type_id"]').empty();
                            // $('select[name="unit_condition_id"]').empty();
                            $('select[name="view_id"]').empty();
                            // $('select[name="unit_condition_id"]').append(
                            //     `<option value="">Any</option>`
                            // );
                        
                        // $('select[name="unit_type_id"]').append(
                        //         `<option value="">Any</option>`
                        //     );
                        // $('select[name="unit_description_id"]').append(
                        //         `<option value="">Any</option>`
                        //     );
                            // data.unit_conditions.forEach(function(unit_condition) {
                            //     $('select[name="unit_condition_id"]').append(
                            //         `<option value="${unit_condition.id}">${unit_condition.name}</option>`
                            //     );
                            // });
                            data.unit_view.forEach(function(view) {
                                $('select[name="view_id"]').append(
                                    `<option value="${view.id}">${view.name}</option>`
                                );
                            });
                            // data.unit_types.forEach(function(unit_type) {
                            //     $('select[name="unit_type_id"]').append(
                            //         `<option value="${unit_type.id}">${unit_type.name}</option>`
                            //     );
                            // });
                            // data.unit_descriptions.forEach(function(desc) {
                            //     $('select[name="unit_description_id"]').append(
                            //         `<option value="${desc.id}">${desc.name}</option>`
                            //     );
                            // });
                           

                        } else {}
                    },
                    error: function(xhr, status, error) {
                        console.error('Error occurred:', error);
                    }
                });
            }
        })
    </script>
{{-- <script>
    $('select[name=property_id]').on('change', function() {
        var property_id = $(this).val();
        if (property_id) {
            $.ajax({
                url: "{{ route('get_unit_details', ':id') }}".replace(':id', property_id),
                type: "GET",
                dataType: "json",
                success: function(data) {
                    if (data) {
                        $('select[name="unit_description_id"]').empty();
                        $('select[name="unit_type_id"]').empty();
                     
                        $('select[name="unit_type_id"]').append(
                                `<option value="">Any</option>`
                            );
                        $('select[name="unit_description_id"]').append(
                                `<option value="">Any</option>`
                            );
                         
                         
</script> --}}
@endpush