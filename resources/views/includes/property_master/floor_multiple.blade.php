 
<div class="form-group">
    <label for="name" class="title-color">{{ __('property_master.floor_no_prefill_with_zero') }}
    </label>
    <input type="radio" name="fill_zero" id="active" value="yes" class="mr-3 ml-3 fill_zero_link"  >
    <label class="title-color" for="status">
        {{ __('general.yes') }}
    </label>
    <input type="radio" name="fill_zero" id="inactive" value="no" class="mr-3 ml-3 fill_zero_link" checked  >
    <label class="title-color" for="status" >
        {{ __('general.no') }}
    </label>

</div>
<div class="form-group ">
    <label for="" class=" ">{{ __('property_master.no_of_floors') }}</label>
    <input type="number" id="" name="no_of_floors" class=" form-control ">
</div>
<div class="form-group">
    <label for="name" class="title-color">{{ __('property_master.start_floor_no') }}
    </label>
    <input type="number" name="start_floor_no" class="form-control"  >
</div>
<div class="form-group fill_zero_link_input d-none">
    <label for="name" class="title-color">{{ __('property_master.no_of_digits_width') }}
    </label>
    <input type="number" name="width" class="form-control" >
</div>
 
<div class="form-group">
    <label for="name" class="title-color">{{ __('property_master.floor_name_prefix') }}
    </label>
    <input type="radio" name="floor_name_prefix_status" id="active" class="mr-3 ml-3 prefix_link_name"  >
    <label class="title-color" for="status">
        {{ __('general.yes') }}
    </label>
    <input type="radio" name="floor_name_prefix_status" id="inactive" class="mr-3 ml-3 prefix_link_name" checked  >
    <label class="title-color" for="status" >
        {{ __('general.no') }}
    </label>
    <input type="text" name="floor_name_prefix" id="prefix_input" class="prefix_input_name form-control d-none">
</div>
 
<div class="form-group">
    <label for="name" class="title-color">{{ __('property_master.floor_code_prefix') }}
    </label>
    <input type="radio" name="floor_code_prefix_status" id="active" class="mr-3 ml-3 prefix_link"  >
    <label class="title-color" for="status">
        {{ __('general.yes') }}
    </label>
    <input type="radio" name="floor_code_prefix_status" id="inactive" class="mr-3 ml-3 prefix_link" checked  >
    <label class="title-color" for="status" >
        {{ __('general.no') }}
    </label>
    <input type="text" name="floor_code_prefix" id="prefix_input" class="prefix_input form-control d-none">
</div>


<div class="form-group">
    <input type="radio" name="status" class="mr-3 ml-3" checked value="active" >
    <label class="title-color" for="status">
        {{ __('general.active') }}
    </label>
    <input type="radio" name="status"  class="mr-3 ml-3" value="inactive">
    <label class="title-color" for="status" >
        {{ __('general.inactive') }}
    </label>
</div>
<div class="d-flex gap-3 justify-content-end">
    <button type="reset" id="reset"
        class="btn btn-secondary px-4">{{ __('general.reset') }}</button>
    <button type="submit" class="btn btn--primary px-4">{{ __('general.submit') }}</button>
</div>
