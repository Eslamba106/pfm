{{-- <table style="width: 100%; border: none; border-collapse: collapse; margin: 50px 0 0 0; ">
    <tr>
        <td style="vertical-align: top; border: none; **width: 30%;**; height:150px " >


            <h4 style="margin: 0; **width: 95%;**">{{ $company->name }}</h4>
            <table
                style="width: 50%; border: none; border-collapse: collapse;margin:0px">
                <tr>
                    <td style="font-size:10px;vertical-align: top; border: none; **width: 30%;**"> 
                        {{ $company->address1 }}
                    </td> 
                </tr>
            </table>

            <p style="font-size:10px;text-align:right;margin: 2px 0;">{{ __('general.mobile') }} :
                {{ (isset($company->mobile_dail_code) ? '(' . $company->mobile_dail_code . ')' : '') . $company->mobile }}
            </p>
            <p style="font-size:10px;text-align:right;margin: 2px 0;">{{ __('companies.fax') }} :
                {{ (isset($company->fax_dail_code) ? '(' . $company->fax_dail_code . ')' : '') . $company->fax }}
            </p>
            <p style="font-size:10px;text-align:right;margin: 2px 0;">{{ __('general.phone') }} :
                {{ (isset($company->phone_dail_code) ? '(' . $company->phone_dail_code . ')' : '') . $company->phone }}
            </p>
            <p style="font-size:10px;text-align:right;margin: 2px 0;">{{ __('roles.email') }} : {{ $company->email }}</p>
        </td>

        <td style="text-align: right; vertical-align: top; border: none; **width: 30%;** padding: 0;">
            <img src="{{ asset('assets/finexerp_logo.png') }}?v={{ time() }}" alt="Company Logo"
                style="
                    width: {{ optional($invoice_settings)->width ?? '180' }}px;
                    height: {{ optional($invoice_settings)->height ?? '100' }}px;
                    object-fit: contain;
                    margin: 0;
                    padding: 0;
                 ">
        </td>
    </tr>
</table> --}}
<table style="width: 100%; border: none; border-collapse: collapse; margin: 50px 0 0 0; ">
    <tr> 
        <td style="vertical-align: top; border: none; width: 30%; height:150px">
 
            @if(isset($company->name) && $company->name)
                <h4 style="margin: 0; width: 95%;">{{ $company->name }}</h4>
            @endif
            
            <table style="width: 50%; border: none; border-collapse: collapse; margin:0px">
                <tr>
                    {{-- 2. العنوان 1 --}}
                    <td style="font-size:10px;vertical-align: top; border: none; width: 30%;"> 
                        @if(isset($company->address1) && $company->address1)
                            {{ $company->address1 }}
                        @endif
                    </td> 
                </tr>
            </table>

            {{-- 3. الموبايل --}}
            @if(isset($company->mobile) && $company->mobile)
                @php
                    $mobile_code = isset($company->mobile_dail_code) ? '(' . $company->mobile_dail_code . ')' : '';
                @endphp
                <p style="font-size:10px;text-align:right;margin: 2px 0;">{{ __('general.mobile') }} :
                    {{ $mobile_code . $company->mobile }}
                </p>
            @endif

            {{-- 4. الفاكس --}}
            @if(isset($company->fax) && $company->fax)
                @php
                    $fax_code = isset($company->fax_dail_code) ? '(' . $company->fax_dail_code . ')' : '';
                @endphp
                <p style="font-size:10px;text-align:right;margin: 2px 0;">{{ __('companies.fax') }} :
                    {{ $fax_code . $company->fax }}
                </p>
            @endif

            {{-- 5. الهاتف --}}
            @if(isset($company->phone) && $company->phone)
                @php
                    $phone_code = isset($company->phone_dail_code) ? '(' . $company->phone_dail_code . ')' : '';
                @endphp
                <p style="font-size:10px;text-align:right;margin: 2px 0;">{{ __('general.phone') }} :
                    {{ $phone_code . $company->phone }}
                </p>
            @endif
 
            @if(isset($company->email) && $company->email)
                <p style="font-size:10px;text-align:right;margin: 2px 0;">{{ __('roles.email') }} : {{ $company->email }}</p>
            @endif
            
        </td>
 
        <td style="text-align: right; vertical-align: top; border: none; width: 30%; padding: 0;">
            @if(isset($invoice_settings) || asset('assets/finexerp_logo.png'))
                <img src="{{ asset('assets/finexerp_logo.png') }}?v={{ time() }}" alt="Company Logo"
                    style="
                        width: {{ optional($invoice_settings)->width ?? '180' }}px;
                        height: {{ optional($invoice_settings)->height ?? '100' }}px;
                        object-fit: contain;
                        margin: 0;
                        padding: 0;
                     ">
            @endif
        </td>
    </tr>
</table>