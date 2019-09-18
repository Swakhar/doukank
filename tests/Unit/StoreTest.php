<?php

namespace Tests\Unit;

use Badenjki\Seller\Models\Store;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Webkul\Customer\Models\Customer;

class StoreTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function it_must_have_a_path(){

        $store = factory(Store::class)->create([
            'url' => 'some-url',
        ]);

        $this->assertEquals('/some-url', $store->path());

    }

    /** @test */
    function its_status_can_be_changed(){

        $store = factory(Store::class)->create();

        // by default, a store is not active.
        $this->assertEquals(0, $store->isActive());

        // after activation,
        $store->activate();

        // its status is now active
        $this->assertEquals(1, $store->isActive());

        // if inactivated,
        $store->inactivate();

        // it becomes inactive again.
        $this->assertEquals(0, $store->isActive());

    }


}
