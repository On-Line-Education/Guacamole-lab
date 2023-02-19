<?php

namespace App\ActionService\User;

use App\Action\User\UserUpdateAction;
use App\Guacamole\Objects\User\GuacamoleUserData;
use App\Http\Requests\UserUpdateRequest;
use App\Responder\Responder;
use App\Service\GuacamoleUserLoginService;

class UpdateUserActionService
{
    public function __construct(
        private readonly UserUpdateAction          $userUpdateAction,
        private readonly GuacamoleUserLoginService $guacamoleUserLoginService,
        private readonly Responder                 $responder,
    ) {
    }

    public function __invoke(UserUpdateRequest $userCreateRequest)
    {
        $guacAuth = ($this->guacamoleUserLoginService)();
        $user = new GuacamoleUserData($userCreateRequest->all());
        ($this->userUpdateAction)($guacAuth, $user);
        return ($this->responder)();
    }
}
