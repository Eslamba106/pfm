<?php
namespace App\Http\Controllers\Room_Reservation\Master;

use App\Http\Controllers\Controller;
use App\Models\RoomType;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{

    public function index(Request $request)
    {
        $ids = $request->bulk_ids;

        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $room_type   = RoomType::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'   => $room_type,
            'search' => $search,
            'route'  => 'room_type',

        ];
        return view("admin-views.room_reservation.index", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:room_types,name',
            'code' => 'required',
        ]);

        try {
            $room_type = RoomType::create([
                'name' => $request->name,
                'code' => $request->code,
            ]);
            return redirect()->route('room_type.list')->with('success', ui_change('added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput();
        }
    }

    public function update(Request $request )
    { 
        $room_type = RoomType::findOrFail($request->id);

        $request->validate([
            'name' => 'required|unique:room_types,name,' . $room_type->id,
            'code' => 'required',
        ]);

        try {
            $room_type->update([
                'name' => $request->name,
                'code' => $request->code,
            ]);

            return redirect()
                ->route('room_type.list')
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
        $room_type = RoomType::findOrFail($request->id);
        if ($room_type->delete()) {
            return redirect()->route("room_type.list")->with("success", ui_change('deleted_successfully'));
        }
        return redirect()->back()->with('error', ui_change('error_in_deleted'));
    }

    public function edit($id)
    {
        $main_info = RoomType::findOrFail($id);
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
