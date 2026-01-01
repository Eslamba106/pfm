@extends('layouts.back-end.app')
@php
    $lang = Session::get('locale');
@endphp
@section('title', ui_change('view_image' , 'property_config'))
@push('css_or_js')
    <!-- Custom styles for this page -->
    <link href="{{ asset('assets/back-end') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="{{ asset('assets/back-end/css/croppie.css') }}" rel="stylesheet">
    <style>


        .legend {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
        }

        .legend div {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .legend span {
            width: 20px;
            height: 20px;
            display: inline-block;
            border: 1px solid #000;
        }

        .grid-container {
            margin-bottom: 30px;
        }

        .grid-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(5, 100px);
            gap: 5px;
        }

        .grid .floor {
            background-color: teal;
            color: #fff;
            text-align: center;
            line-height: 40px;
            font-weight: bold;
            border: 1px solid #000;
        }

        .grid .unit {
            background-color: #fff;
            text-align: center;
            line-height: 40px;
            border: 1px solid #000;
        }

        .unit.empty {
            background-color: #fff;
        }

        .unit.proposed {
            background-color: #ffeb3b;
        }

        .unit.booked {
            background-color: #d500f9;
            color: #fff;
        }

        .unit.agreement {
            background-color: #f44336;
            color: #fff;
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
                {{ ui_change('view_image' , 'property_config') }}
            </h2>
            {{-- <a href="{{ route('property_management.create') }}"
                class="btn btn--primary">{{ ui_change('property_management.add_new_property' , 'property_config') }}</a> --}}
        </div>
        <!-- End Page Title -->

        <!-- Content Row -->
        <div class="row  @if ($lang == 'ar') rtl text-start @else ltr @endif">

            <div class="col-md-12">
                <div class="card">
                    <div class="px-3 py-4">
                        <div class="legend">
                            <div><span style="background-color: teal;"></span> {{ ui_change('Floors','property_config') }}</div>
                            <div><span style="background-color: #fff;"></span> {{ ui_change('Empty_Units','property_config') }}</div>
                            <div><span style="background-color: #ffeb3b;"></span> {{ ui_change('Proposed_Units','property_config') }}</div>
                            <div><span style="background-color: #d500f9;"></span> {{ ui_change('Booked_Units','property_config') }}</div>
                            <div><span style="background-color: #f44336;"></span> {{ ui_change('Agreement_Units','property_config') }}</div>
                        </div>
                        {{-- @forelse ($properties as $property_item) --}}
                        <div class="grid-title"> <h3  style="color: var(--primary)">{{$property_item->name}}</h3></div>
                        <div class="grid-container">
                            @foreach ($property_item->blocks_management_child as $block_item)
                            <div class="grid-title">{{ $block_item->block->name }}</div>
                            @foreach ($block_item->floors_management_child as $floor_item)
                            <div class="grid">
                                <div class="floor">{{ $floor_item->floor_management_main->name }}</div>
                                @foreach ( $floor_item->unit_management_child as $unit_item)
                                    <div class="unit @if( $unit_item->booking_status == 'empty') empty
                                         @elseif( $unit_item->booking_status == 'proposal') proposed
                                         @elseif( $unit_item->booking_status == 'booking') booked
                                         @elseif($unit_item->booking_status == 'agreement') agreement @endif">{{ $unit_item->unit_management_main->name }}</div>
                                    @endforeach

                                {{-- <div class="unit booked">UNIT015</div>
                                <div class="unit empty">UNIT016</div>
                                <div class="unit empty">UNIT017</div>
                                <div class="unit empty">UNIT018</div> --}}
                            </div>
                            <hr>
                            @endforeach
                            {{-- <div class="grid">
                                <div class="floor">FLR004</div>
                                <div class="unit booked">UNIT015</div>
                                <div class="unit empty">UNIT016</div>
                                <div class="unit empty">UNIT017</div>
                                <div class="unit empty">UNIT018</div>

                                <div class="floor">FLR003</div>
                                <div class="unit empty">UNIT010</div>
                                <div class="unit empty">UNIT011</div>
                                <div class="unit proposed">UNIT012</div>
                                <div class="unit booked">UNIT013</div>
                                <div class="unit booked">UNIT014</div>

                                <div class="floor">FLR002</div>
                                <div class="unit empty">UNIT006</div>
                                <div class="unit empty">UNIT007</div>
                                <div class="unit empty">UNIT008</div>
                                <div class="unit empty">UNIT009</div>

                                <div class="floor">FLR001</div>
                                <div class="unit empty">UNIT001</div>
                                <div class="unit empty">UNIT002</div>
                                <div class="unit empty">UNIT003</div>
                                <div class="unit empty">UNIT004</div>
                                <div class="unit empty">UNIT005</div>
                            </div> --}}
                            @endforeach

                        </div>
                        <hr>
                        {{-- @empty --}}

                        {{-- @endforelse --}}
                        {{-- <div class="grid-container">
                            <div class="grid-title">Block: Block D</div>
                            <div class="grid">
                                <div class="floor">FLR004</div>
                                <div class="unit booked">UNIT015</div>
                                <div class="unit empty">UNIT016</div>
                                <div class="unit empty">UNIT017</div>
                                <div class="unit empty">UNIT018</div>

                                <div class="floor">FLR003</div>
                                <div class="unit empty">UNIT010</div>
                                <div class="unit empty">UNIT011</div>
                                <div class="unit proposed">UNIT012</div>
                                <div class="unit booked">UNIT013</div>
                                <div class="unit booked">UNIT014</div>

                                <div class="floor">FLR002</div>
                                <div class="unit empty">UNIT006</div>
                                <div class="unit empty">UNIT007</div>
                                <div class="unit empty">UNIT008</div>
                                <div class="unit empty">UNIT009</div>

                                <div class="floor">FLR001</div>
                                <div class="unit empty">UNIT001</div>
                                <div class="unit empty">UNIT002</div>
                                <div class="unit empty">UNIT003</div>
                                <div class="unit empty">UNIT004</div>
                                <div class="unit empty">UNIT005</div>
                            </div>
                        </div>

                        <div class="grid-container">
                            <div class="grid-title">Block: Block A</div>
                            <div class="grid">
                                <div class="floor">FLR002</div>
                                <div class="unit booked">UNIT011</div>
                                <div class="unit agreement">UNIT012</div>
                                <div class="unit booked">UNIT013</div>
                                <div class="unit booked">UNIT014</div>
                                <div class="unit booked">UNIT015</div>

                                <div class="floor">FLR001</div>
                                <div class="unit empty">UNIT001</div>
                                <div class="unit agreement">UNIT002</div>
                                <div class="unit empty">UNIT003</div>
                                <div class="unit empty">UNIT004</div>
                                <div class="unit empty">UNIT005</div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('script')
    @endpush
