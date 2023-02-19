<?php

namespace App\Guacamole\Api\User;

use App\Guacamole\Api\AbstractApi;
use App\Guacamole\Objects\User\GuacamoleUserData;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class CreateUserApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(string $token, string $sourceData, GuacamoleUserData $user): ResponseInterface
    {
        return $this->apiClient->post('api/session/data/' . $sourceData . '/users', [
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