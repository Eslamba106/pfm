<?php

namespace App\Http\Controllers\settings;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use App\Http\Controllers\Controller;

class ComplaintSettingsController extends Controller
{
    public function complaintIndex(){
        $complaint_prefix    = optional(BusinessSetting::whereType('complaint_prefix')->first())->value;
        $complaint_suffix    = optional(BusinessSetting::whereType('complaint_suffix')->first())->value ;
        $complaint_width    = optional(BusinessSetting::whereType('complaint_width')->first())->value ;
        $complaint_date_Data = optional(BusinessSetting::whereType('complaint_date')->first())->value  ;
        $complaint_start_number = optional(BusinessSetting::whereType('complaint_start_number')->first())->value  ;
        $complaint_date = ($complaint_date_Data != null) ? Carbon::createFromFormat('Y-m-d', $complaint_date_Data)->format('Y-m-d') : '';
        // 'prefix'            => $request->prefix,
        // 'suffix'            => $request->suffix,
        // 'width'             => $request->width,
        // 'date'              => $request->date,
        // 'start_number'      => $request->start_number,
        $data = [
            "complaint_width"      => $complaint_width,
            "complaint_prefix"      => $complaint_prefix,
            "complaint_date"      => $complaint_date,
            "complaint_suffix"      => $complaint_suffix,
            "complaint_start_number"      => $complaint_start_number,
        ];
        return view('admin-views.settings.complaint_settings' ,$data);
    }
    public function complaintUpdate(Request $request){

        BusinessSetting::updateOrInsert(['type' => 'complaint_prefix'], [
            'value' => $request['complaint_prefix']
        ]);

        BusinessSetting::updateOrInsert(['type' => 'complaint_suffix'], [
            'value' => $request['complaint_suffix']
        ]);

        BusinessSetting::updateOrInsert(['type' => 'complaint_width'], [
            'value' => $request['complaint_width']
        ]);
        BusinessSetting::updateOrInsert(['type' => 'complaint_start_number'], [
            'value' => $request['complaint_start_number']
        ]);
        if($request['complaint_date']){ $start_date = Carbon::createFromFormat('d/m/Y',$request['complaint_date'])->format('Y-m-d'); }

        BusinessSetting::updateOrInsert(['type' => 'complaint_date'], [
            'value' => $start_date
        ]);
        return redirect()->back()->with('success',__('property_transactions.setting_updated'));
    }
}
