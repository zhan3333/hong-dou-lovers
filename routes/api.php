<?php

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

/** @var Dingo\Api\Routing\Router $api */
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', ['namespace' => 'App\Api\V1\Controllers'],function ($api) {

    /**
     * 需要登陆权限的
     * @var Dingo\Api\Routing\Router $api
     */
    $api->group(['middleware' => 'api.auth'], function ($api) {
        /** @var Dingo\Api\Routing\Router $api */
        $api->group(['prefix' => 'user'], function ($api) {
            /** @var Dingo\Api\Routing\Router $api */
            $api->post('/getFriendList', 'UserController@getFriendList');   // 获取好友列表
        });
        $api->group(['prefix' => 'chat'], function ($api) {
            /** @var Dingo\Api\Routing\Router $api */
            $api->post('/sendMessage', 'ChatController@sendMessage');   // 发送消息
            $api->post('/getHistoryMessageList', 'ChatController@getHistoryMessageList');   // 获取历史消息
        });
        $api->group(['prefix' => 'broadcast'], function ($api) {
            /** @var Dingo\Api\Routing\Router $api */
            $api->post('auth', 'BroadcastController@listenAuth');
        });
    });
    /* 不需要登陆权限的 */
    $api->group(['prefix' => 'auth'], function ($api) {
        /** @var Dingo\Api\Routing\Router $api */
        $api->post('/login', 'AuthenticateController@authenticate');  // 登陆获取token
        $api->post('/register', 'AuthenticateController@register');  // 注册
        $api->post('/user', 'AuthenticateController@authenticatedUser');  // 注册
        $api->post('/isLogin', 'AuthenticateController@isLogin');   // 判断是否登陆
    });
});
