<?php

namespace App\ActionService\User;

use App\Action\User\UserUpdateAction;
use App\ActionService\AbstractActionService;
use App\Guacamole\Objects\User\GuacamoleUserData;
use App\Models\User;
use App\Service\GuacamoleUserLoginService;

class UpdateUserActionService extends AbstractActionService
{
    public function __construct(
        private readonly UserUpdateAction          $userUpdateAction,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService,
    ) {
        parent::__construct();
    }

    public function __invoke(User $user, array $userCreateRequestData)
    {
        $guacAuth = ($this->guacamoleUserLoginService)($user);
        $user = new GuacamoleUserData($userCreateRequestData);
        ($this->userUpdateAction)($guacAuth, $user);
        return ($this->responder)();
    }
}
