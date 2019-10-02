<?php

namespace Tests\Unit;

use Badenjki\Seller\Models\Store;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Webkul\Customer\Models\Customer;

class CustomerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function it_can_have_a_store(){

        $this->seed();

        $customer = $this->signIn();
        // before creating a store, the customer is not a seller
        $this->assertFalse($customer->isSeller());

        // create a store for the customer
        $customer->createStore($store = factory(Store::class)->raw());

        // the customer is now also a seller. Welcome to Doukank!
        $this->assertTrue($customer->isSeller());

        $this->assertEquals($store['title'], $customer->store->title);

    }

}
