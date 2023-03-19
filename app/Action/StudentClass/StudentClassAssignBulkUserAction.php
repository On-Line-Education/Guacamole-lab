<?php

namespace App\Action\StudentClass;

use App\Models\StudentClass;
use App\Models\StudentClasses;
use App\Models\User;

class StudentClassAssignBulkUserAction
{
    public function __invoke(StudentClass $class, ?array $users = null): void
    {
        if ($users === null) {
            return;
        }
        StudentClasses::where('student_class', $class->id)->delete();
        foreach ($users as $user) {
            User::find($user)?->assignToClass($class);
        }
    }
}
