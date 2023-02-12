<?php

namespace App\ActionService\Login;

use App\Action\Login\GuacamoleAuthLoginAction;
use App\Action\Login\SystemUserLoginAction;
use App\Exceptions\InvalidCredentialsException;
use App\Http\Requests\LoginRequest;
use App\Models\GuacUserData;
use App\ResponseFormatter\Login\LoginResponseFormatter;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class UserLoginActionService
{
    public function __construct(
        protected readonly SystemUserLoginAction    $systemUserLoginAction,
        protected readonly LoginResponseFormatter   $loginResponseFormatter,
        protected readonly GuacamoleAuthLoginAction $guacamoleAuthLoginAction
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

            GuacUserData::where('user_id', $userData['user']->id)->delete();
            GuacUserData::create([
                'token' => $guacAuth->getAuthToken(),
                'user_id' => $userData['user']->id,
                'data_source' => $guacAuth->getDataSource(),
                'expires' => Carbon::now()->addHour()
            ]);

            return ($this->loginResponseFormatter)($userData['token'], $userData['user']);
        } catch (InvalidCredentialsException $exception) {
            abort(Response::HTTP_UNAUTHORIZED, "Invalid credentials");
        }
    }
}
