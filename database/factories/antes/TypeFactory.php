<?php

use Faker\Generator as Faker;

$factory->define(App\Type::class, function (Faker $faker) {
    return [
        'description'=> $faker->word,
        'url_image'=> $faker-> imageUrl($width = 100, $height = 100),
    ];
});
