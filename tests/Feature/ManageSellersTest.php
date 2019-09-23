<?php

namespace Tests\Feature;

use Badenjki\Seller\Models\Store;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Webkul\Customer\Models\Customer;

class ManageSellersTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function admins_can_see_sellers(){

        $this->seed();

        // create a seller
        $seller = factory(Customer::class)->create([
            'store_id' => factory(Store::class)
        ]);

        // login as an admin
        $this->signIn('admin');

        $this->get('admin/marketplace/stores')->assertSee($seller->store->name);

    }

    /** @test */
    function admins_can_edit_stores(){

        $this->seed();

        $store = factory(Store::class)->create();

        $this->signIn('admin');

        $path = '/admin/marketplace/stores/edit/' . $store->id;

        $this->put($path, [
            'title' => 'different-one'
        ]);

        $store->refresh();

        $this->assertEquals('different-one', $store->title);

    }

    /** @test */
    function a_seller_can_edit_their_store(){

        $this->seed();

        // create a seller
        $seller = $this->signIn('seller');

        $store = $seller->store;

        $this->patch('/stores/edit/' . $store->id, [
            'title' => 'my own Store',
        ]);

        $store->refresh();

        $this->assertEquals('my own Store', $store->title);

    }



//    function a_product_can_belong_to_a_store(){
//
//        $this->assertTrue(true);
//
//    }

}
