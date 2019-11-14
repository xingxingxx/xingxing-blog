<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('upload/image', 'UploadController@image')->name('upload.image');
Route::get('upload/delete', 'UploadController@delete')->name('upload.delete');
Route::get('upload/show', 'UploadController@show')->name('upload.show');