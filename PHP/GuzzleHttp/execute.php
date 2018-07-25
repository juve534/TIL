<?php
declare(strict_types=1);

require_once dirname(__FILE__) . '/vendor/autoload.php';
require_once 'GuzzleFork.php';
use \GuzzleHttp\Client;
use Dotenv\Dotenv;

$dotEnv = new Dotenv(__DIR__);
$dotEnv->load();

$obj = new GuzzleFork(new Client());
$url = getenv('EXECUTE_URL');

try {
    $response = $obj->executeUrl($url);
    var_dump($response->getStatusCode());
} catch (\Exception $e) {
    echo $e->getMessage();
}
