<?php

namespace Tests;

use Badenjki\Seller\Models\Seller;
use Badenjki\Seller\Models\Store;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Webkul\Customer\Models\Customer;
use Webkul\User\Models\Admin;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function signIn(string $type = 'customer'){

        if ($type == 'admin'){

            // assuming seeding has already been done
            $this->post('admin/login', [
                'email' => 'admin@example.com',
                'password' => 'admin123'
            ]);

            return $admin = Admin::where('email', '=', 'admin@example.com')->first();

        } elseif ($type == 'seller') {

            $customer = factory(Customer::class)->raw([
                'store_id' => factory(Store::class),
            ]);

        } elseif ($type == 'customer') { // customer

            $customer = factory(Customer::class)->raw();

        }

        $customer['password_confirmation'] = $customer['password'];

        $this->post(route('customer.register.create'), $customer);

        $this->post(route('customer.session.create'), [
            'email' => $customer['email'],
            'password' => $customer['password'],
        ]);

            return $user = Customer::where('email', '=', $customer['email'])->first();

    }

}
