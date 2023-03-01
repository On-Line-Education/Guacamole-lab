<?php

namespace App\Guacamole\Api\Auth;

use App\Guacamole\Api\AbstractApi;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class LogoutAuthApi extends AbstractApi
{
    /**
     * @throws GuzzleException
     */
    public function __invoke(string $token): ResponseInterface
    {
        return $this->apiClient->delete('api/tokens' . $token);
    }
}
