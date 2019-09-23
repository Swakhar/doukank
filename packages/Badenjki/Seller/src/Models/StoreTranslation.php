<?php


namespace Badenjki\Seller\Models;

use Illuminate\Database\Eloquent\Model;
use Badenjki\Seller\Contracts\StoreTranslation as StoreTranslationContract;

class StoreTranslation extends Model implements StoreTranslationContract
{
    public $timestamps = false;

    protected $fillable = ['title'];
}