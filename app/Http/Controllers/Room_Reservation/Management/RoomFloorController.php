<?php
namespace App\Http\Controllers\Room_Reservation\Management;

use App\Http\Controllers\Controller;
use App\Models\RoomBlock;
use App\Models\RoomBuilding;
use App\Models\RoomFloor;
use Illuminate\Http\Request;

class RoomFloorController extends Controller
{
    public function index(Request $request)
    {
        $ids = $request->bulk_ids;

        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $room_floor  = RoomFloor::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);
        $buildings = RoomBuilding::select('id', 'name')->get();
        $blocks    = RoomBlock::select('id', 'name')->get();
        $data      = [
            'main'      => $room_floor,
            'search'    => $search,
            'route'     => 'room_floor',
            'buildings' => $buildings,
            'blocks'    => $blocks,

        ];
        return view("admin-views.room_reservation.index", $data);
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
            $room_floor = RoomFloor::create([
                'name'        => $request->name,
                'building_id' => $request->building_id,
                'block_id'    => $request->block_id,
                'code'        => $request->code,
            ]);
            return redirect()->route('room_floor.list')->with('success', ui_change('added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput();
        }
    }

    public function update(Request $request)
    {
        $room_floor = RoomFloor::findOrFail($request->id);

        $request->validate([
            'name'        => 'required'  ,
            'code'        => 'required',
            'block_id'    => 'required',
            'building_id' => 'required',
        ]);

        try {
            $room_floor->update([
                'name'        => $request->name,
                'code'        => $request->code,
                'building_id' => $request->building_id,
                'block_id'    => $request->block_id,
            ]);

            return redirect()
                ->route('room_floor.list')
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
        $room_floor = RoomFloor::findOrFail($request->id);
        if ($room_floor->delete()) {
            return redirect()->route("room_floor.list")->with("success", ui_change('deleted_successfully'));
        }
        return redirect()->back()->with('error', ui_change('error_in_deleted'));
    }

    public function edit($id)
    {
        $main_info = RoomFloor::findOrFail($id);
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

    public function getBlocks($building_id)
    {
        $blocks = RoomBlock::where('building_id', $building_id)->get();

        return response()->json([
            'blocks' => $blocks,
        ]);
    }

}
