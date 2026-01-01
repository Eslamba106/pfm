<?php

namespace App\Http\Controllers\Connection;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class TenantConnectionController extends Controller
{
    public function connect(Request $request)
    {
         
        $user = auth()->user();
        if ($user) {
            $company = (new \App\Models\Company())->setConnection('mysql')->find($user->company_id); 

            if ($company) {
                $dbOptions = json_decode($company->database_options, true);
                if (isset($dbOptions['dbname'])) {
                    Config::set('database.connections.tenant.database', $dbOptions['dbname']);
                    DB::purge('tenant');
                    DB::reconnect('tenant'); 
                    session()->save();

                    return redirect()->route('main_dashboard');
                } else { 
                    auth()->logout();
                    return redirect()->route('login')->with('error', __('login.database_config_error'));
                }
            } else { 
                auth()->logout();
                return redirect()->route('login')->with('error', __('login.company_not_found'));
            }
        } else {
            return redirect()->route('login')->with('error', __('auth.failed'));  
        }
    }
}
