@extends('layouts.back-end.app')

@section('title', ui_change('property_master' , 'property_master') )
@php
     if (auth()->check()) {
         $company = (new App\Models\Company())->setConnection('tenant')->where('id', auth()->user()->company_id)->first() ?? App\Models\User::first();
     } else {
         $company = (new App\Models\User())->setConnection('tenant')->first();
     }    $lang = session()->get('locale');
@endphp
@push('css_or_js')
    <style>
        body {
            background-color: #f8f9fa;
        }

        .list-container {
            max-width: 800px;
            margin: 10px 10px;
        }

        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 20px;
            border: none;
            border-bottom: 1px dashed #ddd;
            font-size: 16px;
            color: #007bff;
            text-decoration: none;
        }

        .list-group-item:hover {
            background-color: #f1f1f1;
        }

        .arrow {
            font-size: 14px;
            color: #bbb;
        }
    </style>
@endpush

@section('content')
    <div class="container list-container  ">
        <div class="row">
            <div class="col-md-4">
                <div class="accordion" id="accordionExample">
                  
                    <div class="accordion-item ">
                        <h2 class="accordion-header list-group-item"  >
                            <a class="accordion-button"  href="{{ route('tenant.index') }}"  >{{  ui_change('tenants' , 'property_master')  }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                        </h2>  
                    </div>
                    
                     
                    <div class="accordion-item ">
                        <h2 class="accordion-header list-group-item" >
                            <a class="accordion-button"  href="{{ route('agent.index') }}" >{{ ui_change('agent' , 'property_master') }}</a>  
                        </h2>  
                    </div>
                    <div class="accordion-item ">
                        <h2 class="accordion-header list-group-item" >
                            <a class="accordion-button"  href="{{ route('ownership.index') }}"  >{{ ui_change('ownership' , 'property_master') }}</a>  
                        </h2>  
                    </div>
                    <div class="accordion-item ">
                        <h2 class="accordion-header list-group-item" >
                            <a class="accordion-button"  href="{{ route('property_type.index') }}"  >{{ ui_change('property_type' , 'property_master')  }}</a>  
                        </h2>  
                    </div>
                    <div class="accordion-item ">
                        <h2 class="accordion-header list-group-item" >
                            <a class="accordion-button"  href="{{ route('services.index') }}"  >{{ ui_change('services' , 'property_master') }}</a>  
                        </h2>  
                    </div>
                    <div class="accordion-item ">
                        <h2 class="accordion-header list-group-item" >
                            <a class="accordion-button"  href="{{ route('block.index') }}"  >{{ ui_change('blocks' , 'property_master')  }}</a>  
                        </h2>  
                    </div>
                    
                    <div class="accordion-item ">
                        <h2 class="accordion-header list-group-item"  >
                            <a class="accordion-button"  href="{{ route('floor.index') }}"  >{{ ui_change('floors' , 'property_master')  }}</a>  
                        </h2>  
                    </div>
                    <div class="accordion-item ">
                        <h2 class="accordion-header list-group-item"  >
                            <a class="accordion-button"  href="{{ route('unit_description.index') }}"  >{{ ui_change('unit_descriptions' , 'property_master') }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                        </h2>  
                    </div>
                </div>

            </div>
            <div class="col-md-4">
                <div class="accordion-item ">
                    <h2 class="accordion-header list-group-item"  >
                        <a class="accordion-button"  href="{{ route('unit.index') }}"  >{{ ui_change('units' , 'property_master') }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                    </h2>  
                </div>
               
                <div class="accordion-item ">
                    <h2 class="accordion-header list-group-item" >
                        <a class="accordion-button"  href="{{ route('unit_type.index') }}" >{{ ui_change('unit_types' , 'property_master') }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                    </h2>  
                </div>
                <div class="accordion-item ">
                    <h2 class="accordion-header list-group-item" >
                        <a class="accordion-button"  href="{{ route('unit_condition.index') }}" >{{ ui_change('unit_conditions' , 'property_master')  }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                    </h2>  
                </div>
                <div class="accordion-item ">
                    <h2 class="accordion-header list-group-item" >
                        <a class="accordion-button"  href="{{ route('unit_parking.index') }}" >{{ ui_change('unit_parkings' , 'property_master')  }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                    </h2>  
                </div>
                <div class="accordion-item ">
                    <h2 class="accordion-header list-group-item" >
                        <a class="accordion-button"  href="{{  route('view.index') }}" >{{ ui_change('views' , 'property_master')  }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                    </h2>  
                </div>
                <div class="accordion-item ">
                    <h2 class="accordion-header list-group-item" >
                        <a class="accordion-button"  href="{{  route('business_activity.index') }}" >{{ ui_change('business_activitys' , 'property_master')  }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                    </h2>  
                </div>
                <div class="accordion-item ">
                    <h2 class="accordion-header list-group-item" >
                        <a class="accordion-button"  href="{{ route('live_with.index') }}" >{{ ui_change('live_withs' , 'property_master') }}</a> 
                    </h2>  
                </div>
                <div class="accordion-item ">
                    <h2 class="accordion-header list-group-item" >
                        <a class="accordion-button"  href="{{ route('enquiry_status.index') }}" >{{ ui_change('enquiry_statuss' , 'property_master') }}</a> 
                    </h2>  
                </div>
                
            </div>
            <div class="col-md-4">
                
                <div class="accordion-item ">
                    <h2 class="accordion-header list-group-item" >
                        <a class="accordion-button"  href="{{ route('enquiry_request_status.index') }}" >{{ ui_change('enquiry_request_statuss' , 'property_master') }}</a> 
                    </h2>  
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@endpush
 
  