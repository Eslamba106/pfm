<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Config;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        try {
            // تعيين قاعدة البيانات الديناميكية
            $tenantDB = 'finexerp_67';
            
            // التحقق من وجود الاتصال أولاً
            if (!array_key_exists('tenant', config('database.connections'))) {
                throw new \Exception('Tenant connection not configured');
            }
    
            // تحديث إعدادات الاتصال
            Config::set('database.connections.tenant.database', $tenantDB);
            DB::purge('tenant');
            DB::reconnect('tenant');
    
            // التحقق من إمكانية الاتصال
            DB::connection('tenant')->getPdo();
            Log::info('Current DB: ' . DB::connection('tenant')->getDatabaseName());
            // أو
             // تشغيل السيدرات
            $this->call(SectionsTableSeeder::class);
            $this->call(PermissionsTableSeeder::class);
            DB::connection('tenant')->commit();

        } catch (\Exception $e) {
            Log::error('Tenant Seeder Error: '.$e->getMessage());
            throw $e; 
        }
        // $this->call(RolesTableSeeder::class);
        // Config::set('database.connections.tenant.database', 'finexerp_67');
        // DB::purge('tenant'); 
        // DB::reconnect('tenant');
        // $this->call(SectionsTableSeeder::class);
        // $this->call(PermissionsTableSeeder::class);
        // \App\Models\User::factory()->create([
        //     'name' => 'Eslam',
        //     'user_name' => 'admin',
        //     'password' => Hash::make('12345'),
        //     'role_id'=> 1,
        //     'role_name'=> 'admin',
        // ]);
    }
}
