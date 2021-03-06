<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: juve534
 * Date: 2018/04/10
 * Time: 23:05
 */
require_once dirname(__FILE__) . '/../vendor/autoload.php';
require_once dirname(__FILE__) . '/../Example.php';

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @test
     * @expectedException LogicException
     */
    public function checkNumberOwnTestExcept()
    {
        $obj = new Example();
        $obj->checkNumberOwn(2);
    }

    /**
     * @test
     * @expectedException LogicException
     * @expectedExceptionMessage Invalid Param
     */
    public function checkNumberOwnTestMessage()
    {
        $obj = new Example();
        $obj->checkNumberOwn(2);
    }

    /**
     * @test
     * @expectedException LogicException
     * @expectedExceptionMessageRegExp /Invalid Param : /
     */
    public function checkNumberOwnTestMessageRep()
    {
        $obj = new Example();
        $obj->checkNumberOwn(2);
    }

    public function checkExceptionDataProvider():array
    {
        return [
            'number 1' => [1, \LogicException::class, 'number 1'],
            'number 2' => [2, \ErrorException::class, 'number 2'],
        ];
    }

    /**
     * @test
     * @dataProvider checkExceptionDataProvider
     */
    public function checkExceptionTest($param, $errorClass, $errorMessage)
    {
        $this->expectException($errorClass);
        $this->expectExceptionMessage($errorMessage);

        $obj = new Example();
        $obj->checkExecption($param);
    }
}