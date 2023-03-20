<?php

namespace App\Guacamole\Endpoints\Connection;

use App\Guacamole\Api\Connection\DeleteConnectionApi;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use GuzzleHttp\Exception\GuzzleException;

class ConnectionDeleteEndpoint
{

    public function __construct(
        private readonly DeleteConnectionApi $deleteConnectionApi
    ) {
    }

    public function __invoke(
        GuacamoleAuthLoginData $loginData,
        int $connection
    ): void {
        try {
            ($this->deleteConnectionApi)(
                $loginData->getAuthToken(),
                $loginData->getDataSource(),
                $connection
            );
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
