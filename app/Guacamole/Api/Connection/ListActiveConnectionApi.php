<?php

namespace App\Guacamole\Api\Connection;

use App\Guacamole\Api\AbstractApi;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class ListActiveConnectionApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(string $token, string $sourceData): ResponseInterface
    {
        return $this->apiClient->get('api/session/data/' . $sourceData . '/activeConnections', [
            'query' => [
                'token' => $token
            ],
            'headers' => [
                'Content-Type' => 'application/json;charset=utf-8'
            ]
        ]);
    }
}
