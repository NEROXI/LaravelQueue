<?php

namespace App\Notifications;

use App\Messages\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MessageNotification extends Notification
{
    use Queueable;

    public Message $message;

    /**
     * Create a new notification instance.
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function via(): array
    {
        return [$this->message->getType()];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(): MailMessage
    {
        return (new MailMessage)
            ->line($this->message->getBody())
            ->action($this->message->getAction(), $this->message->getAction());
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return [
            'body' => $this->message->getBody(),
            'receiver' => $this->message->getReceiver(),
            'channel' => $this->message->getChannel(),
            'type' => $this->message->getType(),
            'action' => $this->message->getAction(),
        ];
    }
}
