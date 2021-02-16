<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Client;
use Juve534\LessonDi\UseDi;

class UseDiInterfaceTest extends TestCase
{
    public function test()
    {
        $mockResponse = new Response(200);
        $mock = new MockHandler([$mockResponse]);
        $handler = HandlerStack::create($mock);
        $mockClient = new Client([
            'handler' => $handler,
        ]);

        $StabObj = new UseDi($mockClient);
        $statusCode = $StabObj->getGoogle();

        $this->assertEquals(200, $statusCode);
    }
}