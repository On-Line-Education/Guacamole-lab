<?php

namespace App\Action\Classroom;

use App\Models\ClassRoom;
use App\Models\User;

class ClassroomAssignAction
{
    public function __invoke(ClassRoom $classRoom, User $user): User
    {
        return $user->attachToClassroom($classRoom);
    }
}
