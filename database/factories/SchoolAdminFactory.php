<?php

namespace Database\Factories;

use App\Models\School;
use App\Models\SchoolAdmin;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class SchoolAdminFactory extends Factory
{
    protected $model = SchoolAdmin::class;

    public function definition(): array
    {
        return [
            'school_id' => School::factory(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'phone' => fake()->phoneNumber(),
            'role' => fake()->randomElement(['vice_principal', 'coordinator', 'administrator']),
            'join_date' => fake()->dateTimeBetween('-2 years', 'now'),
            'address' => fake()->address(),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}