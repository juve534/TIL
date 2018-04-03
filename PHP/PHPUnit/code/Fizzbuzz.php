<?php
/**
 * Created by PhpStorm.
 * User: juve534
 * Date: 2018/03/29
 * Time: 0:50
 */
declare(strict_types=1);

class FizzBuzz
{
    public function toFizzBuzz(int $count): string
    {
        $result = '';
        if ($count % 3 == 0) {
            $result .= 'Fizz';
        }
        if ($count % 5 == 0) {
            $result .= 'Buzz';
        }
        if (!($count % 3 == 0)
            && !($count % 5 == 0)
        ) {
            $result .= $count;
        }
        return $result;
    }
}