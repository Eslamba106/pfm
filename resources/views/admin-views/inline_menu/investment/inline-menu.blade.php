<div class="inline-page-menu my-4">
    <ul class="list-unstyled">

        <li class="{{ Request::is('investments*') ?'active':'' }}"><a href="{{ route('investment.index') }}">{{ ui_change('investments' , 'investment')  }} </a></li>
        <li class="{{ Request::is('investors*') ?'active':'' }}"><a href="{{ route('investor.index') }}">{{ ui_change('investors' , 'investment')  }} </a></li> 

    </ul>
</div>
