<div class="inline-page-menu my-4">
    <ul class="list-unstyled">

        <li class="{{ Request::is('transactions_settings/receipt_settings') ?'active':'' }}"><a href="{{ route('receipt_settings') }}">{{ui_change('receipt_settings')}}</a></li>
        <li class="{{ Request::is('transactions_settings/invoice_settings') ?'active':'' }}"><a href="{{ route('invoice_settings') }}">{{ui_change('invoice_settings')}}</a></li>
        <li class="{{ Request::is('transactions_settings/sales_return_settings') ?'active':'' }}"><a href="{{ route('sales_return_settings') }}">{{ui_change('sales_return_settings')}}</a></li>

    </ul>
</div>
