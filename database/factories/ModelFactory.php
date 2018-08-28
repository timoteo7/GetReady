<?php

$factory->define(App\Banner::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'url_image' => $faker->word,
        'status' => $faker->randomElement($array = array ('ACTIVE','DISABLED','EXPIRED','WAITING','CONSUMED')),
        'type_id' => function () {
            return factory(App\Type::class)->create()->id;
        },
        'subtype_id' => function () {
            return factory(App\Subtype::class)->create()->id;
        },
        'payload' => $faker->text,
    ];
});
/*
$factory->define(App\Subtype::class, function (Faker\Generator $faker) {
    return [
        //'type_id' => $faker->randomNumber(),
        'type_id' => function () {
            return factory(App\Type::class)->create()->id;
        },
        'description' => $faker->word,
        'amount' => $faker->randomFloat(),
        'minutes' => $faker->numberBetween($min = 0, $max = 32767),
        'url_image' => $faker->word,

    ];
});*/

$factory->define(App\Account::class, function (Faker\Generator $faker) {
    return [
        'provider_id' => $faker->randomNumber(),
        'emission' => $faker->dateTimeBetween(),
        'amount' => $faker->randomFloat(),
        'order_id' => $faker->randomNumber(),
        'expiration' => $faker->date(),
        'payment' => $faker->date(),
        'discount' => $faker->randomFloat(),
        'fine' => $faker->randomFloat(),
        'issuer' => $faker->word,
        'recipient' => $faker->word,
        'note' => $faker->text,
    ];
});

/*
$factory->define(App\Type::class, function (Faker\Generator $faker) {
    return [
        'description' => $faker->word,
        'url_image' => $faker->word,
    ];
});*/

$factory->define(App\Provider::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'home_phone' => $faker->word,
        'mobile_phone' => $faker->word,
        'rg' => $faker->word,
        'cpf' => $faker->word,
        'main_place_id' => function () {
            return factory(App\Place::class)->create()->id;
       },
        'url_image' => $faker->word,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'gender' => $faker->numberBetween($min = 0, $max = 32767),
        'bank' => $faker->word,
        'ag' => $faker->word,
        'account' => $faker->word,
        'variation' => $faker->word,
    ];
});

$factory->define(App\Place::class, function (Faker\Generator $faker) {
    return [
        'individual_id' => $faker->randomNumber(),
        'profile' => $faker->boolean,
        'latitude'=> $faker->latitude($min = -23.9673069 , $max = -23.935), 
        'longitude'=> $faker->longitude($min = -46.3672751, $max =  -46.3208949),
        'street' => $faker->streetName,
        'number' => $faker->word,
        'district' => $faker->word,
        'city' => $faker->city,
        'state' => $faker->word,
        'postcode' => $faker->postcode,
    ];
});



$factory->define(App\Coupon::class, function (Faker\Generator $faker) {
	$value = NULL;
	$percentage = NULL;
    if ($faker->boolean($chanceOfGettingTrue = 50))
    $value=($faker->numberBetween($min = 1, $max = 10)*5);
    else $percentage=$faker->numberBetween($min = 1, $max = 25);

    return [
        'code' => generate_password(),
        'value' => $value,
        'percentage' => $percentage,
        'validity_start' => $faker->date(),
        'validity_end' => $faker->date(),
        'status'=> $faker->randomElement($array = array ('ACTIVE','DISABLED','EXPIRED','WAITING','CONSUMED')),
    ];
});
/*
$factory->define(App\Activity::class, function (Faker\Generator $faker) {
    return [
        'provider_id' => function () {
             return factory(App\Provider::class)->create()->id;
        },
        'subtype_id' => function () {
             return factory(App\Subtype::class)->create()->id;
        },
        'amount' => $faker->randomFloat(),
        'minutes' => $faker->numberBetween($min = 0, $max = 32767),
    ];
});*/

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'title' => $faker->word,
        'home_phone' => $faker->word,
        'mobile_phone' => $faker->word,
        'rg' => $faker->word,
        'cpf' => $faker->word,
        'main_place_id' => function () {
            return factory(App\Place::class)->create()->id;
        },
        'url_image' => $faker->word,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt($faker->password),
        'remember_token' => str_random(10),
        'api_token' => $faker->word,
    ];
});

$factory->define(App\Order::class, function (Faker\Generator $faker) {
    return [
        'place_id' => function () {
            return factory(App\Place::class)->create()->id;
       },
        'customer_id' => function () {
             return factory(App\Customer::class)->create()->id;
        },
        'subtype_id' => $faker->numberBetween($min = 1, $max = 50),
        'provider_id' => function () {
            return factory(App\Provider::class)->create()->id;
       },
        /*'activitie_id' => function () {
             return factory(App\Activity::class)->create()->id;
        },*/
        'schedule' => $faker->dateTimeBetween(),
        'status' => $faker->randomElement($array = array ('WAITING_PROVIDER_POSTULATION','WAITING_CUSTOMER_PAYMENT','WAITING_CUSTOMER_PAYMENT_CONFIRMATION','WAITING_PROVIDER_CHECKOUT','WAITING_CUSTOMER_CHECKOUT','PROVIDER_PAYMENT_READY','PROVIDER_PAYMENT_DONE')),
        'discount' => $faker->randomFloat(),
        'travel_fee' => $faker->randomFloat(),
        'transaction_code' => $faker->word,
        'account_id' => $faker->randomNumber(),
        'note' => $faker->text,
    ];
});

