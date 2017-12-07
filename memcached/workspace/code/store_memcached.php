<?php
/**
 * Memcachedライブラリで書き込み
 * @var Memcached
 */
$memcache = new Memcached();
$memcache->addServer('192.168.33.52', 11211);
$memcache->addServer('192.168.33.53', 11211);
$memcache->flush();

for ($i = 0; $i < 100000; $i++) {
    $memcache->set(md5($i), crc32($i), 1800);
}