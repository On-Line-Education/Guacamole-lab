<?php

namespace App\Guacamole\Endpoints\Connection;

use App\Guacamole\Api\Connection\AssignPermissionConnectionApi;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use GuzzleHttp\Exception\GuzzleException;

class ConnectionPermissionAssignEndpoint
{

    public function __construct(
        private readonly AssignPermissionConnectionApi $assignPermissionConnectionApi
    ) {
    }

    public function __invoke(
        GuacamoleAuthLoginData $loginData,
        string $username,
        int $connection
    ): void {
        try {
            ($this->assignPermissionConnectionApi)(
                $loginData->getAuthToken(),
                $loginData->getDataSource(),
                $username,
                $connection
            );
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
