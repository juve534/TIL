<?php
/**
 * SwooleでWebSocketサーバを立てる
 * @link https://www.swoole.co.uk/
 */
define('SERVER_IP', '192.168.33.44');
define('PORT', 9502);

$server = new swoole_websocket_server(SERVER_IP, PORT);

$server->on('open', function($server, $req) {
    echo "connection open: {$req->fd}\n";
});

$server->on('message', function($server, $frame) {
    echo "received message: {$frame->data}\n";
    $server->push($frame->fd, json_encode(["hello", "world"]));
});

$server->on('close', function($server, $fd) {
    echo "connection close: {$fd}\n";
});

$server->start();