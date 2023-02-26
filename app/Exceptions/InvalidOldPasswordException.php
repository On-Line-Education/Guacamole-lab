<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class InvalidOldPasswordException extends SystemException
{
    //
    public function __construct()
    {
        parent::__construct('Invalid old password', Response::HTTP_BAD_REQUEST);
    }
}
