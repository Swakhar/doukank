<?php

namespace Badenjki\Seller\Models;

use Illuminate\Database\Eloquent\Model;
use Badenjki\Seller\Contracts\Store as StoreContract;
use Webkul\Core\Eloquent\TranslatableModel;

class Store extends TranslatableModel implements StoreContract
{

    public $translatedAttributes = ['name', 'address', 'description', 'return_policy', 'shipping_policy', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $fillable = ['url', 'tax_number', 'status', 'featured', 'state_id', 'is_physical', 'category_id', 'phone', 'geolocation', 'is_visible'];

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
