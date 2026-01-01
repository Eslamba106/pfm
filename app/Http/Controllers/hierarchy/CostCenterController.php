<?php

namespace App\Http\Controllers\hierarchy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\hierarchy\CostCenter;
use App\Models\hierarchy\CostCenterCategory;

class CostCenterController extends Controller
{
    public function index(Request $request){
        $this->authorize('cost_center');
        $ids = $request->bulk_ids;
        if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
            $data = ['status' => 1, 'worker' => $request->worker];
            (new CostCenter())->setConnection('tenant')->whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $cost_center = (new CostCenter())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);
        $cost_center_categories = (new CostCenterCategory())->setConnection('tenant')->get();
        $data = [
            'main'              => $cost_center,
            'cost_center_categories'              => $cost_center_categories,
            'search'            => $search,
            

        ];
        return view("admin-views.hierarchy.cost_center.index" , $data);
    }

    public function store(Request $request)
    { 
        $this->authorize('create_cost_center');
        $request->validate([
            'cost_center_category_id' => 'required',
            'name' => 'required',
        ]);
        try {
            $cost_center = (new CostCenter())->setConnection('tenant')->create($request->except('_token', 'q'));
            return redirect()->back()->with('success', __('general.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function edit($id){
        $this->authorize('edit_cost_center');
        $cost_center = (new CostCenter())->setConnection('tenant')->findOrFail($id);
        $cost_center_categories = (new CostCenterCategory())->setConnection('tenant')->get();
     
        $data = [
            'cost_center'                          => $cost_center,
            'cost_center_categories'              => $cost_center_categories,
        ];
        return view('admin-views.hierarchy.cost_center.edit' , $data);
    }

    public function update(Request $request , $id)
    { 
        $this->authorize('edit_cost_center');
        $request->validate([ 
            'name' => 'required',
            'cost_center_category_id' => 'required',
        ]);
        try {
            $cost_center = (new CostCenter())->setConnection('tenant')->findOrFail($id);
            $cost_center->update($request->except('_token', 'q'));
            return to_route('cost_center.index')->with('success', __('general.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $this->authorize('delete_cost_center');
        $cost_center =  (new CostCenter())->setConnection('tenant')->find($request->id);
        if($cost_center->delete()){
            return to_route('cost_center.index')->with('success', __('general.deleted_successfully'));
        }else{
            return to_route('cost_center.index')->with('success', __('general.deleted_successfully'));
        }
    }

    public function statusUpdate(Request $request)
    {
        $this->authorize('edit_cost_center');
        $main = (new CostCenter())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('general.updated_successfully'));
    }
}
