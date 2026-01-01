<div class="inline-page-menu my-4">
    <ul class="list-unstyled">
        
        <li class="{{ Request::is('settings/ui-settings/dashboard*') ? 'active' : '' }}"><a href="{{ route('admin.settings.ui_settings.index' , 'dashboard') }}">{{ ui_change('dashboard' , 'ui_settings')}}</a></li>
        <li class="{{ Request::is('settings/ui-settings/ui_settings*') ? 'active' : '' }}"><a href="{{ route('admin.settings.ui_settings.index' , 'ui_settings') }}">{{ ui_change('ui_settings' , 'ui_settings')}}</a></li>
        <li class="{{ Request::is('settings/ui-settings/search_unit*') ? 'active' : '' }}"><a href="{{ route('admin.settings.ui_settings.index' , 'search_unit') }}">{{ ui_change('search_unit' , 'search_unit')}}</a></li>
        <li class="{{ Request::is('settings/ui-settings/hierarchy*') ? 'active' : '' }}"><a href="{{ route('admin.settings.ui_settings.index' , 'hierarchy') }}">{{ ui_change('hierarchy' , 'hierarchy')}}</a></li>
        <li class="{{ Request::is('settings/ui-settings/property_master*') ? 'active' : '' }}"><a href="{{ route('admin.settings.ui_settings.index' , 'property_master') }}">{{ ui_change('property_master' , 'property_master')}}</a></li>
        <li class="{{ Request::is('settings/ui-settings/property_config*') ? 'active' : '' }}"><a href="{{ route('admin.settings.ui_settings.index' , 'property_config') }}">{{ ui_change('property_config' , 'property_config')}}</a></li>
        <li class="{{ Request::is('settings/ui-settings/transaction*') ? 'active' : '' }}"><a href="{{ route('admin.settings.ui_settings.index' , 'property_transaction') }}">{{ ui_change('property_transaction' , 'property_transaction')}}</a></li>
        <li class="{{ Request::is('settings/ui-settings/property_report*') ? 'active' : '' }}"><a href="{{ route('admin.settings.ui_settings.index' , 'property_report') }}">{{ ui_change('property_report' , 'property_report')}}</a></li>
        <li class="{{ Request::is('settings/ui-settings/investment*') ? 'active' : '' }}"><a href="{{ route('admin.settings.ui_settings.index' , 'investment') }}">{{ ui_change('investment' , 'investment')}}</a></li>
        <li class="{{ Request::is('settings/ui-settings/room_reservation*') ? 'active' : '' }}"><a href="{{ route('admin.settings.ui_settings.index' , 'room_reservation') }}">{{ ui_change('room_reservation' , 'room_reservation')}}</a></li>
 
    </ul>
</div>
