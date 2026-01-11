<?php

use App\Helpers\Helpers;
use App\Models\BusinessSetting;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

if (! function_exists('translate')) {
    function translate($key)
    {
        $local = Helpers::default_lang();
        App::setLocale($local);

        try {
            $lang_array    = include base_path('lang/' . $local . '/messages.php');
            $processed_key = ucfirst(str_replace('_', ' ', Helpers::remove_invalid_charcaters($key)));
            $key           = Helpers::remove_invalid_charcaters($key);
            if (! array_key_exists($key, $lang_array)) {
                $lang_array[$key] = $processed_key;
                $str              = "<?php return " . var_export($lang_array, true) . ";";
                $language         = BusinessSetting::where('type', 'language')->first();
                foreach (json_decode($language['value'], true) as $key => $data) {

                    file_put_contents(base_path('lang/' . $data['code'] . '/messages.php'), $str);
                }
                $result = $processed_key;
            } else {
                $result = __('messages.' . $key);
            }
        } catch (\Exception $exception) {
            $result = __('messages.' . $key);
        }
        return $result;
    }

}
// if (! function_exists('ui_change')) {
 
// function ui_change($key, $position = 'dashboard')
// { 
//     $connectionName = 'tenant'; 
//     try { 
//         $value = DB::connection($connectionName)
//                    ->table('ui_settings')
//                    ->where('key', $key)
//                    ->where('position', $position)
//                    ->first();

//     } catch (Throwable $e) { 

//         $connectionName = 'mysql';  
         
//         $value = DB::connection($connectionName)
//                    ->table('ui_settings')
//                    ->where('key', $key)
//                    ->where('position', $position)
//                    ->first();
//     }
     
//     if (is_null($value)) {
//         $formattedValue = str_replace('_', ' ', $key);
//         $formattedValue = ucwords($formattedValue);
 
//         DB::connection($connectionName)->table('ui_settings')->insert([
//             'key'      => $key,
//             'value'    => $formattedValue,
//             'position' => $position,
//         ]);

//         return $formattedValue;
//     }

//     return $value->value;
// }

    // function ui_change($key , $position = 'dashboard')
    // {
    //     $value = DB::connection('tenant')->table('ui_settings')->where('key', $key)->where('position' , $position)->first();

    //     if (is_null($value)) {
    //         $formattedValue = str_replace('_', ' ', $key);
    //         $formattedValue = ucwords($formattedValue);

    //         DB::connection('tenant')->table('ui_settings')->insert([
    //             'key'   => $key,
    //             'value' => $formattedValue,
    //             'position' => $position,
    //         ]);

    //         return $formattedValue;
    //     }

    //     return $value->value;
    // }

// }
if (! function_exists('ui_change')) {
    function ui_change($key, $position = 'dashboard')
    {
        $connectionName = 'tenant';
        try {
            $value = DB::connection($connectionName)
                       ->table('ui_settings')
                       ->whereRaw('BINARY `key` = ?', [$key])
                       ->where('position', $position)
                       ->first();
        } catch (Throwable $e) {
            $connectionName = 'mysql';
            $value = DB::connection($connectionName)
                       ->table('ui_settings')
                       ->whereRaw('BINARY `key` = ?', [$key])
                       ->where('position', $position)
                       ->first();
        }

        if (is_null($value)) {
            $formattedValue = str_replace('_', ' ', $key);
            $formattedValue = ucwords($formattedValue);

            DB::connection($connectionName)->table('ui_settings')->insert([
                'key'      => $key,
                'value'    => $formattedValue,
                'position' => $position,
            ]);

            return $formattedValue;
        }

        return $value->value;
    }
}

