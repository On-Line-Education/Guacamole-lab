<?php

namespace App\Guacamole\Endpoints\ConnectionGroup;

use App\Guacamole\Api\ConnectionGroup\ListConnectionGroupApi;
use App\Guacamole\Endpoints\ApiResponseWrapper;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Guacamole\Objects\User\GuacamoleUserData;
use GuzzleHttp\Exception\GuzzleException;

class ConnectionGroupListEndpoint
{

    public function __construct(
        private readonly ListConnectionGroupApi $listConnectionGroupApi,
        private readonly ApiResponseWrapper $apiResponseWrapper
    )
    {}

    public function __invoke(GuacamoleAuthLoginData $loginData): array
    {
        try {
            $response = ($this->listConnectionGroupApi)($loginData->getAuthToken(), $loginData->getDataSource());
            return ($this->apiResponseWrapper)($response);
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
