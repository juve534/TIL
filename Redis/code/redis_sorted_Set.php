<?php
/**
 * RedisのSorted Set型の勉強
 *
 * @var Redis
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

// スコアと値を追加
$redis->zAdd('science' , 50, 'test1');
$redis->zAdd('science' , 40, 'test2');
$redis->zAdd('science' , 60, 'test3');

// 昇順にソート
$data = $redis->zRangeByScore('science', 40, 60);

var_dump($data);