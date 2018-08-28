<?php

use Faker\Generator as Faker;

$factory->define(App\Banner::class, function (Faker $faker) {
    return [
        'name'=> $faker->word,
        'status' => 'ACTIVE',
		'type_id'=> $faker->numberBetween($min = 1, $max = 6),
		'subtype_id'=> $faker->numberBetween($min = 1, $max = 42),
		'url_image'=> $faker->imageUrl($width = 468, $height = 60) ,
    ];
});
