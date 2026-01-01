@extends('layouts.back-end.app')

@section('title', ui_change('create', 'property_report'))
@php
    $company = App\Models\Company::where('id', auth()->user()?->company_id)->first() ?? App\Models\Company::first();
    $lang = session()->get('locale');
    $dir = session()->get('direction');
    $signature_mode = App\Models\CompanySettings::where('type', 'signature_mode')->first();
    $width = App\Models\CompanySettings::where('type', 'width')->first();
    $height = App\Models\CompanySettings::where('type', 'height')->first();
@endphp
@push('css_or_js')
@endpush

@section('content')

    <div class="content container-fluid">
        <!-- Page Title -->

        <!-- End Page Title -->
        @include('admin-views.inline_menu.property_transaction.inline-menu')
        <form action="{{ route('sales_return.store') }}" method="POST">
            @csrf
            <input type="hidden" value="{{ $tenant->id }}" name="tenant_id">
            <input type="hidden" value="{{ $invoice->id }}" name="invoice_id">
            <div class="row mt-20">
                <div class="col-md-12">
                    <div class="card">
                        <div class="table-responsive">
                            <table id="datatable"
                                style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};"
                                class="table table-hover table-borderless table-thead-bordered table-nowrap table-align-middle card-table w-100">
                                <thead class="thead-light thead-50 text-capitalize">
                                    <tr>
                                        <th style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                                            <input id="bulk_check_all" class="bulk_check_all" type="checkbox" />
                                            {{ ui_change('sl', 'property_report') }}
                                        </th>
                                        <th class="text-center">{{ ui_change('agreement_no', 'property_report') }}</th>
                                        <th class="text-center">{{ ui_change('category', 'property_report') }}</th>
                                        <th class="text-center">{{ ui_change('unit_description', 'property_report') }}</th>
                                        <th class="text-center">
                                            {{ ui_change('amount_Exl. VAT', 'property_report') . ' ( ' . $company->currency_code . ' )' }}
                                        </th>
                                        <th class="text-center">{{ ui_change('VAT', 'property_report') }} %</th>
                                        <th class="text-center">{{ ui_change('VAT_amount', 'property_report') }}</th>
                                        <th class="text-center">{{ ui_change('net_total_amount', 'property_report') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php
                                        $sub_total = 0;
                                        $total_vat = 0;
                                        $dir = Session::get('locale') === 'ar' ? 'rtl' : 'ltr';
                                    @endphp

                                    @foreach ($invoices_items as $k => $invoice_item_main)
                                        <tr>
                                            <th scope="row"
                                                style="text-align: {{ Session::get('locale') === 'ar' ? 'right' : 'left' }};">
                                                <input class="check_bulk_item" name="bulk_ids[]" type="checkbox"
                                                    value="{{ $invoice_item_main->id }}" />
                                                {{ $loop->index + 1 }}
                                            </th>
                                            <td class="text-center">
                                                {{ $invoice_item_main->agreement->agreement_no ?? ui_change('N/A', 'property_report') }}
                                            </td>
                                            <td class="text-center">{{ ucfirst($invoice_item_main->category) }}</td>
                                            <td class="text-center">
                                                {{ ($invoice_item_main->building->name ?? '') .
                                                    '-' .
                                                    ($invoice_item_main->unit_management?->block_unit_management?->block?->name ?? '') .
                                                    '-' .
                                                    ($invoice_item_main->unit_management?->floor_unit_management?->floor_management_main?->name ?? '') .
                                                    '-' .
                                                    ($invoice_item_main->unit_management?->unit_management_main?->name ?? '') }}

                                            </td>

                                            <td style="text-align: {{ $dir == 'rtl' ? 'left' : 'right' }};">
                                                {{ number_format($invoice_item_main->rent_amount, $company->decimals ?? 2) }}
                                            </td>
                                            <td style="text-align: {{ $dir == 'rtl' ? 'left' : 'right' }};">
                                                {{ number_format($invoice_item_main->vat_percentage ?? 0) }}
                                            </td>

                                            <td style="text-align: {{ $dir == 'rtl' ? 'left' : 'right' }};">
                                                {{ number_format($invoice_item_main->vat, $company->decimals ?? 2) }}
                                            </td>

                                            <td style="text-align: {{ $dir == 'rtl' ? 'left' : 'right' }};">
                                                {{ number_format($invoice_item_main->total, $company->decimals ?? 2) }}
                                            </td>



                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                        </div>



                    </div>
                </div>
            </div>
            <div class="row justify-content-end gap-3 mt-3 mx-1">
                <button type="submit" id="saveTenantPersonal"
                    class="btn btn--primary px-5 saveTenant">{{ ui_change('submit', 'property_transaction') }}</button>
            </div>
        </form>
    </div>


@endsection
