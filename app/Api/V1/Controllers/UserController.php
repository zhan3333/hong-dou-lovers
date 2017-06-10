<?php

namespace App\Api\V1\Controllers;
use App\User;
use Dingo\Api\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * @author zhan <grianchan@gmail.com>
 * 2017/6/10 17:23
 */
class UserController extends BaseController
{
    public function show(Request $request)
    {
        $user = User::find(1);
        Log::info('user', [$request->headers]);
        return $user;
    }
}