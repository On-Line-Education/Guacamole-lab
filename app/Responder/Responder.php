<?php

namespace App\Responder;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class Responder
{
    /**
     * @param string|array|null $body
     * @return JsonResponse
     */
    public function __invoke(
            string|array|null $body = null,
    ): JsonResponse
    {
        $response = [
                'success' => true,
        ];
        if (!is_null($body)){
            $response['body'] = $body;
        }
        return new JsonResponse($response, Response::HTTP_OK);
    }
}
