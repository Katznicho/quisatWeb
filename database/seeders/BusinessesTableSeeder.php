<?php

namespace Database\Seeders;

use App\Models\Business;
use Illuminate\Database\Seeder;

class BusinessesTableSeeder extends Seeder
{
    public function run(): void
    {
        $businesses = [
            [
                'name' => 'Tech Solutions Inc',
                'email' => 'info@techsolutions.com',
                'phone' => '1234567890',
                'address' => '123 Tech Street',
                'city' => 'San Francisco',
                'state' => 'CA',
                'country' => 'USA',
                'postal_code' => '94105',
                'website' => 'https://techsolutions.com',
                'description' => 'Leading technology solutions provider',
                'business_type' => 'Technology',
                'status' => 'active',
            ],
            [
                'name' => 'Green Energy Co',
                'email' => 'contact@greenenergy.com',
                'phone' => '0987654321',
                'address' => '456 Energy Avenue',
                'city' => 'Austin',
                'state' => 'TX',
                'country' => 'USA',
                'postal_code' => '73301',
                'website' => 'https://greenenergy.com',
                'description' => 'Renewable energy solutions',
                'business_type' => 'Energy',
                'status' => 'active',
            ],
        ];

        foreach ($businesses as $business) {
            Business::create($business);
        }

        Business::factory(8)->create();
    }
}
