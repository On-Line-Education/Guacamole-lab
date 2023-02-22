<?php

namespace App\ActionService\User;

use App\Action\User\UserPasswordUpdateAction;
use App\ActionService\AbstractActionService;
use App\Exceptions\InvalidOldPasswordException;
use App\Models\User;
use App\Service\GuacamoleUserLoginService;

class UpdateUserPasswordActionService extends AbstractActionService
{
    public function __construct(
        private readonly UserPasswordUpdateAction  $userPasswordUpdateAction,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService
    ) {
        parent::__construct();
    }

    public function __invoke(User $user, array $userNewPasswordRequestData)
    {
        $guacAuth = ($this->guacamoleUserLoginService)($user);

        $oldPassword = $userNewPasswordRequestData['oldPassword'];
        $newPassword = $userNewPasswordRequestData['newPassword'];
        if (!($this->userPasswordUpdateAction)($guacAuth, $user, $oldPassword, $newPassword)) {
            throw new InvalidOldPasswordException();
        }

        return ($this->responder)();
    }
}
