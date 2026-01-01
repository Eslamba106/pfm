 @extends('layouts.back-end.app')

 @section('title', ui_change('facility_masters','facility_master') )
 @php
     if (auth()->check()) {
         $company = (new App\Models\Company())->setConnection('tenant')->where('id', auth()->user()->company_id)->first() ?? App\Models\User::first();
     } else {
         $company = (new App\Models\User())->setConnection('tenant')->first();
     }
     $lang = session()->get('locale');
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
                                 href="{{ route('department.index') }}">{{ ui_change('department','facility_master')  }}</a>
                         </h2>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item">
                             <a class="accordion-button"
                                 href="{{ route('complaint_category.index') }}">{{ ui_change('complaint_category','facility_master')  }}</a>
                         </h2>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item">
                             <a class="accordion-button"
                                 href="{{ route('main_complaint.index') }}">{{ ui_change('main_complaint','facility_master')  }}</a>
                         </h2>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item">
                             <a class="accordion-button" href="{{ route('supplier.index') }}">{{ ui_change('supplier','facility_master')  }}</a>
                         </h2>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item">
                             <a class="accordion-button"
                                 href="{{ route('amc_provider.index') }}">{{ ui_change('amc_provider','facility_master') }}</a>
                         </h2>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item">
                             <a class="accordion-button"
                                 href="{{ route('work_status.index') }}">{{ ui_change('work_status','facility_master') }}</a>
                         </h2>
                     </div>
                 </div>

             </div>
             <div class="col-md-6">
                 <div class="accordion" id="accordionExample">
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item">
                             <a class="accordion-button"
                                 href="{{ route('employee_type.index') }}">{{ ui_change('employee_type','facility_master')  }}</a>
                         </h2>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item">
                             <a class="accordion-button"
                                 href="{{ route('employee.index') }}">{{ ui_change('employee','facility_master')  }}</a>
                         </h2>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item">
                             <a class="accordion-button"
                                 href="{{ route('asset_group.index') }}">{{ ui_change('asset_group','facility_master')  }}</a>
                         </h2>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item">
                             <a class="accordion-button" href="{{ route('asset.index') }}">{{ ui_change('asset','facility_master') }}</a>
                         </h2>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item">
                             <a class="accordion-button"
                                 href="{{ route('priority.index') }}">{{ ui_change('priority','facility_master')  }}</a>
                         </h2>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item">
                             <a class="accordion-button"
                                 href="{{ route('freezing.index') }}">{{ ui_change('freezing','facility_master')  }}</a>
                         </h2>
                     </div>
                 </div>

             </div>
         </div>
     </div>

 @endsection

 @push('script')
     <!-- Bootstrap JavaScript -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
 @endpush
