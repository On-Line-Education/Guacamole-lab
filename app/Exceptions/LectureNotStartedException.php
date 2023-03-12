<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class LectureNotStartedException extends SystemException
{
    public function __construct()
    {
        parent::__construct('Lecture is not started.', Response::HTTP_BAD_REQUEST);
    }
}
