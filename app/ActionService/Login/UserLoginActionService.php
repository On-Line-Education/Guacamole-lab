<?php

namespace App\ActionService\Login;

use App\Action\Login\SystemUserLoginAction;
use App\Exceptions\InvalidCredentialsException;
use App\Http\Requests\LoginRequest;
use App\ResponseFormatter\LoginResponseFormatter;
use Symfony\Component\HttpFoundation\Response;

class UserLoginActionService
{
    public function __construct(
        protected readonly SystemUserLoginAction $systemUserLoginAction,
        protected readonly LoginResponseFormatter $loginResponseFormatter
        )
    {}

    public function __invoke(LoginRequest $request)
    {
        try {
            $userData = ($this->systemUserLoginAction)(
                $request->get("username"),
                $request->get("password"),
                $request->userAgent()
            );
            return ($this->loginResponseFormatter)($userData['token'], $userData['user']);
        } catch (InvalidCredentialsException $exception) {
            abort(Response::HTTP_UNAUTHORIZED, "Invalid credentials");
        }
    }
}
