<?php

namespace App\Guacamole\Endpoints\User;

use App\Guacamole\Api\User\DeleteUserApi;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use GuzzleHttp\Exception\GuzzleException;

class UserDeleteEndpoint {

    public function __construct(
            private readonly DeleteUserApi $deleteUserApi
    ){}

    public function __invoke(GuacamoleAuthLoginData $loginData, string $username): void
    {
        try {
            ($this->deleteUserApi)($loginData->getAuthToken(), $loginData->getDataSource(), $username);
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
