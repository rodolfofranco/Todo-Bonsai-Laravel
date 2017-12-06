<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Controller@index');

Auth::routes();

Route::get('/product' , 'Controller@allProducts');
Route::get('/shoppingCart' , 'ShoppingCartController@index');
Route::get('/getWishlist' , 'WishlistController@index');
Route::get('/orders' , 'OrderController@index');
Route::post('/addProduct', 'ShoppingCartController@store');
Route::post('/removeProduct','ShoppingCartController@destroy');
Route::post('/addWishlist', 'WishlistController@store');
Route::post('/wishlistProducto' , 'WishlistController@addProduct');
Route::post('/newOrder' , 'OrderController@createOrder');
Route::post('/emptyCart', 'ShoppingCartController@emptyCart');
Route::post('/deleteWishlist','WishlistController@deleteWishlist');
Route::post('/wishlistCarrito', 'WishlistController@agregarCarrito');
Route::get('/changePais','Controller@changePais');
Route::get('/admin','AdminController@index');
Route::post('/changeDB' , 'Controller@changeDatabase');
Route::get('/addAdminProduct', 'AdminController@addAdminProduct');
Route::post('/eliminarProducto','AdminController@eliminarProduct');
Route::post('/updateProducto','AdminController@updateProduct');
Route::post('/cancelOrder','OrderController@cancelOrder');
Route::post('/cancelOrderAdmin','AdminController@cancelOrder');

//Show payment form
Route::get('/payment/add-funds/paypal', 'PaypalController@showForm');

// Post payment details for store/process API request
Route::post('/payment/add-funds/paypal', 'PaypalController@store');

// Handle status
Route::get('/payment/add-funds/paypal/status', 'PaypalController@getPaymentStatus');
Route::post('/deleteProductW', 'WishlistController@destroy');