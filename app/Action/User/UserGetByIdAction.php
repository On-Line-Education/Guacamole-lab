<?php

namespace App\Action\User;

use App\Guacamole\Guacamole;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;

class UserGetByIdAction {
    public function __construct(
            private readonly Guacamole $guacamole
    )
    {}
    public function __invoke(GuacamoleAuthLoginData $guacamoleAuthLoginData, string $username)
    {
        return ($this->guacamole->getUser()->get($guacamoleAuthLoginData, $username));
    }
}
