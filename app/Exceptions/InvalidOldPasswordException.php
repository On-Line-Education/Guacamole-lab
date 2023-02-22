<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class InvalidOldPasswordException extends Exception
{
    //
    public function __construct()
    {
        parent::__construct('Invalid old password', Response::HTTP_BAD_REQUEST);
    }
}
