<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Badenjki\Seller\Models\Seller as Seller;
use Badenjki\Seller\Models\Store;


$factory->define(Seller::class, function (Faker $faker) {
    return [
        'channel_id' => 1,
        'first_name' => $fname = $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $pass = $faker->password,
        'store_id' => factory(Store::class),
    ];
});
