<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;
use Webkul\Product\Models\Product as Product;
use Badenjki\Seller\Models\Store as Store;


$factory->define(Product::class, function (Faker $faker) {
    return [
        'sku' => $faker->word,
        'type' => 'simple',
        'attribute_family_id' => 1,
        'store_id' => factory(Store::class),
    ];
});
