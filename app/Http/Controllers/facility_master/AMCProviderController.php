<?php
namespace App\Http\Controllers\facility_master;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\general\Groups;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\facility\AmcProvider;
use App\Models\hierarchy\MainLedger;

class AMCProviderController extends Controller
{
    public function index(Request $request)
    {

        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';

        $amc_providers = (new AmcProvider())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('currency_name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        if (isset($search) && empty($search)) {
            $amc_providers = (new AmcProvider())->setConnection('tenant')->orderBy('created_at', 'asc')
                ->paginate(10);
        }

        $data = [
            'amc_providers' => $amc_providers,
            'search'        => $search,
        ];

        return view('admin-views.facility_master.amc_providers.index', $data);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'code'                  => 'required|string',
            'name'                  => 'required|string',
            'tax_registration'      => 'required|string',
            'dail_code_contact_no'  => 'nullable|string',
            'contact_no'            => 'nullable|string',
            'dail_code_whatsapp_no' => 'nullable|string',
            'whatsapp_no'           => 'nullable|string',
            'city'                  => 'nullable|string',
            'state'                 => 'nullable|string',
            'country'               => 'nullable|string',
            'contact_person'        => 'nullable|string',
            'vat_no'                => 'nullable|string',
            'address1'              => 'nullable',
            'address2'              => 'nullable',
        ]);

        DB::beginTransaction();
        try {
            $amc     = (new AmcProvider())->setConnection('tenant')->create($validated);
            $company  = (new Company())->setConnection('tenant')->first();
            $group   = (new Groups())->setConnection('tenant')->where('id', 52)->first();
            $ledger  = (new MainLedger())->setConnection('tenant')->create([
                'code'                => $amc->code,
                'name'                => $amc->name,
                'currency'            => $company->currency_code,
                'country_id'          => $company->countryid,
                'group_id'            => $group->id,
                'is_taxable'          => $group->is_taxable ?: 0,
                'vat_applicable_from' => $group->vat_applicable_from ?? null,
                'tax_rate'            => $group->tax_rate ?: 0,
                'tax_applicable'      => $group->tax_applicable ?: 0,
                'status'              => 'active',
            ]);
            DB::commit();
            return redirect()->route('amc_provider.index')->with('success', __('property_master.added_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }

    }
    public function edit($id)
    {
        $amc_provider = (new AmcProvider())->setConnection('tenant')->findOrFail($id);

        return view('admin-views.facility_master.amc_providers.edit', compact('amc_provider'));
    }

    public function update(Request $request, $id)
    {
        try {
            $validated = $request->validate([
                'code'                  => 'required|string',
                'name'                  => 'required|string',
                'tax_registration'      => 'required|string',
                'dail_code_contact_no'  => 'nullable|string',
                'contact_no'            => 'nullable|string',
                'dail_code_whatsapp_no' => 'nullable|string',
                'whatsapp_no'           => 'nullable|string',
                'city'                  => 'nullable|string',
                'state'                 => 'nullable|string',
                'country'               => 'nullable|string',
                'contact_person'        => 'nullable|string',
                'address1'              => 'nullable',
                'address2'              => 'nullable',
                'vat_no'                => 'nullable|string',

            ]);
            $amc_provider = (new AmcProvider())->setConnection('tenant')->findOrFail($id);
            $amc_provider->update($validated);
            return redirect()->route('amc_provider.index')->with('success', __('property_master.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request)
    {
        $country = (new AmcProvider())->setConnection('tenant')->findOrFail($request->id);
        $country->delete();
        return redirect()->back()->with('success', __('country.deleted_successfully'));
    }
    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new AmcProvider())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success', __('property_master.updated_successfully'));
    }
}
