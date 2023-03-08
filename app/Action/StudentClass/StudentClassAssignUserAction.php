<?php

namespace App\Action\StudentClass;

use App\Models\StudentClass;
use App\Models\User;

class StudentClassAssignUserAction
{
    public function __invoke(User $user, StudentClass $class): void
    {
        $user->assignToClass($class);
    }
}
