<?php

namespace App\Action\StudentClass;

use App\Models\StudentClass;
use App\Models\User;

class StudentClassUnassignUserAction
{
    public function __invoke(User $user, StudentClass $studentClass): void
    {
        $user->removeFromClass($studentClass);
    }
}
