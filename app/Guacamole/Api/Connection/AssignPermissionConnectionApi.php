<?php

namespace App\Guacamole\Api\Connection;

use App\Guacamole\Api\AbstractApi;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class AssignPermissionConnectionApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(string $token, string $sourceData, string $username, int $connection): ResponseInterface
    {
        return $this->apiClient->patch('api/session/data/' . $sourceData . '/users/' . $username . '/permissions', [
            'query' => [
                'token' => $token
            ],
            'headers' => [
                'Content-Type' => 'application/json;charset=utf-8'
            ],
            'body' => json_encode([[
                'op' => 'add',
                'path' => '/connectionPermissions/' . $connection,
                'value' => 'READ'
            ]])
        ]);
    }
}
