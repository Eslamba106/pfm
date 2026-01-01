<?php

namespace App\Http\Controllers\hierarchy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\hierarchy\CostCenter;
use App\Models\hierarchy\CostCenterCategory;

class CostCenterCategoryController extends Controller
{
    public function index(Request $request){ 
        $this->authorize('cost_center_categories');
        $ids = $request->bulk_ids;
        if ($request->bulk_action_btn === 'update_status'  && is_array($ids) && count($ids)) {
            $data = ['status' => 1, 'worker' => $request->worker];
            (new CostCenterCategory ())->setConnection('tenant')->whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $cost_center_category = (new CostCenterCategory())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $cost_center_category,
            'search'            => $search,
            

        ];
        return view("admin-views.hierarchy.cost_center_category.index" , $data);
    }

    public function store(Request $request)
    { 
        $this->authorize('create_cost_center_category');
        $request->validate([ 
            'name' => 'required',
        ]);
        try {
            $cost_center_category = (new CostCenterCategory())->setConnection('tenant')->create($request->except('_token', 'q'));
            return redirect()->back()->with('success', __('general.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function edit($id){
        $this->authorize('edit_cost_center_category');
        $cost_center_category = (new CostCenterCategory())->setConnection('tenant')->findOrFail($id);

        $data = [
            'cost_center_category'                          => $cost_center_category,
        ];
        return view('admin-views.hierarchy.cost_center_category.edit' , $data);
    }

    public function update(Request $request , $id)
    { 
        $this->authorize('edit_cost_center_category');
        $request->validate([ 
            'name' => 'required',
        ]);
        try {
            $cost_center_category = (new CostCenterCategory())->setConnection('tenant')->findOrFail($id);
            $cost_center_category->update($request->except('_token', 'q'));
            return to_route('cost_center_category.index')->with('success', __('general.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request){
        $this->authorize('delete_cost_center_category');
        $cost_center_category =  (new CostCenterCategory())->setConnection('tenant')->find($request->id);
        $cost_center=  (new CostCenter())->setConnection('tenant')->where('cost_center_category_id',$request->id)->delete();
        if($cost_center_category->delete()){
            return to_route('cost_center_category.index')->with('success', __('general.deleted_successfully'));
        }else{
            return to_route('cost_center_category.index')->with('success', __('general.deleted_successfully'));
        }
    } 
    public function statusUpdate(Request $request)
    {
        $this->authorize('edit_cost_center_category');
        $main = (new CostCenterCategory())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success',__('general.updated_successfully'));
    }
}
