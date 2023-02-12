<?php

namespace App\Guacamole\Endpoints\Auth;

use App\Guacamole\Api\Auth\LogoutAuthApi;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Guacamole\Helpers\ApiResponseWrapper;
use GuzzleHttp\Exception\GuzzleException;

class AuthLogoutEndpoint {

    public function __construct(
            private readonly LogoutAuthApi $logoutAuthApi,
            private readonly ApiResponseWrapper $apiResponseWrapper
            )
    {}

    public function __invoke(string $token)
    {
        try {
            $response = ($this->logoutAuthApi)($token);
            return new GuacamoleAuthLoginData(($this->apiResponseWrapper)($response));
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), $exception->getMessage());
        }
    }
}