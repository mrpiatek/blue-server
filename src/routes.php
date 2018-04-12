<?php


Route::prefix('products')->group(function () {
    Route::get('in-stock', 'MrPiatek\\BlueServer\\Controllers\\ProductsIndexController@indexInStock');
    Route::get('out-of-stock', 'MrPiatek\\BlueServer\\Controllers\\ProductsIndexController@indexOutOfStock');
    Route::get('amount-over-five', 'MrPiatek\\BlueServer\\Controllers\\ProductsIndexController@indexAmoutOverFive');

    Route::post('/', 'MrPiatek\\BlueServer\\Controllers\\ProductsAddingController@addNewProduct');

    Route::put('/{productId}', 'MrPiatek\\BlueServer\\Controllers\\ProductsUpdatingController@updateProduct');
    Route::delete('/{productId}', 'MrPiatek\\BlueServer\\Controllers\\ProductsUpdatingController@removeProduct');

});