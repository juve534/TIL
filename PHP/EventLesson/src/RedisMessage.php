<?php

declare(strict_types=1);

namespace Juve534\EventLesson;

use Predis\Client;

class RedisMessage implements MessageInterface
{
    private Client $client;
    private string $channel;

    public function __construct(Client $client, string $channel)
    {
        $this->client = $client;
        $this->channel = $channel;
    }

    public function sendMessage(array $message): void
    {
        $this->client->publish($this->channel, \json_encode($message));
    }

    public function receiveMessage(): ?array
    {
        $pubsub = $this->client->pubSubLoop();
        $pubsub->subscribe($this->channel);

        foreach ($pubsub as $message) {
            switch ($message->kind) {
                case 'subscribe':
                    echo "Subscribed to {$message->channel}", PHP_EOL;
                    break;

                case 'message':
                    return \json_decode($message->payload, true);
                    break;
            }
        }
    }
}