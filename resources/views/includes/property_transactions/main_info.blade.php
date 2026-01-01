{{-- @php
    $current_url = url()->current();
    $main_url = explode('/' , $current_url);
    $url = $main_url[count($main_url) -2 ];
@endphp --}}
<div class="card-body">
    <div class="row">
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="form-group">
                <label for="name" class="title-color">{{ ui_change('leasing_executive' , 'property_transaction') }}
                </label>
                <select class="js-select2-custom form-control" name="employee_id">
                    <option value="" selected>{{ ui_change('not_applicable' , 'property_transaction') }}
                    @foreach ($employees as $employee_item)
                        <option value="{{ $employee_item->id }}">
                            {{ $employee_item->name ?? $employee_item->company_name }}
                        </option>
                    @endforeach
                </select>
                @error('employee_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="form-group">
                <label for="name" class="title-color">{{ ui_change('agent' , 'property_transaction') }}
                </label>
                <select class="js-select2-custom form-control" name="agent_id">
                    <option value="" selected>{{ ui_change('not_applicable' , 'property_transaction') }}
                    @foreach ($agents as $agent_item)
                        <option value="{{ $agent_item->id }}">
                            {{ $agent_item->name ?? $agent_item->company_name }}
                        </option>
                    @endforeach
                </select>
                @error('agent_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="form-group">
                <label for="price"
                    class="title-color">{{ ui_change('decision_maker' , 'property_transaction') }}</label>
                <input type="text" class="form-control" name="decision_maker">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="form-group">
                <label for="price"
                    class="title-color">{{ ui_change('decision_maker_designation' , 'property_transaction') }}</label>
                <input type="text" class="form-control" name="decision_maker_designation">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="form-group">
                <label for="price"
                    class="title-color">{{ ui_change('current_office_location' , 'property_transaction') }}</label>
                <input type="text" class="form-control" name="current_office_location">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="form-group">
                <label for="price"
                    class="title-color">{{ ui_change('reason_of_relocation' , 'property_transaction') }}</label>
                <input type="text" class="form-control" name="reason_of_relocation">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="form-group">
                <label for="price"
                    class="title-color">{{ ui_change('budget_for_relocation' , 'property_transaction') }}</label>
                <input type="text" class="form-control" name="budget_for_relocation_start">
            </div>
        </div>

        <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="form-group">
                <label for="price" class="title-color"> </label>

                <input type="text" class="form-control mt-2" name="budget_for_relocation_end">
            </div>
        </div>

        <div class="col-md-6 col-lg-4 col-xl-4">
            <div class="form-group">
                <label for="price"
                    class="title-color">{{ ui_change('no_of_emp_staff_strength' , 'property_transaction') }}</label>
                <input type="text" class="form-control" name="no_of_emp_staff_strength">
            </div>
        </div>

        {{-- <div class="col-md-6 col-lg-4 col-xl-3">
            <div class="form-group">
                <label for="price"
                    class="title-color">{{ ui_change('time_frame_for_relocation' , 'property_transaction') }}</label>
                <input type="text" class="form-control" name="time_frame_for_relocation">
            </div>
        </div> --}}

        <div class="col-md-6 col-lg-4 col-xl-4">
            <div class="form-group">
                <label for="price"
                    class="title-color">{{ ui_change('Expected_Date_of_Relocation' , 'property_transaction') }}</label>
                <input type="text" name="relocation_date" class="relocation_date form-control"
                    placeholder="DD/MM/YYYY">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-4">
            <div class="form-group">
                <label for="name" class="title-color">{{ ui_change('enquiry_status' , 'property_transaction') }}
                </label>
                <select class="js-select2-custom form-control" name="proposal_status_id" required>

                    @foreach ($enquiry_statuses as $enquiry_status_item)
                        <option value="{{ $enquiry_status_item->id }}">
                            {{ $enquiry_status_item->name }}
                        </option>
                    @endforeach
                </select>
                @error('proposal_status_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-4">
            <div class="form-group">
                <label for="name" class="title-color">{{ ui_change('proposal_status' , 'property_transaction') }}
                </label>
                <select class="js-select2-custom form-control" name="proposal_request_status_id" required>

                    @foreach ($enquiry_request_statuses as $enquiry_request_status_item)
                        <option value="{{ $enquiry_request_status_item->id }}">
                            {{ $enquiry_request_status_item->name }}
                        </option>
                    @endforeach
                </select>
                @error('proposal_request_status_id')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-4">
            <div class="form-group">
                <label for="price"
                    class="title-color">{{ ui_change('period_from_to' , 'property_transaction') }} <span class="text-danger"> *</span></label>
                <input type="text" name="period_from" class="period_from form-control"
                    placeholder="DD/MM/YYYY"   onchange="proposal_period_date_clc(),unit_change_main_date()" required value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}">
            </div>
        </div>
        <div class="col-md-6 col-lg-4 col-xl-4">
            <div class="form-group">
                <label  class="title-color"> </label>
                <input type="text" name="period_to" class="period_to form-control mt-2" required
                    placeholder="DD/MM/YYYY" value="{{ \Carbon\Carbon::now()->subDay()->addYear()->format('d/m/Y') }}">
            </div>
        </div>
    </div>
</div>
