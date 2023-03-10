<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class ClassHasLectureException extends SystemException
{
    //
    public function __construct()
    {
        parent::__construct('Class alredy has lecture at provided time range.', Response::HTTP_BAD_REQUEST);
    }
}
