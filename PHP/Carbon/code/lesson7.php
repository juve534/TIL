<?php

require 'vendor/autoload.php';

use Carbon\Carbon;

$dt = Carbon::now();

echo '1日後 : ' . $dt->addDay() . PHP_EOL;
echo '3日後 : ' . $dt->addDays(3) . PHP_EOL;

echo '1日前 : ' . $dt->subDay() . PHP_EOL;
echo '3日前 : ' . $dt->subDays(3) . PHP_EOL;

echo '3営業日後 : ' . $dt->addWeekDays(3) . PHP_EOL;

// アロー演算子でチェイン
echo '3営業日後の3時間20分後 : ' . $dt->addWeekDays(3)->addHour(3)->addMinutes(20) . PHP_EOL;