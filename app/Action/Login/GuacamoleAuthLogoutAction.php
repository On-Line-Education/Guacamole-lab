<?php

namespace App\Action\Login;

use App\Guacamole\Guacamole;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;

class GuacamoleAuthLogoutAction {

    public function __construct(
            private readonly Guacamole $guacamole
    )
    {}

    public function __invoke(string $token): GuacamoleAuthLoginData
    {
        return $this->guacamole->getAuth()->logout($token);
    }
}