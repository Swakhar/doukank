<?php

namespace Badenjki\Seller\Repositories;

use Illuminate\Container\Container as App;
use DB;
use Illuminate\Support\Facades\Event;
use Webkul\Core\Eloquent\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Storage;

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

        Event::fire('marketplace.store.create.before');

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

      Event::fire('marketplace.store.create.after');

        return $store;

    }

    /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute = "id")
    {
        $store = $this->find($id);

        Event::fire('marketplace.store.update.before', $id);

        $store->update($data);

        $this->uploadImages($data, $store);

        Event::fire('marketplace.store.update.after', $id);

        return $store;
    }

    /**
     * @param array $data
     * @param mixed $store
     * @return void
     */
    public function uploadImages($data, $store, $type = "image")
    {
        if (isset($data[$type])) {
            $request = request();

            foreach ($data[$type] as $imageId => $image) {
                $file = $type . '.' . $imageId;
                $dir = 'store/' . $store->id;

                if ($request->hasFile($file)) {
                    if ($store->{$type}) {
                        \Illuminate\Support\Facades\Storage::delete($store->{$type});
                    }

                    $store->{$type} = $request->file($file)->store($dir);
                    $store->save();
                }
            }
        } else {
            if ($store->{$type}) {
                Storage::delete($store->{$type});
            }

            $store->{$type} = null;
            $store->save();
        }
    }



}