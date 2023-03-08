<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class InvalidImportFileException extends SystemException
{
    public function __construct()
    {
        parent::__construct('Invalid Import File.', Response::HTTP_BAD_REQUEST);
    }
}
