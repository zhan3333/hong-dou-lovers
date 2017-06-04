<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('chat.{toUserId}', function ($user, $toUserId) {
    Log::info('channel', [$user, $toUserId]);
    return (int) $user->id === (int) $toUserId;
});