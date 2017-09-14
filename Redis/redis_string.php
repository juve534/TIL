<?php
/**
 * RedisのString型について勉強
 *
 * @var Redis
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379);
$redis->set('name', 'taro');
echo $redis->get('name');