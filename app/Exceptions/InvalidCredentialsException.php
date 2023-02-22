<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class InvalidCredentialsException extends Exception
{
    //
    public function __construct()
    {
        parent::__construct('Invalid credentials', Response::HTTP_UNAUTHORIZED);
    }
}
