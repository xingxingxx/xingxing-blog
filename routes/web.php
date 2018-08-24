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
 * 专栏
 */
Route::group(['prefix' => 'special', 'as' => 'special.'], function () {
    Route::get('/', 'SpecialController@index')->name('index');
    Route::get('show/{special_id}', 'SpecialController@show')->name('show');
});

/**
 * 教程
 */
Route::group(['prefix' => 'book', 'as' => 'book.'], function () {
    Route::get('/', 'BookController@index')->name('index');
    Route::get('show/{book_id}', 'BookController@show')->name('show');
    Route::post('comment/store', 'BookController@commentStore')->name('comment.store');
});

/**
 * markdown文件上传
 */
Route::post('markdown/upload', 'MarkdownController@upload')
    ->middleware('auth')
    ->name('markdown.upload');

// 登录认证路由
Auth::routes();

//github社会化登陆
Route::get('/oauth/github', 'Auth\LoginController@redirectToProvider')->name('oauth.github');
Route::get('/oauth/github/callback', 'Auth\LoginController@handleProviderCallback')->name('oauth.github.callback');
//微信社会化登录
Route::get('/oauth/weixin', 'Auth\LoginController@redirectToWeixin')->name('oauth.weixin');
Route::get('/oauth/weixin/callback', 'Auth\LoginController@handleWeixinCallback')->name('oauth.weixin.callback');

Route::group([
    'namespace' => 'Admin',
    'prefix'    => 'admin',
    'as'        => 'admin.',
], function () {

    Route::group(['middleware' => ['auth', 'is_admin']], function () {
        //首页
        Route::get('/', 'IndexController@index')->name('index');

        //博客
        Route::group(['prefix' => 'blog', 'as' => 'blog.'], function () {
            Route::get('/', 'BlogController@index')->name('index');
            Route::get('/create', 'BlogController@create')->name('create');
            Route::post('/store', 'BlogController@store')->name('store');
            Route::get('/edit/{id}', 'BlogController@edit')->name('edit');
            Route::delete('/delete/{id}', 'BlogController@delete')->name('delete');
            Route::put('/update/{id}', 'BlogController@update')->name('update');
            Route::put('setting-type/{id}', 'BlogController@settingType')->name('settingType');
        });

        //专栏
        Route::group(['prefix' => 'special', 'as' => 'special.'], function () {
            Route::get('/', 'SpecialController@index')->name('index');
            Route::get('create', 'SpecialController@create')->name('create');
            Route::post('store', 'SpecialController@store')->name('store');
            Route::get('edit/{id}', 'SpecialController@edit')->name('edit');
            Route::put('update/{id}', 'SpecialController@update')->name('update');
            Route::delete('/delete/{id}', 'SpecialController@delete')->name('delete');
        });

        //教程
        Route::group(['prefix' => 'book', 'as' => 'book.'], function () {
            Route::get('/', 'BookController@index')->name('index');
            Route::get('create', 'BookController@create')->name('create');
            Route::post('store', 'BookController@store')->name('store');
            Route::get('edit/{id}', 'BookController@edit')->name('edit');
            Route::put('update/{id}', 'BookController@update')->name('update');
            Route::delete('/delete/{id}', 'BookController@delete')->name('delete');

            //教程文章
            Route::group(['prefix' => 'article', 'as' => 'article.'], function () {
                Route::get('/{book_id}', 'BookArticleController@index')->name('index');
                Route::get('/{book_id}/create', 'BookArticleController@create')->name('create');
                Route::post('store', 'BookArticleController@store')->name('store');
                Route::get('edit/{id}', 'BookArticleController@edit')->name('edit');
                Route::put('update/{id}', 'BookArticleController@update')->name('update');
                Route::delete('/delete/{id}', 'BookArticleController@delete')->name('delete');
            });
        });
    });

});

Route::get('/sitemap', 'SitemapController@index')->name('sitemap.index');
Route::get('/sitemap/articles', 'SitemapController@articles')->name('sitemap.articles');
Route::get('/sitemap/specials', 'SitemapController@specials')->name('sitemap.specials');
Route::get('/sitemap/books', 'SitemapController@books')->name('sitemap.books');
Route::get('/sitemap/book/articles', 'SitemapController@bookArticles')->name('sitemap.book.articles');

