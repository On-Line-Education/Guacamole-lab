<?php

namespace App\Exceptions;

use Symfony\Component\HttpFoundation\Response;

class YouCantDoThatException extends SystemException
{
    public function __construct()
    {
        parent::__construct('You can\'t do that.', Response::HTTP_BAD_REQUEST);
    }
}
