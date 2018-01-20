<?php

require 'vendor/autoload.php';

use Carbon\Carbon;

$dt1 = Carbon::create(2020, 10, 1);
$dt2 = Carbon::create(2020, 11, 1);

// 分
echo '分 : ' . $dt1->diffInMinutes($dt2) . PHP_EOL;

// 時間
echo '時間 : ' . $dt1->diffInHours($dt2) . PHP_EOL;

// 日
echo '時間 : ' . $dt1->diffInDays($dt2) . PHP_EOL;

// 英語で差分表示
echo '差分(en) : ' . $dt1->diffForHumans($dt2) . PHP_EOL;

// 日本語で差分表示
Carbon::setLocale('ja');
echo '差分(en) : ' . $dt1->diffForHumans($dt2) . PHP_EOL;