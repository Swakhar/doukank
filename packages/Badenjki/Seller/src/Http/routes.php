<?php
//
//Route::group(['middleware' => ['web', 'locale', 'theme', 'currency', 'customer']], function () {
//
//    Route::get('/stores/create', 'Badenjki\Seller\Http\Controllers\StoreController@create')->defaults('_config', [
//        'view' => 'shop::customers.account.store.index'
//    ])->name('customer.store.index');
//
//    Route::post('/stores/create', 'Badenjki\Seller\Http\Controllers\StoreController@store')->defaults('_config',[
//        'redirect' => 'customer.store.index'
//    ])->name('customer.store.create');
//
//});


// moved back to routes under shop