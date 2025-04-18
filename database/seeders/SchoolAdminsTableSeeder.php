<?php

namespace Database\Seeders;

use App\Models\SchoolAdmin;
use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SchoolAdminsTableSeeder extends Seeder
{
    public function run(): void
    {
        $admins = [
            [
                'school_id' => 1,
                'name' => 'John Principal',
                'email' => 'principal@sunriseacademy.edu',
                'password' => Hash::make('password'),
                'phone' => '123-456-7890',
                'role' => 'principal',
                'join_date' => '2023-01-01',
                'address' => '123 Principal Ave',
                'status' => 'active',
            ],
            [
                'school_id' => 2,
                'name' => 'Sarah Administrator',
                'email' => 'admin@globallearning.edu',
                'password' => Hash::make('password'),
                'phone' => '987-654-3210',
                'role' => 'administrator',
                'join_date' => '2023-02-01',
                'address' => '456 Admin Street',
                'status' => 'active',
            ],
        ];

        foreach ($admins as $admin) {
            SchoolAdmin::create($admin);
        }

        // Create random admins for each school
        School::all()->each(function ($school) {
            SchoolAdmin::factory()->count(3)->create([
                'school_id' => $school->id,
            ]);
        });
    }
}