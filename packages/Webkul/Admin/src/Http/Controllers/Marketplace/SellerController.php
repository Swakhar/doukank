<?php

namespace Webkul\Admin\Http\Controllers\Marketplace;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Webkul\Admin\Http\Controllers\Controller;
use Webkul\Customer\Models\Customer;

/**
 * Marketplace Seller controller
 *
 * @author Khaled Badenjki <khaled@badenjki.co>
 * @copyright 2018 Doukank.com Software (http://www.doukank.com)
 */
class SellerController extends Controller
{
    /**
     * Display a listing of the sellers.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $sellers = Customer::where('store_id', '<>', 0)->get();

        return view('admin::marketplace.sellers.index', compact('sellers'));

    }

}