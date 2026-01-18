<?php

namespace App\Http\Controllers\Room_Reservation;

use Illuminate\Http\Request;
use App\Models\PropertyManagement;
use App\Http\Controllers\Controller;

class BookingRoomController extends Controller
{
    public function index()
    {
           
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
        ]; 
        return view('admin-views.room_reservation.booking_room.list' , $data);
    }
}
