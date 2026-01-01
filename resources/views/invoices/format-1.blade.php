<!DOCTYPE html>
<html lang="ar" dir="rtl">
@php
    $dir = session()->get('direction');
@endphp

<head>
    <meta charset="UTF-8">
    <title>{{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: 'dejavusans';
            direction: rtl;
            text-align: right; 
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 8px;
        }

        th {
            background-color: #f0f0f0;
        }

        h1,
        h3 {
            text-align: center;
        }
    </style>
</head>

<body>
    @if (isset($invoice_settings))
        @if ($invoice_settings->invoice_with_logo == 'yes')
            @if ($invoice_settings->invoice_logo_position == 'right')
                @include('invoices.includes.format-1.logo_right', [
                    'invoice_settings' => $invoice_settings,
                ])
            @elseif($invoice_settings->invoice_logo_position == 'left')
                @include('invoices.includes.format-1.logo_left', [
                    'invoice_settings' => $invoice_settings,
                ])
            @elseif($invoice_settings->invoice_logo_position == 'middle')
                @include('invoices.includes.format-1.logo_middle', [
                    'invoice_settings' => $invoice_settings,
                ])
            @endif
        @else
        @endif
    @else
        @include('invoices.includes.format-1.logo_right')

    @endif

    <table style="width: 70%;margin: 0 auto; border-collapse: separate;border-spacing: 1px 0; ">
        <tr>
            <td style="color: {{ $invoice_settings->format_color }}; background-color: {{ $invoice_settings->background_color }}; border: 2px solid black;text-align: center;vertical-align: middle;font-size: 12pt;font-weight: bold;padding: 8px 0;">
                {{ $invoice_settings->invoice_name }}
            </td>
        </tr>
    </table>










    <table
        style="color: {{ $invoice_settings->format_color }}; background-color: {{ $invoice_settings->background_color }};width: 100%;border-collapse: collapse;border: 1px solid #000;font-size: 10pt;">
        <tr>

            <td style="text-align:left;width: 40%;vertical-align: top;padding: 6px 10px;line-height: 1.6;">
                @if(isset($invoice->invoice_number))
                    <p style="text-align:left;width: 45%; text-align: left;">{{ ui_change('Invoice_No.') }} : {{ $invoice->invoice_number }}</p>
                @endif
                @if(isset($invoice->invoice_date))
                    <p style="text-align:left;width: 5%; text-align: center;">{{ ui_change('Invoice_Date') }} : {{ $invoice->invoice_date }}</p>
                @endif
                @if(isset($company->vat_no))
                    <p style="text-align:left;width: 50%; text-align: left;">{{ ui_change('VAT_Regn_No.') }} : {{ $company->vat_no }}</p>
                @endif
                
                
                
            </td>
            <td
                style="text-align:left;width: 60%;vertical-align: top;border-right: 1px solid #000;padding: 6px 10px;line-height: 1.5; ">
                <strong>{{ $invoice->tenant?->name }}</strong><br>
                @if($invoice_settings->tenant_address == 1 && isset($invoice->tenant?->address1)) 
                    {{ $invoice->tenant?->address1 }}<br>
                @endif
                @if($invoice_settings->tenant_vat_no == 1 && isset($invoice->tenant?->registration_no)) 
                    {{ ui_change('VAT_Account_No') }} : {{ $invoice->tenant?->registration_no }}<br>
                @endif 
                @if($invoice_settings->tenant_email == 1 && isset($invoice->tenant?->email1)) 
                    {{ ui_change('email') }} : {{ $invoice->tenant?->email1 }}<br>
                @endif 
                @if($invoice_settings->tenant_phone == 1 && isset($invoice->tenant?->contact_no)) 
                    {{ ui_change('phone') }} : {{ $invoice->tenant?->contact_no }}<br>
                @endif 
                @if($invoice_settings->tenant_fax == 1 && isset($invoice->tenant?->fax)) 
                    {{ ui_change('fax') }} : {{ $invoice->tenant?->fax }}<br>
                @endif 
            </td>
        </tr>
    </table>
   


    @php
        $headerBg = $invoice_settings->background_color;
        $headerColor = $invoice_settings->format_color; 
        $thStyle = "padding: 8px; font-weight: bold; background-color: $headerBg; color: $headerColor;";
    @endphp
 

    <table dir="ltr" style="width: 100%;border-collapse: collapse; /* Merges cell borders */margin-top: 30px; ">
        <thead
            style="color: {{ $invoice_settings->format_color }}; background-color: {{ $invoice_settings->background_color }};">
            <tr
                style="color: {{ $invoice_settings->format_color }}; background-color: {{ $invoice_settings->background_color }};">
                <th
                    style="color: {{ $invoice_settings->format_color }};background-color: {{ $invoice_settings->background_color }}; border: 1px solid #000;padding: 8px;text-align: left; font-weight: bold;width: 5%;  ">
                    #
                </th>
                <th
                    style="color: {{ $invoice_settings->format_color }};background-color: {{ $invoice_settings->background_color }};border: 1px solid #000;padding: 8px;text-align: left; font-weight: bold; width: 15%; ">
                    Agreement No.
                </th>
                <th
                    style="background-color: {{ $invoice_settings->background_color }}; 
                color: {{ $invoice_settings->format_color }};border: 1px solid #000;padding: 8px;text-align: left; font-weight: bold; width: 15%; ">
                    Category
                </th>
                <th
                    style="background-color: {{ $invoice_settings->background_color }}; 
                color: {{ $invoice_settings->format_color }};border: 1px solid #000;padding: 8px;text-align: left; font-weight: bold;width: 45%; ">
                    Unit Description
                </th>
                <th
                    style="background-color: {{ $invoice_settings->background_color }}; 
                color: {{ $invoice_settings->format_color }};border: 1px solid #000;padding: 8px;text-align: center;font-weight: bold;width: 15%; ">
                    Amount Exl. VAT {{ ' ( ' . $company->currency_code . ' )' }}
                </th>
                <th
                    style="background-color: {{ $invoice_settings->background_color }}; 
                color: {{ $invoice_settings->format_color }};border: 1px solid #000;padding: 8px;text-align: center;font-weight: bold;width: 15%; ">
                    VAT %
                </th>
                <th
                    style="background-color: {{ $invoice_settings->background_color }}; 
                color: {{ $invoice_settings->format_color }};border: 1px solid #000;padding: 8px;text-align: center;font-weight: bold;width: 15%; ">
                    VAT Amount
                </th>
                <th
                    style="background-color: {{ $invoice_settings->background_color }}; 
                color: {{ $invoice_settings->format_color }};border: 1px solid #000;padding: 8px;text-align: center;font-weight: bold;width: 15%;">
                    Net Total Amount
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $total_exc_vat = 0;
                $total_vat = 0;
                $tdStyleNoBorder = 'padding: 8px; border: none;';
            @endphp
            @foreach ($invoice->items as $index => $item)
                @php
                    $rowBg = $index % 2 == 0 ? '#FFFFFF' : '#868282';
                @endphp
                <tr style="background-color: {{ $rowBg }};">
                    <td style="{{ $tdStyleNoBorder }}  padding: 8px;text-align: left;">
                        {{ $index + 1 }}
                    </td>
                    <td style="{{ $tdStyleNoBorder }}  padding: 8px;text-align: left;">
                        {{ $item->agreement?->agreement_no }}
                    </td>
                    <td style="{{ $tdStyleNoBorder }}  padding: 8px;text-align: center;">
                        {{ $item->category }}
                    </td>
                    <td style="{{ $tdStyleNoBorder }}  padding: 8px;text-align: center;">
                        {{ $item->building->name .
                            '-' .
                            $item->unit_management->block_unit_management->block->name .
                            '-' .
                            $item->unit_management->floor_unit_management->floor_management_main->name .
                            '-' .
                            $item->unit_management->unit_management_main->name }}
                    </td>
                    <td
                        @if ($dir == 'rtl') style="{{ $tdStyleNoBorder }} text-align: left;" @else  style="{{ $tdStyleNoBorder }} text-align: right;" @endif>
                        {{ number_format($item->rent_amount, $company->decimals ?? 2) }}</td>
                    <td
                        @if ($dir == 'rtl') style="{{ $tdStyleNoBorder }} text-align: left;" @else  style="{{ $tdStyleNoBorder }} text-align: right;" @endif>
                        {{ number_format($item->vat_percentage ?? 0) }}
                    </td>
                    <td
                        @if ($dir == 'rtl') style="{{ $tdStyleNoBorder }} text-align: left;" @else  style="{{ $tdStyleNoBorder }} text-align: right;" @endif>
                        {{ number_format($item->vat, $company->decimals ?? 2) }}</td>
                    <td
                        @if ($dir == 'rtl') style="{{ $tdStyleNoBorder }} text-align: left;" @else  style="{{ $tdStyleNoBorder }} text-align: right;" @endif>
                        {{ number_format($item->total, $company->decimals ?? 2) }}</td>
                    @php
                        $total_exc_vat += $item->rent_amount;
                        $total_vat += $item->vat;
                    @endphp
                </tr>
            @endforeach
        </tbody>
    </table>








    @php

        $in_words = '';

        $in_words_grosstotal = amount_in_words($total_exc_vat);
        $in_words_vat_amount = amount_in_words($total_vat);
        $in_words_nettotal = amount_in_words($invoice->total);
        $in_words .=
            '<p style="margin-top:5px;margin-bottom:0px;"><b>Total Excl. VAT : </b><br>' .
            $in_words_grosstotal .
            '</p>';
        $in_words .=
            '<p style="margin-top:5px;margin-bottom:0px;"><b>VAT Amount : </b><br>' . $in_words_vat_amount . '</p>';

        $in_words .=
            '<p style="margin-top:5px;margin-bottom:0px;"><b>Total Incl. VAT : </b><br>' . $in_words_nettotal . '</p>';
    @endphp

    <table dir="ltr" class="totals" width="100%" cellspacing="0"
        style="vertical-align:middle; border: 1px solid #111; margin-top:10px; border-collapse: collapse;">
        {{-- Changed to border: 1px solid #111 and added border-collapse: collapse --}}
        <tbody>
            <tr>
                {{-- Add border-right and border-bottom to the large cell --}}
                <td rowspan="3" width="68%"
                    style="border-right: 1px solid #111; border-bottom: 1px solid #111; padding: 5px;">
                    {!! $in_words !!}
                    {{-- Use {!! !!} to render raw HTML stored in $in_words --}}
                </td>

                {{-- Cell for "Total Excl. VAT" text --}}
                <td style="border-bottom: 1px solid #111; border-right: 1px solid #111; padding: 5px;">Total Excl. VAT
                    {{ ' (' . $company->currency_code . ')' }}
                </td>

                {{-- Cell for the amount --}}
                <td style="border-bottom: 1px solid #111; border-right: 1px solid #111; padding: 5px;">
                    {{ $total_exc_vat }}</td>
            </tr>
            <tr>
                <td style="border-bottom: 1px solid #111; border-right: 1px solid #111; padding: 5px;">VAT Amount
                    {{ ' (' . $company->currency_code . ')' }}</td>
                <td style="border-bottom: 1px solid #111; border-right: 1px solid #111; padding: 5px;">
                    {{ $total_vat }}</td>
            </tr>
            <tr>
                {{-- Last row, only need border-right for these cells --}}
                <td style="border-right: 1px solid #111; padding: 5px;">Total Incl. VAT
                    {{ ' (' . $company->currency_code . ')' }}</td>
                <td style="border-right: 1px solid #111; padding: 5px;">{{ $invoice->total }}</td>
            </tr>
        </tbody>
    </table>






    <table dir="ltr" class="totals" width="100%" cellspacing="0"
        style="vertical-align:middle;  border: none;border-collapse: collapse; margin-top:10px; border-collapse: collapse;">
        {{-- Changed to border: 1px solid #111 and added border-collapse: collapse --}}
        <tbody>
            <tr>
                {{-- Add border-right and border-bottom to the large cell --}}
                <td rowspan="3" width="68%" style="border: none; padding: 5px;">
                    @if (isset($invoice_settings->ledger->account_name))
                        <div class="bank-details col-6  ">
                            <p><strong>Bank Details :-</strong></p>
                            <p>{{ ui_change('account_name', 'property_report') }}:
                                <strong>{{ $invoice_settings->ledger?->account_name }}</strong>
                            </p>
                            <p>{{ ui_change('bank_name', 'property_report') }}:
                                <strong>{{ $invoice_settings->ledger?->bank_name }}</strong><br>
                                {{ ui_change('branch', 'property_report') }}: <strong>
                                    {{ $invoice_settings->ledger?->branch }}
                                </strong>
                            </p>
                            <p>{{ ui_change('account_no', 'property_report') }}:
                                <strong>{{ $invoice_settings->ledger?->account_no }}</strong>
                            </p>
                            <p>{{ ui_change('swift_code', 'property_report') }}:
                                <strong>{{ $invoice_settings->ledger?->swift_code }}</strong>
                            </p>
                            <p>{{ ui_change('iban_no', 'property_report') }}:
                                <strong>{{ $invoice_settings->ledger?->iban_no }}</strong>
                            </p>
                        </div>
                    @endif
                </td>

                {{-- Cell for "Total Excl. VAT" text --}}
                <td style="padding: 5px;border: none;">
                    @if (isset($invoice->qr_code))
                        <img src="{{ asset('assets/finexerp_logo.png') }}?v={{ time() }}" alt="Company Logo"
                            style="
                        width: {{ optional($invoice_settings)->qr_code_width ?? '180' }}px;
                        height: {{ optional($invoice_settings)->qr_code_height ?? '100' }}px;
                        object-fit: contain;
                        margin: 0;
                        padding: 0;
                     ">
                    @endif
                </td>

            </tr>
        </tbody>
    </table>


</body>

</html>
