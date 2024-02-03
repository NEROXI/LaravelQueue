<?php

namespace App\Messages;

class Message implements IMessage
{
    private string $channel;
    private string $type;
    private string $body;
    private string $receiver;
    private ?string $action;

    public function __construct(
        string $type,
        string $body,
        string $receiver,
        string $channel = 'default',
        ?string $action = null
    ) {
        $this->channel = $channel;
        $this->type = $type;
        $this->body = $body;
        $this->receiver = $receiver;
        $this->action = $action;
    }

    public function getChannel(): string
    {
        return $this->channel;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function getReceiver(): string
    {
        return $this->receiver;
    }
}
