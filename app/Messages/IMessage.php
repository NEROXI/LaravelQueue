<?php

namespace App\Messages;

interface IMessage
{
    public function getChannel(): string;
    public function getType(): string;
    public function getBody(): string;
    public function getAction(): ?string;
    public function getReceiver(): string;
}
