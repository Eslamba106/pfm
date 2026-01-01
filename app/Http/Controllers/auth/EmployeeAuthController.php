<?php
namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;

class EmployeeAuthController extends Controller
{
    public function login(Request $request)
    {
        $company = (new Company())->setConnection('mysql')->where('company_id', $request->company_id)->first();
        if (! $company) {
            return redirect()->back()->with('error', __('login.database_not_found'));
        }
        $dbOptions = json_decode($company->database_options, true);
        if (! isset($dbOptions['dbname'])) {
            return redirect()->back()->with('error', __('login.database_not_found'));
        }
        Config::set('database.connections.tenant.database', $dbOptions['dbname']);
        DB::purge('tenant');
        DB::reconnect('tenant');
        if (isset($request->username) && Auth::guard('employees')->attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
             
            return redirect()->route('employee_dashboard');
        } else {
            return redirect()->back()->with('error', __('login.user_not_found'));
        }
    }
}
