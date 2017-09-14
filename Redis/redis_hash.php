<?php
/**
 * RedisのHash型の勉強
 *
 * @var Redis
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

// 値をセット
$redis->hSet('hash', 'hash1', 1);
$redis->hSet('hash', 'hash2', 2);
$redis->hSet('hash', 'hash3', 3);

// 値を取得
$data = $redis->hGetAll('hash');

var_dump($data);