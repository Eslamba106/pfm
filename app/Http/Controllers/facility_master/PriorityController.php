<?php

namespace App\Http\Controllers\facility_master;

use Illuminate\Http\Request;
use App\Models\facility\Priority;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Services\facility_master\PriorityServices;

class PriorityController extends Controller
{
    public $priority_services;
    public $model;
    public function __construct(PriorityServices $priority_services){
        $this->priority_services = $priority_services;
    }
    public function index(Request $request){
        $ids = $request->bulk_ids;
        if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
            $data = ['status' => 1, 'worker' => $request->worker];
            (new Priority())->setConnection('tenant')->whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $priority = (new Priority())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $priority,
            'search'            => $search,
            'route'             => 'priority',
            'description'       => 'no',
            'department'        => 'no',
            'code_status'                   => 'no',
            'complaint_type'                   => 'no',

        ];
    return view("admin-views.property_master.index" , $data);
    }

    public function store(Request $request){
        try{
            $priority_services = $this->priority_services->storePropertyMasterModal($request);
            return redirect()->route('priority.index')->with('success',__('property_master.added_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id){
        $priority_services = $this->priority_services->findOrFail($id);
        $data = [
            "main"                          => $priority_services,
            'route'                         => 'priority',
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
            $priority_services = $this->priority_services->updatePropertyMasterModal($request);
            return redirect()->route('priority.index')->with('success',__('property_master.updated_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $priority_services = $this->priority_services->findOrFail($request->id);
        // dd($priority_services);

        $priority_services_delete = $this->priority_services->deletePropertyMasterModal($request->id);
        ($priority_services_delete == true) ? redirect()->route("priority.index")->with("success",__('property_master.deleted_successfully'))
        : redirect()->back()->with('error',__('general.error_deleted'));
    }

    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new Priority())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('property_master.updated_successfully'));
    }
}
