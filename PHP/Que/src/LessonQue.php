<?php

declare(strict_types=1);

namespace Juve534\LessonQue;

use Aws\Result;
use Aws\Sqs\SqsClient;

class LessonQue
{
    private SqsClient $client;
    private string $queueUrl;

    public function __construct(SqsClient $client, string $queueUrl)
    {
        $this->client = $client;
        $this->queueUrl = $queueUrl;
    }

    public function sendMessage(array $message): Result
    {
        $params = [
            'DelaySeconds' => 10,
            'MessageBody' => \json_encode($message),
            'QueueUrl' => $this->queueUrl,
        ];

        return $this->client->sendMessage($params);
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

    public function deleteMessage(string $handle): void
    {
        $this->client->deleteMessage([
            'QueueUrl' => $this->queueUrl,
            'ReceiptHandle' => $handle, // $result->get('Messages')[0]['ReceiptHandle']
        ]);
    }

    public static function create(string $queueUrl): LessonQue
    {
        return new self(new SqsClient([
            'profile' => 'default',
            'region' => 'ap-northeast-1',
            'version' => '2012-11-05'
        ]), $queueUrl);
    }
}