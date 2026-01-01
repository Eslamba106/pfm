 {{-- width="250px" height="107px" --}}
 <div class="invoice-header "
     style="display: flex;
flex-direction: column;
align-items: center;  
border-bottom: 2px solid black;
padding-bottom: 10px;
margin: 50px 50px 30px 50px;">

     <div class="partner-logos">
         <img style="margin-bottom: 20px;" src="{{ asset('assets/finexerp_logo.png') }}?v={{ time() }}"
             style="height: {{ $receipt_settings->height . 'px' ?? '107px' }};"
             width="{{ $receipt_settings->width ?? '250px' }}" alt="eBird ERP">

     </div>
     @if ($receipt_settings->address_status == 'yes')
         <div class="company-info "
             style=" text-align: center;  
    display: flex;
    flex-direction: column;
    align-items: center;  ">
             <h2>{{ $company->name }}</h2>
             <p>{{ $company->address1 }}</p>
             <p>{{ $company->address2 }}</p>
             <p>{{ $company->address3 }}</p>
             <p>{{ __('general.mobile') }} : {{ ((isset($company->mobile_dail_code)) ? ('(' . $company->mobile_dail_code . ')' ) : ''). $company->mobile }}</p>
             <p>{{ __('companies.fax') }} : {{ ((isset($company->fax_dail_code)) ? ('(' . $company->fax_dail_code . ')' ) : ''). $company->fax }}</p>
             <p>{{__('general.phone')}} : {{ ((isset($company->phone_dail_code)) ? ('(' . $company->phone_dail_code . ')' ) : ''). $company->phone }}</p>
             <p>{{ __('roles.email') }} : {{ $company->email }}</p>
         </div>
     @endif

 </div>

 {{-- .invoice-header {
    display: flex;
    flex-direction: column;
    align-items: center;  
    border-bottom: 2px solid black;
    padding-bottom: 10px;
    margin: 50px 50px 30px 50px;
} --}}
