<?php

namespace App\Http\Controllers\property_master;

use Illuminate\Http\Request;
use App\Models\ServiceMaster;
use App\Models\general\Groups;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\hierarchy\MainLedger;
use App\Models\User;

class ServiceController extends Controller
{
    // public $service_master_services;
    // public $model;
    // // public function __construct(ServiceMasterServices $service_master_services){
    // //     $this->service_master_services = $service_master_services;
    // // }
    public function index(Request $request){
        // $this->authorize('complaints');
        $ids = $request->bulk_ids;
        if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
            $data = ['status' => 1, 'worker' => $request->worker];
            (new ServiceMaster())->setConnection('tenant')->whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $service_master = (new ServiceMaster())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $service_master,
            'search'            => $search,
            'route'            => 'services',
            

        ];
        return view("admin-views.property_master.service.index" , $data);
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        $company = Company::first();
        DB::beginTransaction();
        try{
            $service_master  = (new ServiceMaster())->setConnection('tenant')->create($request->except('_token' , 'q'));
            $master_group = Groups::where('id' , 47)->first();
            $ledger = MainLedger::create([
                'code'                   => $service_master->code ,
                'name'                   => $service_master->name   ,
                'currency'               => $company->currency_code, 
                'country_id'             => $company->countryid,
                'group_id'               => $master_group->id,
                'main_id'                => $service_master->id,
                'is_taxable'             => $master_group->is_taxable ?: 0,
                'vat_applicable_from'    => $master_group->vat_applicable_from ?? null,
                'tax_rate'               => $master_group->tax_rate ?: 0, 
                'tax_applicable'         => $master_group->tax_applicable ?: 0,
                'status'                 => 'active',
        ]);
            DB::commit();
            return redirect()->route('services.index')->with('success',__('property_master.added_successfully'));
        }catch(\Exception $e){
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id){
        $service_master = (new ServiceMaster())->setConnection('tenant')->findOrFail($id);
        $data = [
            "main"                          => $service_master ,
            'route'            => 'services',
        ];
        return view("admin-views.property_master.service.edit",  $data);
    }
    public function update(Request $request, $id){

        $request->validate([
            'name' => 'required',
            'code' => 'required',
        ]);
        try{ 
            $service_master = (new ServiceMaster())->setConnection('tenant')->findOrFail($id);
            $service_master_services = $service_master->update($request->except('_token' , 'q'));;
            return redirect()->route('services.index')->with('success',__('property_master.updated_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $service_master = (new ServiceMaster())->setConnection('tenant')->findOrFail($request->id); 
        $service_master->delete();
        return redirect()->route('services.index')->with('success',__('general.deleted_successfully'));
    }
    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new ServiceMaster())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('property_master.updated_successfully'));
    }
}
