<?php

namespace App\Action\User;

use App\Models\StudentClass;
use App\Models\StudentClasses;
use App\Models\User;

class UserBulkAssignStudentClassAssignAction
{
    public function __invoke(User $user, ?array $groups = null): void
    {
        if ($groups === null) {
            return;
        }
        StudentClasses::where('student', $user->id)->delete();
        foreach ($groups as $group) {
            $user->assignToClass(StudentClass::find($group));
        }
    }
}
