 @extends('layouts.back-end.app')

 @section('title', __('general.general_management'))
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
                        <h2 class="accordion-header list-group-item" id="headingOne">
                            <a class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">{{ ui_change('all_roles' , 'general_management')  }} </a> <span class="arrow">&rsaquo;</span>
                        </h2> 
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <a class="nav-link " style="color: var(--primary);font-size: 18px; " href="{{ route('roles') }}"
                                    title=" {{ ui_change('all_roles' , 'general_management')  }}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">
                                         {{ ui_change('all_roles' , 'general_management')  }}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{ \App\Models\Role::count() }}
                                        </span>
                                    </span>
                                </a> 
                                <a class="nav-link " style="color: var(--primary);font-size: 18px;"  href="{{ route('roles.create') }}"
                                    title="{{ ui_change('create_role' , 'general_management')  }}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">
                                        {{ ui_change('create_role' , 'general_management')  }}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item ">
                        <h2 class="accordion-header list-group-item" id="headingTwo">
                            <a class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="true"
                                aria-controls="collapseTwo">{{ ui_change('user_management' , 'general_management')  }} </a> <span class="arrow">&rsaquo;</span>
                        </h2> 
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <a class="nav-link " style="color: var(--primary);font-size: 18px; " href="{{ route('user_management') }}"
                                    title=" {{ ui_change('all_users' , 'general_management')  }}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">
                                         {{ ui_change('all_users' , 'general_management')  }}
                                        <span class="badge badge-soft-info badge-pill ml-1">
                                            {{ \App\Models\User::count() }}
                                        </span>
                                    </span>
                                </a> 
                                <a class="nav-link " style="color: var(--primary);font-size: 18px;"  href="{{ route('user_management.create') }}"
                                    title="{{ ui_change('create_user' , 'general_management')  }}">
                                    <span class="tio-circle nav-indicator-icon"></span>
                                    <span class="text-truncate">
                                        {{ ui_change('create_user' , 'general_management')  }}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                     
                 </div>
             </div>
                <div class="col-md-6">
                 <div class="accordion" id="accordionExample"> 
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" >
                             <a class="accordion-button"  href="{{ route('role_admin.create') }}"   >{{ ui_change('employee_role' , 'general_management') }}</a> 
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
 
                 
