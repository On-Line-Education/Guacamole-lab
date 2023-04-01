<?php

namespace App\Action\User;

use App\Guacamole\Guacamole;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use App\Guacamole\Objects\User\GuacamoleUserData;

class GuacamoleUserCreateAction
{

    public function __construct(
        private readonly Guacamole $guacamole
    )
    {}

    public function __invoke(
        GuacamoleAuthLoginData $guacamoleAuthLoginData,
        GuacamoleUserData $user,
        bool $isInstructor = false
        ): void {
        $this->guacamole->getUser()->create($guacamoleAuthLoginData, $user, $isInstructor);
    }
}
