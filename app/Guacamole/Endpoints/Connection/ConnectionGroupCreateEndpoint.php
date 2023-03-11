<?php

namespace App\Guacamole\Endpoints\Connection;

use App\Guacamole\Api\Connection\CreateConnectionApi;
use App\Guacamole\Api\ConnectionGroup\CreateConnectionGroupApi;
use App\Guacamole\Endpoints\ConnectionGroup\ConnectionGroupListEndpoint;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use GuzzleHttp\Exception\GuzzleException;

class ConnectionCreateEndpoint
{

    public function __construct(
        private readonly CreateConnectionApi $createConnectionApi,
        private readonly ConnectionGroupListEndpoint $connectionGroupListEndpoint
    ) {
    }

    public function __invoke(GuacamoleAuthLoginData $loginData, string $name, string $group, string $ip, string $domain): void
    {
        try {
            ($this->createConnectionApi)(
                $loginData->getAuthToken(),
                $loginData->getDataSource(),
                $name,
                $this->getConnectionGroupId($loginData, $group),
                $ip, 
                $domain
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
