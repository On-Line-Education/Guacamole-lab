<?php

namespace App\Guacamole\Endpoints\User;

use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;

class UserEndpoint {

    public function __construct(
            private readonly UserListEndpoint $userListEndpoint
            )
    {}

    public function list(GuacamoleAuthLoginData $loginData): array {
        return ($this->userListEndpoint)($loginData);
    }
}