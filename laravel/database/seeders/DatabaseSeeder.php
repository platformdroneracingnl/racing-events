<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionTableSeeder::class,
            CountriesTableSeeder::class,
            OrganizationsTableSeeder::class,
            LocationsTableSeeder::class,
            StatusTableSeeder::class,

            UserTableSeeder::class,
        ]);
    }
}
