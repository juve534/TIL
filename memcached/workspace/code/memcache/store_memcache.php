<?php
/**
 * Memcacheライブラリで書き込み
 * @var Memcache
 */
$memcache = new Memcache();
$memcache->addServer('192.168.33.52', 11211);
$memcache->addServer('192.168.33.53', 11211);
$memcache->flush();

for ($i = 0; $i < 100000; $i++) {
    $memcache->set(md5($i), crc32($i), 0, 1800);
}