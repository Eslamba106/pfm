<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schema;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class SchemaController extends Controller
{
    public function index(Request $request)
    {
        // $this->authorize('user_management');
        $search      = $request['search'];
        $query_param = $search ? ['search' => $request['search']] : '';

        $schemes = Schema::when($request['search'], function ($q) use ($request) {
            $key = explode(' ', $request['search']);
            foreach ($key as $value) {
                $q->Where('name', 'like', "%{$value}%")
                    ->orWhere('id', $value);
            }
        })
            ->latest()->paginate()->appends($query_param);

        if (isset($search) && empty($search)) {
            $schemes = Schema::orderBy('created_at', 'asc')
                ->paginate(10);
        }
        $data = [
            'schemes' => $schemes,
            'search'  => $search,
        ];

        return view("super_admin.schemes.schemes_list", $data);
    }

    public function create()
    {
        $data = [];
        return view("super_admin.schemes.create", $data);
    }
    public function edit($id)
    {
        $schema = Schema::findOrFail($id);
        $data   = [
            'schema' => $schema,
        ];
        return view("super_admin.schemes.edit", $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                   => 'required|string|max:255',
            'user_charge'            => 'required|numeric',
            'user_count_from'        => 'required|integer',
            'user_count_to'          => 'required|integer',
            'unit_charge'            => 'required|numeric',
            'unit_count_from'        => 'required|integer',
            'unit_count_to'          => 'required|integer',
            'building_charge'        => 'required|numeric',
            'building_count_from'    => 'required|integer',
            'building_count_to'      => 'required|integer',
            'branch_charge'          => 'required|numeric',
            'branch_count_from'      => 'required|integer',
            'branch_count_to'        => 'required|integer',
            'setup_cost'             => 'required|numeric',
            'schema_applicable_date' => 'required|date_format:d/m/Y',
            'schema_end_date'        => 'required|date_format:d/m/Y',
            'display'                => 'required|string',
            'status'                 => 'required|string',
        ]);
        try {
            $applicableDate = Carbon::createFromFormat('d/m/Y', $request->schema_applicable_date)->format('Y-m-d');
            $endDate        = Carbon::createFromFormat('d/m/Y', $request->schema_end_date)->format('Y-m-d');
            $price          =
                ($request->user_charge ?? 0) +
                ($request->unit_charge ?? 0) +
                ($request->building_charge ?? 0) +
                ($request->branch_charge ?? 0) +
                ($request->setup_cost ?? 0);
            $schema = Schema::create([
                'name'                => $request->name,
                'user_charge'         => $request->user_charge,
                'user_count_from'     => $request->user_count_from,
                'user_count_to'       => $request->user_count_to,
                'unit_charge'         => $request->unit_charge,
                'unit_count_from'     => $request->unit_count_from,
                'unit_count_to'       => $request->unit_count_to,
                'building_charge'     => $request->building_charge,
                'building_count_from' => $request->building_count_from,
                'building_count_to'   => $request->building_count_to,
                'branch_charge'       => $request->branch_charge,
                'branch_count_from'   => $request->branch_count_from,
                'branch_count_to'     => $request->branch_count_to,
                'setup_cost'          => $request->setup_cost,
                'applicable_date'     => $applicableDate,
                'end_date'            => $endDate,
                'display'             => $request->display,
                'status'              => $request->status,
                'price'               => $price,
            ]);
            return redirect()->route('admin.schema')->with('success', ui_change('added_successfully'));

        } catch (Exception $ex) {
            return back()->with('error', $ex->getMessage())->withInput();
        }
        // return back()->withInput();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'                   => 'required|string|max:255',
            'user_charge'            => 'required|numeric',
            'user_count_from'        => 'required|integer',
            'user_count_to'          => 'required|integer',
            'unit_charge'            => 'required|numeric',
            'unit_count_from'        => 'required|integer',
            'unit_count_to'          => 'required|integer',
            'building_charge'        => 'required|numeric',
            'building_count_from'    => 'required|integer',
            'building_count_to'      => 'required|integer',
            'branch_charge'          => 'required|numeric',
            'branch_count_from'      => 'required|integer',
            'branch_count_to'        => 'required|integer',
            'setup_cost'             => 'required|numeric',
            'schema_applicable_date' => 'required|date_format:d/m/Y',
            'schema_end_date'        => 'required|date_format:d/m/Y',
            'display'                => 'required|string',
            'status'                 => 'required|string',
        ]);

        try {
            $applicableDate = Carbon::createFromFormat('d/m/Y', $request->schema_applicable_date)->format('Y-m-d');
            $endDate        = Carbon::createFromFormat('d/m/Y', $request->schema_end_date)->format('Y-m-d');

            $schema = Schema::findOrFail($id);
            $price  =
                ($request->user_charge ?? 0) +
                ($request->unit_charge ?? 0) +
                ($request->building_charge ?? 0) +
                ($request->branch_charge ?? 0) +
                ($request->setup_cost ?? 0);
            $schema->update([
                'name'                => $request->name,
                'user_charge'         => $request->user_charge,
                'user_count_from'     => $request->user_count_from,
                'user_count_to'       => $request->user_count_to,
                'unit_charge'         => $request->unit_charge,
                'unit_count_from'     => $request->unit_count_from,
                'unit_count_to'       => $request->unit_count_to,
                'building_charge'     => $request->building_charge,
                'building_count_from' => $request->building_count_from,
                'building_count_to'   => $request->building_count_to,
                'branch_charge'       => $request->branch_charge,
                'branch_count_from'   => $request->branch_count_from,
                'branch_count_to'     => $request->branch_count_to,
                'setup_cost'          => $request->setup_cost,
                'applicable_date'     => $applicableDate,
                'end_date'            => $endDate,
                'display'             => $request->display,
                'status'              => $request->status,
                'price'               => $price,

            ]);

            return redirect()->route('admin.schema')->with('success', ui_change('updated_successfully'));

        } catch (Exception $ex) {
            return back()->with('error', $ex->getMessage())->withInput();
        }
    }

    public function displayUpdate(Request $request)
    {

        $main = Schema::findOrFail($request->id);
        $main->update([
            'display' => ($request->display == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success', ui_change('updated_successfully'));
    }
    public function statusUpdate(Request $request)
    {
        // $this->authorize('edit_cost_center_category');
        $main = Schema::findOrFail($request->id);
        $main->update([
            'status' => ($request->status == 1) ? 'active' : 'inactive',
        ]);
        return redirect()->back()->with('success', ui_change('updated_successfully'));
    }

}
