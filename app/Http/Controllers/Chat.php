<?php
/**
 * @desc
 * @author zhan <grianchan@gmail.com>
 * @since 2017/6/2 11:53
 */

namespace App\Http\Controllers;


use App\Events\SendMessage;
use App\Models\Message;
use App\User;
use Illuminate\Http\Request;

class Chat extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sendMessage(Request $request)
    {
        /** @var User $user */
        $this->validate($request, [
            'content' => 'required|string|max:255',
            'to' => 'required',
            'type' => 'required'
        ]);
        $content = $request->input('content');
        $to = $request->input('to');
        $type = $request->input('type');
        $user = $request->user();
        $userId = $user->id;
        \Log::info('send message', [$content, $to, $type, $userId]);
//        Message::insert([
//            'content' => $message,
//            'to' => $to,
//            'type' => $type,
//            'user_id' => $userId,
//        ]);
        $message = Message::make([
            'content' => $content,
            'to' => $to,
            'type' => $type,
            'user_id' => $userId,
        ]);
        broadcast(new SendMessage($user, $message));
        return view('chat.chat', ['user_id' => $user->id]);
    }
}