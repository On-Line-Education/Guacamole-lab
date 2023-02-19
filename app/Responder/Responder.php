<?php

namespace App\Responder;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class Responder
{
    /**
     * @param string|array|null $body
     * @param int $status
     * @param bool $success
     * @param string|null $message
     * @return JsonResponse
     */
    public function __invoke(
            string|array|null $body = null,
            int $status = Response::HTTP_OK,
            bool $success = true,
            ?string $message = null
    ): JsonResponse
    {
        $response = [
                "success" => $success
        ];
        if ($body !== null){
            $response['body'] = $body;
        } else if ($message !== null) {
            $response['message'] = $message;
        }
        return new JsonResponse($response, $status);
    }
}
