<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class CannotReserveLectureInThePastException extends SystemException
{
    public function __construct()
    {
        parent::__construct('Cannot reserve lecture in the past.', Response::HTTP_BAD_REQUEST);
    }
}
