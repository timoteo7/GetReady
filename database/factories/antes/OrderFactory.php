<?php

use Faker\Generator as Faker;

$factory->define(App\Order::class, function (Faker $faker) {

    //DateTimeProvider::setDefaultTimezone('America/Sao_Paulo');

    return [
        'place_id'=> $faker->numberBetween($min = 1, $max = 50),
        'customer_id'=> $faker->numberBetween($min = 1, $max = 50),
        'activitie_id'=> $faker->numberBetween($min = 1, $max = 100),
        //'schedule'=>  \Carbon\Carbon::createFromFormat('d/M/Y:H:i:s',$faker->date($format = 'Y-m-d', $min = '+1 days', $max = '+1 week')),
        'schedule'=>  \Carbon\Carbon::parse(\Carbon\Carbon::createFromTimestamp($faker->dateTimeBetween($startDate = '+1 days', $endDate = '+1 week', $timezone = 'America/Sao_Paulo' )->getTimeStamp()))->addHours( $faker->numberBetween( 1, 8 )),
    ];
});
