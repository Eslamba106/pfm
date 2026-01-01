<div class="inline-page-menu my-4">
    <ul class="list-unstyled">

        <li class="{{ Request::is('general_check_property') ?'active':'' }}"><a href="{{ route('enquiry.general_check_property') }}">{{ ui_change('enquiry_quick_search' , 'property_transaction') }}</a></li>
        <li class="{{ (Request::is('enquiry') || Request::is('enquiry/create') || Request::is('enquiry/edit/*') || Request::is('enquiry/create_with_select_unit*') ) ?'active':'' }}"><a href="{{ route('enquiry.index') }}">{{ ui_change('enquiry' , 'property_transaction') }}</a></li>
        <li class="{{ (Request::is('proposal') || Request::is('proposal/create') || Request::is('proposal/edit/*')  || Request::is('proposal/create_with_select_unit*')||  Request::is('enquiry/add_to_proposal/*') ) ?'active':'' }}"><a href="{{ route('proposal.index') }}">{{ ui_change('proposal' , 'property_transaction') }}</a></li>
        <li class="{{ (Request::is('booking') || Request::is('booking/create') || Request::is('booking/edit/*') || Request::is('booking/create_with_select_unit*') ||  Request::is('proposal/add_to_booking/*')) ?'active':'' }}"><a href="{{ route('booking.index') }}">{{ ui_change('booking' , 'property_transaction')  }}</a></li>
        <li class="{{ (Request::is('agreement') || Request::is('agreement/create') || Request::is('agreement/edit/*')  || Request::is('agreement/create_with_select_unit*')||  Request::is('booking/add_to_agreement/*')) ?'active':'' }}"><a href="{{ route('agreement.index') }}">{{ ui_change('agreement' , 'property_transaction')  }}</a></li>
        <li class="{{ (Request::is('termination') || Request::is('termination*') ) ?'active':'' }}"><a href="{{ route('termination.index') }}">{{ ui_change('termination' , 'property_transaction') }}</a></li>
        <li class="{{ (Request::is('renewal') || Request::is('renewal*') ) ?'active':'' }}"><a href="">{{ ui_change('renewal' , 'property_transaction') }}</a></li>
 
    </ul>
</div>
