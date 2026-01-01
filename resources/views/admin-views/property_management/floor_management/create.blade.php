@extends('layouts.back-end.app')
@section('title', ui_change('create_floor_management', 'property_config'))
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

        .floor-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .floor-item {
            display: flex;
            align-items: center;
            background-color: #f5f5dc;
            padding: 10px 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .floor-item input[type="checkbox"] {
            margin-right: 10px;
        }

        .floor-item:hover {
            background-color: #e0e0d1;
        }

        .floor-title {
            font-size: 18px;
            margin-bottom: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">
                {{ ui_change('create_floor_management', 'property_config') }}
            </h2>
        </div>
        <!-- End Page Title -->
        @include('admin-views.inline_menu.property_config.inline-menu')


        <form class="product-form text-start" id="myForm" action="{{ route('floor_management.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <!-- general setup -->
            <div class="card mt-3 rest-part">
                <div class="card-header">
                    <div class="d-flex gap-2">
                        <h4 class="mb-0">{{ ui_change('create_floor_management', 'property_config') }}</h4>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">

                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ ui_change('property', 'property_config') }}
                                </label>
                                <select class="js-select2-custom form-control" name="property" required>
                                    <option selected disabled>{{ ui_change('select', 'property_config') }}
                                    </option>
                                    @foreach ($property as $property_item)
                                        <option value="{{ $property_item->id }}">
                                            {{ $property_item->name . ' - ' . $property_item->code }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="name" class="title-color">{{ ui_change('blocks', 'property_config') }}
                                </label>
                                <select class="js-select2-custom form-control" name="block" required disabled>
                                    <option selected>{{ ui_change('select', 'property_config') }}
                                    </option>
                                    @foreach ($blocks as $block_item)
                                        <option value="{{ $block_item->id }}">
                                            {{ $block_item->name . ' - ' . $block_item->code }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="token"
                                    class="title-color">{{ ui_change('Total_No._Floor*', 'property_config') }}</label>
                                <input type="text" class="form-control" name="floor_count">
                            </div>
                        </div>

                        <div class="col-md-6 col-lg-4 col-xl-12 floors  ">
                            <div class="floor-title">{{ ui_change('floors', 'property_config') }}</div>
                            <div class="floor-container">
                                @foreach ($floors as $floor_item)
                                    <label class="floor-item">
                                        <input type="checkbox" name="floors[]" value="{{ $floor_item->id }}">
                                        {{ $floor_item->name . ' - ' . $floor_item->code }}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="row justify-content-end gap-3 mt-3 mx-1">
                <button type="reset" class="btn btn-secondary px-5">{{ ui_change('reset', 'property_config') }}</button>
                <button type="submit" class="btn btn--primary px-5">{{ ui_change('submit', 'property_config') }}</button>
            </div>
        </form>

    </div>
@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $('select[name="property"]').on('change', function() {
                var property = $(this).val();
                if (property) {
                    $.ajax({
                        url: "{{ URL::to('floor_management/get_blocks_by_property_id') }}/" +
                            property,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('select[name="block"]').removeAttr('disabled');
                                console.log(data);
                                $('select[name="block"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="block"]').append(
                                        '<option value="' + value.id + '">' + value
                                        .block.name + ' - ' + value.block.code +
                                        '</option>'
                                    )
                                })

                            } else {}
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                        }
                    });
                }

            });

            $('input[name="floor_count"]').on('keyup', function() {
                var count = parseInt($(this).val());
                $('.floors').removeClass('d-none');

                $('input[name="floors[]"]').each(function(index) {
                    if (index < count) {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                });
            });

        });
    </script>

    <script>
        $(document).ready(function() {
            $('input[name="floor_count"]').on('keyup', function() {
                const $floorCountInput = $('input[name="floor_count"]');
                const $floorCheckboxes = $('input[name="floors[]"]');
                const $myForm = $('#myForm');

                function updateCheckboxStates() {
                    const maxFloors = parseInt($floorCountInput.val()) || 0;
                    const checkedCount = $floorCheckboxes.filter(':checked').length;

                    $floorCheckboxes.each(function() {
                        $(this).prop('disabled', checkedCount >= maxFloors && !$(this).prop(
                            'checked'));
                    });
                }

                $floorCountInput.on('input', updateCheckboxStates);
                $floorCheckboxes.on('change', updateCheckboxStates);

                $myForm.on('submit', function(event) {
                    const minFloors = parseInt($floorCountInput.val()) || 0;
                    const checkedCount = $floorCheckboxes.filter(':checked').length;

                    if (checkedCount < minFloors) {
                        event.preventDefault();
                        alert(
                            'You must select a number of floors no less than the total number specified.'
                        );
                        return false;
                    }
                    return true;
                });
                updateCheckboxStates();
            });
        });
        // $(document).ready(function() {
        //     $('input[name="floor_count"]').on('keyup', function() {
        //     const $floorCountInput = $('input[name="floor_count"]');
        //     const $floorCheckboxes = $('input[name="floors[]"]');

        //     function updateCheckboxStates() {
        //         const maxFloors = parseInt($floorCountInput.val()) || 0;
        //         const checkedCount = $floorCheckboxes.filter(':checked').length; 
        //         $floorCheckboxes.each(function() {
        //             $(this).prop('disabled', checkedCount >= maxFloors && !$(this).prop('checked'));
        //         });
        //     }

        //     $floorCountInput.on('input', updateCheckboxStates);
        //     $floorCheckboxes.on('change', updateCheckboxStates); 
        //     updateCheckboxStates();

        // });
        // });
    </script>
    {{-- <script>
    </script>
        $(document).ready(function() {
            $('select[name="property"]').on('change', function() {
                var property = $(this).val();
                if (property) {
                    $.ajax({
                        url: "{{ URL::to('floor_management/get_blocks_by_property_id') }}/" +
                            property,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            if (data) {
                                $('select[name="block"]').removeAttr('disabled');
                                console.log(data);
                                $('select[name="block"]').empty();
                                $.each(data, function(key, value) {
                                    $('select[name="block"]').append(
                                        '<option value="' + value.id + '">' + value
                                        .block.name + ' - ' + value.block.code +
                                        '</option>'
                                    )
                                })

                            } else {
                                // $('input[name="token"]').removeAttr('disabled')
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error occurred:', error);
                            // $('input[name="token"]').removeAttr('disabled')
                            //
                        }
                    });
                }

            });

            // $('input[name="floor_count"]').on('keyup', function() {
            //     var count = $(this).val();
            //     var floors = $('.floors');
            //     $('.floors').removeClass('d-none');
            //     $('input[name="floors[]"]').each(floors, function());
            // })
            $('input[name="floor_count"]').on('keyup', function() {
                var count = parseInt($(this).val());
                $('.floors').removeClass('d-none');

                $('input[name="floors[]"]').each(function(index) {
                    if (index < count) {
                        $(this).prop('checked', true);
                    } else {
                        $(this).prop('checked', false);
                    }
                });
            });

        });
    </script>
    <script>
       $(document).ready(function() {
    const $floorCountInput = $('input[name="floor_count"]');
    const $floorCheckboxes = $('input[name="floors[]"]');

    function updateCheckboxStates() {
        const maxFloors = parseInt($floorCountInput.val()) || 0;
        const checkedCount = $floorCheckboxes.filter(':checked').length;

        $floorCheckboxes.each(function() {
            $(this).prop('disabled', checkedCount > maxFloors && !$(this).prop('checked'));
        });
    }

    $floorCountInput.on('input', updateCheckboxStates);
    $floorCheckboxes.on('change', updateCheckboxStates);

    // قم بتنفيذ التحديث الأولي في حالة وجود قيم محددة بالفعل عند التحميل
    updateCheckboxStates();
}); --}}
    {{-- </script> --}}
@endpush
