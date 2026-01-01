 @extends('layouts.back-end.app')

 @php
     if (auth()->check()) {
         $company = (new App\Models\Company())->setConnection('tenant')->where('id', auth()->user()->company_id)->first() ?? App\Models\User::first();
     } else {
         $company = (new App\Models\User())->setConnection('tenant')->first();
     }     $lang = session()->get('locale');
 @endphp
  @section('title',    ui_change('property_Config' , 'property_config')  ) 

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
             <div class="col-md-6">
                 <div class="accordion" id="accordionExample"> 
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" >
                             <a class="accordion-button"  href="{{ route('property_management.index') }}"   >{{  ui_change('property_management' , 'property_config')  }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                         </h2>  
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" >
                             <a class="accordion-button"   href="{{ route('block_management.index') }}"  >{{ ui_change('block_management' , 'property_config')  }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                         </h2>  
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" >
                             <a class="accordion-button"   href="{{ route('floor_management.index') }}"  >{{ ui_change('floor_management' , 'property_config')  }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                         </h2>  
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" >
                             <a class="accordion-button"    href="{{ route('unit_management.index') }}"    >{{ ui_change('unit_management' , 'property_config')  }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                         </h2>  
                     </div> 
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" >
                             <a class="accordion-button"    href="{{ route('rent_price.index') }}"    >{{ ui_change('rent_price_list' , 'property_config')  }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                         </h2>  
                     </div> 


                 </div>

             </div>
             {{-- <div class="col-md-6">
                 <a href="#" class="list-group-item">Store Master <span class="arrow">&rsaquo;</span></a>
                 <a href="#" class="list-group-item">Zone Master <span class="arrow">&rsaquo;</span></a>
                 <a href="#" class="list-group-item">Rack Master <span class="arrow">&rsaquo;</span></a>
                 <a href="#" class="list-group-item">Bin Master <span class="arrow">&rsaquo;</span></a>
             </div> --}}
         </div>
     </div>

 @endsection

 @push('script')
     <!-- Bootstrap JavaScript -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 @endpush
 