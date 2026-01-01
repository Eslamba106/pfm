<div class="form-group">
    <label for="name" class="title-color">{{ ui_change('unit_no_prefill_with_zero' , 'property_master') }}
    </label>
    <input type="radio" name="fill_zero" id="active" value="yes" class="mr-3 ml-3 fill_zero_link"  >
    <label class="title-color" for="status">
        {{ ui_change('yes' , 'property_master') }}
    </label>
    <input type="radio" name="fill_zero" id="inactive" value="no" class="mr-3 ml-3 fill_zero_link" checked  >
    <label class="title-color" for="status" >
        {{ ui_change('no' , 'property_master') }}
    </label>

</div>
<div class="form-group ">
    <label for="" class=" ">{{ ui_change('no_of_units' , 'property_master') }}</label>
    <input type="number" id="" name="no_of_units" class=" form-control ">
</div>
<div class="form-group">
    <label for="name" class="title-color">{{ ui_change('start_unit_no' , 'property_master') }}
    </label>
    <input type="number" name="start_unit_no" class="form-control"  >
</div>
<div class="form-group fill_zero_link_input d-none">
    <label for="name" class="title-color">{{ ui_change('no_of_digits_width' , 'property_master') }}
    </label>
    <input type="number" name="width" class="form-control" >
</div>

<div class="form-group">
    <label for="name" class="title-color">{{ ui_change('unit_name_prefix' , 'property_master') }}
    </label>
    <input type="radio" name="unit_name_prefix_status" id="active" class="mr-3 ml-3 prefix_link_name"  >
    <label class="title-color" for="status">
        {{ ui_change('yes' , 'property_master') }}
    </label>
    <input type="radio" name="unit_name_prefix_status" id="inactive" class="mr-3 ml-3 prefix_link_name" checked  >
    <label class="title-color" for="status" >
        {{ ui_change('no' , 'property_master') }}
    </label>
    <input type="text" name="unit_name_prefix" id="prefix_input" class="prefix_input_name form-control d-none">
</div>
 
 
<div class="form-group">
    <label for="name" class="title-color">{{ ui_change('unit_code_prefix' , 'property_master') }}
    </label>
    <input type="radio" name="unit_code_prefix_status" id="active" class="mr-3 ml-3 prefix_link"  >
    <label class="title-color" for="status">
        {{ ui_change('yes' , 'property_master') }}
    </label>
    <input type="radio" name="unit_code_prefix_status" id="inactive" class="mr-3 ml-3 prefix_link" checked  >
    <label class="title-color" for="status" >
        {{ ui_change('no', 'property_master') }}
    </label>
    <input type="text" name="unit_code_prefix" id="prefix_input" class="prefix_input form-control d-none">
</div>

<div class="form-group">
    <input type="radio" name="status" class="mr-3 ml-3" checked value="active" >
    <label class="title-color" for="status">
        {{ ui_change('active', 'property_master') }}
    </label>
    <input type="radio" name="status"  class="mr-3 ml-3" value="inactive">
    <label class="title-color" for="status" >
        {{ ui_change('inactive', 'property_master') }}
    </label>
</div>
<div class="d-flex gap-3 justify-content-end">
    <button type="reset" id="reset"
        class="btn btn-secondary px-4">{{ ui_change('reset', 'property_master') }}</button>
    <button type="submit" class="btn btn--primary px-4">{{ ui_change('submit', 'property_master') }}</button>
</div>
