<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome to FinexERP</title>
    @php
        $lang = session()->get('locale');
        $signature_mode = App\Models\CompanySettings::where('type', 'signature_mode')->first();
        $width = App\Models\CompanySettings::where('type', 'width')->first();
        $height = App\Models\CompanySettings::where('type', 'height')->first();
        $invoice_settings = App\Models\collections\InvoiceSettings::first();
        // dd($width , $height)
    @endphp

    <style>
        .section_two {
            margin-right: 50px;
            margin-left: 50px;
        }

        .company-info {
            max-width: 50%;
        }

        .company-info h2 {
            margin: 0;
            font-size: 18px;
        }

        .company-info p {
            margin: 2px 0;
            font-size: 14px;
        }

        .logo {
            width: 150px;

        }

        .partner-logos img {
            height: 50px;
            margin: 0 5px;

        }

        .invoice-title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-top: 10px;
        }

        .invoice-container-two {
            margin: auto;
            border: 1px solid #000;
            padding: 10px;
        }

        .title-two {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .invoice-header-two {
            display: flex;
            justify-content: space-between;
            border: 1px solid #000;
            background: #ddd;
            padding: 8px;
            font-weight: bold;
        }

        .invoice-body-two {
            display: flex;
            justify-content: space-between;
            border: 1px solid #000;
            padding: 10px;
        }

        .invoice-section-two {
            width: 48%;
        }

        .bold-two {
            font-weight: bold;
        }

        .invoice {
            margin-right: 50px;
            margin-top: 20px;

            margin-left: 50px;
            border-collapse: collapse;
        }

        .invoice th,
        .invoice td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }

        .invoice th {
            background-color: #f2f2f2;
        }

        .total {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="content container-fluid">
        <div class="row mt-20">
            <div class="col-md-12">
                <div class="card " id="printableArea">
                    @if (isset($invoice_settings))
                        @if ($invoice_settings->invoice_with_logo == 'yes')
                            @if ($invoice_settings->invoice_logo_position == 'right')
                                @include('emails.includes.logo_right', [
                                    'invoice_settings' => $invoice_settings,
                                ])
                            @elseif($invoice_settings->invoice_logo_position == 'left')
                                @include('emails.includes.logo_left', [
                                    'invoice_settings' => $invoice_settings,
                                ])
                            @elseif($invoice_settings->invoice_logo_position == 'middle')
                                @include('emails.includes.logo_middle', [
                                    'invoice_settings' => $invoice_settings,
                                ])
                            @endif
                        @else
                        @endif
                    @else
                        @include('emails.includes.logo_right')

                    @endif

                    <div class="section_two mt-5">
                        <div class="title-two">
                            @if (isset($invoice_settings))
                                {{ $invoice_settings->invoice_name }}
                            @else
                                {{ 'TAX INVOICE' }}
                            @endif
                        </div>

                        <div class="invoice-header-two">
                            <span>TO:</span>
                            <span></span>
                        </div>
                        @php
                            $company = $data['company'];
                            $country_master = $data['country_master'];
                            $users_cost = $data['users_cost'];
                            $users_count = $data['users_count'];
                            $buildings_cost = $data['buildings_cost'];
                            $buildings_count = $data['buildings_count'];
                            $units_cost = $data['units_cost'];
                            $units_count = $data['units_count'];
                            $branches_cost = $data['branches_cost'];
                            $branches_count = $data['branches_count'];
                            $setup_cost = $data['setup_cost'];
                        @endphp
                        <div class="invoice-body-two">
                            <div class="invoice-section-two">
                                <p class="bold-two">
                                    {{ $company->name }}
                                </p>

                                @if (isset($company->countryid))
                                    <p>{{ __('country.country') }} : {{ $country_master->country->name }}</p>
                                @endif

                            </div>

                            <div class="invoice-section-two">
                                <p><span class="bold-two">{{ __('collections.invoice_date') }}:</span>
                                    {{ \Carbon\Carbon::now()->format('j-M-Y') }} </p>
                            </div>
                        </div>
                    </div>


                    <table class="invoice">
                        <tr>
                            <th>{{ __('general.sl') }}</th>
                            <th>{{ __('Count') }}</th>
                            <th>{{ __('Cost') }}</th>
                            <th>{{ __('property_reports.total') }}</th>
                        </tr>
                        @php
                            $total =
                                $users_count * $users_cost +
                                $buildings_cost * $buildings_count +
                                $units_cost * $units_count +
                                $branches_cost * $branches_count;
                            $total_format = number_format($total, $company->decimals ?? 2);
                        @endphp
                        <tr>
                            <td>1</td>
                            <td>{{ __('companies.user_count') . ': ' . $users_count }}</td>
                            <td>{{ __('companies.monthly_subscription_user') . ': ' . number_format($users_cost, $company->decimals ?? 2) }}
                            </td>
                            <td>{{ number_format($users_count * $users_cost, $company->decimals ?? 2) }}</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>{{ __('companies.buildings_count') . ': ' . $buildings_count }}</td>
                            <td>{{ __('companies.monthly_subscription_building') . ': ' . number_format($buildings_cost, $company->decimals ?? 2) }}
                            </td>
                            <td>{{ number_format($buildings_cost * $buildings_count, $company->decimals ?? 2) }}</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>{{ __('companies.units_count') . ': ' . $units_count }}</td>
                            <td>{{ __('companies.monthly_subscription_units') . ': ' . number_format($units_cost, $company->decimals ?? 2) }}
                            </td>
                            <td>{{ number_format($units_cost * $units_count, $company->decimals ?? 2) }}</td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>{{ __('companies.branches_count') . ': ' . $branches_count }}</td>
                            <td>{{ __('companies.monthly_subscription_branches') . ': ' . number_format($branches_cost, $company->decimals ?? 2) }}
                            </td>
                            <td>{{ number_format($branches_cost * $branches_count, $company->decimals ?? 2) }}</td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td></td>
                            <td></td>
                            <td colspan="3">
                                {{ __('companies.setup_cost') . ': ' . number_format($setup_cost, $company->decimals ?? 2) }}
                            </td>
                        </tr>



                    </table>
                    <table class="invoice">

                        <tr>
                            <td class="total">Grand Total {{ ' ( ' . $company->currency_code . ' )' }} </td>
                            <td>{{ number_format($total, $company->decimals ?? 2) }}</td>
                        </tr>
                    </table>





                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Page level plugins -->
    <script src="{{ asset(main_path() . 'back-end') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset(main_path() . 'back-end') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>



</body>

</html>
