<?php

namespace App\Guacamole\Helpers;

use App\Guacamole\Guacamole;

class CreateSessionCoinnectionUrl
{
    public static function generateSessionConnectionUrl(int $connectionId, string $provider) : string {
        $urlBuilder = "$connectionId\0c\0$provider";

        return Guacamole::getUrl() . "guacamole/#/client/" . base64_encode($urlBuilder);
    }
}
