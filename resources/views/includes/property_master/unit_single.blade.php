<div class="form-group">
    <label for="name" class="title-color">{{ ui_change('unit_name','property_master') }}
    </label>
    <input type="text" name="name" class="form-control" value="{{ (isset($main->name)) ? $main->name : '' }}"  required>
</div>
<div class="form-group" id="single-form-code">
    <label for="name" class="title-color">{{ ui_change('unit_code','property_master') }}
    </label>
    <input type="text" name="code" class="form-control" value="{{ (isset($main->code)) ? $main->code : '' }}"  required>
</div>
<div class="input-group">
    <input type="radio" name="status" class="mr-3 ml-3" 
    {{ (isset($main->status) && $main->status == 'active') ? 'checked' : '' }} 
    {{ (!isset($main->status)) ? 'checked' : '' }} 
    value="active">
 <label class="title-color" for="status">
        {{ ui_change('active','property_master') }}
    </label>
    <input type="radio" name="status"  class="mr-3 ml-3"  {{(isset($main->status) && $main->status == 'inactive') ?  'checked'   : '' }} value="inactive">
    <label class="title-color" for="status" >
        {{ ui_change('inactive','property_master') }}
    </label>
     
</div>
<div class="d-flex gap-3 justify-content-end">
    <button type="reset" id="reset"
        class="btn btn-secondary px-4">{{ ui_change('reset','property_master') }}</button>
    <button type="submit" class="btn btn--primary px-4">{{ ui_change('submit','property_master') }}</button>
</div>