<?php

namespace App\Guacamole\Endpoints\Connection;

use App\Guacamole\Api\Connection\ListActiveConnectionApi;
use App\Guacamole\Endpoints\ApiResponseWrapper;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use GuzzleHttp\Exception\GuzzleException;

class ConnectionActiveListEndpoint
{

    public function __construct(
        private readonly ListActiveConnectionApi $listActiveConnectionApi,
        private readonly ApiResponseWrapper $apiResponseWrapper
    ) {
    }

    public function __invoke(
        GuacamoleAuthLoginData $loginData
    ) {
        try {
            $response = ($this->listActiveConnectionApi)(
                $loginData->getAuthToken(),
                $loginData->getDataSource()
            );
            return ($this->apiResponseWrapper)($response);
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
