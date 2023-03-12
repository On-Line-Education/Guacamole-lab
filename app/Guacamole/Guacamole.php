<?php

namespace App\Guacamole;

use App\Guacamole\Endpoints\Auth\AuthEndpoint;
use App\Guacamole\Endpoints\Connection\ConnectionEndpoint;
use App\Guacamole\Endpoints\ConnectionGroup\ConnectionGroupEndpoint;
use App\Guacamole\Endpoints\User\UserEndpoint;

class Guacamole
{
    public function __construct(
        private readonly AuthEndpoint $auth,
        private readonly UserEndpoint $user,
        private readonly ConnectionGroupEndpoint $connectionGroupEndpoint,
        private readonly ConnectionEndpoint $connectionEndpoint
    ) {
    }

    public static function getUrl() : string
    {
        return str_ends_with(env("GUACAMOLE_URL"), '/')
            ? env("GUACAMOLE_URL")
            : env("GUACAMOLE_URL") . "/";
    }

    public static function getAppUrl() : string
    {
        return str_ends_with(env("GUACAMOLE_APP_URL"), '/')
            ? env("GUACAMOLE_APP_URL")
            : env("GUACAMOLE_APP_URL") . "/";
    }
    
    public static function generateSessionConnectionUrl(int $connectionId, string $provider) : string
    {
        $urlBuilder = "$connectionId\0c\0$provider";

        return Guacamole::getAppUrl() . "guacamole/#/client/" . base64_encode($urlBuilder);
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

    /**
     * @return ConnectionGroupEndpoint
     */
    public function getConnectionGroupEndpoint(): ConnectionGroupEndpoint
    {
        return $this->connectionGroupEndpoint;
    }

    /**
     * @return ConnectionGroupEndpoint
     */
    public function getConnectionEndpoint(): ConnectionEndpoint
    {
        return $this->connectionEndpoint;
    }
}
