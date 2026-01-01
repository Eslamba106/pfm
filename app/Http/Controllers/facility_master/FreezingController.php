<?php

namespace App\Http\Controllers\facility_master;

use Illuminate\Http\Request;
use App\Models\facility\Freezing;
use App\Http\Controllers\Controller;
use App\Services\facility_master\FreezingServices;

class FreezingController extends Controller
{
    public $freezing_services;
    public $model;
    public function __construct(FreezingServices $freezing_services){
        $this->freezing_services = $freezing_services;
    }
    public function index(Request $request){
        $ids = $request->bulk_ids;
        if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
            $data = ['status' => 1, 'worker' => $request->worker];
            (new Freezing())->setConnection('tenant')->whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $freezing = (new Freezing())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $freezing,
            'search'            => $search,
            'route'             => 'freezing',
            'description'       => 'no',
            'department'        => 'no',
            'code_status'                   => 'no',
            'complaint_type'                   => 'no',

        ];
    return view("admin-views.property_master.index" , $data);
    }

    public function store(Request $request){
        try{
            $freezing_services = $this->freezing_services->storePropertyMasterModal($request);
            return redirect()->route('freezing.index')->with('success',__('property_master.added_successfully'));
        }catch(\Exception $e){
            // Log::error($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id){
        $freezing_services = $this->freezing_services->findOrFail($id);
        $data = [
            "main"                          => $freezing_services,
            'route'                         => 'freezing',
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
            $freezing_services = $this->freezing_services->updatePropertyMasterModal($request);
            return redirect()->route('freezing.index')->with('success',__('property_master.updated_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $freezing_services = $this->freezing_services->findOrFail($request->id);
        // dd($freezing_services);

        $freezing_services_delete = $this->freezing_services->deletePropertyMasterModal($request->id);
        ($freezing_services_delete == true) ? redirect()->route("freezing.index")->with("success",__('property_master.deleted_successfully'))
        : redirect()->back()->with('error',__('general.error_deleted'));
    }

    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new Freezing())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('property_master.updated_successfully'));
    }
}
