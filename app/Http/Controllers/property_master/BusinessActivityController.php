<?php

namespace App\Http\Controllers\property_master;

use App\Models\BusinessActivity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\property_master\BusinessActivityServices;
use Illuminate\Support\Facades\Log;

class BusinessActivityController extends Controller
{
    public $business_activity_services;
    public $model;
    public function __construct(BusinessActivityServices $business_activity_services){
        $this->business_activity_services = $business_activity_services;
    }
    public function index(Request $request){
        // $this->authorize('complaints');
        // $ids = $request->bulk_ids;
        // if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
        //     $data = ['status' => 1, 'worker' => $request->worker];
        //     (new BusinessActivity())->setConnection('tenant')->whereIn('id', $ids)->update($data);
        //     return back()->with('success', __('general.updated_successfully'));
        // }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $business_activity = (new BusinessActivity())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $business_activity,
            'search'            => $search,
            'route'             => 'business_activity',
            'description'       => 'no',
            'code_status'       => 'yes',
            'department'        => 'no',
            'complaint_type'                   => 'no',

        ];
        return view("admin-views.property_master.index" , $data);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        try{
            $business_activity_services = $this->business_activity_services->storePropertyMasterModal($request);
            return redirect()->route('business_activity.index')->with('success',__('property_master.added_successfully'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id){
        $business_activity_services = $this->business_activity_services->findOrFail($id);
        $data = [
            "main"                          => $business_activity_services,
            'route'                         => 'business_activity',
            'description'                   => 'no',
            'code_status'                   => 'yes',
            'department'        => 'no',
            'complaint_type'                   => 'no',

        ];
        return view("admin-views.property_master.edit",  $data);
    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        try{
            // $request->id = $id;
            $business_activity_services = $this->business_activity_services->updatePropertyMasterModal($request);
            return redirect()->route('business_activity.index')->with('success',__('property_master.updated_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $business_activity_services = $this->business_activity_services->findOrFail($request->id);
        // dd($business_activity_services);

        $business_activity_services_delete = $this->business_activity_services->deletePropertyMasterModal($request->id);
        ($business_activity_services_delete == true) ? redirect()->route("business_activity.index")->with("success",__('property_master.deleted_successfully'))
        : redirect()->back()->with('error',__('general.error_deleted'));
    }
    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new BusinessActivity())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('property_master.updated_successfully'));
    }

}
