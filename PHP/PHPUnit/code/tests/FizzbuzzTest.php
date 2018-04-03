<?php
/**
 * Created by PhpStorm.
 * User: kimura-tsuyoshi
 * Date: 2018/03/29
 * Time: 1:20
 */
require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '/../Fizzbuzz.php';

use PHPUnit\Framework\TestCase;

class FizzbuzzTest extends TestCase
{
    /**
     * @test
     */
    public function toFizzBuzzTest()
    {
        $obj = new FizzBuzz();
        $res = $obj->toFizzBuzz(1);
        $this->assertEquals($res, 1);

        $res = $obj->toFizzBuzz(3);
        $this->assertEquals($res, 'Fizz');

        $res = $obj->toFizzBuzz(5);
        $this->assertEquals($res, 'Buzz');

        $res = $obj->toFizzBuzz(15);
        $this->assertEquals($res, 'FizzBuzz');
    }
}