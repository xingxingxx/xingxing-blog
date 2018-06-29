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

/**
 * 博客
 */
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

/**
 * 教程
 */
Route::group(['prefix' => 'book'], function () {
    Route::get('/', 'BookController@index')->name('book.index');
    Route::get('show/{book_id}', 'BookController@show')->name('book.show');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('create', 'BookController@create')->name('book.create');
        Route::post('store', 'BookController@store')->name('book.store');
        Route::get('edit/{id}', 'BookController@edit')->name('book.edit');
        Route::put('update/{id}', 'BookController@update')->name('book.update');
        Route::delete('/delete/{id}', 'BookController@delete')->name('book.delete');

        Route::group(['prefix' => 'article'], function () {
            Route::get('create', 'BookArticleController@create')->name('book.article.create');
            Route::post('store', 'BookArticleController@store')->name('book.article.store');
            Route::get('edit/{id}', 'BookArticleController@edit')->name('book.article.edit');
            Route::put('update/{id}', 'BookArticleController@update')->name('book.article.update');
            Route::delete('/delete/{id}', 'BookArticleController@delete')->name('book.article.delete');
        });
    });
});

/**
 * markdown文件上传
 */
Route::post('markdown/upload', 'MarkdownController@upload')
    ->middleware('auth')
    ->name('markdown.upload');