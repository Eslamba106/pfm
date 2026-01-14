$(document).ready(function () {
    $('select[name="property"]').on('change', function () {
        var property = $(this).val();
        if (property) {
            $.ajax({
                url: "{{ URL::to('unit_management/get_blocks_by_property_id') }}/" +
                    property,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('select[name="block"]').removeAttr('disabled');

                        // $('select[name="block"]').empty();
                        $('select[name="block"]').empty().append(
                            '<option value=""  selected>{{ ui_change('select', 'property_config') }}</option>'
                        );
                        $.each(data, function (key, value) {
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
                error: function (xhr, status, error) {
                    console.error('Error occurred:', error);
                    // $('input[name="token"]').removeAttr('disabled')
                    //
                }
            });
        }

    });
    $('select[name="block"]').on('change', function () {
        var block = $(this).val();
        if (block) {
            $.ajax({
                url: "{{ URL::to('unit_management/get_floors_by_block_id') }}/" + block,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('select[name="floor"]').removeAttr('disabled');

                        $('select[name="floor"]').empty().append(
                            '<option value=""  selected>{{ ui_change('select', 'property_config') }}</option>'
                        );
                        $.each(data, function (key, value) {
                            $('select[name="floor"]').append(
                                '<option value="' + value.id +
                                '">' + value
                                    .floor_management_main.name + ' - ' + value
                                        .floor_management_main.code + '</option>'
                            )
                        })

                    } else {
                        // $('input[name="token"]').removeAttr('disabled')
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error occurred:', error);
                    // $('input[name="token"]').removeAttr('disabled')
                    //
                }
            });
        }

    });

    $('select[name="floor"]').on('change', function () {
        var floor = $(this).val();
        var block = $('select[name="block"]').val();
        var property = $('select[name="property"]').val();
        if (floor) {
            $.ajax({
                url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                    "/" + block + "/" + property,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('select[name="start_up_unit"]').removeAttr('disabled');

                        $('select[name="start_up_unit"]').empty().append(
                            '<option value=""  selected>{{ ui_change('select', 'property_config') }}</option>'
                        );
                        $.each(data, function (key, value) {
                            $('select[name="start_up_unit"]').append(
                                '<option value="' + value.id +
                                '">' + value.name + '</option>'
                            )
                        })

                    } else {
                        // $('input[name="token"]').removeAttr('disabled')
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error occurred:', error);
                    // $('input[name="token"]').removeAttr('disabled')
                    //
                }
            });
        }

    });

    $('#start_up_unit').on('change', function () {
        $('#no_of_unit').removeAttr('disabled');
    })
    $('#no_of_unit').on('change', function () {
        $('#unit_type_mode_range').removeAttr('disabled');
        $('#unit_description_mode_range').removeAttr('disabled');
        $('#unit_condition_mode_range').removeAttr('disabled');
        $('#unit_parking_mode_range').removeAttr('disabled');
        $('#view_mode_range').removeAttr('disabled');
    })
    $('#unit_type_mode_default').on('click', function () {
        $('#general_unit_type').attr('disabled', false);
        $('.unit_type').addClass('d-none');
    })
    $('#unit_description_mode_default').on('click', function () {
        $('#general_unit_description').attr('disabled', false);
        $('.unit_description').addClass('d-none');
    })
    $('#unit_condition_mode_default').on('click', function () {
        $('#general_unit_condition').attr('disabled', false);
        $('.unit_condition').addClass('d-none');
    })
    $('#unit_parking_mode_default').on('click', function () {
        $('#general_unit_parking').attr('disabled', false);
        $('.unit_parking').addClass('d-none');
    })
    $('#view_mode_default').on('click', function () {
        $('#general_view').attr('disabled', false);
        $('.view').addClass('d-none');
    })

    $('#unit_type_mode_range').on('click', function () {
        $('#general_unit_type').attr('disabled', true);
        $('.unit_type').removeClass('d-none');
        var start_up_unit = $('#start_up_unit').val();
        var unit_count = $('#no_of_unit').val();

        var floor = $('select[name="floor"]').val();
        var block = $('select[name="block"]').val();
        var property = $('select[name="property"]').val();
        if (floor) {
            $.ajax({
                url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                    "/" + block + "/" + property,
                type: "GET",
                data: {
                    "start_up_unit": start_up_unit,
                    "unit_count": unit_count
                },
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('select[name="unit_start_unit_type"]').removeAttr('disabled');

                        $('select[name="unit_start_unit_type"]').empty().append(
                            '<option value=""  selected>{{ ui_change('select', 'property_config') }}</option>'
                        );
                        $('select[name="unit_start_unit_type[]"]').empty();
                        $('select[name="unit_end_unit_type[]"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="unit_start_unit_type[]"]').append(
                                '<option value="' + value.id +
                                '">' + value.name + '</option>'
                            )
                            $('select[name="unit_end_unit_type[]"]').append(
                                '<option value="' + value.id +
                                '">' + value.name + '</option>'
                            )
                        })

                    } else {
                        // $('input[name="token"]').removeAttr('disabled')
                    }
                },
                error: function (xhr, status, error) {
                    console.error('Error occurred:', error);
                    // $('input[name="token"]').removeAttr('disabled')
                    //
                }
            });
        }


    })
    $('#unit_description_mode_range').on('click', function () {
        $('#general_unit_description').attr('disabled', true);
        $('.unit_description').removeClass('d-none');
        var start_up_unit = $('#start_up_unit').val();
        var unit_count = $('#no_of_unit').val();

        var floor = $('select[name="floor"]').val();
        var block = $('select[name="block"]').val();
        var property = $('select[name="property"]').val();
        if (floor) {
            $.ajax({
                url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                    "/" + block + "/" + property,
                type: "GET",
                data: {
                    "start_up_unit": start_up_unit,
                    "unit_count": unit_count
                },
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('select[name="unit_start_unit_description"]').removeAttr(
                            'disabled');

                        $('select[name="unit_start_unit_description"]').empty().append(
                            '<option value=""  selected>{{ ui_change('select', 'property_config') }}</option>'
                        );
                        $('select[name="unit_start_unit_description[]"]').empty();
                        $('select[name="unit_end_unit_description[]"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="unit_start_unit_description[]"]')
                                .append(
                                    '<option value="' + value.id +
                                    '">' + value.name + '</option>'
                                )
                            $('select[name="unit_end_unit_description[]"]')
                                .append(
                                    '<option value="' + value.id +
                                    '">' + value.name + '</option>'
                                )
                        })

                    } else { }
                },
                error: function (xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        }


    })
    $('#unit_condition_mode_range').on('click', function () {
        $('#general_unit_condition').attr('disabled', true);
        $('.unit_condition').removeClass('d-none');
        var start_up_unit = $('#start_up_unit').val();
        var unit_count = $('#no_of_unit').val();

        var floor = $('select[name="floor"]').val();
        var block = $('select[name="block"]').val();
        var property = $('select[name="property"]').val();
        if (floor) {
            $.ajax({
                url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                    "/" + block + "/" + property,
                type: "GET",
                data: {
                    "start_up_unit": start_up_unit,
                    "unit_count": unit_count
                },
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('select[name="unit_start_unit_condition"]').removeAttr(
                            'disabled');

                        $('select[name="unit_start_unit_condition"]').empty().append(
                            '<option value=""  selected>{{ ui_change('select', 'property_config') }}</option>'
                        );
                        $('select[name="unit_start_unit_condition[]"]').empty();
                        $('select[name="unit_end_unit_condition[]"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="unit_start_unit_condition[]"]')
                                .append(
                                    '<option value="' + value.id +
                                    '">' + value.name + '</option>'
                                )
                            $('select[name="unit_end_unit_condition[]"]')
                                .append(
                                    '<option value="' + value.id +
                                    '">' + value.name + '</option>'
                                )
                        })

                    } else { }
                },
                error: function (xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        }


    })
    $('#unit_parking_mode_range').on('click', function () {
        $('#general_unit_parking').attr('disabled', true);
        $('.unit_parking').removeClass('d-none');
        var start_up_unit = $('#start_up_unit').val();
        var unit_count = $('#no_of_unit').val();

        var floor = $('select[name="floor"]').val();
        var block = $('select[name="block"]').val();
        var property = $('select[name="property"]').val();
        if (floor) {
            $.ajax({
                url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                    "/" + block + "/" + property,
                type: "GET",
                data: {
                    "start_up_unit": start_up_unit,
                    "unit_count": unit_count
                },
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('select[name="unit_start_unit_parking"]').removeAttr(
                            'disabled');

                        $('select[name="unit_start_unit_parking"]').empty().append(
                            '<option value=""  selected>{{ ui_change('select', 'property_config') }}</option>'
                        );
                        $('select[name="unit_start_unit_parking[]"]').empty();
                        $('select[name="unit_end_unit_parking[]"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="unit_start_unit_parking[]"]')
                                .append(
                                    '<option value="' + value.id +
                                    '">' + value.name + '</option>'
                                )
                            $('select[name="unit_end_unit_parking[]"]').append(
                                '<option value="' + value.id +
                                '">' + value.name + '</option>'
                            )
                        })

                    } else { }
                },
                error: function (xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        }


    })
    $('#view_mode_range').on('click', function () {
        $('#general_view').attr('disabled', true);
        $('.view').removeClass('d-none');
        var start_up_unit = $('#start_up_unit').val();
        var unit_count = $('#no_of_unit').val();

        var floor = $('select[name="floor"]').val();
        var block = $('select[name="block"]').val();
        var property = $('select[name="property"]').val();
        if (floor) {
            $.ajax({
                url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                    "/" + block + "/" + property,
                type: "GET",
                data: {
                    "start_up_unit": start_up_unit,
                    "unit_count": unit_count
                },
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('select[name="unit_start_view"]').removeAttr('disabled');

                        $('select[name="unit_start_view"]').empty().append(
                            '<option value=""  selected>{{ ui_change('select', 'property_config') }}</option>'
                        );
                        $('select[name="unit_start_view[]"]').empty();
                        $('select[name="unit_end_view[]"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="unit_start_view[]"]').append(
                                '<option value="' + value.id +
                                '">' + value.name + '</option>'
                            )
                            $('select[name="unit_end_view[]"]').append(
                                '<option value="' + value.id +
                                '">' + value.name + '</option>'
                            )
                        })

                    } else { }
                },
                error: function (xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        }


    })


});


$(document).ready(function () {

    let addedUnitDescIds = [];
    let addedUnitTypeIds = [];
    let addedUnitCondIds = [];
    let addedUnitViewIds = [];
    let addedUnitParkIds = [];
    $('#add-more-unit-description').on('click', function () {
        var start_up_unit = $('#start_up_unit').val();
        var unit_count = $('#no_of_unit').val();

        var floor = $('select[name="floor"]').val();
        var block = $('select[name="block"]').val();
        var property = $('select[name="property"]').val();

        let addedUnitDescIds = [];
        let unitCountLimit = unit_count;
        $('.unit-select-description-start option:selected, .unit-select-description-end option:selected')
            .each(function () {
                const val = $(this).val();
                if (val && !addedUnitDescIds.includes(parseInt(val))) {
                    addedUnitDescIds.push(parseInt(val));
                }
            });

        if (floor) {
            $.ajax({
                url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                    "/" + block + "/" + property,
                type: "GET",
                data: {
                    "start_up_unit": start_up_unit,
                    "unit_count": unitCountLimit
                },
                dataType: "json",
                success: function (data) {
                    if (!data || data.length === 0) {
                        console.log('You Dont Have Units');
                        return;
                    }

                    let unitOptions = '';
                    $.each(data, function (key, value) {
                        if (!addedUnitDescIds.includes(parseInt(value.id))) {
                            unitOptions +=
                                `<option value="${value.id}">${value.name}</option>`;
                        }
                    });

                    if (addedUnitDescIds.length >= unitCountLimit) {
                        console.log('Reached unit limit, cannot add more rows');
                        $('#add-more-unit-description').addClass('d-none');
                        return;
                    }

                    const unitTypeRow = `
                <div class="row unit-description-row mt-3">
                    <div class="col-md-3">
                        <label>{{ ui_change('Unit_Start', 'property_config') }}</label>
                        <select class="js-select2-custom form-control unit-select-description-start" name="unit_start_unit_description[]">
                            ${unitOptions}
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>{{ ui_change('Unit_End', 'property_config') }}</label>
                        <select class="js-select2-custom form-control unit-select-description-end" name="unit_end_unit_description[]">
                            ${unitOptions}
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>{{ ui_change('unit_description', 'property_config') }}</label>
                        <select class="js-select2-custom form-control" name="unit_description[]">
                            @foreach ($unit_descriptions as $unit_description_item)
                            <option value="{{ $unit_description_item->id }}">{{ $unit_description_item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-remove"><i class="tio-delete"></i></button>
                    </div>
                </div>`;

                    $('#unit-description-container').append(unitTypeRow);
                    $('.js-select2-custom').select2();

                    updateAddedUnits();

                    $('.unit-select-description-start, .unit-select-description-end')
                        .off('change').on('change', function () {
                            updateAddedUnits();
                        });

                    $('.btn-remove').off('click').on('click', function () {
                        const row = $(this).closest('.unit-description-row');
                        row.find('option:selected').each(function () {
                            const val = parseInt($(this).val());
                            const index = addedUnitDescIds.indexOf(val);
                            if (index > -1) addedUnitDescIds.splice(
                                index, 1);
                        });
                        row.remove();
                        checkUnitLimitMessage();
                    });

                },
                error: function (xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        }

        function updateAddedUnits() {
            addedUnitDescIds = [];
            let selectedCount = 0;

            $('.unit-select-description-start option:selected, .unit-select-description-end option:selected')
                .each(function () {
                    const val = $(this).val();
                    if (val) {
                        addedUnitDescIds.push(parseInt(val));
                        selectedCount++;
                    }
                });

            if (selectedCount > unitCountLimit) {

                $(event.target).val(null).trigger('change');
            }
        }

        function checkUnitLimitMessage() {
            if (addedUnitDescIds.length >= unitCountLimit) {
                if ($('#unit-limit-message').length === 0) {
                    $('<div id="unit-limit-message" class="text-danger mt-2">{{ ui_change('You cannot add more than') }}</div>')
                        .insertBefore('#unit-description-container');
                }
            } else {
                $('#unit-limit-message').remove();
            }
        }

        $(document).on('click', '.btn-remove', function () {
            $('#add-more-unit-description').removeClass('d-none');
            const parentRow = $(this).closest('.unit-description-row');
            const startUnitId = parentRow.find('.unit-select-description-start').val();
            const endUnitId = parentRow.find('.unit-select-description-end').val();
            addedUnitDescIds = addedUnitDescIds.filter(id => id != startUnitId && id !=
                endUnitId);
            parentRow.remove();
            updateAddedUnits();
            checkUnitLimitMessage();
        });
    });
    $('#add-more-unit-parking').on('click', function () {
        var start_up_unit = $('#start_up_unit').val();
        var unit_count = $('#no_of_unit').val();

        var floor = $('select[name="floor"]').val();
        var block = $('select[name="block"]').val();
        var property = $('select[name="property"]').val();

        let addedUnitParkIds = [];
        let unitCountLimit = unit_count;
        $('.unit-select-parking-start option:selected, .unit-select-parking-end option:selected')
            .each(function () {
                const val = $(this).val();
                if (val && !addedUnitParkIds.includes(parseInt(val))) {
                    addedUnitParkIds.push(parseInt(val));
                }
            });

        if (floor) {
            $.ajax({
                url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                    "/" + block + "/" + property,
                type: "GET",
                data: {
                    "start_up_unit": start_up_unit,
                    "unit_count": unitCountLimit
                },
                dataType: "json",
                success: function (data) {
                    if (!data || data.length === 0) {
                        console.log('You Dont Have Units');
                        return;
                    }

                    let unitOptions = '';
                    $.each(data, function (key, value) {
                        if (!addedUnitParkIds.includes(parseInt(value.id))) {
                            unitOptions +=
                                `<option value="${value.id}">${value.name}</option>`;
                        }
                    });

                    if (addedUnitParkIds.length >= unitCountLimit) {
                        console.log('Reached unit limit, cannot add more rows');
                        $('#add-more-unit-parking').addClass('d-none');
                        return;
                    } else {
                        $('#add-more-unit-parking').removeClass('d-none');
                    }

                    const unitTypeRow = `
                <div class="row unit-parking-row mt-3">
                    <div class="col-md-3">
                        <label>{{ ui_change('Unit_Start', 'property_config') }}</label>
                        <select class="js-select2-custom form-control unit-select-parking-start" name="unit_start_unit_parking[]">
                            ${unitOptions}
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>{{ ui_change('Unit_End', 'property_config') }}</label>
                        <select class="js-select2-custom form-control unit-select-parking-end" name="unit_end_unit_parking[]">
                            ${unitOptions}
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>{{ ui_change('unit_parking', 'property_config') }}</label>
                        <select class="js-select2-custom form-control" name="unit_parking[]">
                            @foreach ($unit_parkings as $unit_parking_item)
                            <option value="{{ $unit_parking_item->id }}">{{ $unit_parking_item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-remove"><i class="tio-delete"></i></button>
                    </div>
                </div>`;

                    $('#unit-parking-container').append(unitTypeRow);
                    $('.js-select2-custom').select2();

                    updateAddedUnitsParking();

                    $('.unit-select-parking-start, .unit-select-parking-end')
                        .off('change').on('change', function () {
                            updateAddedUnitsParking();
                        });

                    $('.btn-remove').off('click').on('click', function () {
                        const row = $(this).closest('.unit-parking-row');
                        row.find('option:selected').each(function () {
                            const val = parseInt($(this).val());
                            const index = addedUnitParkIds.indexOf(val);
                            if (index > -1) addedUnitParkIds.splice(
                                index, 1);
                        });
                        row.remove();
                        checkUnitLimitMessageParking();
                    });

                },
                error: function (xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        }

        function updateAddedUnitsParking() {
            addedUnitParkIds = [];
            let selectedCount = 0;

            $('.unit-select-parking-start option:selected, .unit-select-parking-end option:selected')
                .each(function () {
                    const val = $(this).val();
                    if (val) {
                        addedUnitParkIds.push(parseInt(val));
                        selectedCount++;
                    }
                });

            if (selectedCount > unitCountLimit) {

                $(event.target).val(null).trigger('change');
            }

            // checkUnitLimitMessage(); 
        }

        function checkUnitLimitMessageParking() {
            if (addedUnitParkIds.length >= unitCountLimit) {
                if ($('#unit-limit-parking-message').length === 0) {
                    $('<div id="unit-limit-parking-message" class="text-danger mt-2">{{ ui_change('You cannot add more than') }}</div>')
                        .insertBefore('#unit-parking-container');
                }
            } else {
                $('#unit-limit-parking-message').remove();
            }
        }

        $(document).on('click', '.btn-remove', function () {
            $('#add-more-unit-parking').removeClass('d-none');
            const parentRow = $(this).closest('.unit-parking-row');
            const startUnitId = parentRow.find('.unit-select-parking-start').val();
            const endUnitId = parentRow.find('.unit-select-parking-end').val();
            addedUnitParkIds = addedUnitParkIds.filter(id => id != startUnitId && id !=
                endUnitId);
            parentRow.remove();
            updateAddedUnitsParking();
            checkUnitLimitMessageParking();


        });
    });




    // Unit Type
    $('#add-more-unit-type').on('click', function () {
        var start_up_unit = $('#start_up_unit').val();
        var unit_count = $('#no_of_unit').val();

        var floor = $('select[name="floor"]').val();
        var block = $('select[name="block"]').val();
        var property = $('select[name="property"]').val();

        let addedUnitTypeIds = [];
        let unitCountLimit = unit_count;
        $('.unit-select-type-start option:selected, .unit-select-type-end option:selected')
            .each(function () {
                const val = $(this).val();
                if (val && !addedUnitTypeIds.includes(parseInt(val))) {
                    addedUnitTypeIds.push(parseInt(val));
                }
            });

        if (floor) {
            $.ajax({
                url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                    "/" + block + "/" + property,
                type: "GET",
                data: {
                    "start_up_unit": start_up_unit,
                    "unit_count": unitCountLimit
                },
                dataType: "json",
                success: function (data) {
                    if (!data || data.length === 0) {
                        console.log('You Dont Have Units');
                        return;
                    }

                    let unitOptions = '';
                    $.each(data, function (key, value) {
                        if (!addedUnitTypeIds.includes(parseInt(value.id))) {
                            unitOptions +=
                                `<option value="${value.id}">${value.name}</option>`;
                        }
                    });

                    if (addedUnitTypeIds.length >= unitCountLimit) {
                        console.log('Reached unit limit, cannot add more rows');
                        $('#add-more-unit-type').addClass('d-none');
                        return;
                    } else {
                        $('#add-more-unit-type').removeClass('d-none');
                    }

                    const unitTypeRow = `
                <div class="row unit-type-row mt-3">
                    <div class="col-md-3">
                        <label>{{ ui_change('Unit_Start', 'property_config') }}</label>
                        <select class="js-select2-custom form-control unit-select-type-start" name="unit_start_unit_type[]">
                            ${unitOptions}
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>{{ ui_change('Unit_End', 'property_config') }}</label>
                        <select class="js-select2-custom form-control unit-select-type-end" name="unit_end_unit_type[]">
                            ${unitOptions}
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>{{ ui_change('unit_type', 'property_config') }}</label>
                        <select class="js-select2-custom form-control" name="unit_type[]">
                            @foreach ($unit_types as $unit_type_item)
                            <option value="{{ $unit_type_item->id }}">{{ $unit_type_item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-remove"><i class="tio-delete"></i></button>
                    </div>
                </div>`;

                    $('#unit-type-container').append(unitTypeRow);
                    $('.js-select2-custom').select2();

                    updateAddedUnitsType();

                    $('.unit-select-type-start, .unit-select-type-end')
                        .off('change').on('change', function () {
                            updateAddedUnitsType();
                        });

                    $('.btn-remove').off('click').on('click', function () {
                        const row = $(this).closest('.unit-type-row');
                        row.find('option:selected').each(function () {
                            const val = parseInt($(this).val());
                            const index = addedUnitTypeIds.indexOf(val);
                            if (index > -1) addedUnitTypeIds.splice(
                                index, 1);
                        });
                        row.remove();
                        checkUnitLimitMessageType();
                    });

                },
                error: function (xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        }

        function updateAddedUnitsType() {
            addedUnitTypeIds = [];
            let selectedCount = 0;

            $('.unit-select-type-start option:selected, .unit-select-type-end option:selected')
                .each(function () {
                    const val = $(this).val();
                    if (val) {
                        addedUnitTypeIds.push(parseInt(val));
                        selectedCount++;
                    }
                });

            if (selectedCount > unitCountLimit) {

                $(event.target).val(null).trigger('change');
            }

            // checkUnitLimitMessage(); 
        }

        function checkUnitLimitMessageType() {
            if (addedUnitTypeIds.length >= unitCountLimit) {
                if ($('#unit-limit-type-message').length === 0) {
                    $('<div id="unit-limit-type-message" class="text-danger mt-2">{{ ui_change('You cannot add more than') }}</div>')
                        .insertBefore('#unit-type-container');
                }
            } else {
                $('#unit-limit-type-message').remove();
            }
        }

        $(document).on('click', '.btn-remove', function () {
            $('#add-more-unit-type').removeClass('d-none');
            const parentRow = $(this).closest('.unit-type-row');
            const startUnitId = parentRow.find('.unit-select-type-start').val();
            const endUnitId = parentRow.find('.unit-select-type-end').val();
            addedUnitTypeIds = addedUnitTypeIds.filter(id => id != startUnitId && id !=
                endUnitId);
            parentRow.remove();
            updateAddedUnitsType();
            checkUnitLimitMessageType();


        });
    });




    // Unit Condition
    $('#add-more-unit-condition').on('click', function () {
        var start_up_unit = $('#start_up_unit').val();
        var unit_count = $('#no_of_unit').val();

        var floor = $('select[name="floor"]').val();
        var block = $('select[name="block"]').val();
        var property = $('select[name="property"]').val();

        let addedUnitCondIds = [];
        let unitCountLimit = unit_count;
        $('.unit-select-condition-start option:selected, .unit-select-condition-end option:selected')
            .each(function () {
                const val = $(this).val();
                if (val && !addedUnitCondIds.includes(parseInt(val))) {
                    addedUnitCondIds.push(parseInt(val));
                }
            });

        if (floor) {
            $.ajax({
                url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                    "/" + block + "/" + property,
                type: "GET",
                data: {
                    "start_up_unit": start_up_unit,
                    "unit_count": unitCountLimit
                },
                dataType: "json",
                success: function (data) {
                    if (!data || data.length === 0) {
                        console.log('You Dont Have Units');
                        return;
                    }

                    let unitOptions = '';
                    $.each(data, function (key, value) {
                        if (!addedUnitCondIds.includes(parseInt(value.id))) {
                            unitOptions +=
                                `<option value="${value.id}">${value.name}</option>`;
                        }
                    });

                    if (addedUnitCondIds.length >= unitCountLimit) {
                        console.log('Reached unit limit, cannot add more rows');
                        $('#add-more-unit-condition').addClass('d-none');
                        return;
                    } else {
                        $('#add-more-unit-condition').removeClass('d-none');
                    }

                    const unitTypeRow = `
                <div class="row unit-condition-row mt-3">
                    <div class="col-md-3">
                        <label>{{ ui_change('Unit_Start', 'property_config') }}</label>
                        <select class="js-select2-custom form-control unit-select-condition-start" name="unit_start_unit_condition[]">
                            ${unitOptions}
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>{{ ui_change('Unit_End', 'property_config') }}</label>
                        <select class="js-select2-custom form-control unit-select-condition-end" name="unit_end_unit_condition[]">
                            ${unitOptions}
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>{{ ui_change('unit_condition', 'property_config') }}</label>
                        <select class="js-select2-custom form-control" name="unit_condition[]">
                            @foreach ($unit_conditions as $unit_condition_item)
                            <option value="{{ $unit_condition_item->id }}">{{ $unit_condition_item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-remove"><i class="tio-delete"></i></button>
                    </div>
                </div>`;

                    $('#unit-condition-container').append(unitTypeRow);
                    $('.js-select2-custom').select2();

                    updateAddedUnitsCondition();

                    $('.unit-select-condition-start, .unit-select-condition-end')
                        .off('change').on('change', function () {
                            updateAddedUnitsCondition();
                        });

                    $('.btn-remove').off('click').on('click', function () {
                        const row = $(this).closest('.unit-condition-row');
                        row.find('option:selected').each(function () {
                            const val = parseInt($(this).val());
                            const index = addedUnitCondIds.indexOf(val);
                            if (index > -1) addedUnitCondIds.splice(
                                index, 1);
                        });
                        row.remove();
                        checkUnitLimitMessageCondition();
                    });

                },
                error: function (xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        }

        function updateAddedUnitsCondition() {
            addedUnitCondIds = [];
            let selectedCount = 0;

            $('.unit-select-condition-start option:selected, .unit-select-condition-end option:selected')
                .each(function () {
                    const val = $(this).val();
                    if (val) {
                        addedUnitCondIds.push(parseInt(val));
                        selectedCount++;
                    }
                });

            if (selectedCount > unitCountLimit) {

                $(event.target).val(null).trigger('change');
            }

            // checkUnitLimitMessage(); 
        }

        function checkUnitLimitMessageCondition() {
            if (addedUnitCondIds.length >= unitCountLimit) {
                if ($('#unit-limit-condition-message').length === 0) {
                    $('<div id="unit-limit-condition-message" class="text-danger mt-2">{{ ui_change('You cannot add more than') }}</div>')
                        .insertBefore('#unit-condition-container');
                }
            } else {
                $('#unit-limit-condition-message').remove();
            }
        }

        $(document).on('click', '.btn-remove', function () {
            $('#add-more-unit-condition').removeClass('d-none');
            const parentRow = $(this).closest('.unit-condition-row');
            const startUnitId = parentRow.find('.unit-select-condition-start').val();
            const endUnitId = parentRow.find('.unit-select-condition-end').val();
            addedUnitCondIds = addedUnitCondIds.filter(id => id != startUnitId && id !=
                endUnitId);
            parentRow.remove();
            updateAddedUnitsType();
            checkUnitLimitMessageType();


        });
    });




    // View
    $('#add-more-view').on('click', function () {
        var start_up_unit = $('#start_up_unit').val();
        var unit_count = $('#no_of_unit').val();

        var floor = $('select[name="floor"]').val();
        var block = $('select[name="block"]').val();
        var property = $('select[name="property"]').val();

        let addedUnitViewIds = [];
        let unitCountLimit = unit_count;
        $('.unit-select-view-start option:selected, .unit-select-view-end option:selected')
            .each(function () {
                const val = $(this).val();
                if (val && !addedUnitViewIds.includes(parseInt(val))) {
                    addedUnitViewIds.push(parseInt(val));
                }
            });

        if (floor) {
            $.ajax({
                url: "{{ URL::to('unit_management/get_units_by_floor_id') }}/" + floor +
                    "/" + block + "/" + property,
                type: "GET",
                data: {
                    "start_up_unit": start_up_unit,
                    "unit_count": unitCountLimit
                },
                dataType: "json",
                success: function (data) {
                    if (!data || data.length === 0) {
                        console.log('You Dont Have Units');
                        return;
                    }

                    let unitOptions = '';
                    $.each(data, function (key, value) {
                        if (!addedUnitViewIds.includes(parseInt(value.id))) {
                            unitOptions +=
                                `<option value="${value.id}">${value.name}</option>`;
                        }
                    });

                    if (addedUnitViewIds.length >= unitCountLimit) {
                        console.log('Reached unit limit, cannot add more rows');
                        $('#add-more-view').addClass('d-none');
                        return;
                    } else {
                        $('#add-more-view').removeClass('d-none');
                    }

                    const unitTypeRow = `
                <div class="row view-row mt-3">
                    <div class="col-md-3">
                        <label>{{ ui_change('Unit_Start', 'property_config') }}</label>
                        <select class="js-select2-custom form-control unit-select-view-start" name="unit_start_view[]">
                            ${unitOptions}
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>{{ ui_change('Unit_End', 'property_config') }}</label>
                        <select class="js-select2-custom form-control unit-select-view-end" name="unit_end_view[]">
                            ${unitOptions}
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label>{{ ui_change('view', 'property_config') }}</label>
                        <select class="js-select2-custom form-control" name="view[]">
                            @foreach ($views as $view_item)
                            <option value="{{ $view_item->id }}">{{ $view_item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="button" class="btn btn-danger btn-remove"><i class="tio-delete"></i></button>
                    </div>
                </div>`;

                    $('#view-container').append(unitTypeRow);
                    $('.js-select2-custom').select2();

                    updateAddedView();

                    $('.unit-select-view-start, .unit-select-view-end')
                        .off('change').on('change', function () {
                            updateAddedView();
                        });

                    $('.btn-remove').off('click').on('click', function () {
                        const row = $(this).closest('.view-row');
                        row.find('option:selected').each(function () {
                            const val = parseInt($(this).val());
                            const index = addedUnitViewIds.indexOf(val);
                            if (index > -1) addedUnitViewIds.splice(
                                index, 1);
                        });
                        row.remove();
                        checkUnitLimitMessageView();
                    });

                },
                error: function (xhr, status, error) {
                    console.error('Error occurred:', error);
                }
            });
        }

        function updateAddedView() {
            addedUnitViewIds = [];
            let selectedCount = 0;

            $('.unit-select-view-start option:selected, .unit-select-view-end option:selected')
                .each(function () {
                    const val = $(this).val();
                    if (val) {
                        addedUnitViewIds.push(parseInt(val));
                        selectedCount++;
                    }
                });

            if (selectedCount > unitCountLimit) {

                $(event.target).val(null).trigger('change');
            }

            // checkUnitLimitMessage(); 
        }

        function checkUnitLimitMessageView() {
            if (addedUnitViewIds.length >= unitCountLimit) {
                if ($('#unit-limit-view-message').length === 0) {
                    $('<div id="unit-limit-view-message" class="text-danger mt-2">{{ ui_change('You cannot add more than') }}</div>')
                        .insertBefore('#view-container');
                }
            } else {
                $('#unit-limit-view-message').remove();
            }
        }

        $(document).on('click', '.btn-remove', function () {
            $('#add-more-view').removeClass('d-none');
            const parentRow = $(this).closest('.view-row');
            const startUnitId = parentRow.find('.unit-select-view-start').val();
            const endUnitId = parentRow.find('.unit-select-view-end').val();
            addedUnitViewIds = addedUnitViewIds.filter(id => id != startUnitId && id !=
                endUnitId);
            parentRow.remove();
            updateAddedView();
            checkUnitLimitMessageView();


        });
    });





});