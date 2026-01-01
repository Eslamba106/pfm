<?php
namespace App\Http\Controllers\hierarchy;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\general\Groups;
use App\Models\hierarchy\MainLedger;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    public function index(Request $request)
    {
        // $this->authorize('complaints');
        $ids         = $request->bulk_ids;
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $main_ledger = (new MainLedger())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);
        $countries = (new Country())->setConnection('tenant')->get();
        $groups    = (new Groups())->setConnection('tenant')->get();
        $data      = [
            'main'      => $main_ledger,
            'search'    => $search,
            'countries' => $countries,
            'groups'    => $groups,

        ];
        return view("admin-views.hierarchy.ledgers.ledgers_list", $data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'     => 'required|string|max:255',
            'code'     => 'required|string|max:255',
            'currency' => 'required|string|max:255',
            'group_id' => 'required',

        ]);
        try {
            ($request->vat_applicable_from != null) ? $vat_applicable_from = Carbon::createFromFormat('d/m/Y', $request->vat_applicable_from)->format('Y-m-d') : $vat_applicable_from = null;
            $ledger                                                        = (new MainLedger())->setConnection('tenant')->create([
                'code'                   => $request->code,
                'name'                   => $request->name,
                'currency'               => $request->currency,
                'contact_person'         => $request->contact_person,
                'phone'                  => $request->phone,
                'email'                  => $request->email,
                'nature'                 => $request->nature,
                'address'                => $request->address,
                'country_id'             => $request->country_id,
                'group_id'               => $request->group_id,
                'is_taxable'             => $request->is_taxable ?: 0,
                'vat_applicable_from'    => $vat_applicable_from,
                'tax_rate'               => $request->tax_rate ?: 0,
                'is_discount'            => $request->is_discount ?: 0,
                'is_cash'                => $request->is_cash ?: 0,
                'project_general_ledger' => $request->project_general_ledger ?: 0,
                'maintain_bill_by_bill'  => $request->maintain_bill_by_bill ?: 0,
                'tax_applicable'         => $request->tax_applicable ?: 0,
                'is_custom_vat'          => $request->is_custom_vat ?: 0,
                'status'                 => $request->status ?: 'active',
                'iban_no'                => $request->iban_no ?? null,
                'swift_code'             => $request->swift_code ?? null,
                'account_no'             => $request->account_no ?? null,
                'branch'                 => $request->branch ?? null,
                'bank_name'              => $request->bank_name ?? null,
                'account_name'           => $request->account_name ?? null,
            ]);

            return redirect()->route("ledgers.index")->with("success", __('general.added_successfully'));
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", $th->getMessage());

        }
    }

    public function edit($id)
    {
        $main      = (new MainLedger())->setConnection('tenant')->findOrFail($id);
        $groups    = (new Groups())->setConnection('tenant')->get();
        $countries = (new Country())->setConnection('tenant')->get();

        $data = [
            'groups'    => $groups,
            'ledger'    => $main,
            'countries' => $countries,

        ];
        return view("admin-views.hierarchy.ledgers.edit", $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'code'     => 'required|string|max:255',
            'currency' => 'required|string|max:255',
            'group_id' => 'required',
        ]);

        try {
            $ledger              = (new MainLedger())->setConnection('tenant')->findOrFail($id);
            $vat_applicable_from = $request->vat_applicable_from
            ? Carbon::createFromFormat('d/m/Y', $request->vat_applicable_from)->format('Y-m-d')
            : null;

            $ledger->update([
                'code'                   => $request->code,
                'name'                   => $request->name,
                'currency'               => $request->currency,
                'contact_person'         => $request->contact_person,
                'phone'                  => $request->phone,
                'email'                  => $request->email,
                'nature'                 => $request->nature,
                'address'                => $request->address,
                'country_id'             => $request->country_id,
                'group_id'               => $request->group_id,
                'is_taxable'             => $request->is_taxable ?: 0,
                'vat_applicable_from'    => $vat_applicable_from,
                'tax_rate'               => $request->tax_rate ?: 0,
                'is_discount'            => $request->is_discount ?: 0,
                'is_cash'                => $request->is_cash ?: 0,
                'project_general_ledger' => $request->project_general_ledger ?: 0,
                'maintain_bill_by_bill'  => $request->maintain_bill_by_bill ?: 0,
                'tax_applicable'         => $request->tax_applicable ?: 0,
                'is_custom_vat'          => $request->is_custom_vat ?: 0,
                'status'                 => $request->status ?: 'active',
                'iban_no'                => $request->iban_no ?? $ledger->iban_no,
                'swift_code'             => $request->swift_code ?? $ledger->swift_code,
                'account_no'             => $request->account_no ?? $ledger->account_no,
                'branch'                 => $request->branch ?? $ledger->branch,
                'bank_name'              => $request->bank_name ?? $ledger->bank_name,
                'account_name'           => $request->account_name ?? $ledger->account_name,
            ]);

            return redirect()->route("ledgers.index")->with("success", __('general.updated_successfully'));
        } catch (\Throwable $th) {
            return redirect()->back()->with("error", $th->getMessage());
        }

    }
    public function delete(Request $request)
    {
        $ledger = (new MainLedger())->setConnection('tenant')->findOrFail($request->id);
        $ledger->delete();
        return redirect()->route("ledgers.index")->with("success", __('general.deleted_successfully'));
    }
    public function show($id)
    {
        $ledger = (new MainLedger())->setConnection('tenant')->findOrFail($id);
        // $sub_groups = Groups::where('group_id' , $id)->get();
        // $countries = Country::get();
        // $parent_group = Groups::where('id' , $group->group_id)->first();
        $data = [
            // 'parent_group' => $parent_group,
            'ledger' => $ledger,
            // 'sub_groups' => $sub_groups,
            // 'countries' => $countries,
        ];
        return view("admin-views.hierarchy.ledgers.show", $data);
    }
}
