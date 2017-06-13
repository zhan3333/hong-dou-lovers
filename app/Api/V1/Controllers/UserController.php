<?php

namespace App\Api\V1\Controllers;
use App\User;
use Illuminate\Support\Facades\Log;
use Request;

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
        $users = User::all();
        return $this->formatReturn($users);
    }
}