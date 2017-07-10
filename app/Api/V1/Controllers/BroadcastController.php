<?php
/**
 * @desc
 * @author zhan <grianchan@gmail.com>
 * @since 2017/7/10 12:55
 */

namespace App\Api\V1\Controllers;


use App\Api\V1\BaseController;
use Broadcast;
use Illuminate\Http\Request;

class BroadcastController extends BaseController
{
    public function listenAuth(Request $request)
    {
        \Log::debug('broadcast listen', [$request->user()->id]);
        return Broadcast::auth($request);
    }
}