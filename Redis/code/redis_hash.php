<?php
/**
 * RedisのHash型の勉強
 *
 * @var Redis
 */
require_once 'vendor/autoload.php';

$redis = new Predis\Client();

// 値をセット
$redis->hSet('hash', 'hash1', 1);
$redis->hSet('hash', 'hash2', 2);
$redis->hSet('hash', 'hash3', 3);

// 値を取得
$data = $redis->hGetAll('hash');

var_dump($data);