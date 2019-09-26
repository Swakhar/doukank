<?php

namespace Badenjki\Seller\Models;

use Illuminate\Database\Eloquent\Model;
use Badenjki\Seller\Contracts\StoreCategoryTranslation as StoreCategoryTranslationContract;

class StoreCategoryTranslation extends Model implements StoreCategoryTranslationContract{

    public $timestamps = false;

    protected $fillable = ['name', 'description', 'meta_title', 'meta_keywords', 'meta_description'];

}