<?php
namespace App\Http\Controllers\collections;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\general\Groups;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\hierarchy\MainLedger;
use App\Models\collections\ReceiptSettings;

class ReceiptSettingsController extends Controller
{
    public function ReceiptIndex(Request $request)
    {
        $ids              = $request->bulk_ids;
        $search           = $request['search'];
        $query_param      = $search ? ['search' => $request['search']] : '';
        $receipt_settings = (new ReceiptSettings())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param); 
                $group_one = (new Groups())->setConnection('tenant')->where('name', 'like', '%Bank Accounts%')->first(); 
                $group_two = (new Groups())->setConnection('tenant')->where('name', 'like', '%Cash-in-Hand%')->first();
                $allGroupIds = [];  
            
                 if ($group_one) {
                    $subgroupIdsOne = (new Groups())->setConnection('tenant')->where('group_id', $group_one->id)->pluck('id')->toArray();
                    $allGroupIds = array_merge($allGroupIds, [$group_one->id], $subgroupIdsOne);
                }
            
                 if ($group_two) {
                    $subgroupIdsTwo = (new Groups())->setConnection('tenant')->where('group_id', $group_two->id)->pluck('id')->toArray();
                    $allGroupIds = array_merge($allGroupIds, [$group_two->id], $subgroupIdsTwo);
                } 
                $ledgers = (new MainLedger())->setConnection('tenant')->whereIn('group_id', $allGroupIds)->get();
                // dd($ledgers  ); 

                $groups = [ $group_one, $group_two];

        // $ledgers = MainLedger::where('group_id', $group->id)->get();
        // dd($group , $ledgers);
        $data = [
            "receipt_settings" => $receipt_settings,
            "search"           => $search,
            "ledgers"          => $ledgers,
            "group"            => $groups,

        ];
        return view('admin-views.transactions_settings.receipt_settings', $data);
    }
    public function ReceiptStore(Request $request)
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'ledgers'         => 'required|array',
            'result'          => 'required',
            'applicable_date' => 'required',

        ]);
         DB::beginTransaction();
        try {

            $receipt_settings = (new ReceiptSettings())->setConnection('tenant')->create([
                'name'             => $request->name,
                'prefix'           => $request->prefix,
                'sufix'            => $request->sufix,
                'starting_number'     => $request->start_number,
                'prefix_with_zero' => $request->prefix_with_zero  ,
                'total_digit'      => $request->total_digit,
                'result'           => $request->result,
                'receipt_with_logo'           => $request->receipt_with_logo,
                'address_status'           => $request->receipt_with_address,
                'balance_amount_status'           => $request->receipt_with_balance_amount,
                'signature_status'           => $request->receipt_with_signature,
                'receipt_logo_position'           => $request->receipt_logo_position,
                'receipt_format'           => $request->receipt_format,
                'width'           => $request->width,
                'height'           => $request->height,
                'applicable_date'  => Carbon::createFromFormat('d/m/Y', $request->applicable_date)->format('Y-m-d') ?? null,

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

            if ($request->has('ledgers')) {
                $receipt_settings->main_ledgers()->attach($request->ledgers);
            }

            DB::commit();
            return redirect()->route("receipt_settings")->with("success", __('general.added_successfully'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("error", $th->getMessage());

        }
    }
    public function ReceiptUpdate(Request $request )
    {
        $request->validate([
            'name'            => 'required|string|max:255',
            'ledgers'         => 'required|array',
            'edit_result'          => 'required',
            'applicable_date' => 'required',
        ]);

        DB::beginTransaction();
        try {
            $receipt_settings = (new ReceiptSettings())->setConnection('tenant')->findOrFail($request->edit_receipt_settings_id);
            $receipt_settings->update([
                'name'             => $request->name,
                'prefix'           => $request->edit_prefix,
                'sufix'            => $request->edit_sufix,
                'starting_number'  => $request->edit_start_number,
                'prefix_with_zero' => $request->edit_prefix_with_zero,
                'total_digit'      => $request->edit_total_digit,
                'result'           => $request->edit_result,
                'receipt_with_logo'           => $request->edit_receipt_with_logo,
                'receipt_logo_position'           => $request->edit_receipt_logo_position,
                'receipt_format'           => $request->edit_receipt_format,
                'address_status'           => $request->edit_receipt_with_address,
                'balance_amount_status'           => $request->edit_receipt_with_balance_amount,
                'signature_status'           => $request->edit_receipt_with_signature,
                'width'           => $request->edit_width,
                'height'           => $request->edit_height,
                'applicable_date'  => Carbon::createFromFormat('d/m/Y', $request->applicable_date)->format('Y-m-d') ?? null,

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
            if ($request->has('ledgers')) {
                $receipt_settings->main_ledgers()->sync($request->ledgers);
            }

            DB::commit();
            return redirect()->route("receipt_settings")->with("success", __('general.updated_successfully'));
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->with("error", $th->getMessage());
        }     
    }

    public function edit($id)
    {
        $receipt_settings         = (new ReceiptSettings())->setConnection('tenant')->findOrFail($id);
        $main_ledgers          = DB::connection('tenant')->table('main_ledgers_receipt_settings')->where('receipt_settings_id' ,$id )->get();
        // dd($main_ledgers);
        if ($receipt_settings) {
            return response()->json([
                'status' => 200,
                "receipt_settings" => $receipt_settings,
                "main_ledgers" => $main_ledgers,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                "message" => "Receipt Settings Not Found",
            ]);
        }
    }

    public function delete(Request $request)
    {
        $receipt_settings         = (new ReceiptSettings())->setConnection('tenant')->findOrFail($request->id);
        $receipt_settings->delete();
        return to_route('receipt_settings')->with('success', __('general.deleted_successfully'));
    }

    public function invoiceIndex(){
        $invoice_prefix    = optional((new BusinessSetting())->setConnection('tenant')->whereType('invoice_prefix')->first())->value;
        $invoice_suffix    = optional((new BusinessSetting())->setConnection('tenant')->whereType('invoice_suffix')->first())->value ;
        $invoice_width    = optional((new BusinessSetting())->setConnection('tenant')->whereType('invoice_width')->first())->value ;
        $invoice_date_Data = optional((new BusinessSetting())->setConnection('tenant')->whereType('invoice_date')->first())->value  ;
        $invoice_start_number = optional((new BusinessSetting())->setConnection('tenant')->whereType('invoice_start_number')->first())->value  ;
        $invoice_name = optional((new BusinessSetting())->setConnection('tenant')->whereType('invoice_name')->first())->value  ;
        $invoice_with_logo = optional((new BusinessSetting())->setConnection('tenant')->whereType('invoice_with_logo')->first())->value  ;
        $invoice_logo_position = optional((new BusinessSetting())->setConnection('tenant')->whereType('invoice_logo_position')->first())->value  ;
        $ledger_id = optional((new BusinessSetting())->setConnection('tenant')->whereType('ledger_id')->first())->value  ;
        $invoice_date = ($invoice_date_Data != null) ? Carbon::createFromFormat('Y-m-d', $invoice_date_Data)->format('Y-m-d') : '';
        $ledgers = (new MainLedger())->setConnection('tenant')->whereNotNull('account_no')->get();
        $data = [
            "ledger_id"      => $ledger_id,
            "ledgers"      => $ledgers,
            "invoice_width"      => $invoice_width,
            "invoice_prefix"      => $invoice_prefix,
            "invoice_date"      => $invoice_date,
            "invoice_suffix"      => $invoice_suffix,
            "invoice_start_number"      => $invoice_start_number,
            "invoice_name"      => $invoice_name,
            "invoice_with_logo"      => $invoice_with_logo,
            "invoice_logo_position"      => $invoice_logo_position,
        ];
        return view('admin-views.transactions_settings.invoice_settings' ,$data);
    }
    public function invoiceUpdate(Request $request){

        (new BusinessSetting())->setConnection('tenant')->updateOrInsert(['type' => 'invoice_prefix'], [
            'value' => $request['invoice_prefix']
        ]);

        (new BusinessSetting())->setConnection('tenant')->updateOrInsert(['type' => 'invoice_suffix'], [
            'value' => $request['invoice_suffix']
        ]);

        (new BusinessSetting())->setConnection('tenant')->updateOrInsert(['type' => 'invoice_width'], [
            'value' => $request['invoice_width']
        ]);
        (new BusinessSetting())->setConnection('tenant')->updateOrInsert(['type' => 'invoice_start_number'], [
            'value' => $request['invoice_start_number']
        ]);
        (new BusinessSetting())->setConnection('tenant')->updateOrInsert(['type' => 'invoice_name'], [
            'value' => $request['invoice_name']
        ]);
        (new BusinessSetting())->setConnection('tenant')->updateOrInsert(['type' => 'invoice_with_logo'], [
            'value' => $request['invoice_with_logo']
        ]);
        (new BusinessSetting())->setConnection('tenant')->updateOrInsert(['type' => 'invoice_logo_position'], [
            'value' => $request['invoice_logo_position']
        ]);
        (new BusinessSetting())->setConnection('tenant')->updateOrInsert(['type' => 'ledger_id'], [
            'value' => $request['ledger_id']
        ]);
        if($request['invoice_date']){ $start_date = Carbon::createFromFormat('d/m/Y',$request['invoice_date'])->format('Y-m-d'); }

        (new BusinessSetting())->setConnection('tenant')->updateOrInsert(['type' => 'invoice_date'], [
            'value' => $start_date
        ]);
        return redirect()->back()->with('success',__('property_transactions.setting_updated'));
    }

}
