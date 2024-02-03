<?php

namespace App\Jobs;

use App\Messages\Message;
use App\Notifications\MessageNotification;
use App\Services\MessageService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class ProcessMessage implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private Message $message;
    public $tries = 3;
    public $maxExceptions = 3;

    /**
     * Create a new job instance.
     */
    public function __construct(Message $message)
    {
        $this->message = $message;
        $this->queue = $message->getChannel();
    }

    /**
     * Execute the job.
     */
    public function handle(MessageService $messageService): void
    {
        try {
            Notification::route($this->message->getType(), $this->message->getReceiver())
                ->notify(new MessageNotification($this->message));
        } catch (\Exception $e) {
            $this->release(10);
        }
    }
}
