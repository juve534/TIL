<?php
require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '/../Fizzbuzz.php';

use PHPUnit\Framework\TestCase;

class FizzBuzzTest extends TestCase
{
    /**
     * @dataProvider
     */
    public function toFizzBuzzDataProvider()
    {
        return [
            'number 1' => [1, 1],
            'number 3' => [3, 'Fizz'],
            'number 5' => [5, 'Buzz'],
            'number 15' => [15, 'FizzBuzz'],
        ];
    }

    /**
     * @test
     * @dataProvider toFizzBuzzDataProvider
     */
    public function toFizzBuzzTest(int $param, $actual)
    {
        $obj = new FizzBuzz();
        $res = $obj->toFizzBuzz($param);
        $this->assertEquals($res, $actual);
    }
}