<?php
namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{

    public function login(Request $request)
    {

        // dd($request->all());
        //    dd( DB::connection()->getDatabaseName()    );
        try {
            $request->validate([
                'company_id' => 'required',
                'domain'     => 'required',
                'user_name'  => 'required',
                'password'   => 'required',
            ]);
            Config::set('database.connections.mysql.database', 'property_management_admin');
            DB::purge('mysql');
            DB::reconnect('mysql');

            $company = (new Company())
                ->setConnection('mysql')
                ->where('company_id', $request->company_id)
                ->where('domain', $request->domain)
                ->first();

            if (! $company) {
                return redirect()->back()->with('error', __('login.company_not_found'));
            }
            if ($company->expiry_date <= now() && $company->expiry_date != null) {
                return redirect()->back()->with('error', value: translate('your_subscription_ended'));
            }
            $dbOptions = json_decode($company->database_options, true);
            if (! isset($dbOptions['dbname'])) {
                return redirect()->back()->with('error', __('login.database_not_found'));
            }

            // Config::set('database.connections.tenant.database', $dbOptions['dbname']);

            // DB::purge('tenant');
            // DB::reconnect('tenant');
            // Config::set('database.default', 'tenant'); 

            $user = (new User())->setConnection('mysql')
                ->where('user_name', $request['user_name'])
                ->where('company_id', $company->id)
                ->first();

            if ($user && Hash::check($request['password'], $user->password)) {
                 
                auth()->login($user, true);

                session()->put('user_logged_in', true);
                session()->put('user_id', $user->id);
                session()->save();

                $sessionId = session()->getId();

                $sessionData = DB::connection('mysql')->table('sessions')->where('id', $sessionId)->first();

                if ($sessionData) {
                    $tenantSessionTableName = 'tenant_sessions';
                    $tenantSessionData      = [
                        'session_id'    => $sessionId,
                        'user_id'       => $user->id,
                        'last_activity' => time(),
                        'payload'       => $sessionData->payload,
                        'created_at'    => now(),
                        'updated_at'    => now(),
                    ];

                    DB::connection('tenant')->table($tenantSessionTableName)->insert($tenantSessionData);
                }

                return redirect()->route('main_dashboard');
            } else {
                return redirect()->back()->with('error', __('login.user_not_found'));
            }

        } catch (\Throwable $th) {
            return redirect()->back()->with("error", $th->getMessage());
        }
    }
    // public function login(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'company_id' => 'required',
    //             'domain'     => 'required',
    //         ]);
    //         Config::set('database.connections.mysql.database', 'property_management_admin');
    //         DB::purge('mysql');
    //         DB::reconnect('mysql');

    //         $company = (new Company())
    //             ->setConnection('mysql')
    //             ->where('company_id', $request->company_id)
    //             ->where('domain', $request->domain)
    //             ->first();

    //         if (! $company) {
    //             return redirect()->back()->with('error', __('login.company_not_found'));
    //         }
    //         $dbOptions = json_decode($company->database_options, true);
    //         if (! isset($dbOptions['dbname'])) {
    //             return redirect()->back()->with('error', __('login.database_not_found'));
    //         }
    //         Config::set('database.connections.tenant.database', $dbOptions['dbname']);
    //         DB::purge('tenant');
    //         DB::reconnect('tenant');
    //         Auth::setProvider(app('auth')->createUserProvider('users'));

    //         $user = (new User())->setConnection('tenant')
    //             ->where('user_name', $request['user_name'])
    //             ->first();

    //         if ($user && Hash::check($request['password'], $user->password)) {
    //             auth()->login($user, true);

    //             session()->put('user_logged_in', true);
    //             session()->put('user_id', $user->id);
    //             // dd(auth()->check());
    //             session()->save();
    //             // dd(session()->all());
    //             return redirect()->route('main_dashboard');
    //         } else {
    //             return redirect()->back()->with('error', __('login.user_not_found'));
    //         }

    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with("error", $th->getMessage());

    //     }
    // }

    public function logout()
    {
        // dd("log");
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login-page');
    }
    public function admin_login(Request $request)
    {
        // dd($request->all());
        if (isset($request['user_name']) && Auth::guard('admins')->attempt(['user_name' => $request->input('user_name'), 'password' => $request->input('password')])) {
            return redirect()->route('admin.dashboard');
        } elseif (isset($request['email']) && Auth::guard('admins')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->with('error', __('login.user_not_found'));
    }

//     public function admin_login(Request $request)
//     {
//         if(isset($request['user_name']) && Auth::guard('admins')->attempt(['user_name' => $request->input('email'), 'password' => $request->input('password')])){
//             $user = Admin::where('user_name', $request['email'])->first();
//         // Config::set('database.connections.mysql.database' , 'finexerp');
//         // DB::purge('mysql');
//         // DB::reconnect('mysql');
//         // dd( DB::connection()->getDatabaseName()    );
//         Config::set('database.connections.mysql.database', 'property_management_admin');
//         DB::purge('mysql');
//         DB::reconnect('mysql');

//         if (isset($request['user_name']) && Auth::guard('admins')->attempt(['user_name' => $request->input('user_name'), 'password' => $request->input('password')])) {
//             dd(DB::getDatabaseName());
//             $user = (new Admin())->setConnection('mysql')->where('user_name', $request['user_name'])->first();
//             session()->put('user_logged_in', true);
//         }elseif (isset($request['email']) && Auth::guard('admins')->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])){
//             $user = Admin::where('email', $request->input('email'))->first();
//             session()->put('user_logged_in', true);
//         }

//         if (auth()->guard('admins')->check()) {

//             return redirect()->route('admin.dashboard');
//         } else {
//             return redirect()->back()->with('error', __('login.user_not_found'));
//         }

//     }
// }
    // public function admin_login(Request $request)
    // {
    //     // Config::set('database.connections.mysql.database' , 'finexerp');
    //     // DB::purge('mysql');
    //     // DB::reconnect('mysql');
    //     // dd( DB::connection()->getDatabaseName()    );
    //     Config::set('database.connections.mysql.database', 'property_management_admin');
    //     DB::purge('mysql');
    //     DB::reconnect('mysql');

    //     if (isset($request['user_name']) && Auth::guard('admins')->attempt(['user_name' => $request->input('user_name'), 'password' => $request->input('password')])) {
    //         // dd(DB::getDatabaseName());
    //         $user = (new Admin())->setConnection('mysql')->where('user_name', $request['user_name'])->first();
    //         session()->put('user_logged_in', true);
    //         session()->put('admin_id', $user->id);
    //         if (auth()->guard('admins')->check()) {
    //             // dd($request->all());

    //             return redirect()->route('admin.dashboard');

    //             // return redirect()->route('admin.dashboard');
    //         } else {
    //             // dd("Eeroe");
    //             return redirect()->back()->with('error', __('login.user_not_found'));
    //         }
    //     }

    // }

    public function admin_logout()
    {
        Auth::guard('admins')->logout();
        session()->invalidate();
        session()->regenerateToken();
        return to_route('admin.login-page');
    }
    public function login_page()
    {

        return view('auth.login');
    }
}
