<?php

namespace App\Http\Controllers\property_master;

use App\Models\Block;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\property_master\BlockServices;
use Illuminate\Support\Facades\Log;

class BlockController extends Controller
{
    public $block_services;
    public $model;
    public function __construct(BlockServices $block_services){
        $this->block_services = $block_services;
    }
    public function index(Request $request){
        // $this->authorize('complaints');
        $ids = $request->bulk_ids;
        if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
            $data = ['status' => 1, 'worker' => $request->worker];
            (new Block())->setConnection('tenant')->whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $block = (new Block())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $block,
            'search'            => $search,
            'route'             => 'block',
            'description'       => 'no',
            'code_status'                   => 'yes',
            'department'        => 'no',
            'complaint_type'                   => 'no',

        ];
        return view("admin-views.property_master.index" , $data);
    }

    public function store(Request $request){
        app()->make('db')->setDefaultConnection('tenant');
        $request->validate([
            'name'          => 'required|unique:blocks,name',
            'code' => 'required'
        ]);
     
        try{
            $block_services = $this->block_services->storePropertyMasterModal($request);
            return redirect()->route('block.index')->with('success',__('property_master.added_successfully'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id){
        $block_services = $this->block_services->findOrFail($id);
        $data = [
            "main"                          => $block_services,
            'route'                         => 'block',
            'description'                   => 'no',
            'code_status'                   => 'yes',
            'department'        => 'no',
            'complaint_type'                   => 'no',

        ];
        return view("admin-views.property_master.edit",  $data);
    }
    public function update(Request $request, $id){
        app()->make('db')->setDefaultConnection('tenant');
        $request->validate([
            'name' => 'required|unique:blocks,name,' . $id . ',id'
        ]);
        try{ 
            $block_services = $this->block_services->updatePropertyMasterModal($request);
            return redirect()->route('block.index')->with('success',__('property_master.updated_successfully'));
        }catch(\Exception $e){
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $block_services = $this->block_services->findOrFail($request->id);
        // dd($block_services);

        $block_services_delete = $this->block_services->deletePropertyMasterModal($request->id);
        ($block_services_delete == true) ? redirect()->route("block.index")->with("success",__('property_master.deleted_successfully'))
        : redirect()->back()->with('error',__('general.error_deleted'));
    }
    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new Block())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('property_master.updated_successfully'));
    }
}
