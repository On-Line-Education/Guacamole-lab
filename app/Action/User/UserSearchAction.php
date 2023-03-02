<?php

namespace App\Action\User;

use App\Guacamole\Guacamole;
use App\Guacamole\Objects\Auth\GuacamoleAuthLoginData;
use Illuminate\Support\Collection;

class UserSearchAction
{
    public function __construct(
            private readonly Guacamole $guacamole
    )
    {}
    public function __invoke(GuacamoleAuthLoginData $guacamoleAuthLoginData, string $search)
    {
        $users = ($this->guacamole->getUser()->list($guacamoleAuthLoginData));
        return array_values(array_filter($users, function ($user) use ($search) {
            return str_contains($user->username, $search);
        }));
    }
}
