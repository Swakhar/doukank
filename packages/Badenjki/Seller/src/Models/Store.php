<?php

namespace Badenjki\Seller\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{

    protected $guarded = [];

    public function sellers(){

        return $this->hasMany(Seller::class);

    }

    public function activate(){

        $this->status = 1;

    }

    public function inactivate(){

        $this->status = 0;

    }

    public function isActive(){

        return $this->status;

    }

    public function path(){

        return '/' . $this->url;

    }

    public function getRouteKeyName()
    {
        return 'url';
    }

}
