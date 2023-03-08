<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class ImportComputerExistsException extends SystemException
{
    public function __construct(string $name)
    {
        parent::__construct('Computer ' . $name . ' already exists.', Response::HTTP_BAD_REQUEST);
    }
}
