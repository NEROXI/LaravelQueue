<?php

namespace App\Services;

use App\Jobs\ProcessMessage;
use App\Messages\Message;
use App\Notifications\MessageNotification;
use Illuminate\Support\Facades\Notification;

class MessageService
{
    public function sendMessage(string $type, string $body, string $receiver, ?string $channel, ?string $action): void
    {
        $message = new Message($type, $body, $receiver, $channel, $action);

        ProcessMessage::dispatch($message);
    }
}
