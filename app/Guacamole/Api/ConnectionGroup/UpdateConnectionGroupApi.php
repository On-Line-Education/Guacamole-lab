<?php

namespace App\Guacamole\Api\ConnectionGroup;

use App\Guacamole\Api\AbstractApi;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class UpdateConnectionGroupApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(string $token, string $sourceData, string $name, int $connectionGroup): ResponseInterface
    {
        return $this->apiClient->put('api/session/data/' . $sourceData . '/connectionGroups/'.$connectionGroup, [
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
