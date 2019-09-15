<?php

namespace Badenjki\Seller\Providers;

use Konekt\Concord\BaseModuleServiceProvider;

class ModuleServiceProvider extends BaseModuleServiceProvider
{
    protected $models = [
        \Badenjki\Seller\Models\Seller::class,
        \Badenjki\Seller\Models\Store::class,
    ];
}