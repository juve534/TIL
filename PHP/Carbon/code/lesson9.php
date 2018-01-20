<?php
require 'vendor/autoload.php';

use Carbon\Carbon;

$dt = Carbon::now();

// その日の最初の時間を取得
echo 'startOfDay : ' . $dt->startOfDay() . PHP_EOL;

// その日の最後の時間を取得
echo 'endOfDay : ' . $dt->endOfDay() . PHP_EOL;

// その月の最初の日時を取得
echo 'startOfMonth : ' . $dt->startOfMonth() . PHP_EOL;

// その月の最後の日時を取得
echo 'endOfMonth : ' . $dt->endOfMonth() . PHP_EOL;

// その週の最初の時間を取得
echo 'startOfWeek : ' . $dt->startOfWeek() . PHP_EOL;

// その週の最後の時間を取得
echo 'endOfWeek : ' . $dt->endOfWeek() . PHP_EOL;

// 次の月曜を取得
echo 'nextMONDAY : ' . $dt->next(Carbon::MONDAY) . PHP_EOL;

// 前の月曜を取得
echo 'previousMONDAY : ' . $dt->previous(Carbon::MONDAY) . PHP_EOL;

// 月の最初の月曜を取得
echo 'firstOfMonth : ' . $dt->firstOfMonth(Carbon::MONDAY) . PHP_EOL;

// 月の最後の月曜を取得
echo 'lastOfMonth : ' . $dt->lastOfMonth(Carbon::MONDAY) . PHP_EOL;

// 月の第3月曜を取得
echo 'nthOfMonth : ' . $dt->nthOfMonth(3, Carbon::MONDAY) . PHP_EOL;
