<?php

namespace App\Guacamole\Api\User;

use App\Guacamole\Api\AbstractApi;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class GetUserApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(string $token, string $sourceData, string $username): ResponseInterface
    {
        return $this->apiClient->get('api/session/data/'.$sourceData.'/users/'.$username, [
            'query' => [
                'token' => $token
            ]
        ]);
    }
}
