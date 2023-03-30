<?php

namespace App\Guacamole\Endpoints\Connection;

use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Guacamole\Objects\Connection\GuacamoleConnection;

class ConnectionEndpoint
{

    public function __construct(
        private readonly ConnectionCreateEndpoint $connectionCreateEndpoint,
        private readonly ConnectionPermissionAssignEndpoint $connectionPermissionAssignEndpoint,
        private readonly ConnectionPermissionRevokeEndpoint $connectionPermissionRevokeEndpoint,
        private readonly ConnectionKillEndpoint $connectionKillEndpoint,
        private readonly ConnectionDeleteEndpoint $connectionDeleteEndpoint
    ) {
    }

    public function create(
        GuacamoleAuthLoginData $loginData,
        string $name,
        string $group,
        string $ip,
        string $mac,
        string $domain
    ): GuacamoleConnection {
        return ($this->connectionCreateEndpoint)(
            $loginData,
            $name,
            $group,
            $ip,
            $mac,
            $domain
        );
    }

    public function assignPermission(
        GuacamoleAuthLoginData $loginData,
        string $username,
        int $connection
    ): void {
        ($this->connectionPermissionAssignEndpoint)($loginData, $username, $connection);
    }

    public function revokePermission(
        GuacamoleAuthLoginData $loginData,
        string $username,
        int $connection
    ): void {
        ($this->connectionPermissionRevokeEndpoint)($loginData, $username, $connection);
    }

    public function killConnection(
        GuacamoleAuthLoginData $loginData,
        int $connection
    ): void {
        ($this->connectionKillEndpoint)($loginData, $connection);
    }

    public function deleteConnection(
        GuacamoleAuthLoginData $loginData,
        int $connection
    ): void {
        ($this->connectionDeleteEndpoint)($loginData, $connection);
    }
}
