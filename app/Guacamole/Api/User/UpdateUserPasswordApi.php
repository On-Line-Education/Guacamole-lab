<?php

namespace App\Guacamole\Api\User;

use App\Guacamole\Api\AbstractApi;
use App\Guacamole\Objects\User\GuacamoleUserData;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class UpdateUserPasswordApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(string $token, string $sourceData, string $username, string $oldPassword, string $newPassword): ResponseInterface
    {
        return $this->apiClient->put('api/session/data/' . $sourceData . '/users/' . $username . '/password', [
                'query' => [
                        'token' => $token
            ],
            'headers' => [
                    'Content-Type' => 'application/json'
            ],
            'body' => json_encode([
                'oldPassword' => $oldPassword,
                'newPassword' => $newPassword
            ])
        ]);
    }
}