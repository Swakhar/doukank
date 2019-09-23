<?php

namespace Badenjki\Seller\Repositories;

use Illuminate\Container\Container as App;
use DB;
use Illuminate\Support\Facades\Event;
use Webkul\Core\Eloquent\Repository;
use Webkul\Attribute\Repositories\AttributeRepository;
use Webkul\Attribute\Repositories\AttributeOptionRepository;
use Badenjki\Seller\Models\StoreAttributeValue;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Storage;

/**
 * Store Repository
 *
 * @author Khaled Badenjki <m.k.badenjki@gmail.com>
 * @copyright 2019 Doukank.com (http://www.doukank.com)
 */

class StoreRepository extends Repository{

    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    function model()
    {
        return 'Badenjki\Seller\Contracts\Store';
    }

    public function create(array $data){

//        Event::fire('marketplace.store.create.before');

        if(isset($data['locale']) && $data['locale'] == 'all'){

            $model = app()->make($this->model());

            foreach (core()->getAllLocales() as $locale){

                foreach ($model->translatedAttributes as $attribute){

                    if (isset($data[$attribute])){

                        $data[$locale->code][$attribute] = $data[$attribute];

                    }

                }

            }

        }

        $store = $this->model->create($data);

//      Event::fire('marketplace.store.create.after');

        return $store;

    }


}