<?php

namespace App\Guacamole\Endpoints\Auth;

use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Guacamole\Api\Auth\LoginAuthApi;
use App\Guacamole\Helpers\ApiResponseWrapper;
use GuzzleHttp\Exception\GuzzleException;

class AuthLoginEndpoint
{

    public function __construct(
        private readonly LoginAuthApi $loginAuthApi,
        private readonly ApiResponseWrapper $apiResponseWrapper
    )
    {}

    public function __invoke(string $username, string $password): GuacamoleAuthLoginData
    {
        try {
            $response = ($this->loginAuthApi)($username, $password);
            return new GuacamoleAuthLoginData(($this->apiResponseWrapper)($response));
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
