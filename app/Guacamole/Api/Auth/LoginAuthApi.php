<?php

namespace App\Guacamole\Api\Auth;

use App\Guacamole\Api\AbstractApi;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class LoginAuthApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(string $username, string $password): ResponseInterface
    {
        return $this->apiClient->post('api/tokens', [
            'form_params' => [
                'username' => $username,
                'password' => $password
            ]
        ]);
    }
}