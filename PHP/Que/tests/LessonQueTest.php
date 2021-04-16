<?php

declare(strict_types=1);

namespace Tests;

use Aws\MockHandler;
use Aws\Result;
use Aws\Sqs\SqsClient;
use Juve534\LessonQue\LessonQue;
use PHPUnit\Framework\TestCase;

/**
 * @group Queのテスト
 */
class LessonQueTest extends TestCase
{
    private array $awsParam = [
        'profile' => 'default',
        'region' => 'ap-northeast-1',
        'version' => '2012-11-05'
    ];

    /**
     * @test
     */
    public function メッセージ送信成功()
    {
        $queueUrl = 'hoge';
        $message = [
            'name' => 'taro',
            'message' => 'hello',
        ];

        $mock = new MockHandler();
        $mock->append(new Result(['foo' => 'bar']));

        $this->awsParam['handler'] = $mock;

        $stubClass = new LessonQue(new SqsClient($this->awsParam), $queueUrl);
        $stubClass->sendMessage($message);

        $this->assertTrue(true);
    }

    /**
     * @test
     */
    public function メッセージ受信成功()
    {
        $queueUrl = 'hoge';
        $message = [
            'name' => 'taro',
            'message' => 'hello',
        ];

        $mock = new MockHandler();
        $mock->append(new Result(
            [
                'Messages' => [
                    [
                        'Body' => \json_encode($message)
                    ],
                ],
            ]
        ));
        $this->awsParam['handler'] = $mock;

        $stubClass = new LessonQue(new SqsClient($this->awsParam), $queueUrl);
        $actual = $stubClass->receiveMessage();

        $this->assertSame($message, $actual);
    }
}