<?php

namespace App\Http\Controllers\Room_Reservation\Master;

use App\Models\RentalType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RentalTypeController extends Controller
{
      public function index(Request $request)
    {
        $ids = $request->bulk_ids;

        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $rental_type   = RentalType::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'   => $rental_type,
            'search' => $search,
            'route'  => 'rental_type',

        ];
        return view("admin-views.room_reservation.rental_type.index", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:rental_types,name',
            'code' => 'required',
        ]);

        try {
            $rental_type = RentalType::create([
                'name' => $request->name,
                'code' => $request->code,
            ]);
            return redirect()->route('rental_type.list')->with('success', ui_change('added_successfully'));
        } catch (\Exception $e) {
            return redirect()->back()->with("error", $e->getMessage())->withInput();
        }
    }

    public function update(Request $request )
    { 
        $rental_type = RentalType::findOrFail($request->id);

        $request->validate([
            'name' => 'required|unique:rental_types,name,' . $rental_type->id,
            'code' => 'required',
        ]);

        try {
            $rental_type->update([
                'name' => $request->name,
                'code' => $request->code,
            ]);

            return redirect()
                ->route('rental_type.list')
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
        $rental_type = RentalType::findOrFail($request->id);
        if ($rental_type->delete()) {
            return redirect()->route("rental_type.list")->with("success", ui_change('deleted_successfully'));
        }
        return redirect()->back()->with('error', ui_change('error_in_deleted'));
    }

    public function edit($id)
    {
        $main_info = RentalType::findOrFail($id);
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
