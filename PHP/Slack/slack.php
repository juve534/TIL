<?php
require_once dirname(__FILE__) . '/vendor/autoload.php';
use \GuzzleHttp\Client;

function sendToSlack(array $message)
{
    $dotEnv = new Dotenv\Dotenv(__DIR__);
    $dotEnv->load();
    $webHookUrl = getenv('WEB_HOOK_URL');

    $client = new Client();
    $method = 'POST';
    $uri = $webHookUrl;
    $options = [
        'json' => $message
    ];
    $response = $client->post($uri, $options);

    return $response;
}

$message = [
  'username' => 'Bot',
  'text' => 'fooooo!!!',
];

sendToSlack($message);