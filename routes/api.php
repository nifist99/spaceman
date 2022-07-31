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

Route::group(['prefix' => '/v1/space-man'], function() {
    //result
    Route::post('insert/result','Api\ResultController@store');

    // data login
    Route::post('get/data-login','Api\DataLoginController@show');

    // auth
    Route::post('login','Api\AuthController@login');
});
