<?php

namespace App\ActionService\Login;

use App\Action\Login\GuacamoleAuthCreateLoginData;
use App\Action\Login\GuacamoleAuthLoginAction;
use App\Action\Login\SystemUserLoginAction;
use App\ActionService\AbstractActionService;
use App\Exceptions\InvalidCredentialsException;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;

class UserLoginActionService extends AbstractActionService
{
    public function __construct(
        private readonly SystemUserLoginAction        $systemUserLoginAction,
        private readonly GuacamoleAuthLoginAction     $guacamoleAuthLoginAction,
        private readonly GuacamoleAuthCreateLoginData $guacamoleAuthCreateLoginData
    ) {
        parent::__construct();
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws InvalidCredentialsException
     */
    public function __invoke(LoginRequest $request): JsonResponse
    {
        try {
            $userData = ($this->systemUserLoginAction)(
                $request->get('username'),
                $request->get('password'),
                $request->userAgent()
            );

            $guacAuth = ($this->guacamoleAuthLoginAction)($request->get('username'), $request->get('password'));
            ($this->guacamoleAuthCreateLoginData)($userData['user']->id, $guacAuth->getAuthToken(), $guacAuth->getDataSource());

            return ($this->responder)(['token' => $userData['token'], 'user' => $userData['user']]);
        } catch (InvalidCredentialsException $exception) {
            throw new InvalidCredentialsException();
        }
    }
}
