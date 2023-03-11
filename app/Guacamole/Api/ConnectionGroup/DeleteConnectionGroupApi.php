<?php

namespace App\Guacamole\Api\ConnectionGroup;

use App\Guacamole\Api\AbstractApi;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class DeleteConnectionGroupApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(string $token, string $sourceData, int $id): ResponseInterface
    {
        return $this->apiClient->delete('api/session/data/' . $sourceData . '/connectionGroups/' . $id, [
            'query' => [
                'token' => $token
            ]
        ]);
    }
}
