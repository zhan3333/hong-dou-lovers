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

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('/chat', 'Chat@sendMessage');
});

/** @var Dingo\Api\Routing\Router $api */
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', ['namespace' => 'App\Api\V1\Controllers'],function ($api) {
    /** @var Dingo\Api\Routing\Router $api */
    $api->group(['middleware' => 'api.auth'], function ($api) {
        $api->group(['prefix' => 'auth'], function () {

        });
        /** @var Dingo\Api\Routing\Router $api */
        $api->any('/user', function () {
            $user = app('Dingo\Api\Auth\Auth')->user();
            return $user;
        });
    });
    $api->group(['prefix' => 'auth'], function ($api) {
        /** @var Dingo\Api\Routing\Router $api */
        $api->any('/login', 'AuthenticateController@authenticate');  // 登陆获取token
        $api->post('/register', 'AuthenticateController@register');  // 注册
        $api->any('/user', 'AuthenticateController@authenticatedUser');  // 注册


    });
});
