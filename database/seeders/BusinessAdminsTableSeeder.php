<?php

namespace Database\Seeders;

use App\Models\BusinessAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BusinessAdminsTableSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'business_id' => 1,
                'name' => 'John Manager',
                'email' => 'john@techsolutions.com',
                'password' => Hash::make('password'),
                'phone' => '1234567890',
                'status' => 'active',
            ],
            [
                'business_id' => 2,
                'name' => 'Sarah Director',
                'email' => 'sarah@greenenergy.com',
                'password' => Hash::make('password'),
                'phone' => '0987654321',
                'status' => 'active',
            ],
        ];

        foreach ($admins as $admin) {
            BusinessAdmin::create($admin);
        }

        BusinessAdmin::factory(8)->create();
    }
}
