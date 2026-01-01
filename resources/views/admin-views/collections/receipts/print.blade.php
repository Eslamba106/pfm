@extends('layouts.back-end.app')
@php
        // $company = App\Models\Company::where('id' , auth()->user()->company_id )->first() ?? App\Models\User::first();
    $lang = session()->get('locale');
        $company = App\Models\Company::first() ;

@endphp
@section('title', __('roles.print_receipt'))

@push('css_or_js')
    <style>
        /* body {
                        font-family: Arial, sans-serif;
                        margin: 20px;
                    } */

        .receipt {
            width: 100%;
            border: 1px solid #000;
            padding: 20px;
            box-sizing: border-box;
        }


        .header {
            text-align: center;
            font-weight: bold;
            font-size: 18px;
            text-decoration: underline;
        }

        .section {
            margin-top: 15px;
        }

        .bold {
            font-weight: bold;
        }

        .info {
            display: flex;
            justify-content: space-between;
        }

        /* .amount-box {
            text-align: right;
            font-weight: bold;
            border: 1px solid #000;
            padding: 5px;
            display: inline-block;
        } */ 
        .amount-box {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
        } 
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .table th,
        .table td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        .footer_sec {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .underline {
            border-top: 1px solid black;
            padding-top: 5px;
        }
        /* .text-end{
            text-align: end;
        } */

        @media print {
            .print-btn {
                display: none;
            }
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3">
            <h2 class="h1 mb-0 text-capitalize d-flex gap-2">

                {{-- <button class="btn btn--primary mt-3" onclick="print_receipt()">{{ __('roles.print_receipt') }}</button> --}}
        <a class="btn btn--primary mt-3" target="_blank" href="{{ route('receipt.pdf' , $receipt->id) }}">{{ ui_change('print', 'property_report') }}</a>

            </h2>
        </div>
        <div class="container mt-4">
            <div class="card">
             
                <div class="card-header bg-light">
                    <h5 class="mb-0">{{ __('roles.print_receipt') }}</h5>
                </div>
                <div class="card-body" id="printableArea">
          
                    <div class="receipt ">
                                     @if (isset($receipt_settings))
                @if ($receipt_settings->receipt_with_logo == 'yes')
                    @if ($receipt_settings->receipt_logo_position == 'right')
                        @include('admin-views.collections.receipts.includes.logo_right', [
                            'receipt_settings' => $receipt_settings,
                        ])
                    @elseif($receipt_settings->receipt_logo_position == 'left')
                        @include('admin-views.collections.receipts.includes.logo_left', [
                            'receipt_settings' => $receipt_settings,
                        ])
                    @elseif($receipt_settings->receipt_logo_position == 'middle')
                        @include('admin-views.collections.receipts.includes.logo_middle', [
                            'receipt_settings' => $receipt_settings,
                        ])
                    @endif
                @else
                @endif
            @else
                @include('admin-views.collections.receipts.includes.logo_right')

            @endif
                        <div class="header">{{ __('roles.receipt') }}</div>

                        <div class="section info">
                            <div>
                                {{ __('roles.received_from') }} : <span class="bold">{{ $tenant->name }}</span><br>
                                @foreach ($invoice_items->unique(fn($item) => $item->unit_management->property_unit_management->name . '-' . $item->unit_management->unit_management_main->name . '-' . $item->unit_management->block_unit_management->block->name . '-' . $item->unit_management->floor_unit_management->floor_management_main->name) as $invoice_items_item_unit)
                                    {{ $invoice_items_item_unit->unit_management->property_unit_management->name .
                                        '-' .
                                        $invoice_items_item_unit->unit_management->unit_management_main->name .
                                        '-' .
                                        $invoice_items_item_unit->unit_management->block_unit_management->block->name .
                                        '-' .
                                        $invoice_items_item_unit->unit_management->floor_unit_management->floor_management_main->name }}<br>
                                @endforeach

                                {{-- @foreach ($invoice_items->unique('building_id') as $invoice_items_item_building)
                                    {{ $invoice_items_item_building->building->name }}<br>
                                @endforeach --}}

                                {{-- HORIZON TOWER {{ number_format($total_debit, $company->decimals) }} --}}
                            </div>
                            <div>
                                {{ __('collections.receipt_no') }} : <span
                                    class="bold">{{ $receipt->receipt_ref }}</span><br>
                                {{ __('collections.receipt_date') }} : <span
                                    class="bold">{{ \Carbon\Carbon::parse($receipt->receipt_date)->format('d-M-Y') }}
                                </span>
                            </div>
                        </div>

                        <hr>

                       
                        
                        

                        <table class="table" @if($lang == 'ar') dir="rtl" @else dir="ltr" @endif>
                            <thead>
                                <tr>
                                    <th class="text-start">{{ __('property_master.description') }}</th>
                                    <th class="@if($lang == 'ar') text-left @else text-right @endif">{{ __('property_transactions.amount') . ' (' . $company->currency_code . ')' }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($receipt_items as $receipt_items_item)
                                    @if ($receipt_items_item->paid_amount != 0)
                                        <tr>
                                            <td class="text-start">
                                                {{ $receipt_items_item->ref . '-' . $receipt_items_item->unit_name . '-(' . ucfirst($receipt_items_item->type) . ')' }}
                                            </td>
                                            <td class="@if($lang == 'ar') text-left @else text-right @endif" style="white-space: nowrap;">
                                                {{ number_format($receipt_items_item->paid_amount, $company->decimals) }}
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                        
                        <div class="section">
                            <div class="amount-box">
                                <span>Amount in words {{ amount_in_words($receipt->receipt_amount, $company->decimals) }}</span>
                                <span>{{ number_format($receipt->receipt_amount, $company->decimals) . ' '. $company->currency_code }}</span>
                            </div>
                        </div>
                        
                        <div class="section">
                            <strong>Mode of Payment</strong> :
                            {{ implode(
                                ' , ',
                                $receipts_payment_method->map(
                                        fn($item) => optional(App\Models\hierarchy\MainLedger::find($item->main_ledger_id))->bank_name
                                            ? 'Bank'
                                            : optional(App\Models\hierarchy\MainLedger::find($item->main_ledger_id))->name,
                                    )->toArray(),
                            ) }}

                        </div>

                        <div class="info ">
                            <div class="section ">
                                @foreach ($receipts_payment_method as $receipts_payment_method_item)
                                    @if ($receipts_payment_method_item->bank_name != null)
                                        <div>
                                            <strong>Bank</strong> - Amount: {{ number_format($receipts_payment_method_item->amount, $company->decimals) }}
                                            <br>
                                            Cheque No.: {{ $receipts_payment_method_item->cheque_no }} <br>
                                            Cheque Date:
                                            {{ \Carbon\Carbon::parse($receipts_payment_method_item->cheque_date)->format('d-M-Y') }}
                                            <br>
                                            {{-- Bank: {{ $receipts_payment_method_item->bank_name }} --}}
                                        </div>
                                    @else
                                        <div>
                                            <strong>{{ App\Models\hierarchy\MainLedger::where('id', $receipts_payment_method_item->main_ledger_id)->first()->name . ' -' }}</strong>
                                            Amount: {{  number_format($receipts_payment_method_item->amount, $company->decimals)  }}
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            <div >
                                <strong>Balance Amount : </strong><div class="amount-box">{{ $company->currency_code }} {{ number_format($total_debit, $company->decimals) }}</div>
                            </div>
                        </div>

                        <div class="footer_sec">
                            <div class="underline">For {{ $company->name }}</div>
                            <div class="underline"> @if ($receipt_settings->address_status == 'yes') Receiver's Signature @else Receiver's Signature @endif</div>
                        </div>
                        {{-- <button class="print-btn" onclick="window.print()">Print Receipt</button> --}}
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Page level plugins -->
    <script src="{{ asset(main_path() . 'back-end') }}/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ asset(main_path() . 'back-end') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <script>
        function print_receipt() {
            var printContents = document.getElementById('printableArea').innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload();
        }
    </script>
@endpush
