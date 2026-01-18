<?php
namespace App\Http\Controllers\Investment;

use Throwable;
use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Block;
use App\Models\Floor;
use App\Models\Company;
use App\Models\Investor;
use App\Models\Ownership;
use App\Models\Investment;
use Illuminate\Http\Request;
use App\Models\CountryMaster;
use App\Models\general\Groups;
use App\Models\UnitManagement;
use App\Models\BlockManagement;
use App\Models\FloorManagement;
use App\Models\PropertyManagement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\hierarchy\CostCenter;
use App\Models\hierarchy\MainLedger;
use App\Models\hierarchy\CostCenterCategory;

class InvestmentController extends Controller
{
    public function investments_list(Request $request)
    {

        // $this->authorize('agreement');
        $ids = $request->bulk_ids;

        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $investments = Investment::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('investment_no', 'like', "%{$value}%")
                ->orWhere('name', 'like', "%{$value}%")->orWhere('company_name', 'like', "%{$value}%") ;
            }
        })->latest()->orderBy('created_at', 'asc')->paginate()->appends($query_param);
        $data = [
            'investments' => $investments,
            'search'      => $search,
        ];
        return view("admin-views.investments.investment_list", $data);
    }

    public function create()
    { 
        $country_master           = CountryMaster::get();
        $live_withs               = DB::table('live_withs')->get();
        $business_activities      = DB::table('business_activities')->get(); 
        $unit_descriptions        = DB::table('unit_descriptions')->get();
        $unit_conditions          = DB::table('unit_conditions')->get();
        $unit_types               = DB::table('unit_types')->get();
        $views                    = DB::table('views')->get();
        $property_types           = DB::table('property_types')->get();
        // newest 

        $investors = Investor::select('id', 'name' , 'company_name' ,'type')->get(); 
        $buildings = PropertyManagement::forUser()->select('id', 'name' , 'code' , 'property_type_id')
        ->with('units_managment')->get();
        // ->with('blocks_management_child' , 'blocks_management_child.block' , 'blocks_management_child.floors_management_child'
        //  ,'blocks_management_child.floors_management_child.floor_management_main',
        //  'blocks_management_child.floors_management_child.floor_management_main.unit_management_child',
        //  'blocks_management_child.floors_management_child.floor_management_main.unit_management_child.')->get();
        $data = [
            'unit_types'               => $unit_types,
            'property_types'           => $property_types,
            'views'                    => $views,
            'unit_conditions'          => $unit_conditions,
            'unit_descriptions'        => $unit_descriptions, 
            'country_master'           => $country_master,
            'live_withs'               => $live_withs,
            'business_activities'      => $business_activities, 
            'investors'                 => $investors, 
            'buildings'                 => $buildings, 
        ];
        return view('admin-views.investments.create', $data);
    }

    public function store(Request $request)
    {
        // Validation based on investor type
        if ($request->investor_type == 'individual') {
            $request->validate([
                'gender'         => 'required|string|max:10',
                'nationality_id' => 'required|integer',
            ]);
        } elseif ($request->investor_type == 'company') {
            $request->validate([
                'company_name'         => 'required|string|max:255',
                'business_activity_id' => 'required|integer',
                'contact_person'       => 'required|string|max:255',
            ]);
        }

        // General Validation
        $request->validate([
            'name'                  => 'required|string|max:255',
            'investment_no'         => 'required|unique:investments,investment_no',
            'investment_date'       => 'required',
            'country_id'            => 'required|integer',
            'total_no_of_units'     => 'required',
            'total_no_of_buildings' => 'nullable',
            'type'                  => 'nullable|string|max:255',
            'id_number'             => 'nullable|string|max:255',
            'registration_no'       => 'nullable|string|max:255',
            'nick_name'             => 'nullable|string|max:255',
            'group_company_name'    => 'nullable|string|max:255',
            'designation'           => 'nullable|string|max:255',
            'contact_no'            => 'nullable|string|max:255',
            'whatsapp_no'           => 'nullable|string|max:255',
            'fax_no'                => 'nullable|string|max:255',
            'telephone_no'          => 'nullable|string|max:255',
            'other_contact_no'      => 'nullable|string|max:255',
            'address1'              => 'nullable|string|max:255',
            'address2'              => 'nullable|string|max:255',
            'address3'              => 'nullable|string|max:255',
            'state'                 => 'nullable|string|max:255',
            'city'                  => 'nullable|string|max:255',
            'passport_no'           => 'nullable|string|max:255',
            'email1'                => 'nullable|string|max:255',
            'email2'                => 'nullable|string|max:255',
        ]);
        DB::beginTransaction();
        try {
                $investment_date = Carbon::createFromFormat('d/m/Y', $request->investment_date)->format('Y-m-d');
                $period_from = Carbon::createFromFormat('d/m/Y', $request->period_from)->format('Y-m-d');
                $period_to = Carbon::createFromFormat('d/m/Y', $request->period_to)->format('Y-m-d');

            $investment = Investment::create([
                'investment_no'         => $request->investment_no,
                'total_no_of_units'     => $request->total_no_of_units, 
                'investment_date'       => $investment_date,
                'period_from'       => $period_from,
                'period_to'       => $period_to,
                'name'                  => $request->name,
                'type'                  => $request->investor_type,
                'gender'                => $request->gender,
                'id_number'             => $request->id_number,
                'registration_no'       => $request->registration_no,
                'nick_name'             => $request->nick_name,
                'group_company_name'    => $request->group_company_name,
                'contact_person'        => $request->contact_person,
                'designation'           => $request->designation,
                'contact_no'            => $request->contact_no,
                'whatsapp_no'           => $request->whatsapp_no,
                'company_name'          => $request->company_name,
                'fax_no'                => $request->fax_no,
                'telephone_no'          => $request->telephone_no,
                'other_contact_no'      => $request->other_contact_no,
                'address1'              => $request->address1,
                'address2'              => $request->address2,
                'address3'              => $request->address3,
                'state'                 => $request->state,
                'city'                  => $request->city,
                'country_id'            => $request->country_id,
                'nationality_id'        => $request->nationality_id,
                'passport_no'           => $request->passport_no,
                'email1'                => $request->email1,
                'email2'                => $request->email2,
                'live_with_id'          => $request->live_with_id,
                'business_activity_id'  => $request->business_activity_id,
            ]);
            $owner_ship = Ownership::where('name', 'LIKE', '%Manag')->first();
            if (! $owner_ship) {
                $owner_ship = Ownership::create([
                    'name' => 'Managed',
                    'code' => '00005',
                ]);
            }
            // add property
            $property_management = PropertyManagement::create([
                'name'              => $request->input('property_name'),
                'code'              => $request->input('investment_no'),
                'investment_id'     => $investment->id,
                'ownership_id'      => $owner_ship->id,
                'description'       => $request->description,
                'country_master_id' => $request->input('country_id'),
                'status'            => 'active',
            ]);

            // add group for building
            $master_group = Groups::where('id', 48)->first();

            $group = Groups::create([
                'code'                     => $request->input('investment_no'),
                'property_id'              => $property_management->id,
                'name'                     => $request->input('property_name'),
                'display_name'             => $request->input('property_name'),
                'group_id'                 => $master_group->id,
                'is_projects_parent_group' => $master_group->is_projects_parent_group ?: 0,
                'enable_auto_code'         => $master_group->enable_auto_code ?: 0,
                'status'                   => 'active',
                'tax_applicable'           => $master_group->tax_applicable ?: 0,
                'is_taxable'               => $master_group->is_taxable ?: 0,
                'vat_applicable_from'      => $master_group->vat_applicable_from ?? null,
                'tax_rate'                 => $master_group->tax_rate ?: 0,
            ]);
            $cost_center = CostCenterCategory::create([
                'code'      => $request->input('investment_no'),
                'name'      => $request->input('property_name'),
                'main_id'   => $property_management->id,
                'main_type' => 'property',
                'status'    => 'active',
            ]);
            if ($property_management) {
                $property_management->property_types()->sync($request->property_type_id);
            }
            $company = Company::select('id', 'currency_code')->first();
            // Block Management , Floor Managment , UnitManagment
            $totalUnits = (int) $request->total_no_of_units;
            $group      = Groups::where('property_id', $property_management->id)->first();
            $property   = CostCenterCategory::where('main_id', $property_management->id)->where('main_type', 'property')->first();

            for ($i = 1; $i <= $totalUnits; $i++) {

                $block_name = $request->input("block_name-$i");
                $floor_name = $request->input("floor_name-$i");
                $unit_name  = $request->input("unit_name-$i");

                if (! $block_name || ! $floor_name || ! $unit_name) {
                    continue; // skip empty row
                }

                // --------- CREATE BLOCK ---------

                $blockName = Block::firstOrCreate([
                    'name' => $block_name,
                ]);

                $block = BlockManagement::firstOrCreate([
                    'block_id'               => $blockName->id,
                    'property_management_id' => $property_management->id,
                ]);

                // --------- CREATE FLOOR ---------
                $floorName = Floor::firstOrCreate([
                    'name' => $floor_name,
                ]);

                $floor = FloorManagement::firstOrCreate([
                    'floor_id'               => $floorName->id,
                    'block_management_id'    => $block->id,
                    'property_management_id' => $property_management->id,
                ]);

                $unitName = Unit::firstOrCreate([
                    'name' => $unit_name,
                ]);
                // --------- CREATE UNIT ---------
                $unit_management = UnitManagement::create([
                    'property_management_id'         => $property_management->id,
                    'block_management_id'            => $block->id,
                    'floor_management_id'            => $floor->id,
                    'unit_id'                => $unitName->id,
                    'investment'          => 1,
                    'return'                => $request->input("return-$i"),
                    'return_mode'         => $request->input("return_mode-$i"),
                    'unit_type_id'        => $request->input("unit_type_id-$i") ?: null,
                    'unit_description_id' => $request->input("unit_description_id-$i") ?: null,
                    'unit_condition_id'   => $request->input("unit_condition_id-$i") ?: null,
                    'status'              => 'active',
                ]);

                $ledger = MainLedger::create([
                    'code'                => $request->investment_no,
                    'name'                => $unit_management->property_unit_management->name . '-' . $unit_management->block_unit_management->block->name . '-' .
                    $unit_management->floor_unit_management->floor_management_main->name . '-' . $unit_management->unit_management_main->name,
                    'currency'            => $company->currency_code,
                    'country_id'          => $unit_management->property_unit_management?->country_master?->country?->id,
                    'group_id'            => $group->id,
                    'main_id'             => $unit_management->id,
                    'is_taxable'          => $group->is_taxable ?: 0,
                    'vat_applicable_from' => $group->vat_applicable_from ?? null,
                    'tax_rate'            => $group->tax_rate ?: 0,
                    'tax_applicable'      => $group->tax_applicable ?: 0,
                    'status'              => 'active',
                ]);
                $unit_cost = CostCenter::create([

                    'name'                    => $unit_management->property_unit_management->name .
                    '-' .
                    $unit_management->unit_management_main->name .
                    '-' .
                    $unit_management->block_unit_management->block->name .
                    '-' .
                    $unit_management->floor_unit_management->floor_management_main->name . '-' . $unit_management->unit_management_main->name,
                    'main_id'                 => $unit_management->id,
                    'main_type'               => 'unit',
                    'cost_center_category_id' => $property->id,
                    'status'                  => 'active',
                ]);

            }
            DB::commit();
            return redirect()->route('investment.index')->with('success', ui_change('Investment_created_successfully!', 'investment'));

        } catch (Throwable $th) {

            DB::rollback();
            return redirect()->back()->with('error', 'Error: ' . $th->getMessage())->withInput();
        }
    }

    public function update(Request $request, $id)
{
    $investment = Investment::findOrFail($id);

    // Validation based on investor type
    if ($request->investor_type == 'individual') {
        $request->validate([
            'gender'         => 'required|string|max:10',
            'nationality_id' => 'required|integer',
        ]);
    } elseif ($request->investor_type == 'company') {
        $request->validate([
            'company_name'         => 'required|string|max:255',
            'business_activity_id' => 'required|integer',
            'contact_person'       => 'required|string|max:255',
        ]);
    }

    // General validation
    $request->validate([
        'name'              => 'required|string|max:255',
        'investment_no'     => 'required|unique:investments,investment_no,' . $investment->id,
        'investment_date'   => 'required',
        'country_id'        => 'required|integer',
        'total_no_of_units' => 'required',
    ]);

    DB::beginTransaction();
    try {

        $investment_date = Carbon::createFromFormat('d/m/Y', $request->investment_date)->format('Y-m-d');
        $period_from     = Carbon::createFromFormat('d/m/Y', $request->period_from)->format('Y-m-d');
        $period_to       = Carbon::createFromFormat('d/m/Y', $request->period_to)->format('Y-m-d');

        // -------------------- UPDATE INVESTMENT --------------------
        $investment->update([
            'investment_no'        => $request->investment_no,
            'total_no_of_units'    => $request->total_no_of_units,
            'investment_date'      => $investment_date,
            'period_from'          => $period_from,
            'period_to'            => $period_to,
            'name'                 => $request->name,
            'type'                 => $request->investor_type,
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

        // -------------------- UPDATE PROPERTY --------------------
        $property = PropertyManagement::where('investment_id', $investment->id)->first();

        if ($property) {
            $property->update([
                'name'              => $request->property_name,
                'code'              => $request->investment_no,
                'description'       => $request->description,
                'country_master_id' => $request->country_id,
            ]);
        }

        // Update property types
        if ($property) {
            $property->property_types()->sync($request->property_type_id);
        }

        // -------------------- UPDATE GROUP --------------------
        $group = Groups::where('property_id', $property->id)->first();
        if ($group) {
            $group->update([
                'code'         => $request->investment_no,
                'name'         => $request->property_name,
                'display_name' => $request->property_name,
            ]);
        }

        // -------------------- UPDATE UNITS --------------------
        $totalUnits = (int) $request->total_no_of_units;

        for ($i = 1; $i <= $totalUnits; $i++) {

            $block_name = $request->input("block_name-$i");
            $floor_name = $request->input("floor_name-$i");
            $unit_name  = $request->input("unit_name-$i");
            $unit_id    = $request->input("unit_id-$i"); // <--- مهم

            if (! $block_name || ! $floor_name || ! $unit_name) {
                continue;
            }

            // CREATE OR UPDATE BLOCK / FLOOR / UNIT
            $blockName = Block::firstOrCreate(['name' => $block_name]);
            $floorName = Floor::firstOrCreate(['name' => $floor_name]);
            $unitName  = Unit::firstOrCreate(['name' => $unit_name]);

            if ($unit_id) {
                // UPDATE UNIT EXISTING
                $unit_management = UnitManagement::find($unit_id);
                if ($unit_management) {
                    $unit_management->update([
                        'block_management_id' => BlockManagement::firstOrCreate([
                            'block_id'               => $blockName->id,
                            'property_management_id' => $property->id,
                        ])->id,
                        'floor_management_id' => FloorManagement::firstOrCreate([
                            'floor_id'               => $floorName->id,
                            'property_management_id' => $property->id,
                            'block_management_id'    => BlockManagement::where('block_id', $blockName->id)
                                ->where('property_management_id', $property->id)->first()->id,
                        ])->id,
                        'unit_id'             => $unitName->id,
                        'return'              => $request->input("return-$i"),
                        'return_mode'         => $request->input("return_mode-$i"),
                        'unit_type_id'        => $request->input("unit_type_id-$i"),
                        'unit_description_id' => $request->input("unit_description_id-$i"),
                        'unit_condition_id'   => $request->input("unit_condition_id-$i"),
                    ]);
                }
            } else {
                // NEW UNIT
                UnitManagement::create([
                    'property_management_id' => $property->id,
                    'block_management_id'    => BlockManagement::firstOrCreate([
                        'block_id'               => $blockName->id,
                        'property_management_id' => $property->id,
                    ])->id,
                    'floor_management_id' => FloorManagement::firstOrCreate([
                        'floor_id'               => $floorName->id,
                        'property_management_id' => $property->id,
                        'block_management_id'    => BlockManagement::where('block_id', $blockName->id)
                            ->where('property_management_id', $property->id)->first()->id,
                    ])->id,
                    'unit_id'             => $unitName->id,
                    'investment'          => 1,
                    'return'              => $request->input("return-$i"),
                    'return_mode'         => $request->input("return_mode-$i"),
                    'unit_type_id'        => $request->input("unit_type_id-$i"),
                    'unit_description_id' => $request->input("unit_description_id-$i"),
                    'unit_condition_id'   => $request->input("unit_condition_id-$i"),
                    'status'              => 'active',
                ]);
            }
        }

        DB::commit();
        return redirect()->route('investment.index')->with('success', 'Investment updated successfully!');

    } catch (Throwable $th) {

        DB::rollback();
        return redirect()->back()->with('error', $th->getMessage())->withInput();
    }
}

}
