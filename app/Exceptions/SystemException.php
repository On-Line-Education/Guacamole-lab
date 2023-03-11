<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

abstract class SystemException extends Exception
{
    protected mixed $additionalData = null;
    public function render(Request $request): Response
    {
        $response = [
            'success' => false,
            'message' => $this->getMessage()
        ];

        if ($this->additionalData !== null) {
            $response['data'] = $this->additionalData;
        }

        return response($response, $this->getCode());
    }
}
