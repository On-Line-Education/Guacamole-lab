<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class UserAlreadyExistsException extends SystemException
{
    public function __construct()
    {
        parent::__construct('User already exists.', Response::HTTP_BAD_REQUEST);
    }
}
