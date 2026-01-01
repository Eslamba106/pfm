 @extends('layouts.back-end.app')

 @section('title', ui_change('settings'))
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
                         <h2 class="accordion-header list-group-item">
                             <a class="accordion-button"
                                 href="{{ route('import_property_master') }}">{{ ui_change('import_Property_Master') }}</a>
                         </h2>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item">
                             <a class="accordion-button"
                                 href="{{ route('import_contract') }}">{{ ui_change('import_Property_Opening_Contracts') }}</a>
                         </h2>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item">
                             <a class="accordion-button"
                                 href="{{ route('import_tenant') }}">{{ ui_change('import_Tenant') }}</a>
                         </h2>
                     </div>
                 
                 </div>
             </div>
         </div>
     </div>

 @endsection

 @push('script') 
 @endpush
