<?php

namespace App\ActionService\Login;

use App\Action\Login\GuacamoleAuthLogoutAction;
use App\Models\GuacUserData;
use Illuminate\Support\Facades\Auth;

class UserLogoutActionService
{
    public function __construct(
            private readonly GuacamoleAuthLogoutAction $guacamoleAuthLogoutAction
            )
    {}

    public function __invoke()
    {
        $guacData = GuacUserData::where('user_id', Auth::user()->id)->first;
        if ($guacData !== null) {
            ($this->guacamoleAuthLogoutAction)($guacData->token);
        }
        Auth::user()->currentAccessToken()->delete();
        return response()->json(true);
    }
}
