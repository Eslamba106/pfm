<div class="inline-page-menu my-4">
    <ul class="list-unstyled">
        <li class="{{ Request::is('tenant') ?'active':'' }}"><a href="{{ route('tenant.index') }}">{{ui_change('tenants' , 'property_master')}}</a></li>
        <li class="{{ Request::is('agent') ?'active':'' }}"><a href="{{ route('agent.index') }}">{{ui_change('agent' , 'property_master')}}</a></li>
        <li class="{{ Request::is('ownership') ?'active':'' }}"><a href="{{ route('ownership.index') }}">{{ui_change('ownership' , 'property_master')}}</a></li>
        <li class="{{ Request::is('property_type') ?'active':'' }}"><a href="{{ route('property_type.index') }}">{{ui_change('property_type' , 'property_master')}}</a></li>
        <li class="{{ Request::is('services') ?'active':'' }}"><a href="{{ route('services.index') }}">{{ui_change('services' , 'property_master')}}</a></li>
        <li class="{{ Request::is('block') ?'active':'' }}"><a href="{{ route('block.index') }}">{{ui_change('blocks' , 'property_master')}}</a></li>
        <li class="{{ Request::is('floors') ?'active':'' }}"><a href="{{ route('floor.index') }}">{{ui_change('floors' , 'property_master')}}</a></li>
        <li class="{{ Request::is('units') ?'active':'' }}"><a href="{{ route('unit.index') }}">{{ui_change('units' , 'property_master')}}</a></li>
        <li class="{{ Request::is('unit_description') ?'active':'' }}"><a href="{{ route('unit_description.index') }}">{{ui_change('unit_description' , 'property_master')}}</a></li>
        <li class="{{ Request::is('unit_condition') ?'active':'' }}"><a href="{{ route('unit_condition.index') }}">{{ui_change('unit_condition' , 'property_master')}}</a></li>
        <li class="{{ Request::is('unit_type') ?'active':'' }}"><a href="{{ route('unit_type.index') }}">{{ui_change('unit_type' , 'property_master')}}</a></li>
        <li class="{{ Request::is('unit_parking') ?'active':'' }}"><a href="{{ route('unit_parking.index') }}">{{ui_change('unit_parking' , 'property_master')}}</a></li>
        <li class="{{ Request::is('view') ?'active':'' }}"><a href="{{ route('view.index') }}">{{ui_change('view' , 'property_master')}}</a></li>
        <li class="{{ Request::is('business_activity') ?'active':'' }}"><a href="{{ route('business_activity.index') }}">{{ui_change('business_activitys' , 'property_master')}}</a></li>
        <li class="{{ Request::is('live_with') ?'active':'' }}"><a href="{{ route('live_with.index') }}">{{ui_change('live_withs' , 'property_master')}}</a></li>
        <li class="{{ Request::is('enquiry_status') ?'active':'' }}"><a href="{{ route('enquiry_status.index') }}">{{ui_change('enquiry_status' , 'property_master')}}</a></li>
        <li class="{{ Request::is('enquiry_request_status') ?'active':'' }}"><a href="{{ route('enquiry_request_status.index') }}">{{ui_change('enquiry_request_status' , 'property_master')}}</a></li>
    </ul>
</div>
