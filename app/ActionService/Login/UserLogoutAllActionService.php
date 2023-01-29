<?php

namespace App\ActionService\Login;

use Illuminate\Support\Facades\Auth;

class UserLogoutAllActionService
{
    public function __invoke()
    {
        Auth::user()->tokens()->delete();
        return response()->json(true);
    }
}
