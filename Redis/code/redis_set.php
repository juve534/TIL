<?php
/**
 * Set型について確認
 *
 * @var Redis
 */
require_once 'vendor/autoload.php';

$redis = new Predis\Client();

// 値を追加
$redis->sAdd('test1' , '1');
$redis->sAdd('test1' , '2');
$redis->sAdd('test2' , '1'); // 重複
$redis->sAdd('test2' , '2'); // 重複
$redis->sAdd('test2' , '3');

// 重複が弾かれていることを確認する
$data = $redis->sUnion('test1', 'test2');

var_dump($data);