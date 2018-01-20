<?php

require 'vendor/autoload.php';

use Carbon\Carbon;

$dt = Carbon::now();

// インスタンスのコピーを作って加算
echo $dt->copy()->addYear() . PHP_EOL;

// 元のインスタンスには影響がない
echo $dt . PHP_EOL;; 