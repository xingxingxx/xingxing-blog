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

Route::get('/', 'BlogController@index')->name('index');

Auth::routes();

Route::group(['prefix' => 'blog'], function () {
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/create', 'BlogController@create')->name('blog.create');
        Route::post('/store', 'BlogController@store')->name('blog.store');
        Route::get('/edit/{id}', 'BlogController@edit')->name('blog.edit');
        Route::delete('/delete/{id}', 'BlogController@delete')->name('blog.delete');
        Route::put('/update/{id}', 'BlogController@update')->name('blog.update');
        Route::put('setting-type/{id}', 'BlogController@settingType')->name('blog.settingType');
    });

    Route::get('/{id}/{title}', 'BlogController@show')->name('blog.show');
});