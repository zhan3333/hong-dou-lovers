<?php
/**
 * @author zhan <grianchan@gmail.com>
 * 2017/6/13 22:39
 */

namespace App\Api\V1\Controllers;
use App\Api\V1\BaseController;
use App\Events\SendMessage;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends BaseController
{
    /**
     * 发送消息
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
        return $this->formatReturn();
    }
}