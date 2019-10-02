<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageCatalogTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    function admin_can_see_products_categories(){

        $this->assertTrue(true);

    }

}
