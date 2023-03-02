<?php

namespace App\Action\Classroom;

use App\Models\User;

class ClassroomUnassignAction
{
    public function __invoke(User $user): User
    {
        return $user->detachFromClassroom();
    }
}
