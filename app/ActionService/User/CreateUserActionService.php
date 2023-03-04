<?php

namespace App\ActionService\User;

use App\Action\User\GuacamoleUserCreateAction;
use App\Action\User\UserCreateAction;
use App\ActionService\AbstractActionService;
use App\Guacamole\Objects\User\GuacamoleUserData;
use App\Service\GuacamoleUserLoginService;

class CreateUserActionService extends AbstractActionService
{
    public function __construct(
        private readonly UserCreateAction $userCreateAction,
        private readonly GuacamoleUserCreateAction $guacamoleUserCreateAction,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService,
    ) {
        parent::__construct();
    }

    public function __invoke(array $userCreateRequestData)
    {
        $guacAuth = ($this->guacamoleUserLoginService)();
        $user = new GuacamoleUserData($userCreateRequestData);
        ($this->guacamoleUserCreateAction)($guacAuth, $user);
        $sysuser = ($this->userCreateAction)(
            $userCreateRequestData['username'],
            $userCreateRequestData['password'],
            $userCreateRequestData['role']
        );
        return ($this->responder)(['user' => $sysuser->getUserWithGuacDataArray($user)]);
    }
}
