<?php

namespace App\ActionService\User;

use App\Action\User\UserCreateAction;
use App\Guacamole\Objects\User\GuacamoleUserData;
use App\Http\Requests\UserCreateRequest;
use App\Responder\Responder;
use App\Service\GuacamoleUserLoginService;

class CreateUserActionService
{
    public function __construct(
            private readonly UserCreateAction $userCreateAction,
            private readonly GuacamoleUserLoginService $guacamoleUserLoginService,
            private readonly Responder $responder,
    )
    {}
    public function __invoke(UserCreateRequest $userCreateRequest)
    {
        $guacAuth = ($this->guacamoleUserLoginService)();
        $user = new GuacamoleUserData($userCreateRequest->all());
        ($this->userCreateAction)($guacAuth, $user);
        return ($this->responder)();
    }
}
