<?php

namespace App\ActionService\User;

use App\Action\User\UserCreateAction;
use App\ActionService\AbstractActionService;
use App\Guacamole\Objects\User\GuacamoleUserData;
use App\Service\GuacamoleUserLoginService;

class CreateUserActionService extends AbstractActionService
{
    public function __construct(
            private readonly UserCreateAction $userCreateAction,
            private readonly GuacamoleUserLoginService $guacamoleUserLoginService,
    )
    {}
    public function __invoke(array $userCreateRequestData)
    {
        $guacAuth = ($this->guacamoleUserLoginService)();
        $user = new GuacamoleUserData($userCreateRequestData);
        $response = ($this->userCreateAction)($guacAuth, $user);
        return ($this->responder)(['user' => $response]);
    }
}
