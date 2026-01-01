<?php

namespace App\Http\Controllers\Room_Reservation\Master;

use App\Models\RoomFacility;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoomFacilityController extends Controller
{
        public function index(Request $request)
    {
        $ids = $request->bulk_ids;

        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $room_facility   = RoomFacility::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'   => $room_facility,
            'search' => $search,
            'route'  => 'room_facility',

        ];
        return view("admin-views.room_reservation.index", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:room_facilities,name',
            'code' => 'required',
        ]);

        try {
            $room_facility = RoomFacility::create([
                'name' => $request->name,
                'code' => $request->code,
            ]);
            return redirect()->route('room_facility.list')->with('success', ui_change('added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput();
        }
    }

    public function update(Request $request )
    { 
        $room_facility = RoomFacility::findOrFail($request->id);

        $request->validate([
            'name' => 'required|unique:room_facilities,name,' . $room_facility->id,
            'code' => 'required',
        ]);

        try {
            $room_facility->update([
                'name' => $request->name,
                'code' => $request->code,
            ]);

            return redirect()
                ->route('room_facility.list')
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
        $room_facility = RoomFacility::findOrFail($request->id);
        if ($room_facility->delete()) {
            return redirect()->route("room_facility.list")->with("success", ui_change('deleted_successfully'));
        }
        return redirect()->back()->with('error', ui_change('error_in_deleted'));
    }

    public function edit($id)
    {
        $main_info = RoomFacility::findOrFail($id);
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
}
