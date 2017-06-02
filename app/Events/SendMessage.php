<?php

namespace App\Events;

use App\Models\Message;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class SendMessage implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /** @var User $user */
    public $user;

    /** @var Message $message */
    public $message;

    /**
     * Create a new event instance.
     *
     * @param User $user
     * @param Message $message
     */
    public function __construct(User $user, Message $message)
    {
        $this->user = $user;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        \Log::info('队列中执行事件，进行广播', []);
        return new PrivateChannel('chat'.$this->message->user_id);
    }
}
