<?php
/**
 * SwooleでHTTPサーバを立てる
 * @link https://www.swoole.co.uk/
 */
define('SERVER_IP', '192.168.33.44');
define('PORT', 9501);

$http = new swoole_http_server(SERVER_IP, PORT);

$http->on('start', function ($server) {
    echo 'Swoole http server is started at ';
    echo 'http://' . SERVER_IP . ':' . PORT . PHP_EOL;
});

$http->on('request', function ($request, $response) {
    $response->header('Content-Type', 'text/plain');
    $response->end('Hello World<br>');
});

$http->start();