<?php

namespace App\Console\Commands;

use App\Services\MessageService;
use Illuminate\Console\Command;

class TestMessageCommand extends Command
{
    private MessageService $messageService;

    public function __construct(MessageService $messageService)
    {
        parent::__construct();
        $this->messageService = $messageService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:test-message-command {type} {body} {receiver} {channel=messages} {action?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a test message to the Redis Pub/Sub channel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Extract the channel, type, and body from the command arguments
        $channel = $this->argument('channel');
        $type = $this->argument('type');
        $body = $this->argument('body');
        $action = $this->argument('action');
        $receiver = $this->argument('receiver');

        $this->messageService->sendMessage($type, $body, $receiver, $channel, $action);

        $this->info("Message published to the Redis Pub/Sub channel: $channel");
    }
}
