<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class SystemException extends Exception
{
    public function render(Request $request): Response
    {
        return response([
            'success' => false,
            'message' => $this->getMessage()
        ], $this->getCode());
    }
}
