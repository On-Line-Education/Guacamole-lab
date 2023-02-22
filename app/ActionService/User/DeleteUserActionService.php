<?php

namespace App\ActionService\User;

use App\Action\User\UserDeleteAction;
use App\ActionService\AbstractActionService;
use App\Models\User;
use App\Service\GuacamoleUserLoginService;

class DeleteUserActionService extends AbstractActionService
{
    public function __construct(
            private readonly GuacamoleUserLoginService $guacamoleUserLoginService,
            private readonly UserDeleteAction $userDeleteAction
    ) {
        parent::__construct();
    }

    public function __invoke(User $user)
    {
        $guacAuth = ($this->guacamoleUserLoginService)($user);
        ($this->userDeleteAction)($guacAuth, $user);
        return ($this->responder)();
    }
}
