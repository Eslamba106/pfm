 
{{-- width="250px" height="107px" --}}
<div class="invoice-header "
    style="display: flex;
flex-direction: column;
align-items: center;  
border-bottom: 2px solid black;
padding-bottom: 10px;
margin: 50px 50px 30px 50px;">

    <div class="partner-logos">
        <img style="margin-bottom: 20px;" src="{{ asset('assets/finexerp_logo.png') }}?v={{ time() }}"  style="height: {{ ($invoice_settings->height.'px') ?? '107px' }};" width="{{ $invoice_settings->width ?? '250px' }}" alt="eBird ERP">

    </div>
    <div class="company-info " style=" text-align: center;  
    display: flex;
    flex-direction: column;
    align-items: center;  ">
         <h2>FINEX INFORMATION TECHNOLOGY W.L.L</h2> 
         <p>{{__('general.phone')}} : +973 17250471</p>
         <p>{{  __('roles.email')  }} :  support@tallybahrain.com</p>
    </div>


</div>

{{-- .invoice-header {
    display: flex;
    flex-direction: column;
    align-items: center;  
    border-bottom: 2px solid black;
    padding-bottom: 10px;
    margin: 50px 50px 30px 50px;
} --}}
