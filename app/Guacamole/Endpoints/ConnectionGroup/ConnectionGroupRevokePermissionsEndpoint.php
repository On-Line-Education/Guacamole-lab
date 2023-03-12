<?php

namespace App\Guacamole\Endpoints\ConnectionGroup;

use App\Guacamole\Api\ConnectionGroup\RevokePermissionConnectionGroupApi;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use GuzzleHttp\Exception\GuzzleException;

class ConnectionGroupRevokePermissionsEndpoint
{

    public function __construct(
        private readonly RevokePermissionConnectionGroupApi $revokePermissionConnectionGroupApi,
        private readonly ConnectionGroupListEndpoint $connectionGroupListEndpoint
    ) {
    }

    public function __invoke(GuacamoleAuthLoginData $loginData, string $name, string $group): void
    {
        try {
            ($this->revokePermissionConnectionGroupApi)(
                $loginData->getAuthToken(),
                $loginData->getDataSource(),
                $name,
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
