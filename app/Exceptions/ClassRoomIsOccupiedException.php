<?php

namespace App\Exceptions;

use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

class ClassRoomIsOccupiedException extends SystemException
{
    //
    public function __construct(Collection $lectures)
    {
        parent::__construct('Class room is occupied at provided time range.', Response::HTTP_BAD_REQUEST);
        $this->additionalData = $lectures;
    }
}
