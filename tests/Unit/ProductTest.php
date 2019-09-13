<?php

namespace Tests\Unit;

use App\Store;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Webkul\Product\Models\Product;

class ProductTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function it_can_belong_to_a_store(){

        $this->withoutExceptionHandling();

        $this->seed();

        $store = Store::create([
            'url' => 'sample-store'
        ]);

        $product = Product::create([
            'sku' => 'sample-product',
            'type' => 'simple',
            'attribute_family_id' => 1,
            'store_id' => $store->id,
        ]);

        $this->assertInstanceOf(Store::class, $product->store);

    }

}
