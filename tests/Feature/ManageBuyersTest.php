<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageBuyersTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function a_phone_number_is_required(){

        $this->seed();

        $this->post('customer/register', [
            'first_name' => 'abdo',
            'last_name' => 'badenjki',
            'email' => 'abdo@badenjki.co',
            'password' => '123123',
            'password_confirmation' => '123123',
            'is_seller' => '1',
            'store_url' => 'abdo-store',
        ])->assertSessionHasErrors('phone');

    }

    /** @test */
    function a_buyer_can_have_a_phone_number(){

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
            'phone' => '123123123',
        ]);

    }


}
