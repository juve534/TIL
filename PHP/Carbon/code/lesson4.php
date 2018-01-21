<?php

require 'vendor/autoload.php';

use Carbon\Carbon;

$dt = Carbon::now();

// 現在時刻に対して、それぞれの値を取得
echo $dt->year . PHP_EOL;
echo $dt->month . PHP_EOL;
echo $dt->day. PHP_EOL;
echo $dt->hour . PHP_EOL;
echo $dt->minute . PHP_EOL;
echo $dt->second. PHP_EOL;

// 指定したフォーマットで時間を取得
echo $dt->format('Y年m月d日') . PHP_EOL;

// 週のうちの何日目か 0 (日曜)から 6 (土曜)
echo $dt->dayOfWeek . PHP_EOL;

// 年のうちの何日目か 0から開始
echo $dt->dayOfYear . PHP_EOL;

// 月のうちの何週目か
echo $dt->weekOfMonth . PHP_EOL;

// 年のうちの何週目か
echo $dt->weekOfYear . PHP_EOL;

// 月の日数
echo $dt->daysInMonth . PHP_EOL;

// 四半期
echo $dt->quarter . PHP_EOL;

// タイムスタンプ
echo $dt->timestamp . PHP_EOL;

// タイムゾーン名
echo $dt->tzName . PHP_EOL;