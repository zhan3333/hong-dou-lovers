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
        $message->name = $user->name;
        if ($type == 1) {
            broadcast(new SendMessage($user, $message));
        } elseif ($type == 2) {
            // todo 群聊天
        }
        return $this->formatReturn();
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
            'curMessageId' => 'integer|min:1'
        ]);
        $userId = $request->input('userId');
        $page = $request->input('page', 1);
        $length = $request->input('length', 20);
        $curMessageId = $request->input('curMessageId');
        $uid = $request->user()->id;
        $query = \DB::table('messages as m')
            ->where('user_id', $uid)
            ->orWhere('user_id', $userId)
            ->orWhere('to', $userId)
            ->orWhere('to', $uid);
        $total = $query->count();
        if ($curMessageId) {
            $query->where('id', '<', $curMessageId);
        }
        $messages = $query
            ->leftJoin('users as u', 'u.id', '=', 'm.user_id')
            ->orderBy('id', 'asc')
            ->forPage($page, $length)
            ->get(['m.id', 'm.user_id', 'm.to', 'm.type', 'm.content', 'm.created_at', 'm.updated_at', 'u.name']);
        return $this->formatReturn([
            'messages' => $messages,
            'total' => $total,
            'page' => $page,
            'length' => $length
        ]);

    }
}