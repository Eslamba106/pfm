<div class="invoice-header " style="display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid black;
            padding-bottom: 10px;
            margin-right: 50px;
            margin-left: 50px;
            margin-top: 50px;
            margin-bottom: 30px;">
<div class="company-info ">
    <h2>FINEX INFORMATION TECHNOLOGY W.L.L</h2> 
    <p>{{__('general.phone')}} : +973 17250471</p>
    <p>{{  __('roles.email')  }} :  support@tallybahrain.com</p>
</div>

<div class="partner-logos">
    <img   src="{{ asset('assets/finexerp_logo.png') }}?v={{ time() }}"  
    style="height: {{ ($invoice_settings->height.'px') ?? '107px' }};" width="{{ $invoice_settings->width ?? '250px' }}"  alt="eBird ERP">
     
</div>
</div>
 