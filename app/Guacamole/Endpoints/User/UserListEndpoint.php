<?php

namespace App\Guacamole\Endpoints\User;

use App\Guacamole\Api\User\ListUserApi;
use App\Guacamole\Helpers\ApiResponseWrapper;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Guacamole\Objects\User\GuacamoleUserData;
use GuzzleHttp\Exception\GuzzleException;

class UserListEndpoint {

    public function __construct(
            private readonly ListUserApi $listUserApi,
            private readonly ApiResponseWrapper $apiResponseWrapper
    ){}

    public function __invoke(GuacamoleAuthLoginData $loginData): array
    {
        try {
            $response = ($this->listUserApi)($loginData->getAuthToken(), $loginData->getDataSource());
            $usersArray = ($this->apiResponseWrapper)($response);
            $users = [];
            foreach ($usersArray as $user) {
                $users[] = new GuacamoleUserData($user);
            }
            return $users;
        } catch (GuzzleException $exception) {
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
