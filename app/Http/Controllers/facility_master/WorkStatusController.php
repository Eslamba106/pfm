<?php

namespace App\Http\Controllers\facility_master;

use App\Models\WorkStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\facility_master\WorkStatusServices;

class WorkStatusController extends Controller
{
    public $work_status_services;
    public $model;
    public function __construct(WorkStatusServices $work_status_services){
        $this->work_status_services = $work_status_services;
    }
    public function index(Request $request){
        $ids = $request->bulk_ids;
        if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
            $data = ['status' => 1, 'worker' => $request->worker];
            (new WorkStatus())->setConnection('tenant')->whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $work_status = (new WorkStatus())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $work_status,
            'search'            => $search,
            'route'             => 'work_status',
            'description'       => 'no',
            'department'        => 'no',
            'code_status'                   => 'no',
            'complaint_type'                   => 'no',

        ];
    return view("admin-views.property_master.index" , $data);
    }

    public function store(Request $request){
        try{
            $work_status_services = $this->work_status_services->storePropertyMasterModal($request);
            return redirect()->route('work_status.index')->with('success',__('property_master.added_successfully'));
        }catch(\Exception $e){
            // Log::error($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id){
        $work_status_services = $this->work_status_services->findOrFail($id);
        $data = [
            "main"                          => $work_status_services,
            'route'                         => 'work_status',
            'description'                   => 'no',
            'code_status'                   => 'no',
            'department'        => 'no',
            'complaint_type'                   => 'no',
        ];
        return view("admin-views.property_master.edit",  $data);
    }
    public function update(Request $request, $id){
        // dd($request->all());
        try{
            $work_status_services = $this->work_status_services->updatePropertyMasterModal($request);
            return redirect()->route('work_status.index')->with('success',__('property_master.updated_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $work_status_services = $this->work_status_services->findOrFail($request->id);
        // dd($work_status_services);

        $work_status_services_delete = $this->work_status_services->deletePropertyMasterModal($request->id);
        ($work_status_services_delete == true) ? redirect()->route("work_status.index")->with("success",__('property_master.deleted_successfully'))
        : redirect()->back()->with('error',__('general.error_deleted'));
    }

    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new WorkStatus())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('property_master.updated_successfully'));
    }
}
