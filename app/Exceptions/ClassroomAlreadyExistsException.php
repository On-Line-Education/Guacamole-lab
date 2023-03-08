<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class ClassroomAlreadyExistsException extends SystemException
{
    public function __construct()
    {
        parent::__construct('Classroom already exists.', Response::HTTP_BAD_REQUEST);
    }
}
