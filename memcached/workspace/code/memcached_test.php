<?php
/**
 * Memcachedライブラリの動作検証
 * @var Memcached
 */
$memcache = new Memcached();
$memcache->addServer('192.168.33.52', 11211);
$memcache->addServer('192.168.33.53', 11211);
$memcache->set('key', 'test!', 1000);
echo $memcache->get('key');