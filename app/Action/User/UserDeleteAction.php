<?php

namespace App\Action\User;

use App\Guacamole\Guacamole;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Models\User;

class UserDeleteAction {

    public function __construct(
            private readonly Guacamole $guacamole
    )
    {}

    public function __invoke(GuacamoleAuthLoginData $guacamoleAuthLoginData, User $user): ?bool
    {
        $this->guacamole->getUser()->delete($guacamoleAuthLoginData, $user->username);
        $user->delete();
        return true;
    }
}
