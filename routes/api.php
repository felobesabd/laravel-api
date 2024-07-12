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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([ 'namespace' => 'Auth', 'middleware' => ['api', /*'checkPass'*/ 'lang']], function () {
    Route::get('/get-all', 'CategoriesController@index');
    Route::get('/get-one/{id}', 'CategoriesController@getOne');
    Route::post('/update-status/{id}', 'CategoriesController@changeStatus');

    ######### Admin #########
    Route::group([ 'namespace' => 'Admin', 'prefix' => 'admin'], function () {
        Route::post('/login', 'AdminController@login');
        Route::post('/logout', 'AdminController@logout')->middleware('assign_guard:admin');
    });

    ####### User ###########
    Route::group([ 'namespace' => 'User', 'prefix' => 'user'], function () {
        Route::post('/login', 'UserController@login');
    });

    Route::group(['middleware' => 'assign_guard:user', 'prefix' => 'user'], function () {
        Route::get('profile', function() {
            return \Auth::user();
        });
    });
});

Route::group([ 'namespace' => 'Auth', 'middleware' => ['api', 'checkPass', 'lang', 'admin:admin']], function () {
    Route::get('/get-all', 'CategoriesController@index');
});
