<?php

use Faker\Generator as Faker;

$factory->define(App\Property::class, function (Faker $faker) {
    DB::table('properties')->insert([
        'address_1' => $faker->address,
        'address_2' => $faker->address,
        'city' 		=> $faker->city,,
        'postcode' 	=> $faker->postcode,, 
    ]);
});
