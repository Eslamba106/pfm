<?php
namespace App\Http\Controllers\facility_master;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\BusinessActivity;
use App\Models\Company;
use App\Models\CountryMaster;
use App\Models\general\Groups;
use App\Models\hierarchy\MainLedger;
use App\Models\LiveWith;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller
{
    public function index(Request $request)
    {
        // $this->authorize('unit_management');
        $ids = $request->bulk_ids;
        if ($request->bulk_action_btn === 'update_status' && is_array($ids) && count($ids)) {
            $data = ['status' => 1];
            (new Agent())->setConnection('tenant')->whereIn('id', $ids)->update($data);
            return back()->with('success', __('general.updated_successfully'));
        }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $agents      = (new Agent())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'agents' => $agents,
            'search' => $search,

        ];
        return view("admin-views.facility_master.agents.agent_list", $data);
    }

    public function create()
    {

        $country_master      = CountryMaster::get();
        $live_withs          = LiveWith::get();
        $business_activities = BusinessActivity::get();

        $data = [
            'country_master'      => $country_master,
            'live_withs'          => $live_withs,
            'business_activities' => $business_activities,
        ];
        return view("admin-views.facility_master.agents.create", $data);
    }

    public function edit($id)
    {
        $agent               = (new Agent())->setConnection('tenant')->find($id);
        $country_master      = CountryMaster::get();
        $live_withs          = LiveWith::get();
        $business_activities = BusinessActivity::get();

        $data = [
            'agent'               => $agent,
            'country_master'      => $country_master,
            'live_withs'          => $live_withs,
            'business_activities' => $business_activities,
        ];
        return view("admin-views.facility_master.agents.edit", $data);
    }

    public function store(Request $request)
    {
        // dd($request->all()); 
        if ($request->type == 'individual') {
            $request->validate([
                'name'             => 'required|string|max:255',
                'gender'           => 'required|string|max:10',
                'live_with_id'     => 'required|integer',
                'country_id'       => 'required|integer',
                'nationality_id'   => 'required|integer',
                'tax_registration' => 'required|string',
            ]);
        } elseif ($request->type == 'company') {
            $request->validate([
                'company_name'         => 'required|string|max:255',
                'business_activity_id' => 'required|integer',
                'country_id'           => 'required|integer',
                'contact_person'       => 'required|string|max:255',
                'tax_registration'     => 'required|string',
            ]);
        }
        $validatedData = $request->validate([
            'name'                 => 'nullable|string|max:255',
            'gender'               => 'nullable|string|max:10',
            'tax_registration'     => 'nullable|string',
            'vat_no'               => 'nullable|string',
            'id_number'            => 'nullable|string|max:50',
            'registration_no'      => 'nullable|string|max:50',
            'nick_name'            => 'nullable|string|max:255',
            'group_company_name'   => 'nullable|string|max:255',
            'contact_person'       => 'nullable|string|max:255',
            'designation'          => 'nullable|string|max:255',
            'contact_no'           => 'nullable|string|max:20',
            'whatsapp_no'          => 'nullable|string|max:20',
            'company_name'         => 'nullable|string|max:255',
            'fax_no'               => 'nullable|string|max:20',
            'telephone_no'         => 'nullable|string|max:20',
            'other_contact_no'     => 'nullable|string|max:20',
            'address1'             => 'nullable|string|max:255',
            'address2'             => 'nullable|string|max:255',
            'address3'             => 'nullable|string|max:255',
            'state'                => 'nullable|string|max:255',
            'city'                 => 'nullable|string|max:255',
            'country_id'           => 'nullable|integer',
            'nationality_id'       => 'nullable|integer',
            'passport_no'          => 'nullable|string|max:50',
            'email1'               => 'nullable|email|max:255',
            'email2'               => 'nullable|email|max:255',
            'live_with_id'         => 'nullable|integer',
            'business_activity_id' => 'nullable|integer',
            'document'             => 'nullable|string|max:255',
            'type'                 => 'required|string|max:50',
        ]);
        DB::beginTransaction();
        try {

            $agent   = (new Agent())->setConnection('tenant')->storeAgent($validatedData);
            $company = Company::first();
            $group   = Groups::where('id', 51)->first();
            $ledger  = MainLedger::create([
                'code'                => ($agent->type == 'individual') ? $agent->nick_name : $agent->group_company_name,
                'name'                => $agent->name ?? $agent->contact_person,
                'currency'            => $company->currency_code,
                'country_id'          => $company->countryid,
                'group_id'            => $group->id ?? 0,
                'is_taxable'          => $group->is_taxable ?: 0,
                'vat_applicable_from' => $group->vat_applicable_from ?? null,
                'tax_rate'            => $group->tax_rate ?: 0,
                'tax_applicable'      => $group->tax_applicable ?: 0,
                'status'              => 'active',
            ]);

            DB::commit();
            return redirect()->route('agent.index')->with('success', __('general.added_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }

    }
    public function update(Request $request, $id)
    {
         if ($request->type == 'individual') {
            $request->validate([
                'name'             => 'required|string|max:255',
                'gender'           => 'required|string|max:10',
                'live_with_id'     => 'required|integer',
                'country_id'       => 'required|integer',
                'nationality_id'   => 'required|integer',
                'tax_registration' => 'required|string',
            ]);
        } elseif ($request->type == 'company') {
            $request->validate([
                'company_name'         => 'required|string|max:255',
                'business_activity_id' => 'required|integer',
                'country_id'           => 'required|integer',
                'contact_person'       => 'required|string|max:255',
                'tax_registration'     => 'required|string',
            ]);
        }
        $validatedData = $request->validate([
            'name'                 => 'nullable|string|max:255',
            'gender'               => 'nullable|string|max:10',
            'id_number'            => 'nullable|string|max:50',
            'tax_registration'     => 'required|string',
            'vat_no'               => 'nullable|string',
            'registration_no'      => 'nullable|string|max:50',
            'nick_name'            => 'nullable|string|max:255',
            'group_company_name'   => 'nullable|string|max:255',
            'contact_person'       => 'nullable|string|max:255',
            'designation'          => 'nullable|string|max:255',
            'contact_no'           => 'nullable|string|max:20',
            'whatsapp_no'          => 'nullable|string|max:20',
            'company_name'         => 'nullable|string|max:255',
            'fax_no'               => 'nullable|string|max:20',
            'telephone_no'         => 'nullable|string|max:20',
            'other_contact_no'     => 'nullable|string|max:20',
            'address1'             => 'nullable|string|max:255',
            'address2'             => 'nullable|string|max:255',
            'address3'             => 'nullable|string|max:255',
            'state'                => 'nullable|string|max:255',
            'city'                 => 'nullable|string|max:255',
            'country_id'           => 'nullable|integer',
            'nationality_id'       => 'nullable|integer',
            'passport_no'          => 'nullable|string|max:50',
            'email1'               => 'nullable|email|max:255',
            'email2'               => 'nullable|email|max:255',
            'live_with_id'         => 'nullable|integer',
            'business_activity_id' => 'nullable|integer',
            'document'             => 'nullable|string|max:255',
            'type'                 => 'required|string|max:50',
        ]);

        DB::beginTransaction();
        try {

            $agent = (new Agent())->setConnection('tenant')->findOrFail($id);
            $agent->update($validatedData);

            $company = auth()->user() ?? User::first();
            $group   = Groups::where('id', 51)->first();

            // $ledger = MainLedger::where('code', $agent->nick_name)
            //     ->orWhere('code', $agent->group_company_name)
            //     ->first();

            // if ($ledger) {
            //     $ledger->update([
            //         'code'                => ($agent->type == 'individual') ? $agent->nick_name : $agent->group_company_name,
            //         'name'                => ($agent->type == 'individual') ? $agent->name : $agent->company_name,
            //         'currency'            => $company->currency_code,
            //         'country_id'          => $company->countryid,
            //         'group_id'            => $group->id,
            //         'is_taxable'          => $group->is_taxable ?: 0,
            //         'vat_applicable_from' => $group->vat_applicable_from ?? null,
            //         'tax_rate'            => $group->tax_rate ?: 0,
            //         'tax_applicable'      => $group->tax_applicable ?: 0,
            //         'status'              => 'active',
            //     ]);
            // }

            DB::commit();
            return redirect()->route('agent.index')->with('success', __('general.updated_successfully'));

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new Agent())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success', __('property_master.updated_successfully'));
    }
    public function delete(Request $request)
    {
        $agent = (new Agent())->setConnection('tenant')->findOrFail($request->id);

        $agent->delete();

        return to_route('agent.index')->with('success', __('general.deleted_successfully'));
    }

}
