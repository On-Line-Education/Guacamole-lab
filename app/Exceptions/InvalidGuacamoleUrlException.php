<?php

namespace App\Exceptions;
use Symfony\Component\HttpFoundation\Response;

class InvalidGuacamoleUrlException extends SystemException
{
    //
    public function __construct()
    {
        parent::__construct('Invalid Guacamole URL', Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
