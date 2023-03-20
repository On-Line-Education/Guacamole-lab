<?php

namespace App\Action\StudentClass;

use App\Models\Lecture;
use App\Models\StudentClass;
use App\Models\StudentClasses;

class StudentClassDeleteAction
{
    public function __invoke(int $id): void
    {
        Lecture::where('class_id', $id)->delete();
        StudentClasses::where('student_class', $id)->delete();
        StudentClass::find($id)->delete();
    }
}
