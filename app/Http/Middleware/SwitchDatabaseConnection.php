<?php
namespace App\Http\Middleware;

use App\Models\Company;
use Closure;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class SwitchDatabaseConnection
{
    public function handle($request, Closure $next)
    {
        // dd(Auth::guard('web')->check());
        // if (Auth::guard('web')->check()) {

        //     $company = Company::where('id' , auth()->guard('web')->user()->company_id)->select('database_options' )->first();
        //     // dd( $company  );
        //     $dbOptions = json_decode($company->database_options, true);

        //     Config::set('database.connections.tenant.database', $dbOptions['dbname']);
        //     DB::purge('tenant');
        //     DB::reconnect('tenant');
        //     DB::setDefaultConnection('tenant');
        //     // dd(DB::getDefaultConnection());
        // }

        $host       = $request->getHost();
        // $mainDomain = 'pfm.finexerp.com';
        $mainDomain = 'localhost';

        if ($host != $mainDomain) {
            if (! session()->has('company_id')) {
                $company = Company::where('domain', $host)->select('database_options', 'id')->first();
                if ($company) {
                    session(['company_id' => $company->id]);
                    $db = $company->database_options['dbname'] ?? 'finexerp_' . $company->id;
                    Config::set('database.connections.tenant.database', $db);
                    DB::purge('tenant');
                    DB::reconnect('tenant');
                    DB::setDefaultConnection('tenant');
                    app()->instance('current_company', $company);
                } else {
                    return abort(404);
                }
            } else {

                $company = Company::select('id', 'database_options')->find(session('company_id'));
                if ($company) {
                    session(['company_id' => $company->id]);
                    $db = $company->database_options['dbname'] ?? 'finexerp_' . $company->id;
                    Config::set('database.connections.tenant.database', $db);
                    DB::purge('tenant');
                    DB::reconnect('tenant');
                    DB::setDefaultConnection('tenant');
                    app()->instance('current_company', $company);
                } else {
                    return abort(404);
                }
                app()->instance('current_company', $company);
            }
        } else {
            Config::set('database.connections.mysql.database', 'property_management_admin');
            DB::purge('mysql');
            DB::reconnect('mysql');
            DB::setDefaultConnection('mysql');
        }

        return $next($request);
    }
}
