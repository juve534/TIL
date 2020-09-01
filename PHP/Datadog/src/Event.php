<?php

declare(strict_types=1);

namespace Datadog;

use GuzzleHttp\ClientInterface as HttpClient;
use Datadog\Constants\EndPoint;

class Event
{
    private HttpClient $client;
    private string $apiKey;

    public function __construct(HttpClient $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function addEvent():void
    {
        $this->client->request(
            'POST',
            EndPoint::EVENT_URI,
            [
                'query' => [
                    'api_key' => $this->apiKey,
                ],
                'json' => [
                    'text' => 'Oh boy!',
                    'title' => 'Did you hear the news today?',
                ],
            ]
        );
    }
}