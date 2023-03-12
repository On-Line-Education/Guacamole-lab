<?php

namespace App\Guacamole\Endpoints;

use Psr\Http\Message\ResponseInterface;

class ApiResponseWrapper
{
    public function __invoke(ResponseInterface $response): array
    {
        try {
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Exception $e) {
            abort($e->getCode(), $e->getMessage());
        }
    }
}
