<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class InvalidCredentialsException extends SystemException
{
    //
    public function __construct()
    {
        parent::__construct('Invalid credentials', Response::HTTP_UNAUTHORIZED);
    }
}
