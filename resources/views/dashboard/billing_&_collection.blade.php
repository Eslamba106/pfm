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
 @section('title', ui_change('property_transaction', 'property_transaction'))

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
                     <p class="accordion-header list-group-item">
                         <a class="accordion-button"
                             href="{{ route('schedules.index') }}">{{ ui_change('pre_bill_checking', 'property_report') }}</a>
                         {{-- <span class="arrow">&rsaquo;</span> --}}
                     </p>
                 </div>
                 <div class="accordion-item ">
                     <p class="accordion-header list-group-item">
                         <a class="accordion-button"
                             href="{{ route('invoices.all_invoices') }}">{{ ui_change('invoices_register', 'property_report') }}</a>
                         {{-- <span class="arrow">&rsaquo;</span> --}}
                     </p>
                 </div>
                 <div class="accordion-item ">
                     <p class="accordion-header list-group-item">
                         <a class="accordion-button"
                             href="{{ route('invoices_return.all_invoices') }}">{{ ui_change('invoices_return', 'property_report') }}</a> 
                     </p>
                 </div>

                 <div class="accordion-item ">
                     <p class="accordion-header list-group-item">
                         <a class="accordion-button" href="{{ route('receipts.list') }}">{{ ui_change('Receipts') }}</a>
                     </p>
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
