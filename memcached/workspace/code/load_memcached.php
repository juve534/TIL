<?php
/**
 * Memcachedライブラリで書き込み
 * @var Memcached
 */
$memcache = new Memcached();
$memcache->addServer('192.168.33.52', 11211);
$memcache->addServer('192.168.33.53', 11211);

for ($i = 0; $i < 100000; $i++) {
    $memcache->get(md5($i));
}