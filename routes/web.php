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

//カート内ページ
Route::get('/cart', 'UserController@cart');

//商品管理ページ
Route::get('/management', 'AuthController@management');
Route::post('/management', 'AuthController@conditions');
