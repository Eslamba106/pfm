<?php

namespace App\Http\Controllers\RolesAndCompanyManagement;
 
use App\Http\Controllers\Controller;
use App\Models\AdminRole; 
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class CustomRoleController extends Controller
{
    public function create(Request $request)
    {
        $search = $request['search'];
        $key = explode(' ', $request['search']);
        $rl = (new AdminRole())->setConnection('tenant')->whereNotIn('id', [1])
            ->when($search != null, function ($query) use ($key) {
                foreach ($key as $value) {
                    $query->where('name', 'like', "%{$value}%");
                }
            })->latest()->get();
        return view('admin-views.custom-role.create', compact('rl', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:admin_roles',
        ], [
            'name.required' => 'Role name is required!'
        ]);

        DB::connection('tenant')->table('admin_roles')->insert([
            'name' => $request->name,
            'module_access' => json_encode($request['modules']),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        Toastr::success(translate('role_added_successfully'));
        return back();
    }

    public function edit($id)
    {
        $role = (new AdminRole())->setConnection('tenant')->where(['id' => $id])->first(['id', 'name', 'module_access']);
        return view('admin-views.custom-role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ], [
            'name.required' => 'Role name is required!'
        ]);

        DB::connection('tenant')->table('admin_roles')->where(['id' => $id])->update([
            'name' => $request->name,
            'module_access' => json_encode($request['modules']),
            'status' => 1,
            'updated_at' => now()
        ]);
        Toastr::success(translate('role_updated_successfully'));
        return back();
    }

    public function employee_role_status_update(Request $request)
    {
        $admin_role = (new AdminRole())->setConnection('tenant')->find($request->id);
        $admin_role->status = $request->status ?? 0;
        $admin_role->save();

        return response()->json([
            'success' => 1,
            'message' => translate('status_updated_successfully'),
        ], 200);

    }
 
    

    public function delete(Request $request)
    {
        $role = (new AdminRole())->setConnection('tenant')->find($request->id);
        $role->delete();
        return response()->json();
    }
}
