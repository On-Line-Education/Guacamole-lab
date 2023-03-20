<?php

namespace App\Guacamole\Api\Connection;

use App\Guacamole\Api\AbstractApi;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class DeleteConnectionApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(string $token, string $sourceData, int $connection): ResponseInterface
    {
        return $this->apiClient->delete('api/session/data/' . $sourceData . '/connections/' . $connection, [
            'query' => [
                'token' => $token
            ]
        ]);
    }
}
