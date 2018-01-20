<?php

require 'vendor/autoload.php';

use Carbon\Carbon;

$dt1 = Carbon::create(2020, 10, 1);
$dt2 = Carbon::create(2020, 11, 1);

// イコール
var_dump($dt1->eq($dt2));

// より大きい
var_dump($dt1->gt($dt2));

// 以上
var_dump($dt1->gte($dt2));

// より小さい
var_dump($dt1->lt($dt2));

// 以下
var_dump($dt1->lte($dt2));

// 日付が２つの日付の間にあるか
var_dump(Carbon::create(2020, 10, 10)->between($dt1, $dt2));
var_dump(Carbon::create(2021, 10, 10)->between($dt1, $dt2));