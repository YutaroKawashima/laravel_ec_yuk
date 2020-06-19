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

Route::get('/', function () {
    return view('welcome');
});

//ログインページ
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//商品一覧ページ
Route::get('/top', 'UserController@top');
Route::post('/top', 'CartController@add_to_cart');

//カート内ページ
Route::get('/cart', 'CartController@cart');
Route::post('/cart', 'CartController@update_amount');
Route::delete('/cart/{id}', 'CartController@delete');

//購入完了ページ
Route::get('/finish', 'FinishController@finish');

//商品管理ページ
Route::get('/management', 'AuthController@management');
Route::post('/management', 'AuthController@conditions');
Route::post('/management/change', 'AuthController@stock_change');
Route::post('/management/change_s', 'AuthController@status_change');
Route::delete('/management/{id}', 'AuthController@delete');
