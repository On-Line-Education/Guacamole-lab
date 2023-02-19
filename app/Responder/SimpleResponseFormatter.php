<?php

namespace App\ResponseFormatter;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class SimpleResponseFormatter
{
    /**
     * @return JsonResponse
     */
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([
            "success" => true
        ], Response::HTTP_OK);
    }
}
