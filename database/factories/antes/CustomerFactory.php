<?php

//use Faker\Generator as Faker;

$autoIncrement = autoIncrement();

$factory->define(App\Customer::class, function (Faker\Generator $faker) use ($autoIncrement)
{
    $faker->addProvider(new Faker\Provider\pt_BR\Person($faker));
    $autoIncrement->next();

    return [
        'name'=> $faker->name,
        'email'=> $faker->email,
        //'title'=> '',
        'home_phone'=> $faker->phoneNumber,
        'mobile_phone'=> $faker->phoneNumber,
        'rg'=> $faker->rg,
        'cpf'=> $faker->cpf,
        'main_place_id'=> $autoIncrement->current(),
        //'url_photo'=> '',
        //'password'=> '',
    ];



});

