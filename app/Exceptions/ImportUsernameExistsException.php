<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class ImportUsernameExistsException extends SystemException
{
    public function __construct(string $username)
    {
        parent::__construct('User ' . $username . ' already exists.', Response::HTTP_BAD_REQUEST);
    }
}
