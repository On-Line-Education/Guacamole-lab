<?php

namespace App\Guacamole\Endpoints\Connection;

use App\Guacamole\Api\Connection\CreateConnectionApi;
use App\Guacamole\Endpoints\ApiResponseWrapper;
use App\Guacamole\Endpoints\ConnectionGroup\ConnectionGroupListEndpoint;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Guacamole\Objects\Connection\GuacamoleConnection;
use GuzzleHttp\Exception\GuzzleException;

class ConnectionCreateEndpoint
{

    public function __construct(
        private readonly CreateConnectionApi $createConnectionApi,
        private readonly ConnectionGroupListEndpoint $connectionGroupListEndpoint,
        private readonly ApiResponseWrapper $apiResponseWrapper
    ) {
    }

    public function __invoke(
        GuacamoleAuthLoginData $loginData,
        string $name,
        string $group,
        string $ip,
        string $mac,
        string $broadcast,
        string $domain
    ): GuacamoleConnection {
        try {
            $response = ($this->createConnectionApi)(
                $loginData->getAuthToken(),
                $loginData->getDataSource(),
                $name,
                $this->getConnectionGroupId($loginData, $group),
                $ip,
                $mac,
                $broadcast,
                $domain
            );
            return new GuacamoleConnection(($this->apiResponseWrapper)($response));
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
