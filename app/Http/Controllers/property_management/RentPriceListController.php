<?php
namespace App\Http\Controllers\property_management;

use App\Http\Controllers\Controller;
use App\Models\BlockManagement;
use App\Models\FloorManagement;
use App\Models\PropertyManagement;
use App\Models\property_management\RentPriceList;
use App\Models\UnitManagement;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RentPriceListController extends Controller
{
    public function index(Request $request)
    {
        // $this->authorize('unit_management');
        $ids = $request->bulk_ids;
        // $lastRun = Cache::get('last_enquiry_expiry_run');
        // if (!$lastRun || now()->diffInHours($lastRun) >= 24) {
        //     $enquiry_settings = get_business_settings('enquiry')->where('type', 'enquiry_expire_date')->first();
        //     $expiry_days = $enquiry_settings ? (int) $enquiry_settings->value : 0;

        //     if ($expiry_days > 0) {
        //         $this->expire_unit($expiry_days);
        //         Cache::put('last_enquiry_expiry_run', now(), now()->addDay());
        //     }
        // }

        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';

        $rent_price_list = (new RentPriceList())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('enquiry_no', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })->with('unit_management:id,unit_id,property_management_id,block_management_id,floor_management_id', 'unit_management.unit_management_main:id,name,code'
            , 'unit_management.property_unit_management:id,name,code', 'unit_management.block_unit_management:id,block_id',
            'unit_management.block_unit_management.block:id,name,code', 'unit_management.floor_unit_management.floor_management_main:id,name,code', 'unit_management.floor_unit_management:id,floor_id'
        )
            ->latest()
            ->orderBy('created_at', 'desc')
            ->paginate()
            ->appends($query_param);

        // if ($request->bulk_action_btn === 'filter') {
        //     $data         = ['status' => 1];
        //     $report_query = (new RentPriceList())->setConnection('tenant')->query();

        //     if ($request->booking_status && $request->booking_status != -1) {
        //         $report_query->where('booking_status', $request->booking_status);
        //     }

        //     if ($request->enquiry_request_status && $request->enquiry_request_status != -1) {
        //         $report_query->whereHas('enquiry_details.enquiry_request_status', function ($query) use ($request) {
        //             $query->where('enquiry_request_status_id', $request->enquiry_request_status);
        //         });
        //     }

        //     if ($request->enquiry_status && $request->enquiry_status != -1) {
        //         $report_query->whereHas('enquiry_details.enquiry_status', function ($query) use ($request) {
        //             $query->where('enquiry_status_id', $request->enquiry_status);
        //         });
        //     }

        //     if ($request->from && $request->to) {
        //         $startDate = Carbon::createFromFormat('d/m/Y', $request->from)->startOfDay();
        //         $endDate   = Carbon::createFromFormat('d/m/Y', $request->to)->endOfDay();
        //         $report_query->whereBetween('created_at', [$startDate, $endDate]);
        //     }

        //     $rent_price_list = $report_query->orderBy('created_at', 'desc')->paginate();
        // }

        $data = [
            'rent_price_list' => $rent_price_list,
            'search'          => $search,
        ];

        return view("admin-views.property_management.rent_price_list.rent_price_list", $data);
    }

    public function create()
    {
        $property_managements = (new PropertyManagement())->setConnection('tenant')->select('id', 'name', 'code')->get();

        $data = [
            'property_managements' => $property_managements,
        ];

        return view("admin-views.property_management.rent_price_list.create_rent_price", $data);
    }

    public function edit($id)
    {
        $unit_rent            = (new RentPriceList())->setConnection('tenant')->findOrFail($id);
        $property_managements = (new PropertyManagement())->setConnection('tenant')->select('id', 'name', 'code')->get();

        $data = [
            'property_managements' => $property_managements,
            'unit_rent'            => $unit_rent,
        ];

        return view("admin-views.property_management.rent_price_list.edit_rent_price", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'rent_amount'     => 'required',
            'property'        => 'required',
            'block'           => 'required',
            'floor'           => 'required',
            'units'           => 'required|array',
            'applicable_date' => 'required',
        ]);
        try {
            if ($request->applicable_date) {$applicable_date = Carbon::createFromFormat('d/m/Y', $request->applicable_date)->format('Y-m-d');}

            foreach ($request->units as $unit_id) {
                (new RentPriceList())->setConnection('tenant')->create([
                    'property_id'         => $request->property,
                    'block_management_id' => $request->block,
                    'floor_management_id' => $request->floor,
                    'applicable_date'     => $applicable_date,
                    'unit_management_id'  => $unit_id,
                    'rent_amount'         => $request->rent_amount,
                ]);
            }
            return to_route('rent_price.index')->with('success', __('property_master.added_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }

    }
    public function update(Request $request, $id)
    { 
        $unit_rent = (new RentPriceList())->setConnection('tenant')->findOrFail($id);

        $request->validate([
            'rent_amount'     => 'required',
            'property'        => 'required',
            'block'           => 'required',
            'floor'           => 'required',
            'units'            => 'required',
            'applicable_date' => 'required',
        ]);
        try {
            if ($request->applicable_date) {$applicable_date = Carbon::createFromFormat('d/m/Y', $request->applicable_date)->format('Y-m-d');}

           
                $unit_rent->update([
                    'property_id'         => $request->property,
                    'block_management_id' => $request->block,
                    'floor_management_id' => $request->floor,
                    'applicable_date'     => $applicable_date,
                    'unit_management_id'  => $request->units,
                    'rent_amount'         => $request->rent_amount,
                ]);
            
            return to_route('rent_price.index')->with('success', __('property_master.updated_successfully'));

        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage());
        }

    }
    public function get_blocks_by_property_id_for_rent($id)
    {
        $property = (new PropertyManagement())->setConnection('tenant')->findOrFail($id);
        $blocks   = (new BlockManagement())->setConnection('tenant')->where('property_management_id', $property->id)->with('block')->get();
        return json_encode($blocks);
    }
    public function get_floors_by_block_id_for_rent($id)
    {
        $blocks = (new BlockManagement())->setConnection('tenant')->findOrFail($id);
        $floors = (new FloorManagement())->setConnection('tenant')->where('block_management_id', $blocks->id)->select('id', 'floor_id')->with('floor_management_main:id,name,code')->get();
        return json_encode($floors);
    }

    public function get_units_by_floor_id_for_rent($id)
    {
        $floor = (new FloorManagement())->setConnection('tenant')->findOrFail($id);
        $units = (new UnitManagement())->setConnection('tenant')->where('floor_management_id', $floor->id)->select('id', 'unit_id')->with('unit_management_main:id,name,code')->get();
        return json_encode($units);
    }
    public function delete(Request $request)
    {
        $rent = (new RentPriceList())->setConnection('tenant')->findOrFail($request->id);
        $rent->delete();
        return redirect()->route('rent_price.index')->with('success', __('property_master.deleted_successfully'));
    }
}
