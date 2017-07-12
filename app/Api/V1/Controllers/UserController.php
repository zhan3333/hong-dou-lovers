<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\BaseController;
use App\User;
use Illuminate\Http\Request;

/**
 * @author zhan <grianchan@gmail.com>
 * 2017/6/10 17:23
 */
class UserController extends BaseController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFriendList(Request $request)
    {
        $uid = $request->user()->id;
        $users = \DB::table('users')->whereNotIn('id', [$uid])->get(['id', 'name']);
        return $this->formatReturn($users);
    }

    /**
     * 获取用户信息
     */
    public function getUserInfo(Request $request)
    {
        $this->validate($request, [
            'user_id' => 'required|integer'
        ]);
        $user_id = $request->input('user_id');
        $user = User::find($user_id);
        return $this->formatReturn(['user' => $user]);
    }
}