<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class OrganizationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organizations')->insert([
            'id' => 1,
            'name' => 'Dutch Drone Squad',
            'short_name' => 'DDS',
        ]);

        DB::table('organizations')->insert([
            'id' => 2,
            'name' => 'Total Drone Experience',
            'short_name' => 'TDX',
        ]);

        DB::table('organizations')->insert([
            'id' => 3,
            'name' => 'Team MRO',
            'short_name' => 'MRO',
        ]);

        DB::table('organizations')->insert([
            'id' => 4,
            'name' => 'DronEvents',
            'short_name' => 'DE',
        ]);

        DB::table('organizations')->insert([
            'id' => 5,
            'name' => 'Team Blobfish',
        ]);
    }
}
