<?php

declare(strict_types=1);

/**
 * ReactPHPを使って非同期処理実装
 * @author juve534
 */
require_once 'vendor/autoload.php';

use React\EventLoop\Factory;
use Psr\Http\Message\ServerRequestInterface;
use React\Http\Message\Response;
use React\Socket\Server;

$loop = Factory::create();

$server = new React\Http\Server($loop, function (ServerRequestInterface $request) {
    return new Response(
        200,
        array(
            'Content-Type' => 'text/plain'
        ),
        "Hello World!\n"
    );
});

$socket = new Server('127.0.0.1:8080', $loop);
$server->listen($socket);

echo "Server running at http://127.0.0.1:8080\n";

$loop->run();