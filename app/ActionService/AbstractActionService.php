<?php

namespace App\ActionService;

use App\Responder\Responder;

abstract class AbstractActionService {
    protected readonly Responder $responder;

    public function __construct()
    {
        $this->responder = new Responder();
    }
}
