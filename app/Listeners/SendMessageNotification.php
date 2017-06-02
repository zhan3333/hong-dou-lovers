<?php

namespace App\Listeners;

use App\Events\SendMessage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMessageNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendMessage  $event
     * @return void
     */
    public function handle(SendMessage $event)
    {
        //
        \Log::info('监听事件中', [$event]);
    }
}
