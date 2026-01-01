@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
@endphp
@section('title', ui_change('property' , 'property_config'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">
    <style>
        .custom-table {
            border-collapse: collapse;
            width: 100%;
        }

        .custom-table th,
        .custom-table td {
            border: 2px solid black;
            padding: 10px;
            text-align: left;
        }

        .header {
            background-color: #2c7da0;
            color: white;
            font-weight: bold;
        }

        .count-units {
            background-color: #4caf50;
            color: white;
        }

        .total-units {
            background-color: #d4af37;
            color: black;
        }

        .striped-row:nth-child(even) {
            background-color: #6ab0c9;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Title -->
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <h2 class="h1 mb-0 d-flex gap-2 align-items-center">
                {{-- <img width="60" src="{{ asset('/assets/back-end/img/property.jpg') }}" alt=""> --}}
                {{ ui_change('property' , 'property_config') }}
            </h2>
            {{-- <a href="{{ route('property_management.create') }}"
                class="btn btn--primary">{{ __('property_management.add_new_property') }}</a> --}}
        </div>




        <div class="row  @if ($lang == 'ar') rtl text-start @else ltr @endif">
            <div class="d-flex flex-wrap mb-3">
                <span class="badge bg-primary me-2 m-2 p-2" style="color:black">{{ ui_change('Property,_Block_and_Floors_Listing' , 'property_config') }}</span>
                <span class="badge bg-success me-2 m-2 p-2" style="color:black">{{ ui_change('Floor_Wise_Unit_Count' , 'property_config') }}</span>
                <span class="badge bg-warning me-2 m-2 p-2" style="color:black">{{ ui_change('Total_Unit' , 'property_config') }}</span>
                <span class="badge bg-danger me-2 m-2 p-2" style="color:black">{{ ui_change('Proposed_Unit' , 'property_config') }}</span>
                <span class="badge bg-success me-2 m-2 p-2" style="color:black">{{ ui_change('Booked_Unit' , 'property_config') }}</span>
                <span class="badge bg-primary me-2 m-2 p-2" style="color:black">{{ ui_change('Agreement_Unit' , 'property_config') }}</span>
            </div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr class="header">
                            <th>{{ ui_change('Property_-Block_-Floor', 'property_config') }}</th>
                            <th>{{ ui_change('Count_Of_Units', 'property_config') }}</th>
                            <th>{{ ui_change('Total_Units', 'property_config') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($main_block->floors_management_child as $floor_item)
                        <tr class="striped-row">
                            <td>{{ $property->code .'-'.$main_block->block->name . '-' . $floor_item->floor_management_main->name }}</td>
                            <td class="count-units">{{ $floor_item->unit_management_child->count() }}</td>
                            <td class="total-units">
                            @foreach ($floor_item->unit_management_child as $unit)
    
                            {{ $unit->unit_management_main->name }},
                            @endforeach
                        </td>
                        </tr>
                        @endforeach
                        {{-- <tr class="striped-row">
                            <td>abc-Block A-FLR002</td>
                            <td class="count-units">0</td>
                            <td class="total-units"></td>
                        </tr>
                        <tr class="striped-row">
                            <td>abc-Block A-FLR003</td>
                            <td class="count-units">0</td>
                            <td class="total-units"></td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('script')
@endpush
