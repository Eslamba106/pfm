 @extends('layouts.back-end.app')

 @section('title', __('roles.accounts_master'))
 @php
     if (auth()->check()) {
         $company = (new App\Models\Company())->setConnection('tenant')->where('id', auth()->user()->company_id)->first() ?? App\Models\User::first();
     } else {
         $company = (new App\Models\User())->setConnection('tenant')->first();
     }     $lang = session()->get('locale');
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
             <div class="col-md-6">
                 <div class="accordion" id="accordionExample"> 
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingTwo">
                             <a class="accordion-button"  href="{{ route('groups.index') }}"   >{{ __('roles.groups') }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                         </h2>  
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingTwo">
                             <a class="accordion-button"   href="{{ route('ledgers.index') }}"  >{{ __('roles.ledgers') }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                         </h2>  
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingTwo">
                             <a class="accordion-button"   href="{{ route('chart_of_account') }}"  >{{ __('collections.chart_of_account') }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                         </h2>  
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingTwo">
                             <a class="accordion-button"    href="{{ route('cost_center_category.index') }}"    >{{ __('roles.cost_center_category') }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                         </h2>  
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingTwo">
                             <a class="accordion-button"   href="{{ route('cost_center.index') }}"  >{{ __('roles.cost_center')  }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
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
 