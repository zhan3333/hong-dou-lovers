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
}