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

/**
 * 博客
 */
Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
    Route::get('/{id}/{title}', 'BlogController@show')->name('show');
    Route::post('/comment/store', 'BlogController@commentStore')->name('comment.store');
});

/**
 * 教程
 */
Route::group(['prefix' => 'book','as'=>'book.'], function () {
    Route::get('/', 'BookController@index')->name('index');
    Route::get('show/{book_id}', 'BookController@show')->name('show');

    Route::group(['middleware' => 'auth'], function () {
        Route::get('create', 'BookController@create')->name('create');
        Route::post('store', 'BookController@store')->name('store');
        Route::get('edit/{id}', 'BookController@edit')->name('edit');
        Route::put('update/{id}', 'BookController@update')->name('update');
        Route::delete('/delete/{id}', 'BookController@delete')->name('delete');

        Route::group(['prefix' => 'article','as'=>'article.'], function () {
            Route::get('create', 'BookArticleController@create')->name('create');
            Route::post('store', 'BookArticleController@store')->name('store');
            Route::get('edit/{id}', 'BookArticleController@edit')->name('edit');
            Route::put('update/{id}', 'BookArticleController@update')->name('update');
            Route::delete('/delete/{id}', 'BookArticleController@delete')->name('delete');
        });
    });
});




/**
 * markdown文件上传
 */
Route::post('markdown/upload', 'MarkdownController@upload')
    ->middleware('auth')
    ->name('markdown.upload');

// 登录认证路由
Route::get('admin/login', 'Auth\LoginController@showLoginForm')->name('admin.login');
Route::post('admin/login', 'Auth\LoginController@login');
Route::get('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');

Route::group([
    'namespace' => 'Admin',
    'prefix'    => 'admin',
    'as'        => 'admin.',
], function () {

    Route::group(['middleware' => 'auth'], function () {
        //首页
        Route::get('/', 'IndexController@index')->name('index');
        Route::group(['prefix' => 'blog','as'=>'blog.'], function () {
            Route::get('/', 'BlogController@index')->name('index');
            Route::get('/create', 'BlogController@create')->name('create');
            Route::post('/store', 'BlogController@store')->name('store');
            Route::get('/edit/{id}', 'BlogController@edit')->name('edit');
            Route::delete('/delete/{id}', 'BlogController@delete')->name('delete');
            Route::put('/update/{id}', 'BlogController@update')->name('update');
            Route::put('setting-type/{id}', 'BlogController@settingType')->name('settingType');
        });
    });

});