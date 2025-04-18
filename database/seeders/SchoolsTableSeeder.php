<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{
    public function run(): void
    {
        $schools = [
            [
                'name' => 'Sunrise Academy',
                'email' => 'info@sunriseacademy.edu',
                'phone' => '123-456-7890',
                'address' => '123 Education Lane',
                'city' => 'San Francisco',
                'state' => 'CA',
                'country' => 'USA',
                'postal_code' => '94105',
                'website' => 'https://sunriseacademy.edu',
                'description' => 'A leading private school focused on academic excellence',
                'status' => 'active',
            ],
            [
                'name' => 'Global Learning Institute',
                'email' => 'contact@globallearning.edu',
                'phone' => '987-654-3210',
                'address' => '456 Knowledge Street',
                'city' => 'Boston',
                'state' => 'MA',
                'country' => 'USA',
                'postal_code' => '02108',
                'website' => 'https://globallearning.edu',
                'description' => 'International school with diverse curriculum',
                'status' => 'active',
            ],
        ];

        foreach ($schools as $school) {
            School::create($school);
        }

        School::factory(8)->create();
    }
}
