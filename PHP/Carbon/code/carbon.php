<?php

require 'vendor/autoload.php';

use Carbon\Carbon;

$dt = new Carbon();
echo $dt . PHP_EOL;

// 時刻を上書きして呼び出し
$dt = new Carbon('2016-04-30');
echo $dt . PHP_EOL;

// スタティックに現在時刻呼び出し
$dt = Carbon::now();
echo $dt . PHP_EOL;

// スタティックに本日の00:00:00を呼び出し
$dt = Carbon::today();
echo $dt . PHP_EOL;

// スタティックに明日の00:00:00を呼び出し
$dt = Carbon::tomorrow();
echo $dt . PHP_EOL;

// スタティックに前日の00:00:00を呼び出し
$dt = Carbon::yesterday();
echo $dt . PHP_EOL;

// 文字列からインスタンスを生成
$dt = Carbon::parse('2018-01-01 12:30:00');
echo $dt . PHP_EOL;

// 特定の形式を渡して日付生成
$dt = Carbon::createFromFormat('Y/m/d H', '2018/01/01 10');
echo $dt . PHP_EOL;