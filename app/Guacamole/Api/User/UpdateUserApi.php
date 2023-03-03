<?php

namespace App\Guacamole\Api\User;

use App\Guacamole\Api\AbstractApi;
use App\Guacamole\Objects\User\GuacamoleUserData;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class UpdateUserApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(string $token, string $sourceData, GuacamoleUserData $user): ResponseInterface
    {
        return $this->apiClient->put('api/session/data/' . $sourceData . '/users/'. $user->username, [
            'query' => [
                'token' => $token
            ],
            'headers' => [
                    'Content-Type' => 'application/json'
            ],
            'body' => json_encode($user->getGuacFormat())
        ]);
    }
}