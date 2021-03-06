<?php
/**
 * RedisのList型について勉強
 *
 * @var Redis
 */
require_once 'vendor/autoload.php';

$redis = new Predis\Client();

// lPushは先頭、rPushは末尾に値をpush
$redis->rPush('name_list', 'c');
$redis->rPush('name_list', 'd');
$redis->lPush('name_list', 'b');
$redis->lPush('name_list', 'a');

// 値をすべて取得する -1はすべて
$value = $redis->lRange('name_list', 0, -1);

var_dump($value); // abcd