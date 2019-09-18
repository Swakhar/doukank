<?php

namespace Badenjki\Seller\Http\Controllers;

use Badenjki\Seller\Models\Store;
use Illuminate\Http\Request;
use Webkul\Customer\Repositories\CustomerRepository;

class StoreController extends Controller
{

    protected $_config;

    protected $customer;

    public function __construct(CustomerRepository $customer)
    {

        $this->customer = $customer;

        $this->_config = request('_config');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $customer->createStore($request->all());

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
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Store  $store
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Store $store)
    {

        // TODO: add some authorization and policy here

        $store->update([
            'title' => $request->title
        ]);

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
