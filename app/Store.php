<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Webkul\Customer\Models\Customer;

class Store extends Model
{

    protected $fillable = ['url'];

    public function sellers(){

        return $this->hasMany(Customer::class)->where('store_id', '<>', '0');

    }

    public function activate(){

        $this->is_active = 1;

    }

    public function inactivate(){

        $this->is_active = 0;

    }

    public function path(){

        return '/' . $this->url;

    }

    public function getRouteKeyName()
    {
        return 'url';
    }

}
