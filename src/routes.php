<?php

Route::prefix('api/v1')->group(function () {
    Route::resource('products', 'MrPiatek\\BlueServer\\Http\\Controllers\\ProductsModificationController')
        ->only([
            'store',
            'update',
            'destroy'
        ]);

    Route::prefix('products')->group(function () {
        Route::get('in-stock', 'MrPiatek\\BlueServer\\Http\\Controllers\\ProductsIndexController@inStock');
        Route::get('out-of-stock', 'MrPiatek\\BlueServer\\Http\\Controllers\\ProductsIndexController@outOfStock');
        Route::get('amount-over-five', 'MrPiatek\\BlueServer\\Http\\Controllers\\ProductsIndexController@amountOverFive');
    });
});