<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class NonStudentAssigmentToClassException extends SystemException
{
    public function __construct()
    {
        parent::__construct('Only student can be assigned to class', Response::HTTP_BAD_REQUEST);
    }
}
