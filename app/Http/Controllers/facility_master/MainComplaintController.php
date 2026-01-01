<?php

namespace App\Http\Controllers\facility_master;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\facility_master\MainComplaintServices;

class MainComplaintController extends Controller
{
    public $complaint_services;
    public $model;
    public function __construct(MainComplaintServices $complaint_services){
        $this->complaint_services = $complaint_services;
    }
    public function index(Request $request){
        $ids = $request->bulk_ids;
        if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
            $data = ['status' => 1, 'worker' => $request->worker];
            (new Complaint())->setConnection('tenant')->whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $complaint = (new Complaint())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $complaint,
            'search'            => $search,
            'route'             => 'main_complaint',
            'description'       => 'no',
            'department'        => 'no',
            'code_status'                   => 'yes',
            'complaint_type'                   => 'yes',

        ];
    return view("admin-views.property_master.index" , $data);
    }

    public function store(Request $request){
        try{
            $complaint_services = $this->complaint_services->storePropertyMasterModal($request);
            return redirect()->route('main_complaint.index')->with('success',__('property_master.added_successfully'));
        }catch(\Exception $e){
            // Log::error($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id){
        $complaint_services = $this->complaint_services->findOrFail($id);
        $data = [
            "main"                          => $complaint_services,
            'route'                         => 'main_complaint',
            'description'                   => 'no',
            'code_status'                   => 'yes',
            'department'        => 'no',
            'complaint_type'                   => 'yes',
        ];
        return view("admin-views.property_master.edit",  $data);
    }
    public function update(Request $request, $id){
        // dd($request->all());
        try{
            $complaint_services = $this->complaint_services->updatePropertyMasterModal($request);
            return redirect()->route('main_complaint.index')->with('success',__('property_master.updated_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $complaint_services = $this->complaint_services->findOrFail($request->id);
        // dd($complaint_services);

        $complaint_services_delete = $this->complaint_services->deletePropertyMasterModal($request->id);
        ($complaint_services_delete == true) ? redirect()->route("complaint.index")->with("success",__('property_master.deleted_successfully'))
        : redirect()->back()->with('error',__('general.error_deleted'));
    }

    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new Complaint())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('property_master.updated_successfully'));
    }
}
