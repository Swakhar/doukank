<?php

namespace Tests\Unit;

use Badenjki\Seller\Models\Store;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Webkul\Customer\Models\Customer;

class SellerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function it_must_have_a_path(){

        $store = Store::create([
            'url' => 'customer-url',
        ]);

        $this->assertEquals('/customer-url', $store->path());

    }


}
