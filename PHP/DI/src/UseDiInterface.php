<?php
declare(strict_types=1);

namespace Juve534\LessonDi;

use Psr\Http\Client\ClientInterface;

class UseDiInterface
{
    private ClientInterface $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function getGoogle()
    {
        $response = $this->client->get('https://www.google.co.jp/');

        return $response->getStatusCode();
    }
}