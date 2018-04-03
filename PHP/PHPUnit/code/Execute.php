<?php
/**
 * Created by PhpStorm.
 * User: kimura-tsuyoshi
 * Date: 2018/03/29
 * Time: 1:01
 */
require_once dirname(__FILE__) . '/Fizzbuzz.php';
$obj = new FizzBuzz();

for ($i = 1; $i <= 15; $i++) {
    echo $obj->toFizzBuzz($i) . PHP_EOL;
}