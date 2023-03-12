<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class InvalidStudentClassException extends SystemException
{
    public function __construct()
    {
        parent::__construct('Invalid student class.', Response::HTTP_BAD_REQUEST);
    }
}
