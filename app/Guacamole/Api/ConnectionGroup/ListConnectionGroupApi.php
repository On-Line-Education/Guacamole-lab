<?php

namespace App\Guacamole\Api\ConnectionGroup;

use App\Guacamole\Api\AbstractApi;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class ListConnectionGroupApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(string $token, string $sourceData): ResponseInterface
    {
        return $this->apiClient->get('api/session/data/'.$sourceData.'/connectionGroups/ROOT/tree', [
            'query' => [
                'token' => $token
            ]
        ]);
    }
}
