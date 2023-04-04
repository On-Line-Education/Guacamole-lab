<?php

namespace App\Guacamole\Endpoints\Connection;

use App\Guacamole\Api\Connection\KillConnectionApi;
use App\Guacamole\Api\Connection\ListActiveConnectionApi;
use App\Guacamole\Endpoints\ApiResponseWrapper;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use GuzzleHttp\Exception\GuzzleException;

class ConnectionKillEndpoint
{

    public function __construct(
        private readonly KillConnectionApi $killConnectionApi,
        private readonly ListActiveConnectionApi $listActiveConnectionApi,
        private readonly ApiResponseWrapper $apiResponseWrapper
    ) {
    }

    public function __invoke(
        GuacamoleAuthLoginData $loginData,
        int $connection
    ): void {
        try {
            $response = ($this->listActiveConnectionApi)(
                $loginData->getAuthToken(),
                $loginData->getDataSource()
            );
            $list = ($this->apiResponseWrapper)($response);
            $connectionId = "";
            foreach ($list as $connId => $activeConnection) {
                if (intval($activeConnection['connectionIdentifier']) === $connection) {
                    $connectionId = $connId;
                    break;
                }
            }
            ($this->killConnectionApi)(
                $loginData->getAuthToken(),
                $loginData->getDataSource(),
                $connectionId
            );
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
