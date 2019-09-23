<?php

namespace Badenjki\Seller\Models;

use Illuminate\Database\Eloquent\Model;
use Badenjki\Seller\Contracts\Store as StoreContract;
use Webkul\Core\Eloquent\TranslatableModel;

class Store extends TranslatableModel implements StoreContract
{

    public $translatedAttributes = ['title'];

    protected $fillable = ['url'];

    protected $with = ['translations'];

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

        return '/' . $this->id;

    }

//    public function getRouteKeyName()
//    {
////        return 'url';
//    }

}
