<?php

namespace App\ActionService\Login;

use App\Action\Login\GuacamoleAuthLogoutAction;
use App\Action\Login\SystemUserLogoutAction;
use App\Models\GuacUserData;
use App\Models\User;
use App\Responder\Responder;
use Illuminate\Support\Facades\Auth;

class UserLogoutActionService
{
    public function __construct(
            private readonly GuacamoleAuthLogoutAction $guacamoleAuthLogoutAction,
            private readonly SystemUserLogoutAction $systemUserLogoutAction,
            private readonly Responder $responder
            )
    {}

    public function __invoke()
    {
        $user = Auth::user();
        if (!is_a($user, User::class)) {
            return ($this->responder)();
        }
        $guacData = GuacUserData::where('user_id', $user->id)->get()->first;
        if ($guacData !== null) {
            ($this->guacamoleAuthLogoutAction)($guacData->token);
        }
        ($this->systemUserLogoutAction)($user);
        return ($this->responder)();
    }
}
