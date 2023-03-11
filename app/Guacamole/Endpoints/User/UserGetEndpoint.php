<?php

namespace App\Guacamole\Endpoints\User;

use App\Guacamole\Api\User\GetUserApi;
use App\Guacamole\Endpoints\ApiResponseWrapper;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Guacamole\Objects\User\GuacamoleUserData;
use GuzzleHttp\Exception\GuzzleException;

class UserGetEndpoint
{

    public function __construct(
        private readonly GetUserApi $getUserApi,
        private readonly ApiResponseWrapper $apiResponseWrapper
    )
    {}

    public function __invoke(GuacamoleAuthLoginData $loginData, string $username): ?GuacamoleUserData
    {
        try {
            $response = ($this->getUserApi)($loginData->getAuthToken(), $loginData->getDataSource(), $username);
            $user = ($this->apiResponseWrapper)($response);
            if (count($user) > 0) {
                return new GuacamoleUserData($user);
            } else {
                return null;
            }
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
