<?php

namespace App\Http\Controllers\collections;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\hierarchy\MainLedger;
use App\Http\Controllers\Controller; 
use App\Models\collections\SalesReturnSettings;

class SalesReturnSettingsController extends Controller
{
    public function sales_return_index(Request $request)
    {
        $ids              = $request->bulk_ids;
        $search           = $request['search'];
        $query_param      = $search ? ['search' => $request['search']] : '';
        $sales_return_settings = SalesReturnSettings::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);
        $ledgers = MainLedger::whereNotNull('account_no')->get();

        // $ledgers = MainLedger::where('group_id', $group->id)->get();
        // dd($group , $ledgers);
        $data = [
            "sales_return_settings" => $sales_return_settings,
            "search"           => $search,
            "ledgers"          => $ledgers,

        ];
        return view('admin-views.transactions_settings.sales_return_settings', $data);
    }
    public function sales_return_store(Request $request)
    {
        $request->validate([
            'sales_return_width'        => 'required',
            'sales_return_start_number' => 'required',
            'sales_return_name'         => 'required|string|max:255',
            'ledger_id'            => 'required',
            Rule::unique('tenant.sales_return_settings', 'sales_return_type'),

        ]);
        // DB::beginTransaction();
        // try {

            $sales_return_settings = SalesReturnSettings::create([
                'invoice_prefix'        => $request->sales_return_prefix,
                'invoice_name'          => $request->sales_return_name,
                'invoice_suffix'        => $request->sales_return_suffix,
                'invoice_start_number'  => $request->sales_return_start_number,
                'invoice_with_logo'     => $request->sales_return_with_logo,
                'invoice_logo_position' => $request->sales_return_logo_position,
                'invoice_width'         => $request->sales_return_width,
                'ledger_id'             => ($request->ledger_id == 0) ? null : $request->ledger_id,
                'invoice_type'          => $request->sales_return_type,
                'invoice_format'        => $request->sales_return_format ?? null,
                'width'                 => $request->width ?? null,
                'height'                => $request->height ?? null,
                'invoice_date'          => Carbon::createFromFormat('d/m/Y', $request->sales_return_date)->format('Y-m-d') ?? null,

                'format_color'          => $request->format_color,
                'background_color'      => $request->background_color,

                'company_email'         => $request->company_email,
                'company_phone'         => $request->company_phone,
                'company_fax'           => $request->company_fax,
                'company_address'       => $request->company_address,
                'company_vat_no'        => $request->company_vat_no,

                'tenant_email'          => $request->tenant_email,
                'tenant_phone'          => $request->tenant_phone,
                'tenant_fax'            => $request->tenant_fax,
                'tenant_address'        => $request->tenant_address,
                'tenant_vat_no'         => $request->tenant_vat_no,

                'qr_code_width'         => $request->qr_code_width,
                'qr_code_height'        => $request->qr_code_height,
            ]);
            DB::commit();
            return redirect()->route("sales_return_settings")->with("success", __('general.added_successfully'));
        // } catch (\Throwable $th) {
        //     DB::rollBack();
        //     return redirect()->back()->with("error", $th->getMessage());

        // }
    }
    public function SalesReturnUpdate(Request $request)
    {
        $request->validate([
            // 'sales_return_prefix'        => 'required|string|max:255',
            // 'sales_return_suffix'        => 'required|string|max:255',
            'sales_return_width'        => 'required',
            'sales_return_start_number' => 'required',
            'sales_return_name'         => 'required|string|max:255',
            'ledger_id'            => 'required',
            'sales_return_type'         => 'required|unique:sales_return_settings,sales_return_type,' . $request->edit_sales_return_settings_id,

        ]);

        DB::beginTransaction();
        try {
            $sales_return_settings = SalesReturnSettings::findOrFail($request->edit_sales_return_settings_id);
            $sales_return_settings->update([
                'sales_return_prefix'        => $request->sales_return_prefix,
                'sales_return_name'          => $request->sales_return_name,
                'sales_return_suffix'        => $request->sales_return_suffix,
                'sales_return_start_number'  => $request->sales_return_start_number,
                'sales_return_with_logo'     => $request->sales_return_with_logo,
                'sales_return_logo_position' => $request->sales_return_logo_position,
                'sales_return_width'         => $request->sales_return_width,
                'ledger_id'             => ($request->ledger_id == 0) ? null : $request->ledger_id,
                'sales_return_type'          => $request->sales_return_type,
                'sales_return_format'        => $request->sales_return_format ?? null,
                'width'                 => $request->width ?? null,
                'height'                => $request->height ?? null,
                'sales_return_date'          => $request->sales_return_date
                    ? Carbon::createFromFormat('d/m/Y', $request->sales_return_date)->format('Y-m-d')
                    : null,

                'format_color'          => $request->format_color,
                'background_color'      => $request->background_color,

                'company_email'         => $request->company_email,
                'company_phone'         => $request->company_phone,
                'company_fax'           => $request->company_fax,
                'company_address'       => $request->company_address,
                'company_vat_no'        => $request->company_vat_no,

                'tenant_email'          => $request->tenant_email,
                'tenant_phone'          => $request->tenant_phone,
                'tenant_fax'            => $request->tenant_fax,
                'tenant_address'        => $request->tenant_address,
                'tenant_vat_no'         => $request->tenant_vat_no,

                'qr_code_width'         => $request->qr_code_width,
                'qr_code_height'        => $request->qr_code_height,
            ]);

            DB::commit();
            return redirect()->route("sales_return_settings")->with("success", __('general.updated_successfully'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("error", $th->getMessage());
        }
    }

    public function edit($id)
    {
        $sales_return_settings = SalesReturnSettings::findOrFail($id);
        // $main_ledgers          = DB::table('main_ledgers')->where('receipt_settings_id' ,$id )->get();
        // dd($main_ledgers);
        if ($sales_return_settings) {
            return response()->json([
                'status'           => 200,
                "sales_return_settings" => $sales_return_settings,
                // "main_ledgers" => $main_ledgers,
            ]);
        } else {
            return response()->json([
                'status'  => 404,
                "message" => "SalesReturn Settings Not Found",
            ]);
        }
    }

    public function delete(Request $request)
    {
        $sales_return_settings = SalesReturnSettings::findOrFail($request->id);
        $sales_return_settings->delete();
        return to_route('sales_return_settings')->with('success', __('general.deleted_successfully'));
    }
}
