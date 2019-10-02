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
    function a_customer_phone_number_is_required(){

        $this->seed();

        $this->post(route('customer.register.index'), factory(Customer::class)->raw([
            'phone' => '',
        ]))->assertSessionHasErrors('phone');

    }

    /** @test */
    function a_customer_can_become_a_seller_by_creating_a_store(){

        $this->seed();

        // create a customer
        $user = $this->signIn();

        // by default, the customer is not a seller
        $this->assertFalse($user->isSeller());

        // when a customer creates a store,
        $this->post('/stores/create', $store = factory(Store::class)->raw());

        // they become a seller
        $this->assertTrue($user->refresh()->isSeller());

        // and the store is added to the database under table 'stores'.
        $this->assertDatabaseHas('stores', $store);

    }

    /** @test */
    function a_guest_can_see_a_store(){

        $this->seed();

        $store = factory(Store::class)->create();

        $this->get($store->path())->assertSuccessful();

        $this->get($store->path())->assertSee($store->title);

    }


}
