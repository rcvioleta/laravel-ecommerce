<?php

Route::get('/', 'FrontEndController@index')->name('home');
Route::get('/product/{id}', 'FrontEndController@singleProduct')->name('product.single');
Route::post('/product/add', 'ShoppingController@addToCart')->name('cart.add');
Route::get('/cart', 'ShoppingController@cart')->name('cart');
Route::get('/cart/delete/{id}', 'ShoppingController@delete')->name('cart.delete');
Route::get('/cart/decrement/{id}/{qty}', 'ShoppingController@decrement')->name('cart.decrement');
Route::get('/cart/increment/{id}/{qty}', 'ShoppingController@increment')->name('cart.increment');
Route::get('/cart/rapid/add/{id}', 'ShoppingController@addRapidToCart')->name('cart.rapid.add');
Route::get('/cart/checkout', 'CheckoutController@index')->name('cart.checkout');
Route::post('/cart/checkout', 'CheckoutController@pay')->name('cart.checkout');

Auth::routes();

Route::group(['prefix' => 'products', 'middleware' => 'auth'], function() {
    Route::get('/', 'ProductsController@index')->name('products');
    Route::get('/create', 'ProductsController@create')->name('product.create');
    Route::post('/store', 'ProductsController@store')->name('product.store');
    Route::get('/edit/{id}', 'ProductsController@edit')->name('product.edit');
    Route::post('/update/{id}', 'ProductsController@update')->name('product.update');
    Route::get('/delete/{id}', 'ProductsController@destroy')->name('product.delete');
});