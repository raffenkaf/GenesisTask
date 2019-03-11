<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['simpleAuthentication'])->group(function () {
    Route::apiResource('addresses', 'API\AddressController')
        ->only(['store']);
    Route::apiResource('orders-buckets', 'API\OrderBucketController')
        ->except(['update']);
    Route::apiResource('orders', 'API\OrderController')
        ->except(['destroy']);
    Route::apiResource('payments', 'API\PaymentController')
        ->except(['update', 'destroy']);
    Route::apiResource('products', 'API\ProductController')
        ->except(['destroy']);
    Route::apiResource('users', 'API\UserController')
        ->except(['index', 'destroy']);
});
