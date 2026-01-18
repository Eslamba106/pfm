<?php

namespace App\Http\Controllers\settings;

use App\Models\User;
use App\Models\UserSettings;
use Illuminate\Http\Request;
use App\Models\PropertyManagement;
use Endroid\QrCode\Builder\Builder;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserSettingsController extends Controller
{
    public function index()
    {
        $user = User::where('id', auth()->id())->first();
        $buildings = (new PropertyManagement())->select('id', 'name')->get();
        $user_buildings = UserSettings::where('user_id', $user->id)->first();

        $selectedBuildings = json_decode(optional($user_buildings)->building_ids ?? '[]', true);

        return view('admin-views.settings.user_settings', compact('user', 'buildings', 'selectedBuildings'));
    }

    public function update(Request $request, $id)
    {
        $admin = User::findOrFail($id);

        $admin->update([
            'user_name'                 => $request->username,
            'name'                      => $request->name,
            'my_name'                   => $request->password,
            'building_id'               => $request->property_id,
            'password'                  => Hash::make($request->password),
        ]);

        return back()->with('success', ui_change('updated_successfully'));
    }

    public function update_buildings(Request $request)
    {
        $userSettings = UserSettings::firstOrNew([
            'user_id' => auth()->id()
        ]);

        $buildings = $request->has('buildings')
            ? $request->buildings
            : [];

        $userSettings->building_ids = json_encode($buildings);
        $userSettings->save();

        return back()->with('success', ui_change('updated_successfully'));
    }
}
