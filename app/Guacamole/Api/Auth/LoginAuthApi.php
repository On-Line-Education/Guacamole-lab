<?php

namespace App\Guacamole\Api\Auth;

use App\Exceptions\InvalidGuacamoleUrlException;
use App\Guacamole\Api\AbstractApi;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;
use GuzzleHttp\Exception\ConnectException;

class LoginAuthApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     * @throws InvalidGuacamoleUrlException
     */
    public function __invoke(string $username, string $password): ResponseInterface
    {
        try {
            return $this->apiClient->post('api/tokens', [
                'form_params' => [
                    'username' => $username,
                    'password' => $password
                ]
            ]);
        } catch (ConnectException $e) {
            throw new InvalidGuacamoleUrlException();
        }
    }
}
