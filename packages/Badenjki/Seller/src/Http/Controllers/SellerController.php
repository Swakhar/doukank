<?php

namespace Badenjki\Seller\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail;
use Illuminate\Routing\Controller;
use Webkul\Customer\Models\Customer;


/**
 * Seller Registration controller
 *
 * @author Khaled Badenjki <m.k.badenjki@gmail.com>
 * @copyright 2019 Doukank (http://www.doukank.com)
 */
class SellerController extends Controller
{

    protected $_config;

    /**
     * Display a listing of the sellers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $this->_config = request('_config');

        $sellers = Customer::where('store_id', '<>', 0)->get();

        return view($this->_config['view'], compact('sellers'));
    }

    /**
     * Opens up the sellers's sign up form.
     *
     * @return view
     */
    public function show()
    {

        $this->_config = request('_config');

        return view($this->_config['view']);
    }

    /**
     * Method to store user's sign up form data to DB.
     *
     * @return Mixed
     */
    public function create(Request $request)
    {

    }

}
