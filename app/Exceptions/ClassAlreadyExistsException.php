<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class ClassAlreadyExistsException extends SystemException
{
    public function __construct()
    {
        parent::__construct('Class already exists.', Response::HTTP_BAD_REQUEST);
    }
}
