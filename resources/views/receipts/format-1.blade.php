<!DOCTYPE html>
<html lang="ar" dir="rtl">
@php
    $dir = session()->get('direction');
@endphp

<head>
    <meta charset="UTF-8">
    <title>{{ $receipt->receipt_ref }}</title>
    <style>
        .border-box {
            border: 1px solid #000;
            padding: 8px 10px;
            font-size: 11px;
        }
    </style>
</head>

<body>
 
    <table style="width:100%; border:none; border-collapse:collapse; border-spacing:0; table-layout:fixed;">
        <tr> 
            @php
                $companyLogo = optional($company)->logo_image;

                $logoPath =
                    $companyLogo && file_exists(public_path(main_path() . $companyLogo))
                        ? public_path(main_path() . $companyLogo)
                        : public_path('assets/finexerp_logo.png');

                $imageData = base64_encode(file_get_contents($logoPath));
                $mime = mime_content_type($logoPath);
                $logoSrc = "data:$mime;base64,$imageData";
            @endphp

            <td style="border:none !important; padding:0; margin:0; width:40%; text-align:right; vertical-align:top;">
                <img src="{{ $logoSrc }}"
                    style="display:block; height:80px; width:auto; max-width:100%; margin:0; padding:0;" alt="Logo">
                <table dir="ltr"
                    style="text-align:left;width:100%; border:1px solid #000; font-size:11px; padding:5px;background-color:rgb(207, 204, 204)">
                    <tr>
                        <td style="text-align:left;padding:5px;">Receipt No.</td>
                        <td style="text-align:left;padding:5px; text-align:right; font-weight:bold;">R-25-0019</td>
                    </tr>
                    <tr>
                        <td style="text-align:left;padding:5px;">Date</td>
                        <td style="text-align:left;padding:5px; text-align:right;font-weight:bold;">20-Jan-2025</td>
                    </tr>
                </table>

            </td>
            <td style="border:none !important; width:25%; padding:0; margin:0;"></td>

            <td style="vertical-align: top; border:none !important; width:35%; padding:0; margin:0; text-align:left;">

                @if ($receipt_settings->name)
                    <h4 style="margin:0 0 5px 0;color:{{ $receipt_settings->format_color }}">{{ $receipt_settings->name }}</h4>
                    <hr>
                @endif
                @if ($company->name)
                    <h4 style="margin:0 0 5px 0;">{{ $company->name }}</h4>
                @endif

                @if ($company->address1)
                    <p style="margin:2px 0; font-size:10px;">{{ $company->address1 }}</p>
                @endif

                @if ($company->mobile)
                    <p style="margin:2px 0; font-size:10px;">
                        {{ __('general.mobile') }} :
                        {{ '(' . $company->mobile_dail_code . ')' ?? '' }}{{ $company->mobile }}
                    </p>
                @endif

                @if ($company->phone)
                    <p style="margin:2px 0; font-size:10px;">
                        {{ __('general.phone') }} :
                        {{ '(' . $company->phone_dail_code . ')' ?? '' }}{{ $company->phone }}
                    </p>
                @endif

                @if ($company->email)
                    <p style="margin:2px 0; font-size:10px;">
                        {{ __('roles.email') }} : {{ $company->email }}
                    </p>
                @endif

            </td>


        </tr>
    </table>
    <table style="width:100%; border:none; border-collapse:collapse; border-spacing:0; table-layout:fixed;">
        <tr>


            <td dir="ltr"
                style="border:none !important; padding:0; margin:0; width:40%; text-align:left; vertical-align:top;">
                <br>
                <h4 style="text-align:left;margin:5px 0 5px 0;color:{{ $receipt_settings->format_color }};">{{ ui_change('Received_From') }}</h4>
                <hr>
                <table dir="ltr"
                    style="text-align:left;width:100%; font-size:12px;font-weight:bold; color:black;background-color:rgb(207, 204, 204)">
                    <tr>
                        <td style="text-align:left;padding:5px;">{{ $tenant->name }}</td>
                    </tr>

                </table>

            </td>
            <td style="border:none !important; width:25%; padding:0; margin:0;"></td>

            <td style="vertical-align: top; border:none !important; width:35%; padding:0; margin:0; text-align:left;">
            </td>


        </tr>
    </table>
    <table style="width:100%; border:none; border-collapse:collapse; border-spacing:0; table-layout:fixed;">
        <tr>


            <td dir="ltr"
                style="border:none !important; padding:0; margin:0; width:40%; text-align:left; vertical-align:top;">
                <br>
                <table dir="ltr"
                    style="text-align:center;width:100%; border:1px solid #000; font-size:11px; padding:5px;background-color:{{ $receipt_settings->background_color }};">
                    <tr>
                        <td style="text-align:center;padding:15px;font-size:15px;color:white;font-weight:bold">{{ $company->currency .' '.number_format($receipt->receipt_amount , $company->decimals) }}</td>
                    </tr>

                </table>

            </td>
            <td style="border:none !important; width:25%; padding:0; margin:0;"></td>

            <td style="vertical-align: top; border:none !important; width:35%; padding:0; margin:0; text-align:left;">
            </td>


        </tr>
    </table>



    
     <table width="100%" style="border-collapse: collapse; font-size: 11px; margin-top:10px;margin-bottom:300px;">
    <tr style="background:#e4e4e4;">
         <th style="padding:6px 8px; text-align:right; border:1px solid #000; width:120px;">
            Amount
        </th>
        <th style="padding:6px 8px; text-align:left; border:1px solid #000;">
            Particulars / Settlement Ref.
        </th>
       
    </tr>

    <tr>
       

        <td style="padding:10px 8px;  text-align:right;">
            {{ number_format($receipt->receipt_amount ?? 825, $company->decimals) }}
        </td>
         <td style="padding:10px 8px; text-align:left;">
            Agst Ref &nbsp;&nbsp; {{ $receipt->ref_no ?? 'INV-25-00001' }}
        </td>
    </tr>

    <tr>
        <td colspan="2"  ></td>
    </tr>
</table>







    <table style="width:100%; border-collapse:collapse; font-size:11px; margin-top:20px;text-align:left">

        <tr>
            <td colspan="3" style="border:1px solid #000; padding:6px; font-size:10px;text-align:left">
                The Sum Of : <strong>{{ $company->currency . amount_in_words($receipt->receipt_amount) }}</strong>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="border:1px solid #000; padding:6px; font-size:10px;">
                Remarks
            </td>
        </tr>
        <tr>
            @if ($receipt->payment_methods)
                @foreach ($receipt->payment_methods as $ledger)
                    {{-- @php
                    Log::info($receipt);
                @endphp --}}
                    @if (!empty($ledger->bank_name))
                        <td style="border:1px solid #000; padding:6px; font-size:10px;">
                            Bank Name: {{ $ledger->bank_name }}
                        </td>
                        <td style="border:1px solid #000; padding:6px; font-size:10px;">
                            Cheque No {{ $ledger->cheque_no }}
                        </td>
                        <td style="border:1px solid #000; padding:6px; font-size:10px;">
                            Cheque Date {{ $ledger->cheque_date }}
                        </td>
                    @else
                        <td colspan="3" style="border:1px solid #000; padding:6px; font-size:10px;">
                            {{ $ledger->name }}</td>
                    @endif
                @endforeach
            @endif



        </tr>
        <tr>
            <td colspan="3" style="border:1px solid #000; padding:6px; font-size:10px;">
                Note: Validity of the receipt is subject to realization of this cheque only
            </td>
        </tr>
    </table>

    <!-- SIGNATURE RIGHT SIDE -->
    <div style="text-align:right; margin-top:8px; font-weight:bold;">
        For GREEN FX W.L.L
    </div>



</body>

</html>
