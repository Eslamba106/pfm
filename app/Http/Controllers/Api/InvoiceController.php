<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;

class InvoiceController extends Controller
{
    public function invoices_list(Request $request){
       $host = $request->getHost() ;

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
                    $invoices = Invoice::get();
                    return  ($invoices);
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
        } 
    }
}
