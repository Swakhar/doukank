<?php

return [
    [
        'key' => 'account',
        'name' => 'shop::app.layouts.my-account',
        'route' =>'customer.profile.index',
        'sort' => 1
    ], [
        'key' => 'account.profile',
        'name' => 'shop::app.layouts.profile',
        'route' =>'customer.profile.index',
        'sort' => 1
    ], [
        'key' => 'account.address',
        'name' => 'shop::app.layouts.address',
        'route' =>'customer.address.index',
        'sort' => 2
    ], [
        'key' => 'account.reviews',
        'name' => 'shop::app.layouts.reviews',
        'route' =>'customer.reviews.index',
        'sort' => 3
    ], [
        'key' => 'account.wishlist',
        'name' => 'shop::app.layouts.wishlist',
        'route' =>'customer.wishlist.index',
        'sort' => 4
    ], [
        'key' => 'account.orders',
        'name' => 'shop::app.layouts.orders',
        'route' =>'customer.orders.index',
        'sort' => 5
    ], [
        'key' => 'store',
        'name' => 'shop::app.layouts.my-store',
        'route' => 'customer.profile.index',
        'sort' => 2
    ], [
        'key' => 'store.profile',
        'name' => 'shop::app.layouts.store-profile',
        'route' => 'customer.store.index',
        'sort' => 1,
    ], [
        'key' => 'store.products',
        'name' => 'shop::app.layouts.store-products',
        'route' => 'customer.store.index',
        'sort' => 2
    ], [
        'key' => 'store.orders',
        'name' => 'shop::app.layouts.store-orders',
        'route' => 'customer.store.index',
        'sort' => 3
    ], [
        'key' => 'store.reviews',
        'name' => 'shop::app.layouts.store-reviews',
        'route' => 'customer.store.index',
        'sort' => 4
    ]

];

?>