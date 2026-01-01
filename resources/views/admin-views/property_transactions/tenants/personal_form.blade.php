<div class="row">
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('name', 'property_master') }} <span
                    class="text-danger"> *</span></label>
            <input type="text" class="form-control" name="name" value="{{ isset($tenant) ? $tenant->name : '' }}">
        </div>
    </div>

    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="name" class="title-color">{{ ui_change('Gender', 'property_master') }}<span
                    class="text-danger"> *</span>
            </label>
            <select class="js-select2-custom form-control" name="gender" required>
                <option selected disabled>{{ ui_change('select', 'property_master') }} </option>
                <option value="male" {{ isset($tenant) ? ($tenant->gender == 'male' ? 'selected' : '') : '' }}>
                    {{ ui_change('male', 'property_master') }} </option>
                <option value="female"
                    {{ isset($tenant) ? ($tenant->gender == 'female' ? 'selected' : '') : '' }}>
                    {{ ui_change('female', 'property_master') }} </option>

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
                        {{ isset($tenant) ? ($tenant->country_id == $country_master_item->id ? 'selected' : '') : '' }}>
                        {{ $country_master_item->country->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>



    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="name" class="title-color">{{ ui_change('nationality_of_owner', 'property_master') }}<span
                    class="text-danger"> *</span>
            </label>
            <select class="js-select2-custom form-control" name="nationality_id" required>
                <option selected disabled>{{ ui_change('select', 'property_master') }} </option>
                @foreach ($country_master as $country_master_item)
                    <option value="{{ $country_master_item->id }}"
                        {{ isset($tenant) ? ($tenant->nationality_id == $country_master_item->id ? 'selected' : '') : '' }}>
                        {{ $country_master_item->country->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="name" class="title-color">{{ ui_change('living_status', 'property_master') }}<span
                    class="text-danger"> *</span>
            </label>
            <select class="js-select2-custom form-control" name="live_with_id" required>
                <option selected>{{ ui_change('select', 'property_master') }}
                </option>
                @foreach ($live_withs as $live_with_item)
                    <option value="{{ $live_with_item->id }}"
                        {{ isset($tenant) ? ($tenant->live_with_id == $live_with_item->id ? 'selected' : '') : '' }}>
                        {{ $live_with_item->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('CPR/id_no.', 'property_master') }}</label>
            <input type="text" class="form-control" name="id_number"
                value="{{ isset($tenant) ? $tenant->id_number : '' }}">
            <input type="hidden" class="form-control" name="type" value="individual">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('nick_name', 'property_master') }}</label>
            <input type="text" class="form-control" name="nick_name"
                value="{{ isset($tenant) ? $tenant->nick_name : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('contact_person', 'property_master') }}</label>
            <input type="text" class="form-control" name="contact_person"
                value="{{ isset($tenant) ? $tenant->contact_person : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('designation', 'property_master') }}</label>
            <input type="text" class="form-control" name="designation"
                value="{{ isset($tenant) ? $tenant->designation : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('contact_no.', 'property_master') }}</label>
            <input type="text" class="form-control" name="contact_no"
                value="{{ isset($tenant) ? $tenant->contact_no : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('whatsapp_no.', 'property_master') }}</label>
            <input type="text" class="form-control" name="whatsapp_no"
                value="{{ isset($tenant) ? $tenant->whatsapp_no : '' }}">
        </div>
    </div>

    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('company_name', 'property_master') }}</label>
            <input type="text" class="form-control" name="company_name"
                value="{{ isset($tenant) ? $tenant->company_name : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('fax_no', 'property_master') }}</label>
            <input type="text" class="form-control" name="fax_no"
                value="{{ isset($tenant) ? $tenant->fax_no : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('telephone_no', 'property_master') }}</label>
            <input type="text" class="form-control" name="telephone_no"
                value="{{ isset($tenant) ? $tenant->telephone_no : '' }}">
        </div>
    </div>
    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token"
                class="title-color">{{ ui_change('other_contact_no.', 'property_master') }}</label>
            <input type="text" class="form-control" name="other_contact_no"
                value="{{ isset($tenant) ? $tenant->other_contact_no : '' }}">
        </div>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('address_line_1', 'property_master') }}</label>
            <input type="text" class="form-control" name="address1"
                value="{{ isset($tenant) ? $tenant->address1 : '' }}">
        </div>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('address_line_2', 'property_master') }}</label>
            <input type="text" class="form-control" name="address2"
                value="{{ isset($tenant) ? $tenant->address2 : '' }}">
        </div>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('address_line_3', 'property_master') }}</label>
            <input type="text" class="form-control" name="address3"
                value="{{ isset($tenant) ? $tenant->address3 : '' }}">
        </div>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('city', 'property_master') }}</label>
            <input type="text" class="form-control" name="city"
                value="{{ isset($tenant) ? $tenant->city : '' }}">
        </div>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('state', 'property_master') }}</label>
            <input type="text" class="form-control" name="state"
                value="{{ isset($tenant) ? $tenant->state : '' }}">
        </div>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('passport_no.', 'property_master') }}</label>
            <input type="text" class="form-control" name="passport_no"
                value="{{ isset($tenant) ? $tenant->passport_no : '' }}">
        </div>
    </div>

    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('email_address', 'property_master') }}</label>
            <input type="text" class="form-control" name="email1"
                value="{{ isset($tenant) ? $tenant->email1 : '' }}">
        </div>
    </div>

    <div class="col-md-6 col-lg-4 col-xl-3">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('secondary_email', 'property_master') }}</label>
            <input type="text" class="form-control" name="email2"
                value="{{ isset($tenant) ? $tenant->email2 : '' }}">
        </div>
    </div>


    <div class="col-md-6 col-lg-4 col-xl-3" id="docs_personal_id">
        <div class="form-group">
            <label for="token" class="title-color">{{ ui_change('upload_document', 'property_master') }}</label>
            <input type="file" class="form-control" name="document">
        </div>
    </div>
</div>
