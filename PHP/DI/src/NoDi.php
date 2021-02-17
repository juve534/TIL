<?php
declare(strict_types=1);

namespace Juve534\LessonDi;

use GuzzleHttp\Client;

class NoDi
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getGoogle()
    {
        $response = $this->client->get('https://www.google.co.jp/');

        return $response->getStatusCode();
    }
}