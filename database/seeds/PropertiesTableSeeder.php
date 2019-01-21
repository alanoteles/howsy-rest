<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('properties')->insert([
    	[
	        'address_1' => '83 Upper St',
	        'address_2' => '',
	        'city' 		=> 'London',
	        'postcode' 	=> 'N1 0NU', 
            'latitude'  => null,
            'longitude' => null, 
	        'created_at' => Carbon::now(),
    	],
    	[
	        'address_1' => '54 Islington Park St',
	        'address_2' => '',
	        'city' 		=> 'London',
	        'postcode' 	=> 'N1 1PX', 
            'latitude'  => null,
            'longitude' => null, 
	        'created_at' => Carbon::now(),
    	],
        [
            'address_1' => '6a, Ballyree Drive',
            'address_2' => '',
            'city'      => 'Bangor',
            'postcode'  => 'BT19 7HW',
            'latitude'  => '54.6419915',
            'longitude' => '-5.6589993', 
            'created_at' => Carbon::now(),
        ],
        [
            'address_1' => '2 Bonnington Rd',
            'address_2' => '',
            'city'      => 'Peebles',
            'postcode'  => 'EH45 9HF', 
            'latitude'  => '55.64250699999999',
            'longitude' => '-3.1898606',
            'created_at' => Carbon::now(),
        ],
        [
            'address_1' => 'Eas Brae',
            'address_2' => '',
            'city'      => 'Isle Of Mull',
            'postcode'  => 'PA75 6QA', 
            'latitude'  => '56.6149597',
            'longitude' => '-6.0734487',
            'created_at' => Carbon::now(),
        ]
    ]);
    }
}
