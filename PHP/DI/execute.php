<?php
declare(strict_types=1);

require_once './vendor/autoload.php';

use Juve534\LessonDi\NoDi;
use Juve534\LessonDi\UseDi;
use Juve534\LessonDi\UseDiInterface;
use GuzzleHttp\Client;
use Cake\Http\Client as CakeClient;

$nodi = new NoDi();
var_dump($nodi->getGoogle());

$usedi = new UseDi(new Client());
var_dump($usedi->getGoogle());

foreach ([new CakeClient(), new Client()] AS $client) {
    $usedi2 = new UseDiInterface($client);
    var_dump($usedi2->getGoogle());
}