<?php
namespace App\Http\Controllers\Investment;

use App\Http\Controllers\Controller;
use App\Models\BusinessActivity;
use App\Models\Company;
use App\Models\CountryMaster;
use App\Models\general\Groups;
use App\Models\hierarchy\MainLedger;
use App\Models\Investor;
use App\Models\LiveWith;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestorController extends Controller
{
    public function investors_list(Request $request)
    {
        $ids = $request->bulk_ids;
        if ($request->bulk_action_btn === 'update_status' && is_array($ids) && count($ids)) {
            $data = ['status' => 1];
            Investor::whereIn('id', $ids)->update($data);
            return back()->with('success', ui_change('updated_successfully'));
        }
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $investors   = Investor::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'investors' => $investors,
            'search'    => $search,

        ];
        return view("admin-views.investments.investor.investor_list", $data);
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
        return view("admin-views.investments.investor.create", $data);
    }

    public function edit($id)
    {
        $investor            = Investor::findOrFail($id);
        $country_master      = CountryMaster::get();
        $live_withs          = LiveWith::get();
        $business_activities = BusinessActivity::get();

        $data = [
            'country_master'      => $country_master,
            'live_withs'          => $live_withs,
            'business_activities' => $business_activities,
            'investor'            => $investor,
        ];
        return view("admin-views.investments.investor.edit", $data);
    }

    public function store(Request $request)
    {
        // Validation based on investor type
        if ($request->type == 'individual') {
            $request->validate([
                'gender'         => 'required|string|max:10',
                'nationality_id' => 'required|integer',
                'name'           => 'required|string|max:255',
            ]);
        } elseif ($request->type == 'company') {
            $request->validate([
                'company_name'         => 'required|string|max:255',
                'business_activity_id' => 'required|integer',
                'contact_person'       => 'required|string|max:255',
            ]);
        }

        // General Validation
        $request->validate([

            'country_id'         => 'required|integer',
            'type'               => 'nullable|string|max:255',
            'id_number'          => 'nullable|string|max:255',
            'registration_no'    => 'nullable|string|max:255',
            'nick_name'          => 'nullable|string|max:255',
            'group_company_name' => 'nullable|string|max:255',
            'designation'        => 'nullable|string|max:255',
            'contact_no'         => 'nullable|string|max:255',
            'whatsapp_no'        => 'nullable|string|max:255',
            'fax_no'             => 'nullable|string|max:255',
            'telephone_no'       => 'nullable|string|max:255',
            'other_contact_no'   => 'nullable|string|max:255',
            'address1'           => 'nullable|string|max:255',
            'address2'           => 'nullable|string|max:255',
            'address3'           => 'nullable|string|max:255',
            'state'              => 'nullable|string|max:255',
            'city'               => 'nullable|string|max:255',
            'passport_no'        => 'nullable|string|max:255',
            'email1'             => 'nullable|string|max:255',
            'email2'             => 'nullable|string|max:255',
        ]);
        DB::beginTransaction();
        try {

            $investor = Investor::create([
                'name'                 => $request->name ?? $request->company_name,
                'type'                 => $request->type,
                'gender'               => $request->gender,
                'id_number'            => $request->id_number,
                'registration_no'      => $request->registration_no,
                'nick_name'            => $request->nick_name,
                'group_company_name'   => $request->group_company_name,
                'contact_person'       => $request->contact_person,
                'designation'          => $request->designation,
                'contact_no'           => $request->contact_no,
                'whatsapp_no'          => $request->whatsapp_no,
                'company_name'         => $request->company_name,
                'fax_no'               => $request->fax_no,
                'telephone_no'         => $request->telephone_no,
                'other_contact_no'     => $request->other_contact_no,
                'address1'             => $request->address1,
                'address2'             => $request->address2,
                'address3'             => $request->address3,
                'state'                => $request->state,
                'city'                 => $request->city,
                'country_id'           => $request->country_id,
                'nationality_id'       => $request->nationality_id,
                'passport_no'          => $request->passport_no,
                'email1'               => $request->email1,
                'email2'               => $request->email2,
                'live_with_id'         => $request->live_with_id,
                'business_activity_id' => $request->business_activity_id,
            ]);
            // $company = auth()->user() ?? User())->setConnection()->first();
            $company = Company::where('id', auth()->user()->company_id)->first() ?? Company::first();
            $group   = Groups::where('id', 49)->first();
            $ledger  = MainLedger::create([
                'code'                => ($investor->type == 'individual') ? $investor->nick_name : $investor->company_name,
                'name'                => ($investor->type == 'individual') ? $investor->name : $investor->company_name,
                'currency'            => $company->currency_code,
                'country_id'          => $company->countryid,
                'group_id'            => $group->id,
                'main_id'             => $investor->id,
                'is_taxable'          => $group->is_taxable ?: 0,
                'vat_applicable_from' => $group->vat_applicable_from ?? null,
                'tax_rate'            => $group->tax_rate ?: 0,
                'tax_applicable'      => $group->tax_applicable ?: 0,
                'status'              => 'active',
            ]);

            DB::commit();
            return redirect()->route('investor.index')->with('success', ui_change('added_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function store_for_anything(Request $request)
    {
        if ($request->type == 'individual') {
            $request->validate([
                'gender'         => 'required|string|max:10',
                'nationality_id' => 'required|integer',
                'name'           => 'required|string|max:255',
            ]);
        } elseif ($request->type == 'company') {
            $request->validate([
                'company_name'         => 'required|string|max:255',
                'business_activity_id' => 'required|integer',
                'contact_person'       => 'required|string|max:255',
            ]);
        }

        // General Validation
        $request->validate([

            'country_id'         => 'required|integer',
            'type'               => 'nullable|string|max:255',
            'id_number'          => 'nullable|string|max:255',
            'registration_no'    => 'nullable|string|max:255',
            'nick_name'          => 'nullable|string|max:255',
            'group_company_name' => 'nullable|string|max:255',
            'designation'        => 'nullable|string|max:255',
            'contact_no'         => 'nullable|string|max:255',
            'whatsapp_no'        => 'nullable|string|max:255',
            'fax_no'             => 'nullable|string|max:255',
            'telephone_no'       => 'nullable|string|max:255',
            'other_contact_no'   => 'nullable|string|max:255',
            'address1'           => 'nullable|string|max:255',
            'address2'           => 'nullable|string|max:255',
            'address3'           => 'nullable|string|max:255',
            'state'              => 'nullable|string|max:255',
            'city'               => 'nullable|string|max:255',
            'passport_no'        => 'nullable|string|max:255',
            'email1'             => 'nullable|string|max:255',
            'email2'             => 'nullable|string|max:255',
        ]);
        DB::beginTransaction();
        try {

            $investor = Investor::create([
                'name'                 => $request->name ?? $request->company_name,
                'type'                 => $request->type,
                'gender'               => $request->gender,
                'id_number'            => $request->id_number,
                'registration_no'      => $request->registration_no,
                'nick_name'            => $request->nick_name,
                'group_company_name'   => $request->group_company_name,
                'contact_person'       => $request->contact_person,
                'designation'          => $request->designation,
                'contact_no'           => $request->contact_no,
                'whatsapp_no'          => $request->whatsapp_no,
                'company_name'         => $request->company_name,
                'fax_no'               => $request->fax_no,
                'telephone_no'         => $request->telephone_no,
                'other_contact_no'     => $request->other_contact_no,
                'address1'             => $request->address1,
                'address2'             => $request->address2,
                'address3'             => $request->address3,
                'state'                => $request->state,
                'city'                 => $request->city,
                'country_id'           => $request->country_id,
                'nationality_id'       => $request->nationality_id,
                'passport_no'          => $request->passport_no,
                'email1'               => $request->email1,
                'email2'               => $request->email2,
                'live_with_id'         => $request->live_with_id,
                'business_activity_id' => $request->business_activity_id,
            ]);
            // $company = auth()->user() ?? User())->setConnection()->first();
            $company = Company::where('id', auth()->user()->company_id)->first() ?? Company::first();
            $group   = Groups::where('id', 49)->first();
            $ledger  = MainLedger::create([
                'code'                => ($investor->type == 'individual') ? $investor->nick_name : $investor->company_name,
                'name'                => ($investor->type == 'individual') ? $investor->name : $investor->company_name,
                'currency'            => $company->currency_code,
                'country_id'          => $company->countryid,
                'group_id'            => $group->id,
                'main_id'             => $investor->id,
                'is_taxable'          => $group->is_taxable ?: 0,
                'vat_applicable_from' => $group->vat_applicable_from ?? null,
                'tax_rate'            => $group->tax_rate ?: 0,
                'tax_applicable'      => $group->tax_applicable ?: 0,
                'status'              => 'active',
            ]);

            DB::commit();
            return redirect()->back()->with('success', ui_change('added_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function update(Request $request, $id)
    {
        // Validation based on investor type
        if ($request->type == 'individual') {
            $request->validate([
                'gender'         => 'required|string|max:10',
                'nationality_id' => 'required|integer',
                'name'           => 'required|string|max:255',
            ]);
        } elseif ($request->type == 'company') {
            $request->validate([
                'company_name'         => 'required|string|max:255',
                'business_activity_id' => 'required|integer',
                'contact_person'       => 'required|string|max:255',
            ]);
        }

        // General Validation
        $request->validate([
            'country_id'         => 'required|integer',
            'type'               => 'nullable|string|max:255',
            'id_number'          => 'nullable|string|max:255',
            'registration_no'    => 'nullable|string|max:255',
            'nick_name'          => 'nullable|string|max:255',
            'group_company_name' => 'nullable|string|max:255',
            'designation'        => 'nullable|string|max:255',
            'contact_no'         => 'nullable|string|max:255',
            'whatsapp_no'        => 'nullable|string|max:255',
            'fax_no'             => 'nullable|string|max:255',
            'telephone_no'       => 'nullable|string|max:255',
            'other_contact_no'   => 'nullable|string|max:255',
            'address1'           => 'nullable|string|max:255',
            'address2'           => 'nullable|string|max:255',
            'address3'           => 'nullable|string|max:255',
            'state'              => 'nullable|string|max:255',
            'city'               => 'nullable|string|max:255',
            'passport_no'        => 'nullable|string|max:255',
            'email1'             => 'nullable|string|max:255',
            'email2'             => 'nullable|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $investor = Investor::findOrFail($id);

            // Update investor
            $investor->update([
                'name'                 => $request->name ?? $request->company_name,
                'type'                 => $request->type,
                'gender'               => $request->gender,
                'id_number'            => $request->id_number,
                'registration_no'      => $request->registration_no,
                'nick_name'            => $request->nick_name,
                'group_company_name'   => $request->group_company_name,
                'contact_person'       => $request->contact_person,
                'designation'          => $request->designation,
                'contact_no'           => $request->contact_no,
                'whatsapp_no'          => $request->whatsapp_no,
                'company_name'         => $request->company_name,
                'fax_no'               => $request->fax_no,
                'telephone_no'         => $request->telephone_no,
                'other_contact_no'     => $request->other_contact_no,
                'address1'             => $request->address1,
                'address2'             => $request->address2,
                'address3'             => $request->address3,
                'state'                => $request->state,
                'city'                 => $request->city,
                'country_id'           => $request->country_id,
                'nationality_id'       => $request->nationality_id,
                'passport_no'          => $request->passport_no,
                'email1'               => $request->email1,
                'email2'               => $request->email2,
                'live_with_id'         => $request->live_with_id,
                'business_activity_id' => $request->business_activity_id,
            ]);

            // Fetch company & group
            $company = Company::where('id', auth()->user()->company_id)->first() ?? Company::first();
            $group   = Groups::where('id', 49)->first();

            // Update Ledger linked to this investor
            $ledger = MainLedger::where('main_id', $investor->id)->first();

            if ($ledger) {
                $ledger->update([
                    'code'                => ($investor->type == 'individual') ? $investor->nick_name : $investor->company_name,
                    'name'                => ($investor->type == 'individual') ? $investor->name : $investor->company_name,
                    'currency'            => $company->currency_code,
                    'country_id'          => $company->countryid,
                    'group_id'            => $group->id,
                    'is_taxable'          => $group->is_taxable ?: 0,
                    'vat_applicable_from' => $group->vat_applicable_from ?? null,
                    'tax_rate'            => $group->tax_rate ?: 0,
                    'tax_applicable'      => $group->tax_applicable ?: 0,
                    'status'              => 'active',
                ]);
            }

            DB::commit();
            return redirect()->route('investor.index')->with('success', ui_change('updated_successfully'));

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {

            $investor = Investor::findOrFail($request->id); 
            MainLedger::where('main_id', $investor->id)->delete(); 
            $investor->delete();

            DB::commit();
            return redirect()->route('investor.index')->with('success', ui_change('deleted_successfully'));

        } catch (\Exception $e) {

            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function statusUpdate(Request $request)
    {
        $main = Investor::findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success', ui_change('updated_successfully'));
    }

}
