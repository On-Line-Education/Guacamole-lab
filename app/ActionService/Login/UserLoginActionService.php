<?php

namespace App\ActionService\Login;

use App\Action\Login\GuacamoleAuthCreateLoginData;
use App\Action\Login\GuacamoleAuthLoginAction;
use App\Action\Login\SystemUserLoginAction;
use App\Exceptions\InvalidCredentialsException;
use App\Http\Requests\LoginRequest;
use App\Models\GuacUserData;
use App\Responder\Responder;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class UserLoginActionService
{
    public function __construct(
        private readonly SystemUserLoginAction        $systemUserLoginAction,
        private readonly Responder                    $responder,
        private readonly GuacamoleAuthLoginAction     $guacamoleAuthLoginAction,
        private readonly GuacamoleAuthCreateLoginData $guacamoleAuthCreateLoginData
    )
    {
    }

    public function __invoke(LoginRequest $request)
    {
        try {
            $userData = ($this->systemUserLoginAction)(
                $request->get("username"),
                $request->get("password"),
                $request->userAgent()
            );

            $guacAuth = ($this->guacamoleAuthLoginAction)($request->get("username"), $request->get("password"));
            ($this->guacamoleAuthCreateLoginData)($userData['user']->id, $guacAuth->getAuthToken(), $guacAuth->getDataSource());

            return ($this->responder)(['token' => $userData['token'], 'user' => $userData['user']]);
        } catch (InvalidCredentialsException $exception) {
            return ($this->responder)(
                status: Response::HTTP_UNAUTHORIZED,
                message: "Invalid credentials"
            );
        }
    }
}
