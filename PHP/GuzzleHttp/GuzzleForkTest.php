<?php
declare(strict_types=1);

require_once dirname(__FILE__) . '/vendor/autoload.php';
require_once dirname(__FILE__) . '/GuzzleFork.php';

use \GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;

class GuzzleForkTest extends TestCase
{
    /**
     * @dataProvider
     */
    public function executeUrlProvider()
    {
        return [
            'Invale Url' => ['test', false, \GuzzleHttp\Exception\ConnectException::class],
            'Success Url' => ['https://www.google.co.jp/', true],
        ];
    }

    /**
     * @test
     * @dataProvider executeUrlProvider
     */
    public function executeUrlTest(string $url, $actual, $errorClass = null)
    {
        if (!empty($errorClass)) {
            $this->expectException($errorClass);
        }

        $obj = new GuzzleFork(new Client());
        $res = $obj->executeUrl($url);
        $this->assertEquals($res, $actual);
    }

    /**
     * @dataProvider
     */
    public function requestAsyncProvider()
    {
        $testList = [
            'https://localhost/',
            'test',
        ];

        $urlList = [
            'https://www.google.co.jp/',
            'https://www.google.co.jp/',
        ];

        return [
            'Invale Url' => [$testList, false, \GuzzleHttp\Exception\ConnectException::class],
            'Success UrlList' => [$urlList, true],
        ];
    }

    /**
     * @test
     * @dataProvider requestAsyncProvider
     */
    public function requestAsyncTest(array $urlList, $actual, $errorClass = null)
    {
        if (!empty($errorClass)) {
            $this->expectException($errorClass);
        }

        $obj = new GuzzleFork(new Client());
        $res = $obj->requestAsync($urlList);
        $this->assertEquals($res, $actual);
    }
}