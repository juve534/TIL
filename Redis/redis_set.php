<?php
/**
 * Set型について確認
 *
 * @var Redis
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);

// 値を追加
$redis->sAdd('test1' , '1');
$redis->sAdd('test1' , '2');
$redis->sAdd('test2' , '1'); // 重複
$redis->sAdd('test2' , '2'); // 重複
$redis->sAdd('test2' , '3');

// 重複が弾かれていることを確認する
$data = $redis->sUnion('test1', 'test2');

var_dump($data);