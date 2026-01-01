<div class="row">
 
        <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('Name' , 'property_transaction') }}</label>
            <input type="text" class="form-control" name="name" value="{{ (isset($investor)) ? $investor->name : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="name" class="title-color">{{ ui_change('Gender'  , 'property_transaction')}}<span class="text-danger" style="font-size: 18px; "> *</span> 
            </label>
            <select class="js-select2-custom form-control" name="gender" >
                <option selected disabled>{{ ui_change('select' , 'property_transaction') }}</option>
                <option value="male" {{ (isset($investor) ? (($investor->gender == 'male' ) ? 'selected' : '') : '') }}>{{ ui_change('male' , 'property_transaction') }} </option>
                <option value="female" {{ (isset($investor) ? (($investor->gender == 'female' ) ? 'selected' : '') : '') }}>{{ ui_change('female' , 'property_transaction') }} </option>

            </select>
        </div>
    </div>
     <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="name" class="title-color">{{ ui_change('country', 'property_master') }}<span
                    class="text-danger"> *</span>
            </label>
            <select class="js-select2-custom form-control" name="country_id" required>
                <option disabled>{{ ui_change('select', 'property_master') }} </option>
                @foreach ($country_master as $country_master_item)
                    <option value="{{ $country_master_item->id }}"
                        {{ isset($investor) ? ($investor->country_id == $country_master_item->id ? 'selected' : '') : '' }}>
                        {{ $country_master_item->country->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="name" class="title-color">{{ ui_change('nationality_of_owner' , 'property_transaction') }}<span class="text-danger" style="font-size: 18px; "> *</span>
            </label>
            <select class="js-select2-custom form-control" name="nationality_id" >
                <option selected value="" disabled>{{ ui_change('select' , 'property_transaction') }} </option>
                @foreach ($country_master as $country_master_item)
                    <option value="{{ $country_master_item->id }}" {{ (isset($investor) ? (($investor->nationality_id == $country_master_item->id ) ? 'selected' : '') : '') }}>
                        {{ $country_master_item->country->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
 
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('CPR_/_ID_No.' , 'property_transaction') }}</label>
            <input type="text" class="form-control" name="id_number" value="{{ (isset($investor)) ? $investor->id_number : '' }}">
            <input type="hidden" class="form-control" name="type" value="individual">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('Nick_Name' , 'property_transaction') }}</label>
            <input type="text" class="form-control" name="nick_name" value="{{ (isset($investor)) ? $investor->nick_name : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('Contact_Person' , 'property_transaction') }}</label>
            <input type="text" class="form-control" name="contact_person" value="{{ (isset($investor)) ? $investor->contact_person : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('Designation'  , 'property_transaction')}}</label>
            <input type="text" class="form-control" name="designation" value="{{ (isset($investor)) ? $investor->designation : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('Contact_No.' , 'property_transaction') }}</label>
            <input type="text" class="form-control" name="contact_no" value="{{ (isset($investor)) ? $investor->contact_no : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('Whatsapp_No.' , 'property_transaction') }}</label>
            <input type="text" class="form-control" name="whatsapp_no" value="{{ (isset($investor)) ? $investor->whatsapp_no : '' }}">
        </div>
    </div>

    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('Company_Name' , 'property_transaction') }}</label>
            <input type="text" class="form-control" name="company_name" value="{{ (isset($investor)) ? $investor->company_name : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('Fax_No' , 'property_transaction') }}</label>
            <input type="text" class="form-control" name="fax_no" value="{{ (isset($investor)) ? $investor->fax_no : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('Telephone_No' , 'property_transaction') }}</label>
            <input type="text" class="form-control" name="telephone_no" value="{{ (isset($investor)) ? $investor->telephone_no : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('Other_Contact_No.' , 'property_transaction') }}</label>
            <input type="text" class="form-control" name="other_contact_no" value="{{ (isset($investor)) ? $investor->other_contact_no : '' }}">
        </div>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('Address_Line_1', 'property_transaction') }}</label>
            <input type="text" class="form-control" name="address1" value="{{ (isset($investor)) ? $investor->address1 : '' }}">
        </div>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('Address_Line_2' , 'property_transaction') }}</label>
            <input type="text" class="form-control" name="address2" value="{{ (isset($investor)) ? $investor->address2 : '' }}">
        </div>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('Address_Line_3', 'property_transaction') }}</label>
            <input type="text" class="form-control" name="address3" value="{{ (isset($investor)) ? $investor->address3 : '' }}">
        </div>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('City'  , 'property_transaction')}}</label>
            <input type="text" class="form-control" name="city" value="{{ (isset($investor)) ? $investor->city : '' }}">
        </div>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('State' , 'property_transaction') }}</label>
            <input type="text" class="form-control" name="state" value="{{ (isset($investor)) ? $investor->state : '' }}">
        </div>
    </div>


 
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('Passport_No.' , 'property_transaction') }}</label>
            <input type="text" class="form-control" name="passport_no" value="{{ (isset($investor)) ? $investor->passport_no : '' }}">
        </div>
    </div>

    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('Email_Address' , 'property_transaction') }}</label>
            <input type="text" class="form-control" name="email1" value="{{ (isset($investor)) ? $investor->email1 : '' }}">
        </div>
    </div>

    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('Secondary_Email' , 'property_transaction') }}</label>
            <input type="text" class="form-control" name="email2" value="{{ (isset($investor)) ? $investor->email2 : '' }}">
        </div>
    </div>

    


</div>

