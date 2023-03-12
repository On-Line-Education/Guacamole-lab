<?php

namespace App\Guacamole\Endpoints\ConnectionGroup;

use App\Guacamole\Api\ConnectionGroup\CreateConnectionGroupApi;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use GuzzleHttp\Exception\GuzzleException;

class ConnectionGroupCreateEndpoint
{

    public function __construct(
        private readonly CreateConnectionGroupApi $createConnectionGroupApi
    ) {
    }

    public function __invoke(GuacamoleAuthLoginData $loginData, string $name): void
    {
        try {
            ($this->createConnectionGroupApi)(
                $loginData->getAuthToken(),
                $loginData->getDataSource(),
                $name
            );
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
