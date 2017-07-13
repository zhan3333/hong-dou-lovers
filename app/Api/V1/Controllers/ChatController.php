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
        return $this->formatReturn(['message' => $message, 'user' => $user]);
    }

    /**
     * 获取历史消息
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getHistoryMessageList(Request $request)
    {
        $this->validate($request, [
            'page' => 'integer|min:1',
            'length' => 'integer|min:1',
            'userId' => 'required|integer|min:1',
        ]);
        $userId = $request->input('userId');
        $page = $request->input('page');
        $length = $request->input('length');
        $uid = $request->user()->id;
        $query = \DB::table('messages as m')
            ->where(function ($query) use ($uid, $userId){
                $query->where('m.user_id', $uid)
                    ->where('m.to', $userId);
            })
            ->orWhere(function ($query) use ($uid, $userId){
                $query->where('m.user_id', $userId)
                    ->where('m.to', $uid);
            });
        $total = $query->count();
        if ($page) $query->take($length);
        if ($length) $query->skip(($page - 1) * $length);
        $messages = $query
            ->leftJoin('users as u', 'u.id', '=', 'm.user_id')
            ->orderBy('m.id', 'desc')
            ->get(['m.id', 'm.user_id', 'm.to', 'm.type', 'm.content', 'm.created_at', 'm.updated_at', 'u.name']);
        return $this->formatReturn([
            'messages' => $messages,
            'total' => $total,
            'page' => $page,
            'length' => $length
        ]);

    }
}