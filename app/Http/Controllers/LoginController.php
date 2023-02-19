<?php

namespace App\Http\Controllers;

use App\ActionService\Login\UserLoginActionService;
use App\ActionService\Login\UserLogoutActionService;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

class LoginController extends Controller
{
    //
    public function __construct(
        private readonly UserLoginActionService $userLoginActionService,
        private readonly UserLogoutActionService $userLogoutActionService
    ) {}

    public function login(LoginRequest $request): JsonResponse
    {
        return ($this->userLoginActionService)($request);
    }

    public function logout(): JsonResponse
    {
        return ($this->userLogoutActionService)();
    }
}
