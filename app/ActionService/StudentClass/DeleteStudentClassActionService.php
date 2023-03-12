<?php

namespace App\ActionService\StudentClass;

use App\Action\StudentClass\StudentClassDeleteAction;
use App\ActionService\AbstractActionService;
use App\Models\StudentClass;
use App\Service\GuacamoleUserLoginService;

class DeleteStudentClassActionService extends AbstractActionService
{
    public function __construct(
            private readonly StudentClassDeleteAction $classDeleteAction
    ) {
        parent::__construct();
    }

    public function __invoke(StudentClass $class)
    {
        (new GuacamoleUserLoginService())();
        ($this->classDeleteAction)($class->id);
        return ($this->responder)();
    }
}
