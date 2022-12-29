<?php

namespace App\Guacamole;

use \ridvanaltun\Guacamole\Guacamole as GuacamoleConnection;
use ridvanaltun\Guacamole\User;

class GuacamoleUser
{
    static function getUserDetails(GuacamoleConnection $userConnection, string $username) {
        $user = new User($userConnection);
        return $user->details($username);
    }
}
