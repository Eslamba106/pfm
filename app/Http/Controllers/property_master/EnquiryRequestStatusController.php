<?php

namespace App\Http\Controllers\property_master;

use App\Models\EnquiryRequestStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\property_master\EnquiryRequestStatusServices;
use Illuminate\Support\Facades\Log;

class EnquiryRequestStatusController extends Controller
{
    public $enquiry_request_status_services;
    public $model;
    public function __construct(EnquiryRequestStatusServices $enquiry_request_status_services){
        $this->enquiry_request_status_services = $enquiry_request_status_services;
    }
    public function index(Request $request){
        // $this->authorize('complaints');
        // $ids = $request->bulk_ids;
        // if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
        //     $data = ['status' => 1, 'worker' => $request->worker];
        //     (new EnquiryRequestStatus())->setConnection('tenant')->whereIn('id', $ids)->update($data);
        //     return back()->with('success', __('general.updated_successfully'));
        // }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $enquiry_request_status = (new EnquiryRequestStatus())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $enquiry_request_status,
            'search'            => $search,
            'route'             => 'enquiry_request_status',
            'description'       => 'no',
            'code_status'       => 'no',
            'department'        => 'no',
            'complaint_type'                   => 'no',

        ];
        return view("admin-views.property_master.index" , $data);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
        ]);
        try{
            $enquiry_request_status_services = $this->enquiry_request_status_services->storePropertyMasterModal($request);
            return redirect()->route('enquiry_request_status.index')->with('success',__('property_master.added_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id){
        $enquiry_request_status_services = $this->enquiry_request_status_services->findOrFail($id);
        $data = [
            "main"                          => $enquiry_request_status_services,
            'route'                         => 'enquiry_request_status',
            'description'                   => 'no',
            'code_status'                   => 'no',
            'department'        => 'no',
            'complaint_type'                   => 'no',

        ];
        return view("admin-views.property_master.edit",  $data);
    }
    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
        ]);
        try{
            // $request->id = $id;
            $enquiry_request_status_services = $this->enquiry_request_status_services->updatePropertyMasterModal($request);
            return redirect()->route('enquiry_request_status.index')->with('success',__('property_master.updated_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $enquiry_request_status_services = $this->enquiry_request_status_services->findOrFail($request->id);
        // dd($enquiry_request_status_services);

        $enquiry_request_status_services_delete = $this->enquiry_request_status_services->deletePropertyMasterModal($request->id);
        ($enquiry_request_status_services_delete == true) ? redirect()->route("enquiry_request_status.index")->with("success",__('property_master.deleted_successfully'))
        : redirect()->back()->with('error',__('general.error_deleted'));
    }
    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new EnquiryRequestStatus())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('property_master.updated_successfully'));
    }
}
