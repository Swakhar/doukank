<?php

namespace Webkul\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Core\Contracts\CountryState as CountryStateContract;
use Webkul\Core\Eloquent\TranslatableModel;


class CountryState extends TranslatableModel implements CountryStateContract
{

    public $translatedAttributes = ['name'];

    public $timestamps = false;
}