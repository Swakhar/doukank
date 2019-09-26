<?php

namespace Badenjki\Seller\Http\Controllers;

use Badenjki\Seller\Models\Seller;
//use Badenjki\Seller\Models\Store;
use Illuminate\Http\Request;
use Webkul\Customer\Repositories\CustomerRepository as Customer;
use Badenjki\Seller\Repositories\StoreRepository as Store;

class StoreController extends Controller
{

    protected $_config;

    protected $locale;

    protected $customer;

    /**
     * StoreRepository object
     *
     * @var array
     */
    protected $store;

    public function __construct(Customer $customer, Store $store)
    {

        $this->customer = $customer;

        $this->_config = request('_config');

        $this->store = $store;

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customer = '';

        if(auth()->guard('customer')->user()){
            $customer = $this->customer->find(auth()->guard('customer')->user()->id);
        }

        $sellers = Seller::all();

        return view($this->_config['view'], compact('customer', 'sellers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $customer = $this->customer->find(auth()->guard('customer')->user()->id);

        return view($this->_config['view'], compact('customer'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $customer = auth()->guard('customer')->user();

        $store = $this->storeRepository->create(request()->all());

        $customer->update([
            'store_id' => $store->id
        ]);

        return redirect(route('customer.store.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function show(Store $store)
    {
        return $store->title;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $store = $this->store->findOrFail($id);

        return view($this->_config['view'], compact('store'));

    }

    /**st
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $locale = request()->get('locale') ?: app()->getLocale();

        $this->store->update(request()->all(), $id);

        return redirect()->route($this->_config['redirect']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function destroy(Store $store)
    {
        //
    }
}
