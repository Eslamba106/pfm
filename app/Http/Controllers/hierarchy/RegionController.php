<?php
namespace App\Http\Controllers\hierarchy;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index(Request $request)
    {

        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';

        $regions = (new Region())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        if (isset($search) && empty($search)) {
            $regions = (new Region())->setConnection('tenant')->orderBy('created_at', 'asc')
                ->paginate(10);
        }

        $data = [
            'regions' => $regions,
            'search'  => $search,
        ];

        return view('admin-views.region.index', $data);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            "name" => 'required',
            "code" => 'required',
        ]);
        try {
            $region = (new Region())->setConnection('tenant')->create($request->except('_token', 'q'));
            return redirect()->back()->with('success', __('region.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }

    }
    public function edit($id)
    {
        $region = (new Region())->setConnection('tenant')->findOrFail($id);
        return view('admin-views.region.edit', compact('region'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            "code" => 'required',
        ]);
        try {
            $region = (new Region())->setConnection('tenant')->findOrFail($id);
            $region->update($request->except('_token', 'q'));
            return redirect()->route('region')->with('success', __('region.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }

    }
    public function delete(Request $request)
    {
        $region = (new Region())->setConnection('tenant')->findOrFail($request->id);
        $region->delete();
        return redirect()->back()->with('success', __('region.deleted_successfully'));
    }
}
