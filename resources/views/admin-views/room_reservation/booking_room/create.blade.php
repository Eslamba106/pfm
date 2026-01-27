@extends('layouts.back-end.app')

@section('title', ui_change('booking_page', 'room_reservation'))

@push('css_or_js')
    <style>
        .form-group label {
            font-weight: bold;
        }

        .table thead th {
            background-color: #f8f9fa;
            font-size: 12px;
        }

        .summary-table td {
            border: none !important;
            padding: 5px;
        }

        .qty-control {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            margin-inline-start: 8px;
        }

        .qty-input {
            width: 50px;
            text-align: center;
            border: 1px solid #ccc;
            border-radius: 4px;
            height: 34px;
        }

        .qty-btn {
            width: 32px;
            height: 32px;
            border: 1px solid #ccc;
            background: #f8f9fa;
            cursor: pointer;
            font-size: 18px;
            line-height: 1;
            border-radius: 4px;
        }

        .qty-btn:hover {
            background: #e9ecef;
        }
    </style>
@endpush
@php

    $adults = 0;
    $children = 0;
    foreach ($all_units as $unit) {
        $adults += $unit->adults;
        $children += $unit->children;
    }
@endphp
@section('content')
    <div class="content container-fluid">
        <form action="{{ route('booking_room.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                {{-- <input type="hidden" name="adults" value="{{ $adults }}">
                <input type="hidden" name="children" value="{{ $children }}"> --}}
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label
                                    class="col-sm-4 col-form-label">{{ ui_change('Search_Tenant', 'room_reservation') }}</label>
                                <div class="col-sm-8">

                                    <select name="tenant_id" class="js-select2-custom form-control" required>
                                        <option value="">{{ ui_change('select_tenant') }}</option>
                                        @foreach ($tenants as $tenants_item)
                                            <option value="{{ $tenants_item->id }}">
                                                {{ $tenants_item->name ?? $tenants_item->company_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">{{ ui_change('	ID', 'room_reservation') }}</label>
                                <div class="col-sm-8"> 
                                    <input name="id" class="form-control" type="file"> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group row">
                                <label
                                    class="col-sm-4 col-form-label">{{ ui_change('Booking_Date', 'room_reservation') }}</label>
                                <div class="col-sm-8">
                                    <input type="text" disabled name="booking_date" class="form-control date"
                                        value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-sm-4 col-form-label">{{ ui_change('Booking_from', 'room_reservation') }}</label>
                                <div class="col-sm-8">
                                    <input type="text" name="booking_from" class="form-control date"
                                        value="{{ \Carbon\Carbon::now()->format('d/m/Y') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-sm-4 col-form-label">{{ ui_change('Booking_to', 'room_reservation') }}</label>
                                <div class="col-sm-8">
                                    <input type="text" name="booking_to" class="form-control date_to"
                                        value="{{ \Carbon\Carbon::now()->addDays(1)->format('d/m/Y') }}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label
                                    class="col-sm-4 col-form-label">{{ ui_change('rental_type', 'room_reservation') }}</label>
                                <div class="col-sm-8">
                                    <select name="rental_type_id" class="js-select2-custom form-control" required>
                                        @foreach ($rental_types as $rental_types_item)
                                            <option value="{{ $rental_types_item->id }}">
                                                {{ $rental_types_item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <ul class="list-unstyled">
                                <li>
                                    <strong>{{ ui_change('Adults', 'room_reservation') }}:</strong>

                                    <div class="qty-control">
                                        <button type="button" class="qty-btn minus" data-target="adults">−</button>

                                        <input type="number" name="adults" id="adults" class="qty-input"
                                            value="{{ $adults }}" min="1" readonly>

                                        <button type="button" class="qty-btn plus" data-target="adults">+</button>
                                    </div>
                                </li>

                                <li class="mt-1">
                                    <strong>{{ ui_change('Children', 'room_reservation') }}:</strong>

                                    <div class="qty-control">
                                        <button type="button" class="qty-btn minus" data-target="children">−</button>

                                        <input type="number" name="children" id="children" class="qty-input"
                                            value="{{ $children }}" min="0" readonly>

                                        <button type="button" class="qty-btn plus" data-target="children">+</button>
                                    </div>
                                </li>

                                <li class="mt-2">
                                    <strong
                                        class="mb-2">{{ ui_change('room_options', 'room_reservation') }}:</strong><br>
                                    @forelse ($room_options as $room_option_item)
                                        <input type="hidden" value="{{ $room_option_item->id }}" name="room_ids[]">
                                        <div class="form-group">
                                            <label>{{ $room_option_item->name }}</label>
                                            <div class="d-flex gap-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="room_options[{{ $room_option_item->id }}]"
                                                        id="{{ $room_option_item->name }}_yes" value="yes">
                                                    <label class="form-check-label"
                                                        for="{{ $room_option_item->name }}_yes">{{ ui_change('yes') }}</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="room_options[{{ $room_option_item->id }}]"
                                                        id="{{ $room_option_item->name }}_no" value="no">
                                                    <label class="form-check-label"
                                                        for="{{ $room_option_item->name }}_no">{{ ui_change('no') }}</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio"
                                                        name="room_options[{{ $room_option_item->id }}]"
                                                        id="{{ $room_option_item->name }}_any" value="chargeable"
                                                        checked>
                                                    <label class="form-check-label"
                                                        for="{{ $room_option_item->name }}_any">{{ ui_change('chargeable') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                    @endforelse
                                </li>
                            </ul>
                        </div>
                    </div>

                    <hr>

                    <h5>{{ ui_change('Rooms', 'room_reservation') }}</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{ ui_change('Code', 'room_reservation') }}</th>
                                    <th>{{ ui_change('Name', 'room_reservation') }}</th>
                                    <th>{{ ui_change('Days', 'room_reservation') }}</th>
                                    <th>{{ ui_change('Price / Day', 'room_reservation') }}</th>
                                    <th>{{ ui_change('Discount %', 'room_reservation') }}</th>
                                    <th>{{ ui_change('Total Discount', 'room_reservation') }}</th>
                                    <th>{{ ui_change('Gross Total', 'room_reservation') }}</th>
                                    <th>{{ ui_change('VAT %', 'room_reservation') }}</th>
                                    <th>{{ ui_change('Govt.Levy %', 'room_reservation') }}</th>
                                    <th>{{ ui_change('Net Total', 'room_reservation') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($all_units as $unit_item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $unit_item->unit_management_main?->code }}</td>
                                        <td>{{ $unit_item->unit_management_main?->name }}</td>

                                        <td>
                                            <input type="number" name="days[{{ $unit_item->id }}]"
                                                class="form-control text-center days-input" value="1" min="1"
                                                readonly>
                                        </td>

                                        <td>
                                            <input type="number" step="0.001" name="rent_price[{{ $unit_item->id }}]"
                                                class="form-control text-center price-day-input"
                                                value="{{ number_format(
                                                    (optional($unit_item->rent_schedules->first())->rent_amount ?? 0) / 30,
                                                    $company->decimals,
                                                    '.',
                                                    '',
                                                ) }}">
                                        </td>

                                        <td>
                                            <input type="number" step="0.01"
                                                name="discount_per[{{ $unit_item->id }}]"
                                                class="form-control text-center discount-percent-input" value="0">
                                        </td>

                                        <td>
                                            <input type="text" class="form-control text-center total-discount-input"
                                                value="0.000" readonly name="discount[{{ $unit_item->id }}]">
                                        </td>

                                        <td>
                                            <input type="text" class="form-control text-center gross-total-input"
                                                value="0.000" readonly name="gross[{{ $unit_item->id }}]">
                                        </td>

                                        <td>
                                            <input type="number" step="0.01"
                                                class="form-control text-center vat-percent-input" value="0"
                                                name="vat_per[{{ $unit_item->id }}]">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control text-center levy"
                                                value="{{ number_format($company->levy?->percentage, $company->decimals) }}"
                                                readonly name="levy[{{ $unit_item->id }}]">
                                        </td>
                                        <td>
                                            <input type="text" class="form-control text-center net-total-input"
                                                value="0.000" readonly name="net_total[{{ $unit_item->id }}]">
                                        </td>

                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-3">

                    </div>

                    <div class="row mt-4">
                        <div class="col-md-8"></div>
                        <div class="col-md-4">
                            <table class="table summary-table">
                                <tr>
                                    <td>{{ ui_change('total') }}</td>
                                    <td class="text-right summary-total">
                                        {{ number_format(0, $company->decimals, '.', '') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ ui_change('discount') }}</td>
                                    <td class="text-right summary-discount">
                                        {{ number_format(0, $company->decimals, '.', '') }}
                                    </td>
                                </tr>
                                <tr class="font-weight-bold">
                                    <td>{{ ui_change('Gross_Total') }}</td>
                                    <td class="text-right summary-gross">
                                        {{ number_format(0, $company->decimals, '.', '') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ ui_change('VAT_Amount') }}</td>
                                    <td class="text-right summary-vat">{{ number_format(0, $company->decimals, '.', '') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>{{ ui_change('Govt.Levy') }}</td>
                                    <td class="text-right summary-levy">
                                        {{ number_format($company->levy?->percentage, $company->decimals, '.', '') }}
                                    </td>
                                </tr>
                                <tr class="bg-light font-weight-bold">
                                    <td>{{ ui_change('Net_Total') }}</td>
                                    <td class="text-right summary-net">{{ number_format(0, $company->decimals, '.', '') }}
                                    </td>
                                </tr>
                                <input type="hidden" name="summary_total" id="summary_total">
                                <input type="hidden" name="summary_discount" id="summary_discount">
                                <input type="hidden" name="summary_gross" id="summary_gross">
                                <input type="hidden" name="summary_vat" id="summary_vat">
                                <input type="hidden" name="summary_levy" id="summary_levy">
                                <input type="hidden" name="summary_net" id="summary_net">

                            </table>

                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-3">
                        <button type="submit" class="btn btn-success mr-2"><i class="tio-save"></i>
                            {{ ui_change('save') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('script')
    <script>
        document.addEventListener('click', function(e) {

            if (!e.target.classList.contains('qty-btn')) return;

            const targetId = e.target.dataset.target;
            const input = document.getElementById(targetId);

            let value = parseInt(input.value) || 0;
            const min = parseInt(input.min) || 0;

            if (e.target.classList.contains('plus')) {
                value++;
            }

            if (e.target.classList.contains('minus')) {
                if (value > min) value--;
            }

            input.value = value;
            input.dispatchEvent(new Event('change'));
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const fromInput = document.querySelector('input[name="booking_from"]');
            const toInput = document.querySelector('input[name="booking_to"]');

            const fromPicker = flatpickr(fromInput, {
                dateFormat: "d/m/Y",
                defaultDate: "today",
                minDate: "today",
                onChange: function(selectedDates) {

                    if (!selectedDates.length) return;

                    const fromDate = selectedDates[0];

                    const minToDate = new Date(fromDate);
                    minToDate.setDate(minToDate.getDate() + 1);

                    toPicker.set('minDate', minToDate);

                    if (!toPicker.selectedDates.length || toPicker.selectedDates[0] <= fromDate) {
                        toPicker.setDate(minToDate, true);
                    }

                    calculateDays();
                }
            });

            const toPicker = flatpickr(toInput, {
                dateFormat: "d/m/Y",
                minDate: new Date().fp_incr(1),
                onChange: function() {
                    calculateDays();
                }
            });

            function parseDate(dateStr) {
                const parts = dateStr.split('/');
                return new Date(parts[2], parts[1] - 1, parts[0]);
            }

            function calculateDays() {
                const fromDate = parseDate(fromInput.value);
                const toDate = parseDate(toInput.value);

                if (!fromDate || !toDate) return;

                let diffTime = toDate - fromDate;
                let days = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (days < 1) days = 1;

                document.querySelectorAll('.days-input').forEach(input => {
                    input.value = days;
                    input.dispatchEvent(new Event('input'));
                });

                calculateTotals();
            }

        });
    </script>

    <script>
        // document.addEventListener('DOMContentLoaded', function() {

        //     const fromInput = document.querySelector('input[name="booking_from"]');
        //     const toInput = document.querySelector('input[name="booking_to"]');

        //     function parseDate(dateStr) {
        //         if (!dateStr) return null;
        //         const parts = dateStr.split('/');
        //         return new Date(parts[2], parts[1] - 1, parts[0]);
        //     }

        //     function calculateDays() {
        //         const fromDate = parseDate(fromInput.value);
        //         const toDate = parseDate(toInput.value);

        //         if (!fromDate || !toDate) return;

        //         let diffTime = toDate - fromDate;
        //         let days = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

        //         if (days < 1) days = 1;
        //         document.querySelectorAll('.days-input').forEach(input => {
        //             input.value = days;
        //             input.dispatchEvent(new Event('input'));
        //         });
        //         document.querySelectorAll('.days-input').forEach(input => {
        //             input.value = days;
        //         });

        //         calculateTotals();
        //     }

        //     fromInput.addEventListener('change', calculateDays);
        //     toInput.addEventListener('change', calculateDays);

        // });
    </script>

    <script>
        document.addEventListener('input', function(e) {

            let rows = document.querySelectorAll('tbody tr');

            let totalBase = 0;
            let totalDiscount = 0;
            let totalVat = 0;

            rows.forEach(row => {

                let days = parseFloat(row.querySelector('.days-input')?.value) || 0;
                let priceDay = parseFloat(row.querySelector('.price-day-input')?.value) || 0;
                let discountP = parseFloat(row.querySelector('.discount-percent-input')?.value) || 0;
                let vatP = parseFloat(row.querySelector('.vat-percent-input')?.value) || 0;


                let baseTotal = days * priceDay;
                let discountAmount = baseTotal * (discountP / 100);
                let grossTotal = baseTotal - discountAmount;
                let vatAmount = grossTotal * (vatP / 100);
                let netTotal = grossTotal + vatAmount;
                row.querySelector('.total-discount-input').value =
                    discountAmount.toFixed({{ $company->decimals }});

                row.querySelector('.gross-total-input').value =
                    grossTotal.toFixed({{ $company->decimals }});

                row.querySelector('.net-total-input').value =
                    netTotal.toFixed({{ $company->decimals }});
                row.querySelector('.levy').value =
                    levy.toFixed({{ $company->decimals }});
                totalBase += baseTotal;
                totalDiscount += discountAmount;
                totalVat += vatAmount;
            });

            let summaryGross = totalBase - totalDiscount;
            let summaryNet = summaryGross + totalVat;

            document.querySelector('.summary-total').innerText =
                totalBase.toFixed({{ $company->decimals }});

            document.querySelector('.summary-discount').innerText =
                totalDiscount.toFixed({{ $company->decimals }});

            document.querySelector('.summary-gross').innerText =
                summaryGross.toFixed({{ $company->decimals }});

            document.querySelector('.summary-vat').innerText =
                totalVat.toFixed({{ $company->decimals }});
            document.querySelector('.summary-levy').innerText =
                totalLevy.toFixed({{ $company->decimals }});

            document.querySelector('.summary-net').innerText =
                summaryNet.toFixed({{ $company->decimals }});
        });
    </script>
    <script>
        function calculateTotals() {

            let rows = document.querySelectorAll('tbody tr');

            let totalBase = 0;
            let totalDiscount = 0;
            let totalVat = 0;

            rows.forEach(row => {

                let daysEl = row.querySelector('.days-input');
                let priceEl = row.querySelector('.price-day-input');
                let discountEl = row.querySelector('.discount-percent-input');
                let vatEl = row.querySelector('.vat-percent-input');

                let discountOut = row.querySelector('.total-discount-input');
                let grossOut = row.querySelector('.gross-total-input');
                let netOut = row.querySelector('.net-total-input');
                let levy = row.querySelector('.levy');

                if (!daysEl || !priceEl) return;

                let days = parseFloat(daysEl.value) || 0;
                let priceDay = parseFloat(priceEl.value) || 0;
                let discountP = parseFloat(discountEl?.value) || 0;
                let vatP = parseFloat(vatEl?.value) || 0;
                let baseTotal = days * priceDay;
                let discountAmount = baseTotal * (discountP / 100);
                let grossTotal = baseTotal - discountAmount;
                let vatAmount = grossTotal * (vatP / 100);
                let netTotal = grossTotal + vatAmount;
                if (discountOut)
                    discountOut.value = discountAmount.toFixed({{ $company->decimals }});

                if (grossOut)
                    grossOut.value = grossTotal.toFixed({{ $company->decimals }});

                if (netOut)
                    netOut.value = netTotal.toFixed({{ $company->decimals }});

                totalBase += baseTotal;
                totalDiscount += discountAmount;
                totalVat += vatAmount;
            });

            let summaryGross = totalBase - totalDiscount;
            let summaryNet = summaryGross + totalVat;

            document.querySelector('.summary-total').innerText =
                totalBase.toFixed({{ $company->decimals }});

            document.querySelector('.summary-discount').innerText =
                totalDiscount.toFixed({{ $company->decimals }});

            document.querySelector('.summary-gross').innerText =
                summaryGross.toFixed({{ $company->decimals }});

            document.querySelector('.summary-vat').innerText =
                totalVat.toFixed({{ $company->decimals }});

            document.querySelector('.summary-net').innerText =
                summaryNet.toFixed({{ $company->decimals }});
            document.getElementById('summary_total').value =
                totalBase.toFixed({{ $company->decimals }});

            document.getElementById('summary_discount').value =
                totalDiscount.toFixed({{ $company->decimals }});

            document.getElementById('summary_gross').value =
                summaryGross.toFixed({{ $company->decimals }});

            document.getElementById('summary_vat').value =
                totalVat.toFixed({{ $company->decimals }});
            document.getElementById('summary_levy').value =
                totalLevy.toFixed({{ $company->decimals }});

            document.getElementById('summary_net').value =
                summaryNet.toFixed({{ $company->decimals }});

        }

        document.addEventListener('input', function(e) {
            if (e.target.closest('table')) {
                calculateTotals();
            }
        });
        document.addEventListener('DOMContentLoaded', function() {
            calculateTotals();
        });
    </script>

    <script>
        document.addEventListener('input', function(e) {
            if (e.target.closest('tbody')) {
                calculateTotals();
            }
        });
    </script>


    <script>
        flatpickr(".date", {
            dateFormat: "d/m/Y",
            defaultDate: "today",
            minDate: "today"
        });
        flatpickr(".date_to", {
            dateFormat: "d/m/Y",
            minDate: "today"
        });
    </script>
@endpush
