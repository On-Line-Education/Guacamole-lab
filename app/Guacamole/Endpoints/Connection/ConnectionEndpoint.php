<?php

namespace App\Guacamole\Endpoints\Connection;

use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;

class ConnectionEndpoint
{

    public function __construct(
        private readonly ConnectionCreateEndpoint $connectionCreateEndpoint,
    )
    {}

    public function create(GuacamoleAuthLoginData $loginData, string $name, string $group, string $ip, string $domain): void
    {
        ($this->connectionCreateEndpoint)($loginData, $name, $group, $ip, $domain);
    }
}
