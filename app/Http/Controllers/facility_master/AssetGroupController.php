<?php

namespace App\Http\Controllers\facility_master;

use Illuminate\Http\Request;
use App\Models\general\Groups;
use Illuminate\Support\Facades\DB;
use App\Models\facility\AssetGroup;
use App\Http\Controllers\Controller;
use App\Services\facility_master\AssetGroupServices;

class AssetGroupController extends Controller
{
    public $asset_group_services;
    public $model;
    public function __construct(AssetGroupServices $asset_group_services){
        $this->asset_group_services = $asset_group_services;
    }
    public function index(Request $request){
        $ids = $request->bulk_ids;
        if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
            $data = ['status' => 1, 'worker' => $request->worker];
            (new AssetGroup())->setConnection('tenant')->whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $asset_group = (new AssetGroup())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $asset_group,
            'search'            => $search,
            'route'             => 'asset_group',
            'description'       => 'no',
            'department'        => 'no',
            'code_status'                   => 'yes',
            'complaint_type'                   => 'no',

        ];
    return view("admin-views.property_master.index" , $data);
    }

    public function store(Request $request){
        DB::beginTransaction();
        try{
            $asset_group_services = $this->asset_group_services->storePropertyMasterModal($request);
            $master_group   = (new Groups())->setConnection('tenant')->where('id', 30)->first();
            $group = (new Groups())->setConnection('tenant')->create([
                'code'                              => $request->input('code'),
                'name'                              => $request->input('name'),
                'display_name'                      => $request->input('name'), 
                'group_id'                          => $master_group->id,
                'is_projects_parent_group'          => $master_group->is_projects_parent_group ?: 0,
                'enable_auto_code'                  => $master_group->enable_auto_code ?: 0,
                'status'                            => 'active',
                'tax_applicable'                    => $master_group->tax_applicable ?: 0,
                'is_taxable'                        => $master_group->is_taxable ?: 0,
                'vat_applicable_from'               => $master_group->vat_applicable_from ?? null,
                'tax_rate'                          => $master_group->tax_rate ?: 0,
            ]);
            DB::commit();
            return redirect()->route('asset_group.index')->with('success',__('property_master.added_successfully'));
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id){
        $asset_group_services = $this->asset_group_services->findOrFail($id);
        $data = [
            "main"                          => $asset_group_services,
            'route'                         => 'asset_group',
            'description'                   => 'no',
            'code_status'                   => 'yes',
            'department'        => 'no',
            'complaint_type'                   => 'no',
        ];
        return view("admin-views.property_master.edit",  $data);
    }
    public function update(Request $request, $id){
        // dd($request->all());
        try{
            $asset_group_services = $this->asset_group_services->updatePropertyMasterModal($request);
            return redirect()->route('asset_group.index')->with('success',__('property_master.updated_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $asset_group_services = $this->asset_group_services->findOrFail($request->id);
        // dd($asset_group_services);

        $asset_group_services_delete = $this->asset_group_services->deletePropertyMasterModal($request->id);
        ($asset_group_services_delete == true) ? redirect()->route("asset_group.index")->with("success",__('property_master.deleted_successfully'))
        : redirect()->back()->with('error',__('general.error_deleted'));
    }

    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new AssetGroup())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('property_master.updated_successfully'));
    }
}
