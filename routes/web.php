<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', ['as' => 'user.index', 'uses' => 'UserController@index']);
Route::post('/', ['as' => 'user.login', 'uses' => 'UserController@auth']);

Route::get('/dashboard', ['as' => 'user.dashboard', 'uses' => 'DashboardController@index']);

Route::post('/addproductcart', ['as' => 'add.cart.product', 'uses' => 'DashboardController@addProductToCart']);
Route::post('/cartproducts', ['as' => 'show.cart.products', 'uses' => 'DashboardController@showProductsOnCart']);
Route::post('/checkout', ['as' => 'checkout', 'uses' => 'DashboardController@checkout']);