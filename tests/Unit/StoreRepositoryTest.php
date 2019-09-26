<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Badenjki\Seller\Repositories\StoreRepository as Store;

class StoreRepositoryTest extends TestCase
{

    use RefreshDatabase;

    protected $store;

    /** @test
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    function it_can_create_a_store(){

        $this->seed();

        $this->store = new Store($this->app);

        $data = [
            'url' => 'something',
            'locale' => 'all',
        ];

        $this->store->create($data);

        $this->assertDatabaseHas('stores', ['url' => 'something']);

    }

    /** @test */
    function it_can_update_a_store(){

        $this->seed();

        $this->store = new Store($this->app);

        $this->store->create($data = [
            'url' => 'something',
            'locale' => 'all'
        ]);

        $this->assertDatabaseHas('stores', ['url' => 'something']);

        $this->store->update([
            'status' => '1'
        ], 1);

        $this->assertDatabaseHas('stores', ['status' => '1']);
    }


}
