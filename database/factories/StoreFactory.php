<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Badenjki\Seller\Models\Store as Store;


$factory->define(Store::class, function (Faker $faker) {
    return [
        'url' => $faker->unique()->word,
        'title' => $faker->company,
        'status' => 1,
        'category_id' => 1,
        'type' => 'furniture',
    ];
});
