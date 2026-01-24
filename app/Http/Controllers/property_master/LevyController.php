<?php

namespace App\Http\Controllers\property_master;

use App\Http\Controllers\Controller;
use App\Models\Levy;
use Illuminate\Http\Request;

class LevyController extends Controller
{
    public function index(Request $request)
    {

        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';
        $levy = (new Levy())->setConnection('tenant')->when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        $data = [
            'main'              => $levy,
            'search'            => $search,
            'route'             => 'levy',

        ];
        return view("admin-views.property_master.levy.index", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:levies,name',
            'percentage'    => "required|numeric",
        ]);

        $levy = Levy::create([
            'name'                  => $request->name,
            'percentage'            => $request->percentage,
        ]);

        return redirect()->route('levy.index')->with('success', ui_change('added_successfully'));
    }

    public function edit($id)
    {
        $levy = Levy::findOrFail($id);
        $data = [
            'main'      => $levy,
            'route'             => 'levy',

        ];
        return view('admin-views.property_master.levy.edit', $data);
    }
     public function update(Request $request ,$id)
    {
        $levy = Levy::findOrFail($id);
        $request->validate([
        'name'       => 'required|unique:levies,name,'.$id.',id',
            'percentage'    => "required|numeric",
        ]); 
        $levy->update([
            'name'                  => $request->name,
            'percentage'            => $request->percentage,
        ]);

        return redirect()->route('levy.index')->with('success', ui_change('added_successfully'));
    }
}
