<?php
namespace App\Http\Controllers\facility_master;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Company;
use App\Models\WarrantyType;
use Illuminate\Http\Request;
use App\Models\facility\Asset;
use App\Models\general\Groups;
use App\Models\UnitManagement;
use App\Models\MaintenanceType;
use App\Models\facility\Supplier;
use App\Models\PropertyManagement;
use Illuminate\Support\Facades\DB;
use App\Models\facility\AssetGroup;
use App\Http\Controllers\Controller;
use App\Models\facility\AmcProvider;
use App\Models\hierarchy\MainLedger;
use App\Models\property_master\AssetSchedule;

class AssetController extends Controller
{
    public function index(Request $request)
    {

        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';

        $assets = (new Asset())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('currency_name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->with('main_asset_group', 'main_supplier')->latest()->paginate()->appends($query_param);

        if (isset($search) && empty($search)) {
            $assets = (new Asset())->setConnection('tenant')->orderBy('created_at', 'asc')->with('main_asset_group', 'main_supplier')
                ->paginate(10);
        }
        $unit_management   = (new UnitManagement())->setConnection('tenant')->with(['property_unit_management', 'block_unit_management', 'block_unit_management.block',
            'floor_unit_management', 'floor_unit_management.floor_management_main', 'unit_management_main', 'unit_description'])
            ->select('property_management_id', 'id', 'unit_id', 'floor_management_id', 'block_management_id')->get();
        $data = [
            'assets' => $assets,
            'search' => $search,
            'unit_management' => $unit_management,

        ];

        return view('admin-views.facility_master.assets.index', $data);
    }

    public function create()
    {
        $suppliers         = (new Supplier())->setConnection('tenant')->get();
        $asset_groups      = (new AssetGroup())->setConnection('tenant')->get();
        $amc               = (new AmcProvider())->setConnection('tenant')->get();
        $maintenance_types = (new MaintenanceType())->setConnection('tenant')->get();
        $warranty_types    = (new WarrantyType())->setConnection('tenant')->get();
        $all_building      = (new PropertyManagement())->setConnection('tenant')->select('id', 'name')->get();
        $unit_management   = (new UnitManagement())->setConnection('tenant')->with(['property_unit_management', 'block_unit_management', 'block_unit_management.block',
            'floor_unit_management', 'floor_unit_management.floor_management_main', 'unit_management_main', 'unit_description'])
            ->select('property_management_id', 'id', 'unit_id', 'floor_management_id', 'block_management_id')->get();

        $data = [
            'amc'               => $amc,
            'suppliers'         => $suppliers,
            'all_building'      => $all_building,
            'unit_management'   => $unit_management,
            'asset_groups'      => $asset_groups,
            'maintenance_types' => $maintenance_types,
            'warranty_types'    => $warranty_types,
        ];
        return view('admin-views.facility_master.assets.create', $data);
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'                     => 'required|string|max:255',
            'code'                     => 'required|array',
            'code.*'                   => 'required|string|max:50',
            'report_unit_management'   => 'required|array',
            'report_unit_management.*' => 'required|string|max:50',
            'report_building'          => 'required|array',
            'report_building.*'        => 'required|string|max:50',
            'supplier_id'              => 'required|exists:suppliers,id',
            'asset_group_id'           => 'required|exists:asset_groups,id',
            'amc_ref'                  => 'nullable|string|max:100',
            'warranty_provider'        => 'nullable|string|max:255',
            'warranty_type'            => 'nullable|string|max:100',
            'maintenance_type'         => 'nullable|string|max:100',
            'amc_maintenance_type'     => 'nullable|string|max:100',
            'amc_warranty_type'        => 'nullable|string|max:100',
            'amc_amount'               => 'nullable|numeric|min:0',
            'amc_provider'             => 'nullable|string|max:255',
            'status'                   => 'required|in:active,inactive',
            'invoice_number'           => 'nullable|string|max:50',
            'serial_number'            => 'nullable|array',
            'serial_number.*'          => 'nullable|string|max:50',
            'company_id'               => 'nullable|exists:users,id',
            'warranty'                 => 'nullable|string|max:100',
            'amc'                      => 'nullable|string|max:100',
            'qyt'                      => 'nullable|integer|min:1',
        ]);
        DB::beginTransaction();
        try {
            $validatedData['from']            = $request->from ? Carbon::createFromFormat('d/m/Y', $request->from)->format('Y-m-d') : null;
            $validatedData['to']              = $request->to ? Carbon::createFromFormat('d/m/Y', $request->to)->format('Y-m-d') : null;
            $validatedData['purchase_date']   = $request->purchase_date ? Carbon::createFromFormat('d/m/Y', $request->purchase_date)->format('Y-m-d') : null;
            $validatedData['warranty_expiry'] = $request->warranty_expiry ? Carbon::createFromFormat('d/m/Y', $request->warranty_expiry)->format('Y-m-d') : null;
            $company  = (new Company())->setConnection('tenant')->first();
            $asset_group                      = (new AssetGroup())->setConnection('tenant')->where('id', $request->asset_group_id)->first();
            for ($i = 0; $i < ($validatedData['qyt'] ?? 1); $i++) {
                $asset = (new Asset())->setConnection('tenant')->create([
                    'name'                   => $validatedData['name'],
                    'code'                   => $validatedData['code'][$i] ?? null,
                    'property_management_id' => $validatedData['report_building'][$i] ?? null,
                    'unit_management_id'     => $validatedData['report_unit_management'][$i] ?? null,
                    'supplier_id'            => $validatedData['supplier_id'],
                    'asset_group_id'         => $validatedData['asset_group_id'],
                    'purchase_date'          => $validatedData['purchase_date'],
                    'amc_ref'                => $validatedData['amc_ref'],
                    'warranty_expiry'        => $validatedData['warranty_expiry'] ?? null,
                    'from'                   => $validatedData['from'] ?? null,
                    'to'                     => $validatedData['to'] ?? null,
                    'warranty_provider'      => $validatedData['warranty_provider'] ?? null,
                    'warranty_type'          => $validatedData['warranty_type'] ?? null,
                    'maintenance_type'       => $validatedData['maintenance_type'] ?? null,
                    'amc_maintenance_type'   => $validatedData['amc_maintenance_type'] ?? null,
                    'amc_warranty_type'      => $validatedData['amc_warranty_type'] ?? null,
                    'amc_amount'             => $validatedData['amc_amount'] ?? null,
                    'amc_provider'           => $validatedData['amc_provider'] ?? null,
                    'status'                 => $validatedData['status'],
                    'invoice_number'         => $validatedData['invoice_number'] ?? null,
                    'serial_number'          => $validatedData['serial_number'][$i] ?? null,
                    'company_id'             => $company->id,
                    'warranty'               => $validatedData['warranty'] ?? null,
                    'amc'                    => $validatedData['amc'] ?? null,
                    'created_at'             => now(),
                    'updated_at'             => now(),
                ]);
                $group = (new Groups())->setConnection('tenant')->where('name', 'LIKE', "%{$asset_group->name}%")->first();
                $this->schedule($validatedData['from'], $validatedData['to'], $validatedData['amc_warranty_type'], $validatedData['amc_provider'] , $asset->id);
                if ($group) {
                    $ledger = (new MainLedger())->setConnection('tenant')->create([
                        'code'                => $asset->code,
                        'name'                => $validatedData['serial_number'][$i],
                        // 'name'                => $asset->name . '-' .$validatedData['serial_number'][$i] ,
                        'currency'            => $company->currency_code,
                        'country_id'          => $company->countryid,
                        'group_id'            => $group->id,
                        'is_taxable'          => $group->is_taxable ?: 0,
                        'vat_applicable_from' => $group->vat_applicable_from ?? null,
                        'tax_rate'            => $group->tax_rate ?: 0,
                        'tax_applicable'      => $group->tax_applicable ?: 0,
                        'status'              => 'active',
                        'main_type'           => 'asset',
                        'main_id'             => $asset->id,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('asset.index')->with('success', __('property_master.added_successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with("error", $e->getMessage());
        }

    }

    public function edit($id)
    {
        $asset             = (new Asset())->setConnection('tenant')->findOrFail($id);
        $suppliers         = (new Supplier())->setConnection('tenant')->get();
        $amc               = (new AmcProvider())->setConnection('tenant')->get();
        $asset_groups      = (new AssetGroup())->setConnection('tenant')->get();
        $maintenance_types = (new MaintenanceType())->setConnection('tenant')->get();
        $warranty_types    = (new WarrantyType())->setConnection('tenant')->get();
        $all_building      = (new PropertyManagement())->setConnection('tenant')->select('id', 'name')->get();
        $unit_management   = (new UnitManagement())->setConnection('tenant')->with(['property_unit_management', 'block_unit_management', 'block_unit_management.block',
            'floor_unit_management', 'floor_unit_management.floor_management_main', 'unit_management_main', 'unit_description'])
            ->select('property_management_id', 'id', 'unit_id', 'floor_management_id', 'block_management_id')->get();
        $data = [
            'amc'               => $amc,
            'asset'             => $asset,
            'all_building'      => $all_building,
            'unit_management'   => $unit_management,
            'suppliers'         => $suppliers,
            'asset_groups'      => $asset_groups,
            'maintenance_types' => $maintenance_types,
            'warranty_types'    => $warranty_types,
        ];
        return view('admin-views.facility_master.assets.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            $asset         = (new Asset())->setConnection('tenant')->findOrFail($id);
            $validatedData = $request->validate([
                'name'                   => 'required|string|max:255',
                'code'                   => 'required|string|max:50|unique:assets,code,' . $asset->id,
                'unit_management_id'     => 'nullable',
                'property_management_id' => 'nullable',
                'invoice_number'         => 'nullable|string|max:50',
                'serial_number'          => 'nullable|string|max:50|unique:assets,serial_number,' . $asset->id,
                'supplier_id'            => 'required|exists:suppliers,id',
                'asset_group_id'         => 'required|exists:asset_groups,id',
                'purchase_date'          => 'required',
                'amc_ref'                => 'nullable|string|max:100',
                'warranty_expiry'        => 'nullable',
                'from'                   => 'nullable',
                'to'                     => 'nullable|after_or_equal:from',
                'warranty_provider'      => 'nullable|string|max:255',
                'warranty'               => 'nullable|string|max:255',
                'amc'                    => 'nullable|string|max:255',
                'warranty_type'          => 'nullable|string|max:100',
                'maintenance_type'       => 'nullable|string|max:100',
                'amc_maintenance_type'   => 'nullable|string|max:100',
                'amc_warranty_type'      => 'nullable|string|max:100',
                'amc_amount'             => 'nullable|numeric|min:0',
                'amc_provider'           => 'nullable|string|max:255',
                'status'                 => 'required|in:active,inactive',
            ]);

            $validatedData['from']            = $request->from ? Carbon::createFromFormat('d/m/Y', $request->from)->format('Y-m-d') : null;
            $validatedData['to']              = $request->to ? Carbon::createFromFormat('d/m/Y', $request->to)->format('Y-m-d') : null;
            $validatedData['purchase_date']   = $request->purchase_date ? Carbon::createFromFormat('d/m/Y', $request->purchase_date)->format('Y-m-d') : null;
            $validatedData['warranty_expiry'] = $request->warranty_expiry ? Carbon::createFromFormat('d/m/Y', $request->warranty_expiry)->format('Y-m-d') : null;

            $asset->update($validatedData);

            return redirect()->route('asset.index')->with('success', __('property_master.updated_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        $asset  = (new Asset())->setConnection('tenant')->findOrFail($request->id);
        $ledger = (new MainLedger())->setConnection('tenant')->where('main_type', 'asset')->where('main_id', $request->id)->first()->delete();
        (new AssetSchedule())->setConnection('tenant')->where('asset_id', $request->id)->delete();
        $asset->delete();
        return redirect()->back()->with('success', __('country.deleted_successfully'));
    }
    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_product');
        $main = (new Asset())->setConnection('tenant')->findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success', __('property_master.updated_successfully'));
    }
    public function schedule($from, $to, $amc_warranty_type, $amc_id , $asset_id)
    {
        $start_date         = Carbon::parse($from);
        $end_date           = Carbon::parse($to);
        $warranty_intervals = [
            1 => ['type' => 'days', 'value' => 1],
            2 => ['type' => 'weeks', 'value' => 1],
            3 => ['type' => 'months', 'value' => 1],
            4 => ['type' => 'months', 'value' => 3],
            5 => ['type' => 'months', 'value' => 6],
            6 => ['type' => 'years', 'value' => 1],
        ];

        $interval = $warranty_intervals[$amc_warranty_type] ?? ['type' => 'months', 'value' => 1];

        $rent_intervals = [];

        while ($start_date <= $end_date) {
            $rent_intervals[] = [
                'amc_id' => $amc_id,
                'asset_id' => $asset_id,
                'status' => 'no',
                'date'   => $start_date->copy(),
            ];
            $start_date->add($interval['type'], $interval['value']);
            if ($interval['type'] === 'months' || $interval['type'] === 'years') {
                $start_date->startOfMonth();
            }
        }
        if ($start_date->diffInDays($end_date) > 0) {
            $rent_intervals[] = [
                'amc_id' => $amc_id,
                'asset_id' => $asset_id,
                'status' => 'no',
                'date'   => $start_date,
            ];
        }
        DB::connection('tenant')->table('asset_schedules')->insert($rent_intervals);
    }
    public function schedule_list($id){ 
        $schedules = (new AssetSchedule())->setConnection('tenant')->where('asset_id' , $id)->select('id' , 'amc_id' , 'status' ,'date' , 'asset_id')
        ->with('asset' , 'amc')
        ->orderBy('date', 'asc')
        ->paginate();
        $data = [
            'schedules'             => $schedules,
        ];
        return view('admin-views.facility_master.assets.schedules_list', $data);

    }
    // public function schedule($from , $to ,$amc_warranty_type , $amc_id)
    // {

    //     $start_date = Carbon::parse($from);
    //     $end_date   = Carbon::parse($to);
    //     $warranty_intervals = [
    //         1 => 1,
    //         2 => 1,
    //         3 => 2,
    //         4 => 3,
    //         5 => 6,
    //         6 => 12,
    //     ];

    //     $interval = $warranty_intervals[$amc_warranty_type] ?? 1;

    //     while ($start_date <= $end_date) {
    //         $rent_intervals[] = [
    //             'amc_id' => $amc_id,
    //             'status' => 'no',
    //             'date'   => $start_date->copy(),
    //         ];

    //         if ($amc_warranty_type == 1) {
    //             $start_date->addDay();
    //         } else {
    //             $start_date->addMonths($interval)->startOfMonth();
    //         }
    //     }

    //     if ($start_date->diffInDays($end_date) > 0) {
    //         $rent_intervals[] = [
    //             'amc_id' => $amc_id,
    //             'status' => 'no',
    //             'date'   => $start_date,
    //         ];
    //     }

    //     DB::table('asset_schedules')->insert($rent_intervals);
    // }
}
// public function store(Request $request)
// {
//     DB::beginTransaction();
//     try {

//         $validatedData = $request->validate([
//             'name'                 => 'required|string|max:255',
//             'code'            => 'required|array',
//             'code.*'          => 'required|string|max:50',

//             'invoice_number'  => 'nullable|string|max:50|unique:assets,invoice_number',

//             'serial_number'   => 'nullable|array',
//             'serial_number.*' => 'nullable|string|max:50',
//             'supplier_id'          => 'required|exists:suppliers,id',
//             'asset_group_id'       => 'required|exists:asset_groups,id',
//             'purchase_date'        => 'required',
//             'amc_ref'              => 'nullable|string|max:100',
//             'warranty_expiry'      => 'nullable',
//             'from'                 => 'nullable',
//             'warranty'             => 'nullable|string|max:255',
//             'amc'                  => 'nullable|string|max:255',
//             'to'                   => 'nullable|after_or_equal:from',
//             'warranty_provider'    => 'nullable|string|max:255',
//             'warranty_type'        => 'nullable|string|max:100',
//             'maintenance_type'     => 'nullable|string|max:100',
//             'amc_maintenance_type' => 'nullable|string|max:100',
//             'amc_warranty_type'    => 'nullable|string|max:100',
//             'amc_amount'           => 'nullable|numeric|min:0',
//             'amc_provider'         => 'nullable|string|max:255',
//             'status'               => 'required|in:active,inactive',
//         ]);

//         $validatedData['from']            = $request->from ? Carbon::createFromFormat('d/m/Y', $request->from)->format('Y-m-d') : null;
//         $validatedData['to']              = $request->to ? Carbon::createFromFormat('d/m/Y', $request->to)->format('Y-m-d') : null;
//         $validatedData['purchase_date']   = $request->purchase_date ? Carbon::createFromFormat('d/m/Y', $request->purchase_date)->format('Y-m-d') : null;
//         $validatedData['warranty_expiry'] = $request->warranty_expiry ? Carbon::createFromFormat('d/m/Y', $request->warranty_expiry)->format('Y-m-d') : null;
//         foreach($request->qyt as $qyt_item){
//             $asset = (new Asset())->setConnection('tenant')->create([

//             ]);
//         }

//         $company = auth()->user() ?? User::first();
//         $asset_group   = AssetGroup::where('id',  $request->asset_group_id )->first();
//         $group   = Groups::where('name', 'LIKE' , "%{$asset_group->name}%")->first();
//         if($group){
//             $ledger = MainLedger::create([
//                 'code'                => $asset->code,
//                 'name'                => $asset->name,
//                 'currency'            => $company->currency_code,
//                 'country_id'          => $company->countryid,
//                 'group_id'            => $group->id,
//                 'is_taxable'          => $group->is_taxable ?: 0,
//                 'vat_applicable_from' => $group->vat_applicable_from ?? null,
//                 'tax_rate'            => $group->tax_rate ?: 0,
//                 'tax_applicable'      => $group->tax_applicable ?: 0,
//                 'status'              => 'active',
//             ]);
//         }

//         DB::commit();
//         return redirect()->route('asset.index')->with('success', __('property_master.added_successfully'));
//     } catch (\Exception $e) {
//         DB::rollBack();
//         return redirect()->back()->with("error", $e->getMessage());
//     }
//     // SQLSTATE[42S02]: Base table or view not found: 1146 Table &#039;finexerp.asset&#039; doesn&#039;t exist (Connection: mysql, SQL: select count(*) as aggregate from `asset` where `code` = 001)
// }
