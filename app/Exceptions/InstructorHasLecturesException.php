<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

class InstructorHasLecturesException extends SystemException
{
    //
    public function __construct(Collection $lectures)
    {
        parent::__construct(
            'Instructor already has reserved lecture at provided time range.',
            Response::HTTP_BAD_REQUEST
        );
        $this->additionalData = $lectures;
    }
}
