<div class="row">
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('company_name' , 'property_master') }}<span
                    class="text-danger"> *</span></label>
            <input type="text" class="form-control" name="company_name" value="{{ (isset($agent)) ? $agent->company_name : '' }}">
        </div>
    </div>

<div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="name" class="title-color">{{ ui_change('business_activity' , 'property_master')  }}<span
                    class="text-danger"> *</span>
            </label>
            <select class="js-select2-custom form-control" name="business_activity_id" required>  
                @foreach ($business_activities as $business_activity_item)
                    <option value="{{ $business_activity_item->id }}" {{ (isset($agent)) ? ( ($agent->business_activity_id == $business_activity_item->id ) ? "selected" : "") : '' }}>
                        {{ $business_activity_item->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="name" class="title-color">{{ ui_change('taxability' , 'property_master')  }} <span
                    class="text-danger"> *</span>
            </label>
            <select class="js-select2-custom form-control" name="tax_registration" required>
                <option value="2"   {{ (isset($agent) && (2 == $agent->tax_registration)) ? 'selected' : '' }}>{{ ui_change('no' , 'property_master')  }}</option>
                <option value="1" {{ (isset($agent) && (1 == $agent->tax_registration)) ? 'selected' : '' }}>{{ ui_change('yes' , 'property_master') }}</option>

            </select>
        </div>
    </div>
    
    <div class="col-md-6 col-lg-4 col-xl-3 {{ (isset($agent) && (1 == $agent->tax_registration)) ?  '' : 'd-none'  }} tax_status_html ">
        <div class="form-group">
            <label for="name" class="title-color">{{ ui_change('vat_no' , 'property_master')  }}
            </label>
            <input type="text" name="vat_no" class="form-control" value="{{ (isset($agent) && (1 == $agent->tax_registration)) ? $agent->vat_no  : ''  }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="name" class="title-color">{{ ui_change('country' , 'property_master')  }}<span
                    class="text-danger"> *</span>
            </label>
            <select class="js-select2-custom form-control" name="country_id" required> 
                @foreach ($country_master as $country_master_item)
                    <option value="{{ $country_master_item->id }}" {{  (isset($agent)) ? (($agent->country_id == $country_master_item->id) ? 'selected' : '' ) : '' }}>
                        {{ $country_master_item->country->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
     <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('contact_person' , 'property_master')  }}<span class="text-danger"> *</span></label>
            <input type="text" class="form-control" name="contact_person" value="{{  (isset($agent)) ? $agent->contact_person : '' }}">
        </div>
    </div>
    <input type="hidden" class="form-control" name="type" value="company">

    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('CR/_registration_no.' , 'property_master')  }}</label>
            <input type="text" class="form-control" name="registration_no" value="{{  (isset($agent)) ? $agent->registration_no : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('group_company_name' , 'property_master') }}</label>
            <input type="text" class="form-control" name="group_company_name" value="{{  (isset($agent)) ? $agent->group_company_name : '' }}">
        </div>
    </div>

   
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('designation' , 'property_master')  }}</label>
            <input type="text" class="form-control" name="designation" value="{{  (isset($agent)) ? $agent->designation : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('contact_no.' , 'property_master')  }}</label>
            <input type="text" class="form-control" name="contact_no" value="{{  (isset($agent)) ? $agent->contact_no : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('whatsapp_no.' , 'property_master')  }}</label>
            <input type="text" class="form-control" name="whatsapp_no" value="{{  (isset($agent)) ? $agent->whatsapp_no : '' }}">
        </div>
    </div>

    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('fax_no' , 'property_master')  }}</label>
            <input type="text" class="form-control" name="fax_no" value="{{  (isset($agent)) ? $agent->fax_no : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('telephone_no' , 'property_master') }}</label>
            <input type="text" class="form-control" name="telephone_no" value="{{  (isset($agent)) ? $agent->telephone_no : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('other_contact_no.' , 'property_master')  }}</label>
            <input type="text" class="form-control" name="other_contact_no" value="{{  (isset($agent)) ? $agent->other_contact_no : '' }}">
        </div>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('address_line_1' , 'property_master')  }}</label>
            <input type="text" class="form-control" name="address1" value="{{  (isset($agent)) ? $agent->address1 : '' }}">
        </div>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('address_line_2' , 'property_master')  }}</label>
            <input type="text" class="form-control" name="address2" value="{{  (isset($agent)) ? $agent->address2 : '' }}">
        </div>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('address_line_3' , 'property_master')  }}</label>
            <input type="text" class="form-control" name="address3" value="{{  (isset($agent)) ? $agent->address3 : '' }}">
        </div>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('city' , 'property_master')  }}</label>
            <input type="text" class="form-control" name="city" value="{{  (isset($agent)) ? $agent->city : '' }}">
        </div>
    </div>

    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('state' , 'property_master')  }}</label>
            <input type="text" class="form-control" name="state" value="{{  (isset($agent)) ? $agent->state : '' }}">
        </div>
    </div>




    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('email_address' , 'property_master') }}</label>
            <input type="text" class="form-control" name="email1" value="{{  (isset($agent)) ? $agent->email1 : '' }}">
        </div>
    </div>

    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('secondary_email' , 'property_master')  }}</label>
            <input type="text" class="form-control" name="email2" value="{{  (isset($agent)) ? $agent->email2 : '' }}">
        </div>
    </div>

    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('upload_document' , 'property_master') }}</label>
            <input type="file" class="form-control" name="document">
        </div>
    </div>




</div>

