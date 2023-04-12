<?php

namespace App\Guacamole\Api\Connection;

use App\Guacamole\Api\AbstractApi;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class KillConnectionApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(string $token, string $sourceData, string $connection): ResponseInterface
    {
        return $this->apiClient->patch('api/session/data/' . $sourceData . '/activeConnections', [
            'query' => [
                'token' => $token
            ],
            'headers' => [
                'Content-Type' => 'application/json;charset=utf-8'
            ],
            'body' => json_encode([[
                'op' => 'remove',
                'path' => '/' . $connection,
            ]])
        ]);
    }
}
