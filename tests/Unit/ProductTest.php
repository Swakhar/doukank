<?php

namespace Tests\Unit;

use Badenjki\Seller\Models\Store;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Webkul\Product\Models\Product;

class ProductTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function it_can_belong_to_a_store(){

        $store = factory(Store::class)->create();

        $product = factory(Product::class)->create([
            'store_id' => $store->id,
        ]);

        $this->assertEquals($store->title, $product->store->title);

    }

}
