<div class="inline-page-menu my-4">
    <ul class="list-unstyled">
        {{-- $facility_masters = ['department' , 'complaint_category','freezing' ,'main_complaint' ,'employee_type','priority' , 'asset_group', 'work_status'] --}}

        <li class="{{ Request::is('department') ?'active':'' }}"><a href="{{ route('department.index') }}">{{ui_change('department','facility_master') }}</a></li>
        <li class="{{ Request::is('complaint_category') ?'active':'' }}"><a href="{{ route('complaint_category.index') }}">{{ui_change('complaint_category','facility_master') }}</a></li>
        <li class="{{ Request::is('main_complaint') ?'active':'' }}"><a href="{{ route('main_complaint.index') }}">{{ui_change('main_complaint','facility_master') }}</a></li>
        <li class="{{ Request::is('supplier') ?'active':'' }}"><a href="{{ route('supplier.index') }}">{{ui_change('supplier','facility_master')  }}</a></li>
        <li class="{{ Request::is('amc_providers') ?'active':'' }}"><a href="{{ route('amc_provider.index') }}">{{ui_change('amc_provider','facility_master') }}</a></li>
        <li class="{{ Request::is('work_status') ?'active':'' }}"><a href="{{ route('work_status.index') }}">{{ui_change('work_status','facility_master')  }}</a></li>
        <li class="{{ Request::is('employee_type') ?'active':'' }}"><a href="{{ route('employee_type.index') }}">{{ui_change('employee_type','facility_master') }}</a></li>
        <li class="{{ Request::is('employee') ?'active':'' }}"><a href="{{ route('employee.index') }}">{{ui_change('employee','facility_master')  }}</a></li>
        <li class="{{ Request::is('asset_group') ?'active':'' }}"><a href="{{ route('asset_group.index') }}">{{ui_change('asset_group','facility_master') }}</a></li>
        <li class="{{ Request::is('asset') ?'active':'' }}"><a href="{{ route('asset.index') }}">{{ui_change('asset','facility_master') }}</a></li>
        <li class="{{ Request::is('freezing') ?'active':'' }}"><a href="{{ route('freezing.index') }}">{{ui_change('freezing','facility_master')  }}</a></li>
        <li class="{{ Request::is('priority') ?'active':'' }}"><a href="{{ route('priority.index') }}">{{ui_change('priority','facility_master')  }}</a></li>
 
    </ul>
</div>
