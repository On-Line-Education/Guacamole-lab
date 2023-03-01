<?php

namespace App\Guacamole;

use App\Guacamole\Endpoints\Auth\AuthEndpoint;
use App\Guacamole\Endpoints\User\UserEndpoint;

class Guacamole
{
    public function __construct(
        private readonly AuthEndpoint $auth,
        private readonly UserEndpoint $user
    )
    {}

    public static function getUrl() : string {
        return str_ends_with(env("GUACAMOLE_URL"), '/')
            ? env("GUACAMOLE_URL")
            : env("GUACAMOLE_URL") . "/";
    }

    /**
     * @return AuthEndpoint
     */
    public function getAuth(): AuthEndpoint
    {
        return $this->auth;
    }

    /**
     * @return UserEndpoint
     */
    public function getUser(): UserEndpoint
    {
        return $this->user;
    }
}
