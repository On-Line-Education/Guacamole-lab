<?php

namespace App\Action\Lecture;

use App\Models\Lecture;
use App\Models\StudentClasses;
use App\Models\User;

class LectureWithUserAction
{
    public function __invoke(Lecture $lecture, User $user): bool
    {
        $studentClasses = StudentClasses::where('student', $user->id)->get();
        foreach ($studentClasses as $sc) {
            if ($lecture->class_id === $sc->student_class) {
                return true;
            }
        }
        return false;
    }
}
