<?php

namespace App\ActionService\User;

use App\Action\User\UserUpdateAction;
use App\ActionService\AbstractActionService;
use App\Guacamole\Objects\User\GuacamoleUserData;
use App\Models\User;
use App\Service\GuacamoleUserLoginService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

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
        if (Auth::user()->isStudent() && Auth::id() !== $user->id) {
            throw new UnauthorizedException();
        }

        $guacAuth = ($this->guacamoleUserLoginService)();
        $guacUser = new GuacamoleUserData($userCreateRequestData);
        $guacUser->username = $user->username;
        ($this->userUpdateAction)($guacAuth, $guacUser);
        return ($this->responder)();
    }
}
