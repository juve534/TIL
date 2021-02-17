<?php
declare(strict_types=1);

namespace Juve534\LessonDi;


use GuzzleHttp\Client;

class UseDi
{
    private Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function getGoogle()
    {
        $response = $this->client->get('https://www.google.co.jp/');

        return $response->getStatusCode();
    }
}