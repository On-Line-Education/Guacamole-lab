<?php

namespace App\Action\User;

use App\Guacamole\Guacamole;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;

class UserGetAllAction
{

    public function __construct(
        private readonly Guacamole $guacamole
    )
    {}

    public function __invoke(GuacamoleAuthLoginData $guacamoleAuthLoginData): array
    {
        return ($this->guacamole->getUser()->list($guacamoleAuthLoginData));
    }
}
