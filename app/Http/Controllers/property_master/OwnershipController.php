<?php

namespace App\Http\Controllers\property_master;

use App\Models\Ownership;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\property_master\OwnershipServices;
use Illuminate\Support\Facades\Log;

class OwnershipController extends Controller
{
    public $ownership_services;
    public $model;
    public function __construct(OwnershipServices $ownership_services){
        $this->ownership_services = $ownership_services;
    }
    public function index(Request $request){
        $ids = $request->bulk_ids;
        if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
            $data = ['status' => 1, 'worker' => $request->worker];
            (new Ownership ())->setConnection('tenant')->whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $ownership = (new Ownership ())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $ownership,
            'search'            => $search,
            'route'             => 'ownership',
            'description'       => 'no',
            'department'        => 'no',
            'code_status'                   => 'yes',
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
            $ownership_services = $this->ownership_services->storePropertyMasterModal($request);
            return redirect()->route('ownership.index')->with('success',__('property_master.added_successfully'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id){
        $ownership_services = $this->ownership_services->findOrFail($id);
        $data = [
            "main"                          => $ownership_services,
            'route'                         => 'ownership',
            'description'                   => 'no',
            'code_status'                   => 'yes',
            'department'        => 'no',
            'complaint_type'                   => 'no',


        ];
        return view("admin-views.property_master.edit",  $data);
    }
    public function update(Request $request, $id){
        // dd($request->all());
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        try{

            $ownership_services = $this->ownership_services->updatePropertyMasterModal($request);
            return redirect()->route('ownership.index')->with('success',__('property_master.updated_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $ownership_services = $this->ownership_services->findOrFail($request->id);
        // dd($ownership_services);

        $ownership_services_delete = $this->ownership_services->deletePropertyMasterModal($request->id);
        ($ownership_services_delete == true) ? redirect()->route("ownership.index")->with("success",__('property_master.deleted_successfully'))
        : redirect()->back()->with('error',__('general.error_deleted'));
    }
    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new Ownership ())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('property_master.updated_successfully'));
    }

}
