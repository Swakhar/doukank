<?php

namespace Badenjki\Seller\Repositories;

use Illuminate\Container\Container as App;
use DB;
use Illuminate\Support\Facades\Event;
use Webkul\Core\Eloquent\Repository;

/**
 * Store Category Repository
 *
 * @author Khaled Badenjki <m.k.badenjki@gmail.com>
 * @copyright 2019 Doukank.com (http://www.doukank.com)
 */

class StoreCategoryRepository extends Repository{

    public function __construct(App $app)
    {
        parent::__construct($app);
    }

    function model()
    {
        return 'Badenjki\Seller\Contracts\StoreCategory';
    }

    public function create(array $data){

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

        $storeCategory = $this->model->create($data);

        return $storeCategory;

    }


}