<?php

use Faker\Generator as Faker;

$factory->define(App\Subtype::class, function (Faker $faker) {
    return [
        'description'=> $faker->word,
        'url_image'=> $faker-> imageUrl($width = 100, $height = 100),
        'type_id'=> $faker->numberBetween($min = 1, $max = 100),
    ];
});
