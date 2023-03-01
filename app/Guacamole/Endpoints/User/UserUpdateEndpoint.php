<?php

namespace App\Guacamole\Endpoints\User;

use App\Guacamole\Api\User\UpdateUserApi;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Guacamole\Objects\User\GuacamoleUserData;
use GuzzleHttp\Exception\GuzzleException;

class UserUpdateEndpoint
{

    public function __construct(
        private readonly UpdateUserApi $updateUserApi
    )
    {}

    public function __invoke(GuacamoleAuthLoginData $loginData, GuacamoleUserData $user): void
    {
        try {
            ($this->updateUserApi)($loginData->getAuthToken(), $loginData->getDataSource(), $user);
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
