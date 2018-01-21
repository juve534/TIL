<?php

require 'vendor/autoload.php';

use Carbon\Carbon;

$birthday = Carbon::create(1990, 10, 1);

// テスト用の日付
Carbon::setTestNow(Carbon::create(2020, 10, 1));

$text = ':<';
if ($birthday->isBirthday(Carbon::now())) {
    $text = ':)';
}
echo $text . PHP_EOL;