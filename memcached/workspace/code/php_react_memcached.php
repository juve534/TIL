<?php
/**
 * php-react-memcachedの動作検証
 */
require 'vendor/autoload.php';

use seregazhuk\React\Memcached\Factory;

$loop   = React\EventLoop\Factory::create();
$client = Factory::createClient($loop, '192.168.33.52:11211');

$client->set('example', 'Hello world');

$client->get('example')->then(function ($data) {
    echo $data . PHP_EOL; // Hello world
});

$client->end();
$loop->run();