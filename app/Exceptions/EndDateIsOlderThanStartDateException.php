<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class EndDateIsOlderThanStartDateException extends SystemException
{
    public function __construct()
    {
        parent::__construct('End date is older than start date.', Response::HTTP_BAD_REQUEST);
    }
}
