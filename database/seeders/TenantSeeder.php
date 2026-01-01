<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tenant; // استيراد الموديل
use Faker\Factory as Faker;

class TenantSeeder extends Seeder
{
    /**
     * تشغيل Seeder لإضافة 50,000 سجل.
     */
    public function run()
    {
         
 
                $faker = Faker::create();
        
                for ($i = 0; $i < 50000; $i++) {  
                    Tenant::create([
                        'name' => $faker->name,
                        'gender' => $faker->randomElement(['male', 'female']),
                        'status' => $faker->randomElement(['active', 'inactive']),
                        'id_number' => $faker->unique()->numerify('############'),
                        'registration_no' => $faker->unique()->numerify('REG-#####'),
                        'contact_no' => $faker->phoneNumber,
                        'email1' => $faker->unique()->safeEmail,
                        'address1' => $faker->address,
                        'city' => $faker->city,
                        'state' => $faker->state,
                        'country_id' => rand(1, 6),  
                        'nationality_id' => rand(1, 6),
                        'passport_no' => $faker->optional()->numerify('P########'),
                        'company_name' => $faker->company,
                    ]);
                }
            }
        }
           

