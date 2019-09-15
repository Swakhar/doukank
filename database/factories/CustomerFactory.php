<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

namespace Webkul\Customer\Database\Factories;

use Faker\Generator as Faker;
use Webkul\Customer\Models\Customer as Customer;


$factory->define(Customer::class, function (Faker $faker) {
    return [
        'channel_id' => 1,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'password' => $pass = $faker->password,
        'phone' => $faker->phoneNumber,
    ];
});
