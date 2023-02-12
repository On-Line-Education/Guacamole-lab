<?php

namespace App\ResponseFormatter\User;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class UsersGetResponseFormatter
{
    /**
     * @return JsonResponse
     */
    public function __invoke(array $users): JsonResponse
    {
        return new JsonResponse([
                "users" => $users
        ], Response::HTTP_OK);
    }
}
