<?php

namespace App\ActionService\User;

use App\Action\User\GuacamoleUserCreateAction;
use App\Action\User\UserCreateAction;
use App\Action\User\UserGetAllAction;
use App\ActionService\AbstractActionService;
use App\Exceptions\UserAlreadyExistsException;
use App\Guacamole\Objects\User\GuacamoleUserData;
use App\Service\GuacamoleUserLoginService;

class CreateUserActionService extends AbstractActionService
{
    public function __construct(
        private readonly UserCreateAction $userCreateAction,
        private readonly GuacamoleUserCreateAction $guacamoleUserCreateAction,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService,
        private readonly UserGetAllAction $userGetAllAction
    ) {
        parent::__construct();
    }

    public function __invoke(array $userCreateRequestData)
    {
        $guacAuth = ($this->guacamoleUserLoginService)();
        $user = new GuacamoleUserData($userCreateRequestData);

        $usersInGuaca = ($this->userGetAllAction)($guacAuth);

        foreach ($usersInGuaca as $guacUser) {
            if (strtolower($guacUser->username) === strtolower($userCreateRequestData['username'])) {
                throw new UserAlreadyExistsException();
            }
        }

        ($this->guacamoleUserCreateAction)($guacAuth, $user);
        $sysuser = ($this->userCreateAction)(
            $userCreateRequestData['username'],
            $userCreateRequestData['password'],
            $userCreateRequestData['role']
        );
        return ($this->responder)(['user' => $sysuser->getUserWithGuacDataArray($user)]);
    }
}
