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

Route::group(['prefix' => 'v1/', 'namespace' => "Api\V1", 'middleware' => []], function () {
    Route::group(['prefix' => 'auth/', 'namespace' => "Auth"], function () {
        Route::post('/login', 'LoginController@login');
        Route::post('/register', 'RegisterController@register');
    });

    Route::group(['prefix' => 'auth/', "namespace" => "Auth", 'middleware' => ['auth:api']], function () {
        Route::get('/logout', 'LogoutController@index')->name('users.logout');
    });

    Route::group(['middleware' => ['auth:api'], "namespace" => "PhoneBook"], function () {
        Route::resource('phone-books', 'PhoneBookController');
    });
});
