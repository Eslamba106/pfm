<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

class CompanyAuthController extends Controller
{
     public function login(Request $request)
    {

        try {
            $request->validate([
                'company_id' => 'required',
                'domain'     => 'required',
                'user_name'  => 'required',
                'password'   => 'required',
            ]); 

            $company = Company::select('company_id' ,'id' , 'domain' , 'database_options' ,'expiry_date')->where('company_id', $request->company_id)
                ->where('domain', $request->domain)
                ->first(); 
            if (! $company) {
                return redirect()->back()->with('error', ui_change('company_not_found'));
            }
            if ($company->expiry_date <= now() && $company->expiry_date != null) {
                return redirect()->back()->with('error',  ui_change('your_subscription_ended'));
            }
            $dbOptions = json_decode($company->database_options, true);
            if (! isset($dbOptions['dbname'])) {
                return redirect()->back()->with('error', ui_change('database_not_found'));
            } 
            $user = User::select('id' , 'name' , 'user_name' , 'company_id' , 'password'  )
                ->where('user_name', $request['user_name'])
                ->where('company_id', $company->id)
                ->first();  
            if ($user && Hash::check($request['password'], $user->password)) { 
                auth()->login($user, true);  
                return redirect()->route('main_dashboard');
            } else {
                return redirect()->back()->with('error', ui_change('user_not_found'));
            }

        } catch (\Throwable $th) {
            return redirect()->back()->with("error", $th->getMessage());
        }
    }

      public function logout()
    {
        // dd("log");
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login-page');
    }
}
