<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            BusinessesTableSeeder::class,
            BusinessAdminsTableSeeder::class,
            SchoolsTableSeeder::class,
            SchoolAdminsTableSeeder::class,
        ]);
    }
}
