<?php

namespace App\Guacamole;

class GuacamoleHelper
{
    static function generateSessionConnectionUrl(int $connectionId, string $provider) : string {
        $urlBuilder = "$connectionId\0c\0$provider";

        return Guacamole::getUrl() . "guacamole/#/client/" . base64_encode($urlBuilder);
    }
}
