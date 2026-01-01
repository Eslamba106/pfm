<?php
namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Section;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        $minutes = 60;
        $scopes  = [];
        if (auth()->guard('web')->check()) {
            $sections = Cache::remember('sections', $minutes, function () {
                return (new Section())->setConnection('tenant')->select('id', 'name')->get();
            });
        } elseif (auth()->guard('admins')->check()) {
            $sections = Cache::remember('sections', $minutes, function () {
                return (new Section())->setConnection('mysql')->select('id', 'name')->get();
            });
        } else {
            $sections = Cache::remember('sections', $minutes, function () {
                return (new Section())->setConnection('mysql')->select('id', 'name')->get();
            });
        }
        foreach ($sections as $section) {
            Gate::define($section->name, function ($user) use ($section) {

                if ($user instanceof \App\Models\Admin) {
                    return true;
                }

                if ($user instanceof \App\Models\User) {
                    return $user->hasPermission($section->name);
                }

                return false;
            });
        }

        // foreach ($sections as $section) {
        //     Gate::define($section->name, function ($user) use ($section) {
        //         $guard = Auth::getDefaultDriver();
        //         if ($guard === 'web' && $user instanceof User) {
        //             return $user->hasPermission($section->name);
        //         } elseif ($guard === 'admins' && $user instanceof Admin) {
        //             return $user->hasPermission($section->name);
        //         }
        //         return false;
        //     });
        // }
        // if(auth()->guard('admins')->user()){
        //     Config::set('database.connections.mysql.database');
        //     DB::purge('mysql');
        //     DB::reconnect('mysql');
        //     $sections = Cache::remember('sections', $minutes, function () {
        //         return (new Section())->setConnection('mysql')->select('id' , 'name')->get();
        //     });
        // }elseif(auth()->guard('web')->user()){
        //     // dd(Auth::user());
        //     $company = Company::select('id' , 'database_options' )->where('id', Auth::user()->company_id)->first();
        //     $dbOptions = json_decode($company->database_options, true);

        //     if (!empty($dbOptions['dbname'])) {
        //         Config::set('database.connections.tenant.database', $dbOptions['dbname']);
        //         DB::purge('tenant');
        //         DB::reconnect('tenant');
        //     }

        //     $sections = Cache::remember('sections', $minutes, function () {
        //         return Section::select('id' , 'name')->get();
        //     });
        // }else{
        //     Config::set('database.connections.mysql.database' , 'finexerp');
        //     DB::purge('mysql');
        //     DB::reconnect('mysql');
        //    // nn
        //     $sections = Cache::remember('sections', $minutes, function () {
        //         return (new Section())->setConnection('mysql')->select('id' , 'name')->get();
        //     });
        // }
        // $sections = Cache::remember('sections', $minutes, function () {
        //             return (new Section())->setConnection('mysql')->select('id' , 'name')->get();
        //         });

        // foreach ($sections as $section) {
        //     $scopes[$section->name] = $section->caption;
        //     Gate::define($section->name, function ($user) use ($section) {
        //         return $user->hasPermission($section->name);
        //     });
        // }
        // foreach ($sections as $section) {
        //     Gate::define($section->name, function ($user , Request $request) use ($section) {
        //         $host = $request->getHost();
        //         $company = Company::select('id' , 'company_id' , 'domain' , 'database_options')->where('domain' , $host)->first();
        //         $db = json_decode($company->database_options );
        //         Config::set('database.connections.tenant.database', $db['dbname']);
        //         DB::purge('tenant');
        //         DB::reconnect('tenant');
        //         $guard = Auth::getDefaultDriver();

        //         if ($guard === 'web' && $user instanceof User) {
        //             return $user->hasPermission($section->name);
        //         }  elseif ($guard === 'admins' && $user instanceof Admin) {
        //             return $user->hasPermission($section->name);
        //         }

        //         return false;
        //     });
        // }
    }
}
