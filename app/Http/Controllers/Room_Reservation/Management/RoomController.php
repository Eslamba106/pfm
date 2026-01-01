<?php

namespace App\Http\Controllers\Room_Reservation\Management;

use App\Models\Room;
use App\Models\RoomBuilding;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RoomBlock;
use App\Models\RoomFacility;
use App\Models\RoomFloor;
use App\Models\RoomOption;
use App\Models\RoomType;

class RoomController extends Controller
{
       public function index(Request $request)
    {
        $ids = $request->bulk_ids;

        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $room_unit  = Room::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);
        $buildings              = RoomBuilding::select('id', 'name')->get();
        $blocks                 = RoomBlock::select('id', 'name')->get();
        $floors                 = RoomFloor::select('id', 'name')->get();
        $options                = RoomOption::select('id', 'name')->get();
        $room_types             = RoomType::select('id', 'name')->get();
        $room_facilities        = RoomFacility::select('id', 'name')->get();
        $data      = [
            'main'                  => $room_unit,
            'search'                => $search,
            'route'                 => 'room_unit',
            'buildings'             => $buildings,
            'blocks'                => $blocks,
            'floors'                => $floors,
            'options'               => $options,
            'room_types'            => $room_types,
            'room_facilities'       => $room_facilities,

        ];
        return view("admin-views.room_reservation.room.index", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required',
            'building_id' => 'required',
            'block_id'    => 'required',
            'code'        => 'required',
        ]);

        try {
            $room_unit = Room::create([
                'name'        => $request->name,
                'building_id' => $request->building_id,
                'block_id'    => $request->block_id,
                'code'        => $request->code,
            ]);
            return redirect()->route('room_unit.list')->with('success', ui_change('added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput();
        }
    }

    public function update(Request $request)
    {
        $room_unit = Room::findOrFail($request->id);

        $request->validate([
            'name'        => 'required'  ,
            'code'        => 'required',
            'block_id'    => 'required',
            'building_id' => 'required',
        ]);

        try {
            $room_unit->update([
                'name'        => $request->name,
                'code'        => $request->code,
                'building_id' => $request->building_id,
                'block_id'    => $request->block_id,
            ]);

            return redirect()
                ->route('room_unit.list')
                ->with('success', ui_change('updated_successfully'));

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with("error", $e->getMessage())
                ->withInput();
        }
    }

    public function delete(Request $request)
    {
        $room_unit = Room::findOrFail($request->id);
        if ($room_unit->delete()) {
            return redirect()->route("room_unit.list")->with("success", ui_change('deleted_successfully'));
        }
        return redirect()->back()->with('error', ui_change('error_in_deleted'));
    }

    public function edit($id)
    {
        $main_info = Room::findOrFail($id);
        if ($main_info) {
            return response()->json([
                'status'    => 200,
                "main_info" => $main_info,
            ]);
        } else {
            return response()->json([
                'status'  => 404,
                "message" => "Receipt Settings Not Found",
            ]);
        }
    }

    public function get_floors($building_id , $block_id)
    {
        $floors = RoomFloor::where('building_id', $building_id)->where('block_id' , $block_id)->get();

        return response()->json([
            'floors' => $floors,
        ]);
    }
}
