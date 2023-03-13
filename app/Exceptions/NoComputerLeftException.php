<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class NoComputerLeftException extends SystemException
{
    public function __construct()
    {
        parent::__construct('Cannot assign computer. Computer pool is exhausted.', Response::HTTP_BAD_REQUEST);
    }
}
