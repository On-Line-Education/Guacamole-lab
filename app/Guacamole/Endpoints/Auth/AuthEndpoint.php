<?php

namespace App\Guacamole\Endpoints\Auth;

use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;

class AuthEndpoint {

    public function __construct(
            private readonly AuthLoginEndpoint $loginEndpoint,
            private readonly AuthLogoutEndpoint $logoutEndpoint
            )
    {}

    public function login(string $username, string $password): GuacamoleAuthLoginData {
        return ($this->loginEndpoint)($username, $password);
    }

    public function logout(string $token) {
        return ($this->logoutEndpoint)($token);
    }
}
