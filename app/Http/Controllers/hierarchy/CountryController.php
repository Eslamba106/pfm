<?php
namespace App\Http\Controllers\hierarchy;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\CountryMaster;
use App\Models\Region;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {

        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';

        $country_master = (new CountryMaster())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('currency_name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        if (isset($search) && empty($search)) {
            $country_master = (new CountryMaster())->setConnection('tenant')->orderBy('created_at', 'asc')
                ->paginate(10);
        }
        $countries = (new Country())->setConnection('tenant')->get();
        $regions   = (new Region())->setConnection('tenant')->get();

        $data = [
            'country_master' => $country_master,
            'countries'      => $countries,
            'regions'        => $regions,
            'search'         => $search,
        ];

        return view('admin-views.country.index', $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'region_id' => 'required',
            'country_id' => 'required',
        ]);
        try {
            $country = (new CountryMaster())->setConnection('tenant')->create($request->except('_token', 'q'));
            return redirect()->back()->with('success', __('country.added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function edit($id)
    {
        $country   = (new CountryMaster())->setConnection('tenant')->findOrFail($id);
        $countries = (new Country())->setConnection('tenant')->get();
        $regions   = (new Region())->setConnection('tenant')->get();

        return view('admin-views.country.edit', compact('country', 'countries', 'regions'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'region_id' => 'required',
            'country_id' => 'required',
        ]);
        try {
            $country = (new CountryMaster())->setConnection('tenant')->findOrFail($id);
            $country->update($request->except('_token', 'q'));
            return redirect()->route('country')->with('success', __('country.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request)
    {
        $country = (new CountryMaster())->setConnection('tenant')->findOrFail($request->id);
        $country->delete();
        return redirect()->back()->with('success', __('country.deleted_successfully'));
    }

    public function get_country($id)
    {
        $country = (new Country())->setConnection('tenant')->where('id', $id)->first();
        return json_encode($country);
    }
}
