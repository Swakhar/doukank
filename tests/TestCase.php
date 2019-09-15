<?php

namespace Tests;

use Badenjki\Seller\Models\Seller;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Webkul\Customer\Models\Customer;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn(){

        $user = factory(Customer::class)->create();

        $this->actingAs($user);

        return $user;

    }

}
