<?php

namespace App\ActionService\StudentClass;

use App\Action\StudentClass\StudentClassGetAllAction;
use App\ActionService\AbstractActionService;
use App\Models\StudentClass;
use App\Service\GuacamoleUserLoginService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\UnauthorizedException;

class ReadStudentClassActionService extends AbstractActionService
{
    public function __construct(
            private readonly StudentClassGetAllAction $classGetAllAction
    ) {
        parent::__construct();
    }

    public function __invoke(?StudentClass $class = null)
    {
        (new GuacamoleUserLoginService())();
        $classes = [];
        
        if (!is_null($class)) {
            $classes = ['class' => $class];
        } elseif (!Auth::user()->isStudent()) {
            $classes = ['class' => ($this->classGetAllAction)()];
        } else {
            throw new UnauthorizedException();
        }

        return ($this->responder)($classes);
    }
}
