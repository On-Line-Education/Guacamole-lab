<?php

namespace App\Guacamole\Endpoints\User;

use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Guacamole\Objects\User\GuacamoleUserData;

class UserEndpoint
{

    public function __construct(
        private readonly UserListEndpoint $userListEndpoint,
        private readonly UserGetEndpoint $userGetEndpoint,
        private readonly UserCreateEndpoint $userCreateEndpoint,
        private readonly UserDeleteEndpoint $userDeleteEndpoint,
        private readonly UserUpdateEndpoint $userUpdateEndpoint,
        private readonly UserUpdatePasswordEndpoint $userUpdatePasswordEndpoint,
    )
    {}

    public function list(GuacamoleAuthLoginData $loginData): array
    {
        return ($this->userListEndpoint)($loginData);
    }

    public function get(GuacamoleAuthLoginData $loginData, string $username): ?GuacamoleUserData
    {
        return ($this->userGetEndpoint)($loginData, $username);
    }

    public function create(GuacamoleAuthLoginData $loginData, GuacamoleUserData $user): void
    {
        ($this->userCreateEndpoint)($loginData, $user);
    }

    public function delete(GuacamoleAuthLoginData $loginData, string $username): void
    {
        ($this->userDeleteEndpoint)($loginData, $username);
    }

    public function update(GuacamoleAuthLoginData $loginData, GuacamoleUserData $user, ?string $password = null): void
    {
        ($this->userUpdateEndpoint)($loginData, $user, $password);
    }

    public function updatePassword(
        GuacamoleAuthLoginData $loginData,
        string $username,
        string $oldPassword,
        string $newPassword
    ) {
        ($this->userUpdatePasswordEndpoint)($loginData, $username, $oldPassword, $newPassword);
    }
}
