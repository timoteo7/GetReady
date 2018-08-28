<?php

use Faker\Generator as Faker;

$factory->define(App\Activity::class, function (Faker $faker) {
    return [
		'provider_id'=> $faker->numberBetween($min = 1, $max = 100),
		'subtype_id'=> $faker->numberBetween($min = 1, $max = 42),
		'amount'=> ($faker->numberBetween($min = 3, $max = 20)*10) ,
		'minutes'=> ($faker->numberBetween($min = 2, $max = 18)*5) ,
    ];
});
