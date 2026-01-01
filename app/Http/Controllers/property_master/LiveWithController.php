<?php

namespace App\Http\Controllers\property_master;

use App\Models\LiveWith;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\property_master\LiveWithServices;
use Illuminate\Support\Facades\Log;

class LiveWithController extends Controller
{
    public $live_with_services;
    public $model;
    public function __construct(LiveWithServices $live_with_services){
        $this->live_with_services = $live_with_services;
    }
    public function index(Request $request){
        // $this->authorize('complaints');
        // $ids = $request->bulk_ids;
        // if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
        //     $data = ['status' => 1, 'worker' => $request->worker];
        //     (new LiveWith())->setConnection('tenant')->whereIn('id', $ids)->update($data);
        //     return back()->with('success', __('general.updated_successfully'));
        // }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $live_with = (new LiveWith())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $live_with,
            'search'            => $search,
            'route'             => 'live_with',
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
            $live_with_services = $this->live_with_services->storePropertyMasterModal($request);
            return redirect()->route('live_with.index')->with('success',__('property_master.added_successfully'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id){
        $live_with_services = $this->live_with_services->findOrFail($id);
        $data = [
            "main"                          => $live_with_services,
            'route'                         => 'live_with',
            'description'                   => 'no',
            'code_status'       => 'no',
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
            $live_with_services = $this->live_with_services->updatePropertyMasterModal($request);
            return redirect()->route('live_with.index')->with('success',__('property_master.updated_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $live_with_services = $this->live_with_services->findOrFail($request->id);
        // dd($live_with_services);

        $live_with_services_delete = $this->live_with_services->deletePropertyMasterModal($request->id);
        ($live_with_services_delete == true) ? redirect()->route("live_with.index")->with("success",__('property_master.deleted_successfully'))
        : redirect()->back()->with('error',__('general.error_deleted'));
    }
    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new LiveWith())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('property_master.updated_successfully'));
    }

}
