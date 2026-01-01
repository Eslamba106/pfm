<div class="inline-page-menu my-4">
    <ul class="list-unstyled">

        <li class="{{ Request::is('companies') ?'active':'' }}"><a href="{{ route('companies') }}">{{ ui_change('companies' , 'hierarchy')  }} </a></li>
        <li class="{{ Request::is('region') ?'active':'' }}"><a href="{{ route('region') }}">{{ ui_change('region' , 'hierarchy')  }} </a></li>
        <li class="{{ Request::is('countries') ?'active':'' }}"><a href="{{ route('country') }}">{{ ui_change('countries' , 'hierarchy')  }} </a></li>

    </ul>
</div>
