<div class="inline-page-menu my-4">
    <ul class="list-unstyled"> 
        <li class="{{ Request::is('*room-building*') ?'active':'' }}"><a href="{{ route('room_building.list') }}">{{ui_change('room_building','facility_master') }}</a></li>
        <li class="{{ Request::is('*room-block*') ?'active':'' }}"><a href="{{ route('room_block.list') }}">{{ui_change('room_block','facility_master') }}</a></li>
        <li class="{{ Request::is('*room-floor*') ?'active':'' }}"><a href="{{ route('room_floor.list') }}">{{ui_change('room_floor','facility_master') }}</a></li>
        <li class="{{ Request::is('*room-unit*') ?'active':'' }}"><a href="{{ route('room_unit.list') }}">{{ui_change('room_unit','facility_master') }}</a></li>
         
    </ul>
</div>
