<?php

namespace App\Action\Login;

use App\Guacamole\Guacamole;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;

class GuacamoleAuthLoginAction
{

    public function __construct(
            private readonly Guacamole $guacamole
    )
    {}

    public function __invoke(string $username, string $password): GuacamoleAuthLoginData
    {
        return $this->guacamole->getAuth()->login($username, $password);
    }
}
