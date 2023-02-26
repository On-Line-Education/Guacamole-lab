<?php

namespace App\ActionService\Login;

use App\Action\Login\GuacamoleAuthLogoutAction;
use App\Action\Login\SystemUserLogoutAction;
use App\ActionService\AbstractActionService;
use App\Models\GuacUserData;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserLogoutActionService extends AbstractActionService
{
    public function __construct(
            private readonly GuacamoleAuthLogoutAction $guacamoleAuthLogoutAction,
            private readonly SystemUserLogoutAction $systemUserLogoutAction,
    ) {
        parent::__construct();
    }

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
