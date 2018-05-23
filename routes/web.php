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

Route::get('/', 'IndexController@index');
Route::get('/info/{id}', 'IndexController@show')->name('show');

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/create', 'IndexController@create')->name('create');
    Route::post('/store', 'IndexController@store')->name('store');
    Route::get('/edit/{id}', 'IndexController@edit')->name('edit');
    Route::delete('/delete/{id}', 'IndexController@delete')->name('delete');
    Route::put('/update/{id}', 'IndexController@update')->name('update');
    Route::put('setting-type/{id}','IndexController@settingType')->name('settingType');
});
