<?php

//use Faker\Generator as Faker;

$autoIncrement = autoIncrement();

$factory->define(App\Provider::class, function (Faker\Generator $faker) 
use ($autoIncrement)
{
	$autoIncrement->next();
	$faker->addProvider(new Faker\Provider\pt_BR\Person($faker));
	
    return [
    'name'=> $faker->name,
	'email'=> $faker->email,
	'home_phone'=> $faker->phoneNumber,
	'mobile_phone'=> $faker->phoneNumber,
	'rg'=> $faker->rg,
	'cpf'=> $faker->cpf,
	'main_place_id'=> $autoIncrement->current(),

    ];
});
