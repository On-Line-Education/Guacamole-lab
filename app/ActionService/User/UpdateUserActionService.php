<?php

namespace App\ActionService\User;

use App\Action\User\UserUpdateAction;
use App\ActionService\AbstractActionService;
use App\Guacamole\Objects\User\GuacamoleUserData;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Service\GuacamoleUserLoginService;

class UpdateUserActionService extends AbstractActionService
{
    public function __construct(
        private readonly UserUpdateAction          $userUpdateAction,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService,
    ) {
    }

    public function __invoke(User $user, UserUpdateRequest $userCreateRequest)
    {
        $guacAuth = ($this->guacamoleUserLoginService)($user);
        $user = new GuacamoleUserData($userCreateRequest->all());
        ($this->userUpdateAction)($guacAuth, $user);
        return ($this->responder)();
    }
}
