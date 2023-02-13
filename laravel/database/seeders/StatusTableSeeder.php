<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('registration_status')->insert([
            'id' => 1,
            'name' => 'Signed up',
        ]);

        DB::table('registration_status')->insert([
            'id' => 2,
            'name' => 'Waiting for payment',
        ]);

        DB::table('registration_status')->insert([
            'id' => 3,
            'name' => 'Registration complete',
        ]);

        DB::table('registration_status')->insert([
            'id' => 4,
            'name' => 'Waitlist',
        ]);

        DB::table('registration_status')->insert([
            'id' => 5,
            'name' => 'Canceled',
        ]);

        DB::table('registration_status')->insert([
            'id' => 6,
            'name' => 'Refunded',
        ]);
    }
}
