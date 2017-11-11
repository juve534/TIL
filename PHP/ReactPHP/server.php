<?php
/**
 * ReactPHPを使って非同期処理実装
 * @author juve534
 */
require_once 'vendor/autoload.php';

$loop   = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http   = new React\Http\Server($socket);

$http->on('request', function($request, $response) {
    $response->writeHead(200, [
       "Content-Type" => "text/plain",
    ]);
    $response->end('Hello');
});

$socket->listen(8080, '192.168.33.10');
$loop->run();