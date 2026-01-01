<div class="inline-page-menu my-4">
    <ul class="list-unstyled">
        <li class="{{ Request::is('facility_reports/open*') ?'active':'' }}"><a href="{{ route('facility_reports.open') }}">{{ __('facility_transactions.open_complaint_list') }}</a></li>
        <li class="{{ Request::is('facility_reports/freezed*') ?'active':'' }}"><a href="{{ route('facility_reports.freezed') }}">{{ __('facility_transactions.freezed_complaint_list') }}</a></li>
        <li class="{{ Request::is('facility_reports/closed*') ?'active':'' }}"><a href="{{ route('facility_reports.closed') }}">{{ __('facility_transactions.closed_complaint_list') }}</a></li>
       
    </ul>
</div>
