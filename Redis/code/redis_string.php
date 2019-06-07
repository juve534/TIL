<?php
/**
 * RedisのString型について勉強
 *
 * @var Redis
 */
require_once 'vendor/autoload.php';

$redis = new Predis\Client();
$redis->set('name', 'taro');
echo $redis->get('name');