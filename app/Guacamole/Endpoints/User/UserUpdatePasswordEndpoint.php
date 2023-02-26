<?php

namespace App\Guacamole\Endpoints\User;

use App\Guacamole\Api\User\UpdateUserApi;
use App\Guacamole\Api\User\UpdateUserPasswordApi;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Guacamole\Objects\User\GuacamoleUserData;
use GuzzleHttp\Exception\GuzzleException;

class UserUpdatePasswordEndpoint {

    public function __construct(
            private readonly UpdateUserPasswordApi $updateUserPasswordApi
    ){}

    public function __invoke(GuacamoleAuthLoginData $loginData, string $username, string $oldPassword, string $newPassword): void
    {
        try {
            ($this->updateUserPasswordApi)($loginData->getAuthToken(), $loginData->getDataSource(), $username, $oldPassword, $newPassword);
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
