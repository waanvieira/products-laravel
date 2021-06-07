<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(["namespace" => "Api"], function () {
        
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@authenticate');
    Route::get('logout', 'AuthController@logout');

    Route::middleware(['auth:api', 'jwt.verify'])->group(function () {
        Route::group(['prefix' => 'produtos'], function () {
            Route::resource('', 'ProductController');
        });
    });

});