 @extends('layouts.back-end.app')

 @section('title', ui_change('hierarchy' , 'hierarchy'))
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
                         <h2 class="accordion-header list-group-item" id="headingfive">
                             <a class="accordion-button"  href="{{ route('companies') }}" >{{ ui_change('companies' , 'hierarchy')  }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                         </h2> 
                         
                          
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingTwo">
                             <a class="accordion-button"  href="{{ route('region') }}" >{{ ui_change('regions' , 'hierarchy')  }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                         </h2> 
                         
                          
                     </div>
                     <div class="accordion-item ">
                         <h2 class="accordion-header list-group-item" id="headingTwo">
                             <a class="accordion-button"  href="{{ route('country') }}"  >{{ ui_change('countries' , 'hierarchy')  }}</a> {{-- <span class="arrow">&rsaquo;</span> --}}
                         </h2> 
                         
                         </div>
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
 {{--  
<li class="navbar-vertical-aside-has-menu {{ Request::is('region*') ? 'active' : '' }}">
    <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:void(0)"
        title="{{ __('region.regions') }}">
        <i class="fa fa-globe"></i>
        <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate"
            style="{{ $lang == 'ar' ? 'margin-right: 8px;' : 'margin-left: 8px;' }}">
            {{ __('region.regions') }}
        </span>
    </a>
    <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
        style="display: {{ Request::is('region*') ? 'block' : 'none' }}">
        <li class="nav-item {{ Request::is('region') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('region') }}" title="{{ __('region.regions') }}">
                <span class="tio-circle nav-indicator-icon"></span>
                <span class="text-truncate">
                    {{ __('region.regions') }}
                    <span class="badge badge-soft-info badge-pill ml-1">
                        {{ \App\Models\Region::count() }}
                    </span>
                </span>
            </a>
        </li>


    </ul>
</li>
<li class="navbar-vertical-aside-has-menu {{ Request::is('countries*') ? 'active' : '' }}">
    <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:void(0)"
        title="{{ __('country.countries') }}">
        <i class="fas fa-flag "> </i>
        <span style="{{ $lang == 'ar' ? 'margin-right: 8px;' : 'margin-left: 8px;' }}"
            class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">
            {{ __('country.countries') }}
        </span>
    </a>
    <ul class="js-navbar-vertical-aside-submenu nav nav-sub"
        style="display: {{ Request::is('countries*') ? 'block' : 'none' }}">
        <li class="nav-item {{ Request::is('countries') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('country') }}" title="{{ __('country.all_countries') }}">
                <span class="tio-circle nav-indicator-icon"></span>
                <span class="text-truncate">
                    {{ __('country.all_countries') }}
                    <span class="badge badge-soft-info badge-pill ml-1">
                        {{ \App\Models\CountryMaster::count() }}
                    </span>
                </span>
            </a>
        </li>
        {{-- <li class="nav-item {{ Request::is('countries/create') ? 'active' : '' }}">
           <a class="nav-link" href="{{ route('country.create') }}"
               title="{{ __('country.create_country') }}">
               <span class="tio-circle nav-indicator-icon"></span>
               <span class="text-truncate">
                   {{ __('country.create_country') }}
               </span>
           </a>
       </li> 
    </ul>
</li> --}}
