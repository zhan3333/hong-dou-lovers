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
     * 发送消息
     *
     * <pre>
     * [
     *  'content' => '',    // 消息内容
     *  'type' => '',       // 消息类型
     *  ‘to’ => '',         // 接收者或房间id
     * ]
     * </pre>
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function sendMessage(Request $request)
    {
        /** @var User $user */
        $this->validate($request, [
            'content' => 'required|string|max:255',
            'to' => 'required|integer|min:1',
            'type' => 'required|in:1,2'
        ]);
        $content = $request->input('content');
        $to = $request->input('to');
        $type = $request->input('type');
        $user = $request->user();
        $userId = $user->id;
        \Log::info('send message', [$content, $to, $type, $userId]);
        $message = Message::make([
            'content' => $content,
            'to' => $to,
            'type' => $type,
            'user_id' => $userId,
        ]);
        $message->save();
        if ($type == 1) {
            broadcast(new SendMessage($user, $message));
        } elseif ($type == 2) {
            // todo 群聊天
        }
        return response()->caps([], 0, 'sucess', []);
    }
}