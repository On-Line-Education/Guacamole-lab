<?php

namespace App\ActionService\User;

use App\Action\User\UserDeleteAction;
use App\Models\User;
use App\Responder\Responder;
use App\Service\GuacamoleUserLoginService;

class DeleteUserActionService
{
    public function __construct(
            private readonly GuacamoleUserLoginService $guacamoleUserLoginService,
            private readonly Responder $responder,
            private readonly UserDeleteAction $userDeleteAction
    )
    {}

    public function __invoke(User $user)
    {
        $guacAuth = ($this->guacamoleUserLoginService)();
        ($this->userDeleteAction)($guacAuth, $user);
        return ($this->responder)();
    }
}
