<?php

namespace App\Http\Controllers\settings;

use Illuminate\Http\Request;
use App\Models\CompanySettings;
use App\Http\Controllers\Controller;

class CompanySettingsController extends Controller
{
    public function index(){
        $company_settings = CompanySettings::all();
        $data = [
            "company_settings"      => $company_settings,
        ];
        return view('admin-views.settings.company_settings' ,$data);
    }
    public function update(Request $request){

        CompanySettings::updateOrInsert(['type' => 'seal_mode'], [
            'value' => $request['seal_mode']
        ]);

        CompanySettings::updateOrInsert(['type' => 'signature_mode'], [
            'value' => $request['signature_mode']
        ]);
        CompanySettings::updateOrInsert(['type' => 'width'], [
            'value' => $request['width']
        ]);
        CompanySettings::updateOrInsert(['type' => 'height'], [
            'value' => $request['height']
        ]);
        return redirect()->back()->with('success',__('companies.update_setting'));
    }
}
