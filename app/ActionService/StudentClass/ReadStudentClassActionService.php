<?php

namespace App\ActionService\StudentClass;

use App\Action\StudentClass\StudentClassGetAllAction;
use App\ActionService\AbstractActionService;
use App\Models\StudentClass;

class ReadStudentClassActionService extends AbstractActionService
{
    public function __construct(
            private readonly StudentClassGetAllAction $classGetAllAction
    ) {
        parent::__construct();
    }

    public function __invoke(?StudentClass $class = null)
    {
        if (!is_null($class)) {
            $classes = ['class' => $class];
        } else {
            $classes = ['class' => ($this->classGetAllAction)()];
        }

        return ($this->responder)($classes);
    }
}
