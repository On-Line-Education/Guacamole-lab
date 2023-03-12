<?php

namespace App\Guacamole\Endpoints\Auth;

use App\Guacamole\Api\Auth\LogoutAuthApi;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Guacamole\Endpoints\ApiResponseWrapper;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\HttpFoundation\Response;

class AuthLogoutEndpoint
{

    public function __construct(
        private readonly LogoutAuthApi $logoutAuthApi,
        private readonly ApiResponseWrapper $apiResponseWrapper
    )
    {}

    public function __invoke(string $token)
    {
        try {
            $response = ($this->logoutAuthApi)($token);
            return new GuacamoleAuthLoginData(($this->apiResponseWrapper)($response));
        } catch (GuzzleException $exception) {
            if ($exception->getCode() === Response::HTTP_NOT_FOUND) {
                return new GuacamoleAuthLoginData([]);
            }
            abort($exception->getCode(), "Guacamole Api Error: " . $exception->getMessage());
        }
    }
}
