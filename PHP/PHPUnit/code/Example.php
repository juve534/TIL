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
    public function checkNumberOwn(int $number)
    {
        if ($number !== 1) {
            throw new LogicException('Invalid Param : ' . $number);
        }
        return true;
    }
}