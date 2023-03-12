<?php

namespace App\Guacamole\Endpoints\ConnectionGroup;

use App\Guacamole\Api\ConnectionGroup\AssignPermissionConnectionGroupApi;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use GuzzleHttp\Exception\GuzzleException;

class ConnectionGroupAssignPermissionsEndpoint
{

    public function __construct(
        private readonly AssignPermissionConnectionGroupApi $assignPermissionConnectionGroupApi,
        private readonly ConnectionGroupListEndpoint $connectionGroupListEndpoint
    ) {
    }

    public function __invoke(GuacamoleAuthLoginData $loginData, string $username, string $group): void
    {
        try {
            ($this->assignPermissionConnectionGroupApi)(
                $loginData->getAuthToken(),
                $loginData->getDataSource(),
                $username,
                $this->getConnectionGroupId($loginData, $group)
            );
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }

    public function getConnectionGroupId(GuacamoleAuthLoginData $loginData, string $name): int
    {
        $list = ($this->connectionGroupListEndpoint)($loginData);
        $id = 0;
        if (array_key_exists('childConnectionGroups', $list)) {
            foreach ($list['childConnectionGroups'] as $connectionGroup) {
                if ($connectionGroup['name'] === $name) {
                    $id = (int)$connectionGroup['identifier'];
                    break;
                }
            }
        }
        return $id;
    }
}
