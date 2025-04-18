<?php

namespace Database\Factories;

use App\Models\Business;
use Illuminate\Database\Eloquent\Factories\Factory;

class BusinessFactory extends Factory
{
    protected $model = Business::class;

    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'email' => fake()->unique()->companyEmail(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->streetAddress(),
            'city' => fake()->city(),
            'state' => fake()->state(),
            'country' => fake()->country(),
            'postal_code' => fake()->postcode(),
            'website' => fake()->url(),
            'description' => fake()->paragraph(),
            'business_type' => fake()->randomElement(['Technology', 'Retail', 'Manufacturing', 'Services', 'Healthcare']),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}