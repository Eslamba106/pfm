@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
@endphp
@section('title', ui_change('list_view' , 'property_config'))
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
            color: #6ab0c9;
        }
        .unit.empty {
            color: #fff;
        }

        .unit.proposed {
            color: #ffeb3b;
        }

        .unit.booked {
            color: #d500f9;
            /* color: #fff; */
        }

        .unit.agreement {
            color: #f44336;
            /* color: #fff; */
        }
        @keyframes blink {
    0% { opacity: 1; }
    50% { opacity: 0.2; }
    100% { opacity: 1; }
}

.empty {
    animation: blink 1s infinite;
     font-weight: bold;
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
                class="btn btn--primary">{{ ui_change('property_management.add_new_property' , 'property_config') }}</a> --}}
        </div>




        <div class="row  @if ($lang == 'ar') rtl text-start @else ltr @endif">
            <div class="d-flex flex-wrap mb-3">
                <span class="badge bg-primary me-2 m-2 p-2" style="color:black">Property, Block and Floors Listing</span>
                <span class="badge bg-success me-2 m-2 p-2" style="color:black">Floor Wise Unit Count</span>
                <span class="badge bg-warning me-2 m-2 p-2" style="color:black">Total Unit</span>
                <span class="badge  me-2 m-2 p-2" style="color:black;background-color: #ffeb3b;">Proposed Unit</span>
                <span class="badge   me-2 m-2 p-2" style="color:black;background-color: #d500f9;">Booked Unit</span>
                <span class="badge   me-2 m-2 p-2" style="color:black;background-color: #f44336;">Agreement Unit</span>
            </div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr class="header">
                            <th>Property-Block-Floor</th>
                            <th>Count Of Units</th>
                            <th>Total Units</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($property_item->blocks_management_child as $block_item)
                        @foreach ($block_item->floors_management_child as $floor_item)
                        <tr class="striped-row">


                            <td>{{ $property_item->code .'-'.$block_item->block->name . '-' . $floor_item->floor_management_main->name }}</td>
                            <td class="count-units">{{ $floor_item->unit_management_child->count() }}</td>
                            <td class="total-units">
                            @foreach ($floor_item->unit_management_child as $unit)
                                <div class="unit @if( $unit->booking_status == 'empty') empty
                                    @elseif( $unit->booking_status == 'proposal') proposed
                                    @elseif( $unit->booking_status == 'booking') booked
                                    @elseif($unit->booking_status == 'agreement') agreement @endif" >{{ $unit->unit_management_main->name }},</div>

                            @endforeach
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
