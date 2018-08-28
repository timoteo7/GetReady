<?php

//use Faker\Generator as Faker;

$factory->define(App\Place::class, function (Faker\Generator $faker) {

    $faker->addProvider(new Faker\Provider\pt_BR\Person($faker));

    return [
        
        //'individual_id'=>,
        //'profile'=>,
        'latitude'=> $faker->latitude($min = -23.9673069 , $max = -23.935), 
        'longitude'=> $faker->longitude($min = -46.3672751, $max =  -46.3208949),
        
            'street' => $faker->streetName,
            'number' => $faker->buildingNumber,
            'district' => $faker->region,
            'city' => $faker->city,
            'state' => $faker->stateAbbr,
        
        'postcode'=> $faker->postcode,

    ];
});
