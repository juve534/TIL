<?php

require 'vendor/autoload.php';

use Carbon\Carbon;

$dt = Carbon::now();

// 今日かどうか
var_dump($dt->isToday());

// 明日かどうか
var_dump($dt->isTomorrow());

// 昨日かどうか
var_dump($dt->isYesterday());

// 未来かどうか
var_dump($dt->isFuture());

// 過去かどうか
var_dump($dt->isPast());

// うるう年かどうか
var_dump($dt->isLeapYear());

// 平日かどうか
var_dump($dt->isWeekday());

// 週末かどうか デフォルトで土日が週末っぽい。
var_dump($dt->isWeekend());

// 週末の定義を変更
$dt->setWeekendDays([
    //Carbon::MONDAY,
    Carbon::TUESDAY,
    //Carbon::WEDNESDAY,
    //Carbon::THURSDAY,
    //Carbon::FRIDAY,
    //Carbon::SATURDAY,
    //Carbon::SUNDAY,
]);

// 全部設定したのでいつでもtrue
var_dump($dt->isWeekend()); // true


// 同じ日かどうか
var_dump($dt->isSameDay(Carbon::parse('2018-01-16'))); // false
