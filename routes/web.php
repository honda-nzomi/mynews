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


Route::group(['prefix' => 'admin'], function() {
    Route::get('news/create', 'Admin\NewsController@add')->middleware('auth');
    Route::post('news/create', 'Admin\NewsController@create')->middleware('auth');
    Route::get('news', 'Admin\NewsController@index')->middleware('auth');
    Route::get('news/edit', 'Admin\NewsController@edit')->middleware('auth');
    Route::post('news/edit', 'Admin\NewsController@update')->middleware('auth'); 
    Route::get('news/delete', 'Admin\NewsController@delete')->middleware('auth');
    Route::get('profile/create', 'Admin\ProfileController@add')->middleware('auth');
    Route::post('profile/create', 'Admin\ProfileController@create')->middleware('auth');
    Route::get('profile/edit', 'Admin\ProfileController@edit')->middleware('auth');
    Route::post('profile/edit', 'Admin\ProfileController@update')->middleware('auth');
    Route::get('profile/delete', 'Admin\profileController@delete')->middleware('auth');
    Route::get('profile', 'Admin\ProfileController@index')->middleware('auth');
});
Route::get('/', 'NewsController@index');
Route::get('/profile', 'ProfileController@index');


///課題３
//http://XXXXXX.jp/XXX というアクセスが来たときに、
// AAAControllerのbbbというAction に渡すRoutingの設定
//Route::get('xxx', 'AAAController@bbb');

///課題４
// Route::get('admin/profile/create', 'Admin\ProfileController@add');
// Route::get('admin/profile/edit', 'Admin\ProfileController@edit');
Auth::routes();
Route::get('profile/create', 'Admin\ProfileController@add');
Route::get('profile/edit', 'Admin\ProfileController@edit');
Route::get('/home', 'HomeController@index')->name('home');
