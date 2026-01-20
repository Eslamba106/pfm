<?php

namespace App\Http\Controllers\Room_Reservation;

use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\PropertyManagement;
use App\Http\Controllers\Controller;
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
        $tenant = Tenant::select('id', 'name', 'company_name' , 'address1')->get();
        $unit_managements = UnitManagement::whereIn('id', $ids)->get();
        $data = [
            'unit_managements' => $unit_managements,
            'tenants' => $tenant,
        ];
        return view('admin-views.room_reservation.booking_room.check_in', $data);
    }
}
