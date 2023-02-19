<?php

namespace App\ResponseFormatter\Login;

use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\JsonResponse;

class LoginResponseFormatter
{
    /**
     * @param string $token
     * @param User $user
     * @return JsonResponse
     */
    public function __invoke(string $token, User $user): JsonResponse
    {
        return new JsonResponse([
            "success" => true,
            "token" => $token,
            "user" => $user
        ], Response::HTTP_OK);
    }
}
