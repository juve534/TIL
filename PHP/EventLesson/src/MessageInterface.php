<?php

declare(strict_types=1);

namespace Juve534\EventLesson;

interface MessageInterface
{
    public function sendMessage(array $message): void;
    public function receiveMessage(): ?array;
}