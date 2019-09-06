<?php

namespace Tests\Unit;

use App\Store;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Webkul\Customer\Models\Customer;

class SellerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function it_can_have_a_store(){

        $this->withoutExceptionHandling();

        $store = Store::create([
            'url' => 'customer-url',
        ]);

        $customer = Customer::create([
            'first_name' => 'abdo',
            'last_name' => 'badenjki',
            'email' => 'abdoo@badenjki.co',
            'password' => '123123',
            'channel_id' => '1',
            'password_confirmation' => '123123',
            'store_id' => $store->id,
        ]);

        $this->assertInstanceOf(Store::class, $customer->store);

    }


}
