<?php
namespace App\Http\Controllers\facility_master;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\facility\Supplier;
use App\Models\general\Groups;
use App\Models\hierarchy\MainLedger;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    public function index(Request $request)
    {

        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';

        $suppliers = (new Supplier())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('currency_name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        if (isset($search) && empty($search)) {
            $suppliers = (new Supplier())->setConnection('tenant')->orderBy('created_at', 'asc')
                ->paginate(10);
        }

        $data = [
            'suppliers' => $suppliers,
            'search'    => $search,
        ];

        return view('admin-views.facility_master.supplier.index', $data);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'code' => 'required|string',
            'tax_registration' => 'required|string',
            'name' => 'required|string|unique:suppliers,name',

        ]);

        DB::beginTransaction();
        try {

            $supplier = (new Supplier())->setConnection('tenant')->create($request->except('_token' , 'q'));
            $company  = (new Company())->setConnection('tenant')->first();
            $group    = (new Groups())->setConnection('tenant')->where('id', 50)->first();
            $ledger   = (new MainLedger())->setConnection('tenant')->create([
                'code'                => $supplier->code,
                'name'                => $supplier->name,
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
            return redirect()->route('supplier.index')->with('success', ui_change('added_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }

    }
    public function edit($id)
    {
        $supplier = (new Supplier())->setConnection('tenant')->findOrFail($id);

        return view('admin-views.facility_master.supplier.edit', compact('supplier'));
    }

    public function update(Request $request, $id)
    {
        $supplier = (new Supplier())->setConnection('tenant')->findOrFail($id);
        $validated = $request->validate([
            'code' => 'required|string',
            'tax_registration' => 'required|string',
            'name' => [
                'required',
                'string',
                Rule::unique('suppliers', 'name')->ignore($id),
            ],
        ]);
        try {

            $supplier->update($request->except('_token' , 'q'));
            return redirect()->route('supplier.index')->with('success', __('property_master.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }
    public function delete(Request $request)
    {
        $country = (new Supplier())->setConnection('tenant')->findOrFail($request->id);
        $country->delete();
        return redirect()->back()->with('success', __('country.deleted_successfully'));
    }
    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new Supplier())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success', __('property_master.updated_successfully'));
    }

}
