<?php
declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: juve534
 * Date: 2018/04/10
 * Time: 23:02
 */

/**
 * テストクラス
 */
class Example
{
    /**
     * パラメータが1かどうか判定する
     *
     * @param int $number
     * @return bool
     * @throws LogicException
     */
    public function checkNumberOwn(int $number):bool
    {
        if ($number !== 1) {
            throw new LogicException('Invalid Param : ' . $number);
        }
        return true;
    }

    public function checkExecption(int $number):bool
    {
        if ($number === 1) {
            throw new LogicException('number 1');
        } elseif ($number === 2) {
            throw new ErrorException('number 2');
        }
        return true;
    }
}