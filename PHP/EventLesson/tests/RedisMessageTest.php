<?php

declare(strict_types=1);

namespace Tests;


use Juve534\EventLesson\RedisMessage;
use PHPUnit\Framework\TestCase;
use Predis\Client;

class RedisMessageTest extends TestCase
{
    const CHANNEL = 'test-channel';

    /**
     * @test
     */
    public function メッセージ送信成功()
    {
        $message = [
            'name' => 'taro',
            'message' => 'hello',
        ];

        $mock = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->setMethods(['publish'])
            ->getMock();
        $mock->expects($this->once())
            ->method('publish')
            ->with(self::CHANNEL, \json_encode($message));

        $stubClass = new RedisMessage($mock, self::CHANNEL);
        $stubClass->sendMessage($message);

        $this->assertTrue(true);
    }
}