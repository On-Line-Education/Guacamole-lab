<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class ClassroomAlreadyAssignedException extends SystemException
{
    public function __construct()
    {
        parent::__construct('Classroom already assigned', Response::HTTP_BAD_REQUEST);
    }
}
