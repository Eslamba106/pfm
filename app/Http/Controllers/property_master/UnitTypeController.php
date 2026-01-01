<?php

namespace App\Http\Controllers\property_master;

use App\Models\UnitType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\property_master\UnitTypeServices;
use Illuminate\Support\Facades\Log;

class UnitTypeController extends Controller
{
    public $unit_type_services;
    public $model;
    public function __construct(UnitTypeServices $unit_type_services){
        $this->unit_type_services = $unit_type_services;
    }
    public function index(Request $request){
        // $this->authorize('complaints');
        // $ids = $request->bulk_ids;
        // if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
        //     $data = ['status' => 1, 'worker' => $request->worker];
        //     (new UnitType())->setConnection('tenant')->whereIn('id', $ids)->update($data);
        //     return back()->with('success', __('general.updated_successfully'));
        // }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $unit_type = (new UnitType())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $unit_type,
            'search'            => $search,
            'route'             => 'unit_type',
            'description'       => 'yes',
            'code_status'       => 'yes',
            'department'                   => 'no',
            'complaint_type'                   => 'no',
        ];
        return view("admin-views.property_master.index" , $data);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'code' => 'required',
            'unit_description_id' => 'required',
        ]);
        try{
            $unit_type_services = $this->unit_type_services->storePropertyMasterModal($request);
            return redirect()->route('unit_type.index')->with('success',__('property_master.added_successfully'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id){
        $unit_type_services = $this->unit_type_services->findOrFail($id);
        $data = [
            "main"                          => $unit_type_services,
            'route'                         => 'unit_type',
            'description'                   => 'yes',
            'code_status'                   => 'yes',
            'department'                   => 'no',
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
            $unit_type_services = $this->unit_type_services->updatePropertyMasterModal($request);
            return redirect()->route('unit_type.index')->with('success',__('property_master.updated_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $unit_type_services = $this->unit_type_services->findOrFail($request->id);
        // dd($unit_type_services);

        $unit_type_services_delete = $this->unit_type_services->deletePropertyMasterModal($request->id);
        ($unit_type_services_delete == true) ? redirect()->route("unit_type.index")->with("success",__('property_master.deleted_successfully'))
        : redirect()->back()->with('error',__('general.error_deleted'));
    }
    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new UnitType())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('property_master.updated_successfully'));
    }

}
