<?php

namespace App\Guacamole;

use \ridvanaltun\Guacamole\Guacamole as GuacamoleConnection;

class GuacamoleLogin
{

    function connectUser(string $username, string $password): GuacamoleConnection
    {
         return new GuacamoleConnection(Guacamole::getUrl(), $username, $password, [
            'timeout' => 5,
            'verify' => false
        ]);
    }
}
