<?php

namespace App\Guacamole\Endpoints\User;

use App\Guacamole\Api\User\AssignChangePasswordPermissionUserApi;
use App\Guacamole\Api\User\AssignInstructorPermissionsUserApi;
use App\Guacamole\Api\User\CreateUserApi;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Guacamole\Objects\User\GuacamoleUserData;
use GuzzleHttp\Exception\GuzzleException;

class UserCreateEndpoint
{

    public function __construct(
        private readonly CreateUserApi $createUserApi,
        private readonly AssignChangePasswordPermissionUserApi $assignChangePasswordPermissionUserApi,
        private readonly AssignInstructorPermissionsUserApi $assignInstructorPermissionsUserApi
    )
    {}

    public function __invoke(GuacamoleAuthLoginData $loginData, GuacamoleUserData $user, bool $isInstructor): void
    {
        try {
            ($this->createUserApi)($loginData->getAuthToken(), $loginData->getDataSource(), $user);
            ($this->assignChangePasswordPermissionUserApi)(
                $loginData->getAuthToken(),
                $loginData->getDataSource(),
                $user
            );
            if ($isInstructor) {
                ($this->assignInstructorPermissionsUserApi)(
                    $loginData->getAuthToken(),
                    $loginData->getDataSource(),
                    $user
                );
            }
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
