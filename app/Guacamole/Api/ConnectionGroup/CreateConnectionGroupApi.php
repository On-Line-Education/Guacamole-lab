<?php

namespace App\Guacamole\Api\ConnectionGroup;

use App\Guacamole\Api\AbstractApi;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class CreateConnectionGroupApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(string $token, string $sourceData, string $name): ResponseInterface
    {
        return $this->apiClient->post('api/session/data/' . $sourceData . '/connectionGroups', [
            'query' => [
                'token' => $token
            ],
            'headers' => [
                'Content-Type' => 'application/json;charset=utf-8'
            ],
            'body' => json_encode([
                'name' => $name,
                'parentIdentifier' => 'ROOT',
                'type' => 'ORGANIZATIONAL',
                'activeConnections' => 0,
                'attributes' => [
                    'max-connections' => null,
                    'max-connections-per-user' => null,
                    'enable-session-affinity' => ''
                ]
            ])
        ]);
    }
}
