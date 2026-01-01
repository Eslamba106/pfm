<?php
namespace App\Http\Controllers\settings;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Admin::where('id', auth('admins')->id())->first();
        return view('super_admin.profile.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);

        $admin->update([
            'user_name'                 => $request->username,
            'name'                      => $request->name,
            'my_pass'                   => $request->password,
            'password'                  => Hash::make($request->password),
        ]);

        return back()->with('success' , ui_change('updated_successfully'));

    }
}
