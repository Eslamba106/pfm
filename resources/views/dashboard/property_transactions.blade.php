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
                 <div class="accordion" id="accordionExample">
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item">
                             <a class="accordion-button"
                                 href="{{ route('enquiry.general_check_property') }}">{{ ui_change('enquiry_quick_search', 'property_transaction') }}</a>
                         </h2>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingOne">
                             <a class="accordion-button" type="button" data-bs-toggle="collapse"
                                 data-bs-target="#collapseOne" aria-expanded="true"
                                 aria-controls="collapseOne">{{ ui_change('enquiries', 'property_transaction') }} </a>
                             <span class="arrow">&rsaquo;</span>
                         </h2>
                         <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                             data-bs-parent="#accordionExample">
                             <div class="accordion-body">
                                 <a class="nav-link " style="color: var(--primary);font-size: 18px; "
                                     href="{{ route('enquiry.index') }}"
                                     title=" {{ ui_change('enquiries', 'property_transaction') }}">
                                     <span class="tio-circle nav-indicator-icon"></span>
                                     <span class="text-truncate">
                                         {{ ui_change('enquiries', 'property_transaction') }}
                                         <span class="badge badge-soft-info badge-pill ml-1">
                                             {{ \App\Models\Enquiry::count() }}
                                         </span>
                                     </span>
                                 </a> <a class="nav-link " style="color: var(--primary);font-size: 18px;"
                                     href="{{ route('enquiry.create') }}"
                                     title="{{ ui_change('add_new_enquiry', 'property_transaction') }}">
                                     <span class="tio-circle nav-indicator-icon"></span>
                                     <span class="text-truncate">
                                         {{ ui_change('add_new_enquiry', 'property_transaction') }}
                                     </span>
                                 </a>
                             </div>
                         </div>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingTwo">
                             <a class="accordion-button" type="button" data-bs-toggle="collapse"
                                 data-bs-target="#collapseTwo" aria-expanded="true"
                                 aria-controls="collapseTwo">{{ ui_change('proposals', 'property_transaction') }} </a>
                             <span class="arrow">&rsaquo;</span>
                         </h2>
                         <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                             data-bs-parent="#accordionExample">
                             <div class="accordion-body">
                                 <a class="nav-link " style="color: var(--primary);font-size: 18px; "
                                     href="{{ route('proposal.index') }}"
                                     title=" {{ ui_change('proposals', 'property_transaction') }}">
                                     <span class="tio-circle nav-indicator-icon"></span>
                                     <span class="text-truncate">
                                         {{ ui_change('proposals', 'property_transaction') }}
                                         <span class="badge badge-soft-info badge-pill ml-1">
                                             {{ \App\Models\Proposal::count() }}
                                         </span>
                                     </span>
                                 </a> <a class="nav-link " style="color: var(--primary);font-size: 18px;"
                                     href="{{ route('proposal.create') }}"
                                     title="{{ ui_change('add_new_proposal', 'property_transaction') }}">
                                     <span class="tio-circle nav-indicator-icon"></span>
                                     <span class="text-truncate">
                                         {{ ui_change('add_new_proposal', 'property_transaction') }}
                                     </span>
                                 </a>
                             </div>
                         </div>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingThree">
                             <a class="accordion-button" type="button" data-bs-toggle="collapse"
                                 data-bs-target="#collapseThree" aria-expanded="true"
                                 aria-controls="collapseThree">{{ ui_change('bookings', 'property_transaction') }} </a>
                             <span class="arrow">&rsaquo;</span>
                         </h2>
                         <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                             data-bs-parent="#accordionExample">
                             <div class="accordion-body">
                                 <a class="nav-link " style="color: var(--primary);font-size: 18px; "
                                     href="{{ route('booking.index') }}"
                                     title=" {{ ui_change('bookings', 'property_transaction') }}">
                                     <span class="tio-circle nav-indicator-icon"></span>
                                     <span class="text-truncate">
                                         {{ ui_change('bookings', 'property_transaction') }}
                                         <span class="badge badge-soft-info badge-pill ml-1">
                                             {{ \App\Models\Booking::count() }}
                                         </span>
                                     </span>
                                 </a> <a class="nav-link " style="color: var(--primary);font-size: 18px;"
                                     href="{{ route('booking.create') }}"
                                     title="{{ ui_change('add_new_booking', 'property_transaction') }}">
                                     <span class="tio-circle nav-indicator-icon"></span>
                                     <span class="text-truncate">
                                         {{ ui_change('add_new_booking', 'property_transaction') }}
                                     </span>
                                 </a>
                             </div>
                         </div>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingFour">
                             <a class="accordion-button" type="button" data-bs-toggle="collapse"
                                 data-bs-target="#collapseFour" aria-expanded="true"
                                 aria-controls="collapseFour">{{ ui_change('agreements', 'property_transaction') }} </a>
                             <span class="arrow">&rsaquo;</span>
                         </h2>
                         <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                             data-bs-parent="#accordionExample">
                             <div class="accordion-body">
                                 <a class="nav-link " style="color: var(--primary);font-size: 18px; "
                                     href="{{ route('agreement.index') }}"
                                     title=" {{ ui_change('agreements', 'property_transaction') }}">
                                     <span class="tio-circle nav-indicator-icon"></span>
                                     <span class="text-truncate">
                                         {{ ui_change('agreements', 'property_transaction') }}
                                         <span class="badge badge-soft-info badge-pill ml-1">
                                             {{ \App\Models\Agreement::count() }}
                                         </span>
                                     </span>
                                 </a> <a class="nav-link " style="color: var(--primary);font-size: 18px;"
                                     href="{{ route('agreement.create') }}"
                                     title="{{ ui_change('add_new_agreement', 'property_transaction') }}">
                                     <span class="tio-circle nav-indicator-icon"></span>
                                     <span class="text-truncate">
                                         {{ ui_change('add_new_agreement', 'property_transaction') }}
                                     </span>
                                 </a>
                             </div>
                         </div>
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingTwo">
                             <a class="accordion-button"
                                 href="{{ route('termination.index') }}">{{ ui_change('terminations', 'property_transaction') }}</a>
                             {{-- <span class="arrow">&rsaquo;</span> --}}
                         </h2>
                     </div>


                 </div>

                 {{-- <div class="col-md-6">
                 <a href="#" class="list-group-item">Store Master <span class="arrow">&rsaquo;</span></a>
                 <a href="#" class="list-group-item">Zone Master <span class="arrow">&rsaquo;</span></a>
                 <a href="#" class="list-group-item">Rack Master <span class="arrow">&rsaquo;</span></a>
                 <a href="#" class="list-group-item">Bin Master <span class="arrow">&rsaquo;</span></a>
             </div> --}}
             </div>
             {{-- </div>
         <div class="row"> --}}
             <div class="col-md-6">
                 <div class="accordion-item ">
                     <h2 class="accordion-header list-group-item">
                         <a class="accordion-button"
                             href="{{ route('schedules.index') }}">{{ ui_change('pre_bill_checking', 'property_report') }}</a>
                         {{-- <span class="arrow">&rsaquo;</span> --}}
                     </h2>
                 </div>
                 <div class="accordion-item ">
                     <h2 class="accordion-header list-group-item">
                         <a class="accordion-button"
                             href="{{ route('invoices.all_invoices') }}">{{ ui_change('invoices_register', 'property_report') }}</a>
                         {{-- <span class="arrow">&rsaquo;</span> --}}
                     </h2>
                 </div>
                 <div class="accordion-item ">
                     <h2 class="accordion-header list-group-item">
                         <a class="accordion-button"
                             href="{{ route('invoices_return.all_invoices') }}">{{ ui_change('invoices_return', 'property_report') }}</a> 
                     </h2>
                 </div>

                 <div class="accordion-item ">
                     <h2 class="accordion-header list-group-item">
                         <a class="accordion-button" href="{{ route('receipts.list') }}">{{ ui_change('Receipts') }}</a>
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
