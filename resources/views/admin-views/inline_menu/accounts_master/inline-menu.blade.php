<div class="inline-page-menu my-4">
    <ul class="list-unstyled">

        <li class="{{ Request::is('groups') ?'active':'' }}"><a href="{{ route('groups.index') }}">{{__('roles.groups')}}</a></li>
        <li class="{{ Request::is('ledgers') ?'active':'' }}"><a href="{{ route('ledgers.index') }}">{{__('roles.ledgers')}}</a></li>
        <li class="{{ Request::is('chart_of_account') ?'active':'' }}"><a href="{{ route('chart_of_account') }}">{{__('collections.chart_of_account')}}</a></li>
        <li class="{{ Request::is('category-cost-center') ?'active':'' }}"><a href="{{ route('cost_center_category.index') }}">{{__('roles.cost_center_category')}}</a></li>
        <li class="{{ Request::is('cost_center') ?'active':'' }}"><a href="{{ route('cost_center.index') }}">{{__('roles.cost_center')}}</a></li>

    </ul>
</div>
