<?php

namespace App\Console\Commands;

use App\Models\Message;
use App\User;
use Illuminate\Console\Command;

class SendChatMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'chat:message {message}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send chat message';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $user = User::first();
        $message = Message::make([
            'user_id' => 1,
            'to' => 2,
            'type' => 1,
            'content' => 'hello world'
        ]);
        event(new \App\Events\SendMessage($user, $message));
    }
}
