<?php

namespace App\Http\Controllers\property_management;

use App\Models\Floor;
use Illuminate\Http\Request;
use App\Models\BlockManagement;
use App\Models\FloorManagement;
use Illuminate\Validation\Rule;
use App\Models\PropertyManagement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class FloorManagementController extends Controller
{
    public function index(Request $request)
    {
        // $this->authorize('floor_management');
        $ids              = $request->bulk_ids;
        $search           = $request['search'];
        $query_param      = $search ? ['search' => $request['search']] : '';
        $floor_management = (new FloorManagement())->setConnection('tenant')->join('floors', 'floor_management.floor_id', '=', 'floors.id')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('floors.name', 'like', "%{$value}%")
                    ->orWhere('floor_management.id', $value);
            }
        })
            ->select('floor_management.*', 'floors.name as block_name')
            ->latest()->paginate()->appends($query_param);

        $data = [
            'floor_management' => $floor_management,
            'search'           => $search,

        ];
        return view("admin-views.property_management.floor_management.floor_management_list", $data);
    }
    public function create()
    {
        $property = (new PropertyManagement())->setConnection('tenant')->forUser()->select('id', 'name', 'code')->get();
        $blocks   = (new BlockManagement())->setConnection('tenant')->select('id', 'block_id')->with('block:id,name,code')->get();
        $floors   = (new Floor())->setConnection('tenant')->select('id', 'name', 'code')->get();
        $data     = [
            "property" => $property,
            "floors"   => $floors,
            "blocks"   => $blocks,
        ];

        return view("admin-views.property_management.floor_management.create")->with($data);
    }
    public function edit($id)
    {
        $old_floor = (new FloorManagement())->setConnection('tenant')->findOrFail($id);
        $property  = (new PropertyManagement())->setConnection('tenant')->forUser()->get();
        $blocks    = (new BlockManagement())->setConnection('tenant')->get();
        $floors    = (new Floor())->setConnection('tenant')->get();
        $data      = [
            "property"  => $property,
            "floors"    => $floors,
            "blocks"    => $blocks,
            "old_floor" => $old_floor,
        ];

        return view("admin-views.property_management.floor_management.edit")->with($data);
    }
    public function store(Request $request)
    {
        app()->make('db')->setDefaultConnection('tenant');

        $rules = [
            'floors' => 'required|array',
            'property' => 'required',
            'block' => 'required',
            'type' => 'required',
        ];

        foreach ($request->floors as $index => $floorId) {
            $rules["floors.$index"] = [
                'required',
                Rule::unique('floor_management', 'floor_id')
                    ->where(function ($query) use ($request) {
                        return $query
                            ->where('property_management_id', $request->property)
                            ->where('block_management_id', $request->block);
                    })
            ];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            foreach ($request->floors as $floor) {
                $property = (new FloorManagement())->setConnection('tenant')->create([
                    "floor_id"               => $floor,
                    "property_management_id" => $request->property,
                    "block_management_id"    => $request->block,
                    "long_status"            => $request->type,
                ]);
            }

            return redirect()->route("floor_management.index")->with("success", __('property_master.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        app()->make('db')->setDefaultConnection('tenant');

        $floor = (new FloorManagement())->setConnection('tenant')->findOrFail($id);

        $request->validate([
            'floor'    => [
                'required',
                Rule::unique('floor_management', 'floor_id')
                    ->where(function ($query) use ($request) {
                        return $query->where('property_management_id', $request->property)
                            ->where('block_management_id', $request->block);
                    })
                    ->ignore($id)
            ],
            'property' => 'required',
            'block'    => 'required',
        ]);

        try {
            $property = (new FloorManagement())->setConnection('tenant')->findOrFail($id);

            $property->update([
                "floor_id"               => $request->floor,
                "property_management_id" => $request->property,
                "block_management_id"    => $request->block,
                "long_status"            => $request->type,

            ]);
            return redirect()->route("floor_management.index")->with("success", __('general.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function get_blocks_by_property_id($id)
    {
        $property = (new PropertyManagement())->setConnection('tenant')->findOrFail($id);
        $blocks   = (new BlockManagement())->setConnection('tenant')->where('property_management_id', $property->id)->with('block')->get();
        return json_encode($blocks);
    }

    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_subscription');
        $subscription = (new FloorManagement())->setConnection('tenant')->findOrFail($request->id);
        $subscription->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success', __('property_master.updated_successfully'));
    }
    public function delete(Request $request)
    {
        // $this->authorize('show_block');

        $floor = (new FloorManagement())->setConnection('tenant')->findOrFail($request->id);
        $floor->delete();
        return redirect()->back()->with('success', __('general.deleted_successfully'));
    }
}
