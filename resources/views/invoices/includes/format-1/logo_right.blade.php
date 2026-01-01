<table style="width:100%; border:none; border-collapse:collapse; border-spacing:0; table-layout:fixed;">
{{-- <table style="width: 100%; border: none; border-collapse: collapse; margin: 50px 0 0 0; "> --}}
    <tr>
        <td style="vertical-align: top; border: none; width: 30%; height:150px">

            @if (isset($company->name) && $company->name)
                <h4 style="margin: 0; width: 95%;">{{ $company->name }}</h4>
            @endif

            <table style="width: 50%; border: none; border-collapse: collapse; margin:0px">
                <tr>
                    <td style="font-size:10px;vertical-align: top; border: none; width: 30%;">
                        @if (isset($company->address1) && $company->address1)
                            {{ $company->address1 }}
                        @endif
                    </td>
                </tr>
            </table>

            @if (isset($company->mobile) && $company->mobile)
                @php
                    $mobile_code = isset($company->mobile_dail_code) ? '(' . $company->mobile_dail_code . ')' : '';
                @endphp
                <p style="font-size:10px;text-align:right;margin: 2px 0;">{{ __('general.mobile') }} :
                    {{ $mobile_code . $company->mobile }}
                </p>
            @endif
            @if (isset($company->fax) && $company->fax)
                @php
                    $fax_code = isset($company->fax_dail_code) ? '(' . $company->fax_dail_code . ')' : '';
                @endphp
                <p style="font-size:10px;text-align:right;margin: 2px 0;">{{ __('companies.fax') }} :
                    {{ $fax_code . $company->fax }}
                </p>
            @endif
            @if (isset($company->phone) && $company->phone)
                @php
                    $phone_code = isset($company->phone_dail_code) ? '(' . $company->phone_dail_code . ')' : '';
                @endphp
                <p style="font-size:10px;text-align:right;margin: 2px 0;">{{ __('general.phone') }} :
                    {{ $phone_code . $company->phone }}
                </p>
            @endif

            @if (isset($company->email) && $company->email)
                <p style="font-size:10px;text-align:right;margin: 2px 0;">{{ __('roles.email') }} : {{ $company->email }}
                </p>
            @endif

        </td>
        <td style="border:none !important; padding:0; margin:0; vertical-align:top; width:52%; line-height:0;">


        </td>
        {{-- <td style="text-align: right; vertical-align: top; border: none; width: 30%; padding: 0;"> --}}
        @php
            $companyLogo = optional($company)->logo_image;
            $logoPath =
                $companyLogo && file_exists(public_path(main_path() . $companyLogo))
                    ? public_path(main_path() . $companyLogo)
                    : public_path('assets/finexerp_logo.png');

            $imageData = base64_encode(file_get_contents($logoPath));
            $mime = mime_content_type($logoPath); 
            $logoSrc = "data:$mime;base64,$imageData";
        @endphp

{{-- <td style="text-align:right; vertical-align:top; width:18%; padding:0; margin:0; line-height:0; table-layout:fixed;"> --}}
<td style="border:none !important; padding:0; margin:0; vertical-align:top; width:20%; line-height:0;">
            <img src="{{ $logoSrc }}"
                style="display:block; margin:0; padding:0; height:80px; width:auto; max-width:100%; object-fit:contain;"
                alt="Logo">
        </td>



    </tr>
</table>

{{-- @php
            $mainLogoPath = asset(main_path() . optional($company)->logo_image); 
            $fallbackLogoPath = asset('assets/finexerp_logo.png') . '?v=' . time();
            $logoSource = optional($company)->logo_image ? $mainLogoPath : $fallbackLogoPath;
        @endphp

        <img src="{{ $logoSource }}" style="height: {{ optional($invoice_settings)->height ?? '107' }}px;"
            width="{{ optional($invoice_settings)->width ?? '250' }}px" alt="Company Logo"> --}}
