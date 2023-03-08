<?php

namespace App\ActionService\User;

use App\Action\User\UserDeleteAction;
use App\ActionService\AbstractActionService;
use App\Models\User;
use App\Service\GuacamoleUserLoginService;
use Illuminate\Support\Facades\Auth;

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
        $currUser = Auth::user();
        $guacAuth = ($this->guacamoleUserLoginService)($currUser);
        ($this->userDeleteAction)($guacAuth, $user);
        return ($this->responder)();
    }
}
