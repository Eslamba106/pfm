<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{    
    public function run()
    {
        \App\Models\Role::updateOrCreate(['id' => 1], ['name' => 'user', 'caption' => 'User role', 'is_admin' => 0, 'created_at' => time()]);
        \App\Models\Role::updateOrCreate(['id' => 2], ['name' => 'admin_2', 'caption' => 'Admin role', 'is_admin' => 1, 'created_at' => time()]);
        \App\Models\Role::updateOrCreate(['id' => 3], ['name' => 'admin', 'caption' => 'Super Admin role', 'is_admin' => 1, 'created_at' => time()]);
    }
}
