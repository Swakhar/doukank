<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Webkul\Customer\Models\Customer;

$factory->define(Customer::class, function (Faker $faker) {

    return [
        'channel_id' => 1,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $faker->password,
        'phone' => $faker->phoneNumber,
    ];
});
