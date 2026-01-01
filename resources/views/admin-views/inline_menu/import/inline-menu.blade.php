<div class="inline-page-menu my-4">
    <ul class="list-unstyled">

        <li class="{{ Request::is('import_excel/import_property_master') ?'active':'' }}"><a href="{{ route('import_property_master') }}">{{ ui_change('import_property_master'  )  }} </a></li> 
        <li class="{{ Request::is('import_excel/import_contract') ?'active':'' }}"><a href="{{ route('import_contract') }}">{{ ui_change('import_contract'  )  }} </a></li> 
        <li class="{{ Request::is('import_excel/import_tenant') ?'active':'' }}"><a href="{{ route('import_tenant') }}">{{ ui_change('import_tenant'  )  }} </a></li> 

    </ul>
</div>
