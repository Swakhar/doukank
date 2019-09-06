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

        $this->withoutExceptionHandling();

        $this->seed();

        $this->assertTrue(true);

        $this->post('customer/register', [
            'first_name' => 'abdo',
            'last_name' => 'badenjki',
            'email' => 'abdo@badenjki.co',
            'password' => '123123',
            'password_confirmation' => '123123',
            'is_seller' => '1',
            'store-url' => 'abdo-store'
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



}
