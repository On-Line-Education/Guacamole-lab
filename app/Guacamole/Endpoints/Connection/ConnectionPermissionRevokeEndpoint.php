<?php

namespace App\Guacamole\Endpoints\Connection;

use App\Guacamole\Api\Connection\RevokePermissionConnectionApi;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use GuzzleHttp\Exception\GuzzleException;

class ConnectionPermissionRevokeEndpoint
{

    public function __construct(
        private readonly RevokePermissionConnectionApi $revokePermissionConnectionApi
    ) {
    }

    public function __invoke(
        GuacamoleAuthLoginData $loginData,
        string $username,
        int $connection
    ): void {
        try {
            ($this->revokePermissionConnectionApi)(
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
