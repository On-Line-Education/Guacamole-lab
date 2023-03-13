<?php

namespace App\Guacamole\Endpoints\Connection;

use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Guacamole\Objects\Connection\GuacamoleConnection;

class ConnectionEndpoint
{

    public function __construct(
        private readonly ConnectionCreateEndpoint $connectionCreateEndpoint
    )
    {}

    public function create(
        GuacamoleAuthLoginData $loginData,
        string $name,
        string $group,
        string $ip,
        string $domain
        ): GuacamoleConnection {
        return ($this->connectionCreateEndpoint)(
            $loginData,
            $name,
            $group,
            $ip,
            $domain
        );
    }
}
