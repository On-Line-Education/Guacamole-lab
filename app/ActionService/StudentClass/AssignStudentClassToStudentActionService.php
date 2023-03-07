<?php

namespace App\ActionService\StudentClass;

use App\Action\StudentClass\StudentClassAssignUserAction;
use App\ActionService\AbstractActionService;
use App\Exceptions\NonStudentAssigmentToClassException;
use App\Models\StudentClass;
use App\Models\User;

class AssignStudentClassToStudentActionService extends AbstractActionService
{
    public function __construct(
            private readonly StudentClassAssignUserAction $studentClassAssignUserAction
    ) {
        parent::__construct();
    }

    public function __invoke(User $user, StudentClass $studentClass)
    {
        if (!$user->isStudent()) {
            throw new NonStudentAssigmentToClassException();
        }
        ($this->studentClassAssignUserAction)($user, $studentClass);
        return ($this->responder)();
    }
}
