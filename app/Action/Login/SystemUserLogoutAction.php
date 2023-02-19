<?php

namespace App\Action\Login;

use App\Models\User;

class SystemUserLogoutAction {


    /**
     * @param User $user
     * @return array<string, User|string>
     */
    public function __invoke(User $user): array
    {
        $user->currentAccessToken()->delete();
    }

}
