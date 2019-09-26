<?php

namespace Badenjki\Seller\Models;

use Illuminate\Database\Eloquent\Model;
use Badenjki\Seller\Contracts\StoreCategory as StoreCategoryContract;
use Webkul\Core\Eloquent\TranslatableModel;


class StoreCategory extends TranslatableModel implements StoreCategoryContract
{

    public $translatedAttributes = ['name', 'description', 'meta_title', 'meta_keywords', 'meta_description'];

    protected $fillable = ['code'];

    public $timestamps = false;
}