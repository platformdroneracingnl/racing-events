<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('locations')->insert([
            'id'            => 1,
            'name'          => 'Sportpaleis Alkmaar',
            'house_number'  => '200',
            'street'        => 'Terborchlaan',
            'zip_code'      => '1816 LE',
            'city'          => 'Alkmaar',
            'province'      => 'Noord-Holland',
            'country_id'    => 151,
            'category'      => 'indoor',
            'latitude'      => '52.634736318304604',
            'longitude'     => '4.716487583680192',
        ]);

        DB::table('locations')->insert([
            'id'            => 2,
            'name'          => 'Vliegbasis Valkenburg',
            'house_number'  => '1',
            'street'        => '1e mientlaan',
            'zip_code'      => '2223 LG',
            'city'          => 'Katwijk aan Zee',
            'province'      => 'Zuid-Holland',
            'country_id'    => 151,
            'category'      => 'indoor',
            'latitude'      => '52.1712372',
            'longitude'     => '4.4107497',
        ]);
    }
}
