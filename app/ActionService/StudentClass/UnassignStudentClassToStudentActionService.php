<?php

namespace App\ActionService\StudentClass;

use App\Action\StudentClass\StudentClassUnassignUserAction;
use App\ActionService\AbstractActionService;
use App\Exceptions\NonStudentAssigmentToClassException;
use App\Models\StudentClass;
use App\Models\User;

class UnassignStudentClassToStudentActionService extends AbstractActionService
{
    public function __construct(
            private readonly StudentClassUnassignUserAction $studentClassUnassignUserAction
    ) {
        parent::__construct();
    }

    public function __invoke(User $user, StudentClass $studentClass)
    {
        if (!$user->isStudent()) {
            throw new NonStudentAssigmentToClassException();
        }
        ($this->studentClassUnassignUserAction)($user, $studentClass);
        return ($this->responder)();
    }
}
