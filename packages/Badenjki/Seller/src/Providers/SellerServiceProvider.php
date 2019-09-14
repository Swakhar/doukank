<?php

namespace Badenjki\Seller\Providers;

use Illuminate\Support\ServiceProvider;

class SellerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->make('Badenjki\Seller\Http\Controllers\RegistrationController');

    }
}
