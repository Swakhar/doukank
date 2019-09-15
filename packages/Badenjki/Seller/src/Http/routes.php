<?php

Route::group(['middleware' => ['web', 'locale', 'theme', 'currency']], function () {

    Route::get('/stores/create', 'Badenjki\Seller\Http\Controllers\StoreController@create')->defaults('_config', [
        'view' => 'seller::catalog.products.create'
    ])->name('seller.store.create');

    Route::post('/stores/create', 'Badenjki\Seller\Http\Controllers\StoreController@store')->defaults('_config', [
        'redirect' => 'customer.session.index'
    ])->name('seller.store.store');

    Route::get('/{store}', 'Badenjki\Seller\Http\Controllers\StoreController@show');

    Route::patch('/{store}/edit', 'Badenjki\Seller\Http\Controllers\StoreController@update');

});
