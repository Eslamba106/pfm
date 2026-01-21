<?php

namespace App\Http\Controllers\Room_Reservation;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\PropertyManagement;
use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\RentalType;
use App\Models\Room;
use App\Models\RoomOption;
use App\Models\Unit;
use App\Models\UnitManagement;

class BookingRoomController extends Controller
{
    public function index()
    {
        $tenants = Tenant::select('id', 'name', 'company_name')->get();
        $property = PropertyManagement::with(
            'blocks_management_child',
            'blocks_management_child.block',
            'blocks_management_child.floors_management_child',
            'blocks_management_child.floors_management_child.floor_management_main',
            'blocks_management_child.floors_management_child.unit_management_child',
            'blocks_management_child.floors_management_child.unit_management_child.unit_management_main'
        )->forUser()->get();
        $data = [
            'property_items' => $property,
            'tenants' => $tenants,
        ];
        return view('admin-views.room_reservation.booking_room.list', $data);
    }
    public function check_in_page(Request $request)
    {

        $ids = $request->bulk_ids;
        if ($ids == null) {
            return redirect()->back()->with('error', 'Please Select Unit');
        }
        $tenant = Tenant::select('id', 'name', 'company_name', 'address1')->get();
        $unit_managements = UnitManagement::whereIn('id', $ids)->get();
        $data = [
            'unit_managements' => $unit_managements,
            'tenants' => $tenant,
        ];
        return view('admin-views.room_reservation.booking_room.check_in', $data);
    }
    public function create(Request $request)
    {
        $ids = $request->bulk_ids;
        if ($ids == null) {
            return redirect()->back()->with('error', 'Please Select Unit');
        }
        $company = Company::select('id', 'name', 'decimals')->first();
          $all_units                = UnitManagement::select('id','adults','children', 'property_management_id', 'booking_status', 'view_id', 'unit_type_id', 'unit_condition_id', 'unit_description_id', 'unit_id', 
          'block_management_id', 'floor_management_id')->whereIn('id', $ids)
            ->with('block_unit_management', 'property_unit_management', 'block_unit_management.block', 'floor_unit_management.floor_management_main'
                , 'floor_unit_management', 'unit_management_main', 'unit_description', 'unit_type', 'view', 'unit_condition')->lazy();
       
        $tenants = Tenant::select('id', 'name', 'company_name')->get();
        $room_options = RoomOption::select('id', 'name')->get();
        $rental_types = RentalType::select('id' , 'name')->get();
        $data = [ 
            'tenants' => $tenants,
            'all_units' => $all_units,
            'company' => $company,
            'room_options'  => $room_options,
            'rental_types'  => $rental_types,
        ];
        return view('admin-views.room_reservation.booking_room.create', $data);
    }
}
