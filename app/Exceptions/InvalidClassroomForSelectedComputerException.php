<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class InvalidClassroomForSelectedComputerException extends SystemException
{
    //
    public function __construct()
    {
        parent::__construct('This computer is assigned to different classroom', Response::HTTP_BAD_REQUEST);
    }
}
