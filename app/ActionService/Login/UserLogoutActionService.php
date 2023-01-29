<?php

namespace App\ActionService\Login;

use Illuminate\Support\Facades\Auth;

class UserLogoutActionService
{
    public function __invoke()
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json(true);
    }
}
