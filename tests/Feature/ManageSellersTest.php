<?php

namespace Tests\Feature;

use App\Store;
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
    function a_user_can_be_a_seller(){

        $this->seed();

        $this->post('customer/register', [
            'first_name' => 'abdo',
            'last_name' => 'badenjki',
            'email' => 'abdo@badenjki.co',
            'password' => '123123',
            'password_confirmation' => '123123',
            'is_seller' => '1',
            'store_url' => 'abdo-store',
            'phone' => '123123123',
        ])->assertRedirect('/customer/login');

        $this->assertDatabaseHas('customers', [
            'first_name' => 'abdo'
        ]);

        $customer = Customer::findOrFail(1);

        $this->assertTrue($customer->isSeller());

        $this->assertInstanceOf(Store::class, $customer->store);

        // TODO: move the following tests to unit tests, after creating factories to make your life easier.

        // test: the store is inactive by default.
        $this->assertEquals(0, $customer->store->is_active);

        // test: store can be activated.
        $customer->store->activate();

        $this->assertEquals(1, $customer->store->is_active);

        // test: store can be inactivated.
        $customer->store->inactivate();

        $this->assertEquals(0, $customer->store->is_active);

    }

    /** @test */
    function admins_can_see_sellers(){

        $this->seed();

        // create a seller
        $this->post('customer/register', [
            'first_name' => 'abdo',
            'last_name' => 'badenjki',
            'email' => 'abdo@badenjki.co',
            'phone' => '0123123123',
            'password' => '123123',
            'password_confirmation' => '123123',
            'is_seller' => '1',
            'store_url' => 'abdo-store',
        ]);

        // login as an admin
        $this->post('admin/login', [
            'email' => 'admin@example.com',
            'password' => 'admin123'
        ])->assertRedirect('admin/dashboard');

        $this->get('admin/marketplace/sellers')->assertSee('abdo');

    }

    /** @test */
    function a_user_can_create_and_see_a_store(){

        $this->seed();

        $this->post('customer/register', [
            'first_name' => 'khaled',
            'last_name' => 'badenjki',
            'email' => 'khaled@badenjki.co',
            'password' => '123123',
            'password_confirmation' => '123123',
            'is_seller' => '1',
            'store_url' => 'abdo-store',
            'phone' => '123123123',
        ])->assertRedirect('/customer/login');

        $this->post('/customer/login', [
            'email' => 'khaled@badenjki.co',
            'password' => '123123',
        ])->assertStatus(302)->assertRedirect('/customer/account/profile');

        $store = Store::find(1)->first();

        $this->get($store->path())->assertStatus(200);

        $this->get($store->path())->assertSee($store->url);

    }

    /** @test */
    function a_user_can_edit_their_store(){

        $this->seed();

        $this->post('customer/register', [
            'first_name' => 'khaled',
            'last_name' => 'badenjki',
            'email' => 'khaled@badenjki.co',
            'password' => '123123',
            'password_confirmation' => '123123',
            'is_seller' => '1',
            'store_url' => 'abdo-store',
            'phone' => '123123123',
        ])->assertRedirect('/customer/login');

        $this->post('/customer/login', [
            'email' => 'khaled@badenjki.co',
            'password' => '123123',
        ])->assertStatus(302)->assertRedirect('/customer/account/profile');

        $store = Store::find(1)->first();

        $this->patch($store->path() . '/edit', [
            'title' => 'Khaled Store',
        ]);

        $store->refresh();

        $this->assertEquals($store->title, 'Khaled Store');

    }

//    function a_product_can_belong_to_a_store(){
//
//        $this->assertTrue(true);
//
//    }

}
