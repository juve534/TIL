<?php

declare(strict_types=1);

namespace Juve534\EventLesson;

use Aws\Sqs\SqsClient;

class SqsMessage implements MessageInterface
{
    private SqsClient $client;
    private string $queueUrl;

    public function __construct(SqsClient $client, string $queueUrl)
    {
        $this->client = $client;
        $this->queueUrl = $queueUrl;
    }

    public function sendMessage(array $message): void
    {
        $params = [
            'DelaySeconds' => 10,
            'MessageBody' => \json_encode($message),
            'QueueUrl' => $this->queueUrl,
        ];

        $this->client->sendMessage($params);
    }

    public function receiveMessage(): ?array
    {
        $result = $this->client->receiveMessage(array(
            'AttributeNames' => ['SentTimestamp'],
            'MaxNumberOfMessages' => 1,
            'MessageAttributeNames' => ['All'],
            'QueueUrl' => $this->queueUrl,
            'WaitTimeSeconds' => 0,
        ));

        if (isset($result->get('Messages')[0]['Body'])) {
            return \json_decode($result->get('Messages')[0]['Body'], true);
        }

        return null;
    }
}