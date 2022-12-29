<?php

namespace App\Guacamole;

class Guacamole {
    static function getUrl() : string {
        return str_ends_with(env("GUACAMOLE_URL"), '/')
            ? env("GUACAMOLE_URL")
            : env("GUACAMOLE_URL") . "/";
    }
}
