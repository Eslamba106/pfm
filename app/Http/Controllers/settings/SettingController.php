<?php
namespace App\Http\Controllers\settings;

use App\Http\Controllers\Controller;
use App\Models\UiSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function ui_settings(Request $request, $position = 'dashboard')
    {
        $words = UiSetting::where('position', $position)->get();

        $data = [
            'word'     => $words,
            'position' => $position,
        ];
        return view('admin-views.settings.ui_settings.ui_settings', $data);
    }

    public function translate_submit(Request $request, $position)
    {
        DB::connection('tenant')->table('ui_settings')
            ->where('key', $request->key)
            ->where('position', $position)
            ->update([
                'value' => $request->value,
            ]);
    }
    public function translate_key_remove(Request $request, $position)
    {
        DB::connection('tenant')->table('ui_settings')
            ->where('key', $request->key)
            ->where('position', $position)
            ->delete();
    }

    public function translate_list($position)
{
    $words = (new UiSetting())->setConnection('tenant')->where('position', $position)->get();

    $data = [];  

    foreach ($words as $item) {
        $data[] = [
            'key'   => $item->key,
            'value' => $item->value,
        ];
    }
     return response()->json($data);
}

    // public function translate_list($position ='dashboard')
    // {
    //     $data = [];
    //      $words = (new UiSetting())->setConnection('tenent')->where('position', $position)->get(['key', 'value']);

    // return response()->json($words);
    //     // return response()->json($data);

    // }
}
