<?php

namespace App\Guacamole\Api\User;

use App\Guacamole\Api\AbstractApi;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class ListUserApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(string $token, string $sourceData): ResponseInterface
    {
        return $this->apiClient->get('api/session/data/'.$sourceData.'/users', [
            'query' => [
                'token' => $token
            ]
        ]);
    }
}