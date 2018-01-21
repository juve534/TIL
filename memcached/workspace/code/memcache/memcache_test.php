<?php
/**
 * Memcacheライブラリの動作検証
 * @var Memcache
 */
$memcache = new Memcache();
$memcache->addServer('192.168.33.52', 11211);
$memcache->addServer('192.168.33.53', 11211);
$memcache->set('key', 'test!', 0, 1000);
echo $memcache->get('key');