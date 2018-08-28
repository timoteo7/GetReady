<?php

use Faker\Generator as Faker;

$factory->define(App\Coupon::class, function (Faker $faker) {
	$value = NULL;
	$percentage = NULL;
if ($faker->boolean($chanceOfGettingTrue = 50))
$value=($faker->numberBetween($min = 1, $max = 10)*5);
else $percentage=$faker->numberBetween($min = 1, $max = 25);

    return [
        'code'=> generate_password() ,
        'value'=> $value ,
        'percentage' => $percentage,
        'status'=> 'ACTIVE' ,
    ];
});

	function generate_password ($length = 6)
   {
       //$characters = '234789abcdefghjkmnpqrtuvwxyzABCDEFHJKLMNPQRTUVWXYZ';
       $characters = '234789ABCDEFHJKLMNPQRTUVWXYZ';
       $charactersLength = strlen($characters);
       $randomString = '';
       for ($i = 0; $i < $length; $i++)
       {
           $randomString .= $characters[rand(0, $charactersLength - 1)];
       }
       return $randomString;
   }
