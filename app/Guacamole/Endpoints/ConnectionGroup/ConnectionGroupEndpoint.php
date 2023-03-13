<?php

namespace App\Guacamole\Endpoints\ConnectionGroup;

use App\Guacamole\Endpoints\ConnectionGroup\ConnectionGroupListEndpoint;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;

class ConnectionGroupEndpoint
{

    public function __construct(
        private readonly ConnectionGroupListEndpoint $connectionGroupListEndpoint,
        private readonly ConnectionGroupCreateEndpoint $connectionGroupCreateEndpoint,
        private readonly ConnectionGroupDeleteEndpoint $connectionGroupDeleteEndpoint,
        private readonly ConnectionGroupAssignPermissionsEndpoint $connectionGroupAssignPermissionsEndpoint,
        private readonly ConnectionGroupRevokePermissionsEndpoint $connectionGroupRevokePermissionsEndpoint
    )
    {}

    public function list(GuacamoleAuthLoginData $loginData): array
    {
        return ($this->connectionGroupListEndpoint)($loginData);
    }

    public function create(GuacamoleAuthLoginData $loginData, string $name): void
    {
        ($this->connectionGroupCreateEndpoint)($loginData, $name);
    }

    public function delete(GuacamoleAuthLoginData $loginData, string $name): void
    {
        ($this->connectionGroupDeleteEndpoint)($loginData, $name);
    }

    public function assignPermissions(GuacamoleAuthLoginData $loginData, string $username, string $group): void
    {
        ($this->connectionGroupAssignPermissionsEndpoint)($loginData, $username, $group);
    }

    public function revokePermissions(GuacamoleAuthLoginData $loginData, string $username, string $group): void
    {
        ($this->connectionGroupRevokePermissionsEndpoint)($loginData, $username, $group);
    }
}
