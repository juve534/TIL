<?php
declare(strict_types=1);

namespace Juve534\LessonDi;


use GuzzleHttp\Client;

class UseDi
{
    public function __construct(private Client $client)
    {}

    public function getGoogle()
    {
        $response = $this->client->get('https://www.google.co.jp/');

        return $response->getStatusCode();
    }
}