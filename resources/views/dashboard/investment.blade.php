 @extends('layouts.back-end.app')

 @php
     if (auth()->check()) {
         $company =
            App\Models\Company::where('id', auth()->user()->company_id)
                 ->first() ?? App\Models\User::first();
     } else {
         $company =App\Models\User::first();
     }
     $lang = session()->get('locale');
 @endphp
 @section('title', ui_change('investment_management', 'property_transaction'))

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
                 <div class="accordion-item ">
                     <h2 class="accordion-header list-group-item">
                         <a class="accordion-button"
                             href="{{ route('investment.index') }}">{{ ui_change('investment', 'investment') }}</a> 
                     </h2>
                 </div>
                 <div class="accordion-item ">
                     <h2 class="accordion-header list-group-item">
                         <a class="accordion-button"
                             href="{{ route('investor.index') }}">{{ ui_change('investor', 'investment') }}</a> 
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
