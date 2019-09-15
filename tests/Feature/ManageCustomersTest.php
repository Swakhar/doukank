<?php

namespace Tests\Feature;

use Badenjki\Seller\Models\Store;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Webkul\Customer\Models\Customer;

class ManageCustomersTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function customer_phone_number_is_required(){

        $this->seed();

        $this->post(route('customer.register.index'), factory(Customer::class)->raw([
            'phone' => '',
        ]))->assertSessionHasErrors('phone');

    }

    /** @test */
    function customer_can_become_a_seller_by_creating_a_store(){

        $this->seed();

        $customer = $this->signIn();

        $store = factory(Store::class)->raw();

        $this->post(route('seller.store.store'), $store);

        $this->assertDatabaseHas('stores', $store);

    }

}
