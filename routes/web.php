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

Route::get('/', 'MainController')->name('main');

Route::name('cart.')
    ->prefix('cart')
    ->group(function() {
        Route::name('main')->get('/', 'CartController@index');
        Route::name('add')->get('add/{id}', 'CartController@add');
        Route::name('remove_item')->get('remove/{id}', 'CartController@removeItem');
        Route::name('decrease_item')->get('decrease/{id}', 'CartController@decreaseItemQuantity');
        Route::name('set_quantity')->post('set-quantity/{id}', 'CartController@setQuantity');
    });

Route::name('order.')
    ->prefix('order')
    ->group(function() {
        Route::name('create')->post('/create', 'OrderController@create');
        Route::name('history')->get('/', 'OrderController@index')->middleware('auth');
    });

Auth::routes();
