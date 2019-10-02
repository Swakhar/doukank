<?php

namespace Badenjki\Seller\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Attribute\Models\AttributeProxy;
use Webkul\Channel\Models\ChannelProxy;
use Badenjki\Seller\Contracts\StoreAttributeValue as StoreAttributeValueContract;

class StoreAttributeValue extends Model implements StoreAttributeValueContract{

    public $timestamps = false;



}