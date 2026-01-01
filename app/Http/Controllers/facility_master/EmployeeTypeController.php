<?php

namespace App\Http\Controllers\facility_master;

use App\Models\EmployeeType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\facility_master\EmployeeTypeServices;

class EmployeeTypeController extends Controller
{
    public $employee_type_services;
    public $model;
    public function __construct(EmployeeTypeServices $employee_type_services){
        $this->employee_type_services = $employee_type_services;
    }
    public function index(Request $request){
        // $this->authorize('complaints');
        // $ids = $request->bulk_ids;
        // if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
        //     $data = ['status' => 1, 'worker' => $request->worker];
        //     (new EmployeeType())->setConnection('tenant')->whereIn('id', $ids)->update($data);
        //     return back()->with('success', __('general.updated_successfully'));
        // }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $employee_type = (new EmployeeType())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $employee_type,
            'search'            => $search,
            'route'             => 'employee_type',
            'description'       => 'no',
            'department'        => 'no',
            'code_status'                   => 'no',
            'complaint_type'                   => 'no',

        ];
        return view("admin-views.property_master.index" , $data);
    }

    public function store(Request $request){
        try{
            $employee_type_services = $this->employee_type_services->storePropertyMasterModal($request);
            return redirect()->route('employee_type.index')->with('success',__('property_master.added_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id){
        $employee_type_services = $this->employee_type_services->findOrFail($id);
        $data = [
            "main"                          => $employee_type_services,
            'route'                         => 'employee_type',
            'description'                   => 'no',
            'code_status'                   => 'no',
            'department'        => 'no',
            'complaint_type'                   => 'no',

        ];
        return view("admin-views.property_master.edit",  $data);
    }
    public function update(Request $request, $id){

        try{
            // $request->id = $id;
            $employee_type_services = $this->employee_type_services->updatePropertyMasterModal($request);
            return redirect()->route('employee_type.index')->with('success',__('property_master.updated_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $employee_type_services = $this->employee_type_services->findOrFail($request->id);
        // dd($employee_type_services);
        $employee_type_services_delete = $this->employee_type_services->deletePropertyMasterModal($request->id);
        ($employee_type_services_delete == true) ? redirect()->route("employee_type.index")->with("success",__('property_master.deleted_successfully'))
        : redirect()->back()->with('error',__('general.error_deleted'));
    }
    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new EmployeeType())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('property_master.updated_successfully'));
    }
    
}
