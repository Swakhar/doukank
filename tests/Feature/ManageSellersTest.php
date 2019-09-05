<?php

namespace Tests\Feature;

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
        ])->assertRedirect('/customer/login');

        $this->assertDatabaseHas('customers', [
            'first_name' => 'abdo'
        ]);

        $customer = Customer::findOrFail(1);

        $this->assertTrue($customer->isSeller());

    }

}
