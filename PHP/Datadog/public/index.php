<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

$app = AppFactory::create();

$app->get('/hello', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello world!");
    return $response;
});

$app->group('/datadog', function (Group $group) {
    $group->post('/event', function (Request $request, Response $response, $args) {
        $event = new \Datadog\Event(new \GuzzleHttp\Client(), getenv('DD_API_KEY'));
        return $response->withStatus(204);
    });
});

$app->run();