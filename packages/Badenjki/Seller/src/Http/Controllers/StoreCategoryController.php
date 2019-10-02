<?php

namespace Badenjki\Seller\Http\Controllers;
use Badenjki\Seller\Repositories\StoreCategoryRepository as StoreCategory;

class StoreCategoryController extends Controller{

    protected $_config;

    protected $storeCategory;

    protected $locale;

    public function __construct(StoreCategory $storeCategory)
    {

        $this->storeCategory = $storeCategory;

        $this->_config = request('_config');

    }

    public function index(){

        $storeCategories = $this->storeCategory->all();

        return view($this->_config['view'], compact('storeCategories'));

    }

    public function create(){

        return view($this->_config['view']);

    }

    public function store(){

        $category = $this->storeCategory->create(request()->all());

        session()->flash('success', trans('admin::app.response.create-success', ['name' => 'Category']));

        return redirect()->route($this->_config['redirect']);

    }

}