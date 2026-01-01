<?php

namespace App\Http\Controllers\settings;

use App\Models\CompanySettings;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use App\Http\Controllers\Controller;

class BusinessSettingsController extends Controller
{
    public function index(Request $request){
        $settings = CompanySettings::all();
        $settings = get_settings($settings, 'colors');
        return view("admin-views.settings.company_settings");
    }

    public function companyInfo()
    {

        $web = BusinessSetting::all();
        $settings = get_settings($web, 'colors');
        $data = json_decode($settings['value'], true);

        $business_setting = [
            'primary_color' => $data['primary'] ?? '',
            'secondary_color' => $data['secondary'] ?? '',
            'primary_color_light' => isset($data['primary_light']) ? $data['primary_light'] : '',
            'company_name' => get_settings($web, 'company_name')->value ?? '',
            'company_email' => get_settings($web, 'company_email')->value ?? '',
            'company_phone' => get_settings($web, 'company_phone')->value ?? '',
            'language' => get_settings($web, 'language')->value ?? '',
            'web_logo' => get_settings($web, 'company_web_logo')->value ?? '',
            'mob_logo' => get_settings($web, 'company_mobile_logo')->value ?? '',
            'fav_icon' => get_settings($web, 'company_fav_icon')->value ?? '',
            'footer_logo' => get_settings($web, 'company_footer_logo')->value ?? '',
            'shop_address' => get_settings($web, 'shop_address')->value ?? '',
            'company_copyright_text' => get_settings($web, 'company_copyright_text')->value ?? '',
            'system_default_currency' => get_settings($web, 'system_default_currency')->value ?? '',
            'currency_symbol_position' => get_settings($web, 'currency_symbol_position')->value ?? '',
            'forgot_password_verification' => get_settings($web, 'forgot_password_verification')->value ?? '',
            'business_mode' => get_settings($web, 'business_mode')->value ?? '',
            'email_verification' => get_settings($web, 'email_verification')->value ?? '',
            'otp_verification' => get_settings($web, 'otp_verification')->value ?? '',
            'guest_checkout' => get_settings($web, 'guest_checkout')->value ?? '',
            'pagination_limit' => get_settings($web, 'pagination_limit')->value ?? '',
            'copyright_text' => get_settings($web, 'company_copyright_text')->value ?? '',
        ];

 
    }
}
