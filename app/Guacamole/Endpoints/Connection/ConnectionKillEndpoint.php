<?php

namespace App\Guacamole\Endpoints\Connection;

use App\Guacamole\Api\Connection\KillConnectionApi;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use GuzzleHttp\Exception\GuzzleException;

class ConnectionKillEndpoint
{

    public function __construct(
        private readonly KillConnectionApi $killConnectionApi
    ) {
    }

    public function __invoke(
        GuacamoleAuthLoginData $loginData,
        int $connection
    ): void {
        try {
            ($this->killConnectionApi)(
                $loginData->getAuthToken(),
                $loginData->getDataSource(),
                $connection
            );
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
